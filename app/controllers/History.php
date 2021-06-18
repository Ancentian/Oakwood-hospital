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
class History extends BASE_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('user_aob')) {
            $this->session->set_flashdata('error-msg', "You must login to continue!");
            redirect('user/index');
        }
        $this->load->model('history_model');
        $this->load->model('queue_model');
        $this->load->model('patients_model');
        $this->load->model('inpatient_model');
        $this->load->model('lab_model');
        $this->load->model('radiology_model');
        $this->load->model('pharmacy_model');
        $this->load->model('wards_model');
        $this->load->model('payments_model');

    }

    function search()
    {
        $this->data['pg_title'] = "Search";
        $this->data['page_content'] = 'history/search';
        $this->load->view('layout/template', $this->data);
    }

    function select()
    {
        $forminput = $this->input->post();
        $this->data['patients'] = $this->queue_model->search($forminput);

        if (!$this->data['patients']) {
            $this->session->set_flashdata('error-msg', 'No records found');
            redirect('history/search');
        }
        $this->data['pg_title'] = "Select";
        $this->data['page_content'] = 'history/select';
        $this->load->view('layout/template', $this->data);
    }

    function patient_history(int $id)
    {
        $this->data['patient_details'] = $this->patients_model->fetch_byId($id)[0];
        $this->data['history'] = $this->history_model->fetch_tickets($id);

        $this->data['pg_title'] = "History";
        $this->data['page_content'] = 'history/index';
        $this->load->view('layout/template', $this->data);
    }
    function payments()
    {
        $this->data['phistory'] = $this->history_model->payments();

        $this->data['pg_title'] = "History";
        $this->data['page_content'] = 'history/payments';
        $this->load->view('layout/template', $this->data);
    }

    function print_patientHistory(int $tickid, int $mvtid)
    {
        $labdetails_t = $this->queue_model->ticket_labdetails_p($tickid);
        $radiologydetails_t = $this->queue_model->ticket_radiologydetails_p($tickid);
        $medicationdetails_t = $this->queue_model->ticket_prescription_p($tickid);
        $totlab = 0;
        $totmed = 0;
        $totrad = 0;
        $totpaid = 0;
        $miscdetails = $this->queue_model->mother_child_total($tickid);
        $totmisc = 0;
        foreach ($miscdetails as $one) {
            $totmisc += $one['amount'];
        }

        foreach ($labdetails_t as $labdetail) {
            $totlab += $labdetail['cost'];
        }

        foreach ($medicationdetails_t as $key){
            $totmed += ($key['units'] * $key['cost']);
        }

        foreach($radiologydetails_t as $key){
            $totrad += $key['cost'];
        }

        $phistory = $this->payments_model->fetch($tickid);

        foreach ($phistory as $one){
            $totpaid += $one['amount'];
        }

        $totcons = $this->queue_model->ticket_details($tickid)['cons_fee'];
        $this->data['totaldue'] = $totrad + $totlab + $totmed + $totcons-$totpaid + $totmisc;
        $ticket_details = $this->queue_model->ticket_details($tickid); 
        $this->data['ticket_details'] = $this->queue_model->fetch_mvt($mvtid);
        $this->data['anc_details'] = $this->queue_model->fetch_anc_details($ticket_details['patient_id']);
        $anc = $this->queue_model->fetch_anc_details($ticket_details['patient_id']);
        $this->data['subsequent_anc'] = $this->queue_model->fetch_subsequent_anc($anc['id']);
        // $this->data['anc_details'] = $this->queue_model->ticket_anc_details($tickid);
        $mvtdetails = $this->data['ticket_details'];

        $ticketdata = $this->queue_model->fetch_ticket($tickid);

        $data['patientdetails'] = $this->patients_model->fetch_byId($ticketdata['patient_id'])[0];
        $data['labdetails'] = $this->queue_model->ticket_labdetails($tickid);
        $data['radiologydetails'] = $this->queue_model->ticket_radiologydetails($tickid);
        $data['triagedetails'] = $this->queue_model->ticket_triage($tickid);
        $data['admissiondetails'] = $this->queue_model->ticket_admission($tickid);
        $data['diagnosisdetails'] = $this->queue_model->ticket_diagnosis($tickid);
        $data['medicationdetails'] = $this->queue_model->ticket_prescription($tickid);
        $data['appointmentdetails'] = $this->queue_model->ticket_appointment($tickid);
        $data['nursing_cadex'] = $this->inpatient_model->fetch_nursingCadex($tickid);
        $data['observations'] = $this->inpatient_model->fetch_Observations($tickid);
        $data['transfusions'] = $this->inpatient_model->fetch_transfusions($tickid);
        $data['costs'] = $this->inpatient_model->fetch_costs($tickid);
        $data['nursing_care'] = $this->inpatient_model->fetch_nursingCare($tickid);
        $data['ticket_id'] = $tickid;
        

        // boost the memory limit if it's low ;)
        ini_set('memory_limit', '64M');
        // load library
        $this->load->library('pdf');
        $this->pheight = 0;
        $this->load->library('pdf');
        $pdf = $this->pdf->load();
        // retrieve data from model or just static date
        $data['title'] = "items";
        $pdf->allow_charset_conversion = true;  // Set by default to TRUE
        $pdf->charset_in = 'UTF-8';
        //   $pdf->SetDirectionality('rtl'); // Set lang direction for rtl lang
        $pdf->autoLangToFont = true;
        $html = $this->load->view('printfiles/patient-history', $data, true);
        $h = 160 + $this->pheight;
        //  $pdf->_setPageSize(array(70, $h), $this->orientation);
        // $pdf->_setPageSize(array(280, $h), $pdf->DefOrientation);
        $pdf->WriteHTML($html);
        // render the view into HTML
        // write the HTML into the PDF
        $file_name = preg_replace('/[^A-Za-z0-9]+/', '-', 'ThermalInvoice_' . $tickid);
        if ($this->input->get('d')) {
            $pdf->Output($file_name . '.pdf', 'D');
        } else {
            $pdf->Output($file_name . '.pdf', 'I');
        }

        unlink('userfiles/pos_temp/' . $data['qrc']);
    }
}