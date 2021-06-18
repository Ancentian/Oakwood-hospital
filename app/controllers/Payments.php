<?php
if (!defined('BASEPATH'))
    exit ('No direct script access allowed');

/**
 * @property CI_Session $session
 * @property CI_Input $input
 * @property CI_URI $uri
 * @property CI_Config $config
 * @property CI_DB_mysqli_driver $db
 * @property CI_Form_validation $form_validation
 * @property CI_Security $security
 *
 * This class manages all user module related functions.
 * Data is managed by sending CURL requests to the API; to the relevant endpoint
 */
class Payments extends BASE_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('user_aob')) {
            $this->session->set_flashdata('error-msg', "You must login to continue!");
            redirect('user/index');
        }
        $this->load->model('payments_model');
        $this->load->model('queue_model');
        $this->load->model('patients_model');
        $this->load->model('settings_model');

    }

    function search()
    {
        $this->data['pg_title'] = "Search";
        $this->data['page_content'] = 'payments/search';
        $this->load->view('layout/template', $this->data);
    }

    function select()
    {
        $forminput = $this->input->post();
        $this->data['patients'] = $this->queue_model->search($forminput);

        if (!$this->data['patients']) {
            $this->session->set_flashdata('error-msg', 'No records found');
            redirect('payments/search');
        }
        $this->data['pg_title'] = "Select";
        $this->data['page_content'] = 'payments/select';
        $this->load->view('layout/template', $this->data);
    }

    function patient_history(int $id)
    {
        $this->data['patient_details'] = $this->patients_model->fetch_byId($id)[0];
        $this->data['history'] = $this->payments_model->fetch_tickets($id);

        $this->data['pg_title'] = "History";
        $this->data['page_content'] = 'payments/index';
        $this->load->view('layout/template', $this->data);
    }

    function add()
    {
        $forminput = $this->input->post();
//        var_dump($forminput);
        $inserted = $this->payments_model->add($forminput);
        if ($inserted > 0) {
            $this->session->set_flashdata('success-msg', 'Success!');
        } else {
            $this->session->set_flashdata('error-msg', 'Failed, please try again');
        }
        redirect('queue/pmt_details/'.$forminput["ticket_id"].'/0');
    }
    function delete(int $id,int $tickid)
    {
         $inserted = $this->payments_model->delete($id);
        if ($inserted > 0) {
            $this->session->set_flashdata('success-msg', 'Success!');
        } else {
            $this->session->set_flashdata('error-msg', 'Failed, please try again');
        }
        redirect('queue/pmt_details/'.$tickid.'/0');
    }
    function h_delete(int $id)
    {
         $inserted = $this->payments_model->delete($id);
        if ($inserted > 0) {
            $this->session->set_flashdata('success-msg', 'Success!');
        } else {
            $this->session->set_flashdata('error-msg', 'Failed, please try again');
        }
        redirect('history/payments');
    }

    function r_print(int $id, int $tickid)
    {   
        $labdetails = $this->queue_model->ticket_labdetails_p($tickid);
        $radiologydetails = $this->queue_model->ticket_radiologydetails_p($tickid);
        $medicationdetails = $this->queue_model->ticket_prescription_p($tickid);
        $totlab = 0;
        $totmed = 0;
        $totrad = 0;
        $totpaid = 0;
        
        //discount
        $discount = $this->settings_model->fetch_discounts();//Defined discount
        //$discgiven = $discount['discount'];
        //End Discount

        $miscdetails = $this->queue_model->mother_child_total($tickid);
        $totmisc = 0;
        $rsbpayment = $this->queue_model->ticket_triage($tickid);
        $totrsb = $rsbpayment['rsb'];
        //var_dump($totrsb);die;

        foreach ($miscdetails as $one) {
            $totmisc += $one['amount'];
        }
        foreach ($labdetails as $labdetail) {
            $totlab += $labdetail['cost'];
        }

        foreach ($medicationdetails as $key){
            $totmed += ($key['units'] * $key['cost']);
        }

        foreach($radiologydetails as $key){
            $totrad += $key['cost'];
        }

        $phistory = $this->payments_model->fetch($tickid);

        foreach ($phistory as $one){
            $totpaid += $one['amount'];
        }

        $data['totpaid'] = $totpaid;
        //$data['discount'] = $discgiven;
        $data['ticketdetails'] = $this->queue_model->ticket_details($tickid);
        $data['receipt'] = $this->payments_model->fetchbyreceipt($id);
        $totcons = $this->queue_model->ticket_details($tickid)['cons_fee'];
        $data['totmisc'] = $totmisc;
        $data['total'] = ($totrad + $totlab + $totmed + $totcons + $totmisc + $totrsb) - $discgiven;
//        echo $this->data['total'];die;
        // boost the memory limit if it's low ;)
        ini_set('memory_limit', '64M');
        // load library
        $this->load->library('pdf');
        $this->pheight = 0;
        $this->load->library('pdf');
        $pdf = $this->pdf->load_thermal();
        // retrieve data from model or just static date
        $data['title'] = "items";
        $pdf->allow_charset_conversion = true;  // Set by default to TRUE
        $pdf->charset_in = 'UTF-8';
        //   $pdf->SetDirectionality('rtl'); // Set lang direction for rtl lang
        $pdf->autoLangToFont = true;
        $html = $this->load->view('printfiles/receipt', $data, true);
        $h = 160 + $this->pheight;
        //  $pdf->_setPageSize(array(70, $h), $this->orientation);
        $pdf->_setPageSize(array(70, $h), $pdf->DefOrientation);
        $pdf->WriteHTML($html);
        // render the view into HTML
        // write the HTML into the PDF
        $file_name = preg_replace('/[^A-Za-z0-9]+/', '-', 'ThermalInvoice_' . $tid);
        if ($this->input->get('d')) {
            $pdf->Output($file_name . '.pdf', 'D');
        } else {
            $pdf->Output($file_name . '.pdf', 'I');
        }

        unlink('userfiles/temp/' . $data['qrc']);
    }

    function i_print(int $tickid)
    {
        $labdetails = $this->queue_model->ticket_labdetails_p($tickid);
        $radiologydetails = $this->queue_model->ticket_radiologydetails_p($tickid);
        $medicationdetails = $this->queue_model->ticket_prescription_p($tickid);
        $totlab = 0;
        $totmed = 0;
        $totrad = 0;
        $totpaid = 0;
        $miscdetails = $this->queue_model->mother_child_total($tickid);
        $totmisc = 0;

        $rsbpayment = $this->queue_model->ticket_triage($tickid);
        $totrsb = $rsbpayment['rsb'];
        //var_dump($totrsb);die;
        foreach ($miscdetails as $one) {
            $totmisc += $one['amount'];
        }

        foreach ($labdetails as $labdetail) {
            $totlab += $labdetail['cost'];
        }

        foreach ($medicationdetails as $key){
            $totmed += ($key['units'] * $key['cost']);
        }

        foreach($radiologydetails as $key){
            $totrad += $key['cost'];
        }

        $phistory = $this->payments_model->fetch($tickid);

        foreach ($phistory as $one){
            $totpaid += $one['amount'];
        }

        $data['ticketdetails'] = $this->queue_model->ticket_details($tickid);
        $data['totpaid'] = $totpaid;
        $data['totmed'] = $totmed;
        $data['totrad'] = $totrad;
        $data['totlab'] = $totlab;
        $data['totmisc'] = $totmisc;
        $data['miscdetails'] = $miscdetails;
        $data['totrsb'] = $totrsb;
        $data['totcons'] = $this->queue_model->ticket_details($tickid)['cons_fee'];

        $data['invoice'] = $this->queue_model->ticket_details($tickid);

        $data['total'] = $totrad + $totlab + $totmed + $data['totcons'] + $totmisc + $totrsb;
//        echo $this->data['total'];die;
        // boost the memory limit if it's low ;)
        ini_set('memory_limit', '64M');
        // load library
        $this->load->library('pdf');
        $this->pheight = 0;
        $this->load->library('pdf');
        $pdf = $this->pdf->load_thermal();
        // retrieve data from model or just static date
        $data['title'] = "items";
        $pdf->allow_charset_conversion = true;  // Set by default to TRUE
        $pdf->charset_in = 'UTF-8';
        //   $pdf->SetDirectionality('rtl'); // Set lang direction for rtl lang
        $pdf->autoLangToFont = true;
        $html = $this->load->view('printfiles/invoice', $data, true);
        $h = 160 + $this->pheight;
        //  $pdf->_setPageSize(array(70, $h), $this->orientation);
        $pdf->_setPageSize(array(70, $h), $pdf->DefOrientation);
        $pdf->WriteHTML($html);
        // render the view into HTML
        // write the HTML into the PDF
        $file_name = preg_replace('/[^A-Za-z0-9]+/', '-', 'ThermalInvoice_' . $tid);
        if ($this->input->get('d')) {
            $pdf->Output($file_name . '.pdf', 'D');
        } else {
            $pdf->Output($file_name . '.pdf', 'I');
        }

        unlink('userfiles/temp/' . $data['qrc']);
    }
}