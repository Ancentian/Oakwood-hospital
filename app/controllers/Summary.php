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
class Summary extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('pos_model');
        $this->load->model('send_message');
        $this->load->model('settings_model');
        $this->load->model('summary_model');
    }

    public function summaryReport()
    {
        $salesdata = $this->pos_model->daily_smsReports();
        $totcash = $this->pos_model->cash_summary();
        $totmpesa = $this->pos_model->mpesa_summary();
        $totcheque = $this->pos_model->cheque_summary();
        $totamount_payable = $this->pos_model->totalPayable();
        $totamount = $this->pos_model->totalPaid();
        //Patients
        $ibp =  $this->summary_model->admitted_patients();
        $patients_today = $this->summary_model->patients_today();
        $outpatients = $patients_today-$ibp;

        $discharge =  "0";
        $referral = "0";
        $abscond ="0";

        //var_dump($patients_today);die;

         //var_dump($totamount_payable);die;
        $debt = abs($totamount_payable - $totamount);

        //var_dump($debt);die;

        $time = date("h:i:sa");

        //var_dump($time);die;

        $smsadmins = $this->settings_model->fetch_admin();

        $rec = $smsadmins['recipients'];
        $rec = explode(',', $rec);

        $msg = "Dear Director, kindly receive Oakwood current automated daily reports as at $time
Today's Patients $patients_today
Outpatients $outpatients
Inpatients $ibp
Discharge $discharge
Referral $referral
Deaths $abscond

Grand total kshs. $salesdata
Cash Kshs. $totcash 
Mpesa Kshs. $totmpesa 
Cheque kshs. $totcheque ";
        //var_dump($msg);die;

        foreach ($rec as $one) {
            $this->send_message->send($msg, $one);
        }

        //redirect('pos/index');
    }

    

}