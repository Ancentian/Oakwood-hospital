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
class Pos extends BASE_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('user_aob')) {
            $this->session->set_flashdata('error-msg', "You must login to continue!");
            redirect('user/index');
        }
        $this->load->model('patients_model');
        $this->load->model('pos_model');
        $this->load->model('pharmacy_model');
        $this->load->model('send_message');
        $this->load->model('finance_model');
        $this->load->model('settings_model');

    }
    
    public function addItems()
    {
        $prodArr = $this->pharmacy_model->fetch_medicine();
        foreach($prodArr as $one){
            $data = array(
                'name' => $one['name'],
                'acc_no' => 1,
                'type' => "Product"
            );
            $this->finance_model->add_product($data);
        }
        
        echo "done";
    }

    function index()
    {    
        $this->data['accounts'] = $this->finance_model->fetch_feesAcc();
        $this->data['is_pos'] = TRUE;
        $this->data['prodArr'] = $this->pharmacy_model->fetch_medicine();
        $this->data['clientArr'] = $this->pos_model->fetchPatients();
        // $duesJson = json_encode($dues);
        $this->data['dueArr'] = json_encode($this->pos_model->patientDues($this->data['clientArr']));
        
        // $this->data['phistory'] = $this->history_model->payments();

        $this->data['pg_title'] = "POS";
        $this->data['page_content'] = 'pos/index';
        $this->load->view('layout/pos-template', $this->data);
    }
    function collectpayment()
    {        
        $this->data['clientArr'] = $this->pos_model->fetchPatients();
        $this->data['dueArr'] = $this->pos_model->patientDues($this->data['clientArr']);

        $this->data['pg_title'] = "POS";
        $this->data['page_content'] = 'pos/collectpayment';
        $this->load->view('layout/template', $this->data);
    }
    public function payments()
    {        
        $this->data['pmts'] = $this->pos_model->fetchPayments();
        $this->data['pg_title'] = "POS";
        $this->data['page_content'] = 'pos/payments';
        $this->load->view('layout/template', $this->data);
    }
    public function editpayments($id)
    {       
        $this->data['id'] = $id; 
        $this->data['pmts'] = $this->pos_model->fetchPaymentsID($id);
        $this->data['pg_title'] = "POS";
        $this->data['page_content'] = 'pos/editpayments';
        $this->load->view('layout/template', $this->data);
    }
    public function addpmt($id)
    {       
        $this->data['id'] = $id; 
        $this->data['pg_title'] = "POS";
        $this->data['page_content'] = 'pos/addpmt';
        $this->load->view('layout/template', $this->data);
    }
    public function addpmt_post($id)
    {       
        $forminput = $this->input->post();
        $insert_id = $this->pos_model->addpmt($id,$forminput);

        if ($insert_id > 0) {
            redirect('pos/printpmt/'.$insert_id);
        }else{
            redirect('pos/collectpayment');
        }
        
    }
    public function viewinvoice($id)
    {       
        $this->data['id'] = $id; 
        $this->data['pmts'] = $this->pos_model->fetchInvoicesID($id);
        $this->data['pg_title'] = "POS";
        $this->data['page_content'] = 'pos/viewinvoice';
        $this->load->view('layout/template', $this->data);
    }

    public function printinvoice($id)
    {       
        $data['receipt'] = $this->pos_model->fetchInvoicesID($id);
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
        $html = $this->load->view('printfiles/pos-invoice', $data, true);
        $h = 160 + $this->pheight;
        //  $pdf->_setPageSize(array(70, $h), $this->orientation);
        $pdf->_setPageSize(array(70, $h), $pdf->DefOrientation);
        $pdf->WriteHTML($html);
        // render the view into HTML
        // write the HTML into the PDF
        $file_name = preg_replace('/[^A-Za-z0-9]+/', '-', 'POS_Invoice_' . $tid);
        if ($this->input->get('d')) {
            $pdf->Output($file_name . '.pdf', 'D');
        } else {
            $pdf->Output($file_name . '.pdf', 'I');
        }

        unlink('userfiles/temp/' . $data['qrc']);
    }
    public function printpmt($id)
    {       
        $data['pmts'] = $this->pos_model->fetchPaymentsID($id);
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
        $html = $this->load->view('printfiles/pos-receipt', $data, true);
        $h = 160 + $this->pheight;
        //  $pdf->_setPageSize(array(70, $h), $this->orientation);
        $pdf->_setPageSize(array(70, $h), $pdf->DefOrientation);
        $pdf->WriteHTML($html);
        // render the view into HTML
        // write the HTML into the PDF
        $file_name = preg_replace('/[^A-Za-z0-9]+/', '-', 'POS_Invoice_' . $tid);
        if ($this->input->get('d')) {
            $pdf->Output($file_name . '.pdf', 'D');
        } else {
            $pdf->Output($file_name . '.pdf', 'I');
        }

        unlink('userfiles/temp/' . $data['qrc']);
    }
    public function invoices()
    {       
        $this->data['invs'] = $this->pos_model->fetchInvoices();
        $this->data['pg_title'] = "POS";
        $this->data['page_content'] = 'pos/invoices';
        $this->load->view('layout/template', $this->data);
    }
    public function editpayments_post($id)
    {       
        $forminput = $this->input->post();
        $this->pos_model->updatePmt($id,$forminput);

        redirect('pos/payments');
    }
    public function sell($int)
    {
        $forminput = $this->input->post();
        $client = $forminput['cName'];
        $particulars = $forminput['ordDetails'];
        $amtPaid = $forminput['amtPaid'];
        $prevDue = $forminput['prevDue'];
        $amtDue = $forminput['amtDue'];
        $disc = $forminput['discount'];
        $pmtType = $forminput['pmtType'];
        $stockData = array();
        $amtPayable = 0;

        foreach (json_decode($particulars,true) as $one) {
            $stockData[] = array("product" => $one['prodId'],"qty" => $one['prodQty']);
            $amtPayable += $one['prodCost'] * $one['prodQty'];

        }
        $pmtData = array("amount" => $amtPaid, "mode" => $pmtType,"pid" => $client);
        $invData = array("client_id" => $client, "amount_payable" => $amtPayable-$disc, "discount" => $disc, "particulars" => $particulars);

        $this->pos_model->sell($stockData,$pmtData,$invData);

        redirect('pos');
    }

    public function sellprint($int)
    {
        $forminput = $this->input->post();
        $client = $forminput['cName'];
        $particulars = $forminput['ordDetails'];
        $amtPaid = $forminput['amtPaid'];
        $prevDue = $forminput['prevDue'];
        $amtDue = $forminput['amtDue'];
        $disc = $forminput['discount'];
        $pmtType = $forminput['pmtType'];
        $stockData = array();
        $amtPayable = 0;

        foreach (json_decode($particulars,true) as $one) {
            $stockData[] = array("product" => $one['prodId'],"qty" => $one['prodQty']);
            $amtPayable += $one['prodCost'] * $one['prodQty'];

        }
        $pmtData = array("amount" => $amtPaid, "mode" => $pmtType,"pid" => $client);
        $invData = array("client_id" => $client, "amount_payable" => $amtPayable-$disc, "discount" => $disc, "particulars" => $particulars);

        $resp = $this->pos_model->sell($stockData,$pmtData,$invData);

        if($resp != FALSE){
            redirect('pos/printinvoice/'.$resp);
        }else{
            redirect('pos');
        }

    }
    public function deletepayments($id)
    {
        $this->pos_model->deletepayments($id);
        redirect('pos/payments');
    }
    public function deleteinvoice($id)
    {
        $this->pos_model->deleteInvoice($id);
        redirect('pos/invoices');
    }

    public function summaryReport()
    {
        $salesdata = $this->pos_model->daily_smsReports();
        $totcash = $this->pos_model->cash_summary();
        $totmpesa = $this->pos_model->mpesa_summary();
        $totcheque = $this->pos_model->cheque_summary();
        //$mostselling = $this->pos_model->most_selling();
        $time = date("h:i:sa");

        $smsadmins = $this->settings_model->fetch_admin();

        $rec = $smsadmins['recipients'];
        $rec = explode(',', $rec);

        $msg = "Dear Director, kindly receive F-Tiba current automated daily reports as at $time
Cash Kshs. $totcash 
Mpesa Kshs. $totmpesa 
Cheque kshs. $totcheque
Grand total kshs. $salesdata/= ";
        //var_dump($msg);die;

        foreach ($rec as $one) {
            $this->send_message->send($msg, $one);
        }

        redirect('pos/index');
    }
}