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
class Reports extends BASE_Controller
{
    public function __construct()
    {
        parent::__construct();
        
        $this->load->model('patients_model');
        $this->load->model('users_model');
        $this->load->model('summary_model');
        $this->load->model('send_message');

    }

    /*
     * Default method for this controller - Login
     */
    function index()
    {
        $todaysincome = $this->summary_model->all_todays_income();
        $ptoday = $this->summary_model->patients_today();
        $till = 0;
        $cash = 0;

        // var_dump($todaysincome);die;

        foreach ($todaysincome as $key) {
            if($key['mode'] == 'mpesa'){
                $till += $key['amount'];
            }
            if($key['mode'] == 'cash'){
                $cash+= $key['amount'];
            }
        }

        $ibp = $this->summary_model->admitted_patients();
        $ibptoday = 0;
        foreach ($ibp as $key) {
            if(date('Y-m-d',strtotime($ibp['created_at']))==date('Y-m-d')){
                $ibptoday ++;
            }
        }
       $total = $cash+$till;
        $msg = "Dear Director, Please receive automated Daily Report for Oakwood Hospital: 
Cash at hand (Kshs. ".$cash." ), Till No. (Kshs. ".$till." ), Total Inpatients: ".sizeof($ibp)." ,Total Admitted: ".$ibptoday.". Total Income Kshs. ".$total;
// echo $msg;die;

 $this->send_message->send($msg,"0717576900");
    }

}