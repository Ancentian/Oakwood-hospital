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
class Queue extends BASE_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('user_aob')) {
            $this->session->set_flashdata('error-msg', "You must login to continue!");
            redirect('user/index');
        }
        $this->load->model('queue_model');
        $this->load->model('lab_model');
        $this->load->model('radiology_model');
        $this->load->model('pharmacy_model');
        $this->load->model('patients_model');
        $this->load->model('wards_model');
        $this->load->model('payments_model');
        $this->load->model('settings_model');

    }

    function search()
    {
        $this->data['pg_title'] = "Search";
        $this->data['page_content'] = 'queue/search';
        $this->load->view('layout/template', $this->data);
    }

    function direct_queue(int $pid)
    {
        $this->data['special'] = $this->settings_model->fetch_specialConsultationFee();
        $this->data['pid']  = $pid;
        $this->data['pg_title'] = "Select";
        $this->data['page_content'] = 'queue/direct_queue';
        $this->load->view('layout/template', $this->data);
    }

    function select()
    {
        $this->data['special'] = $this->settings_model->fetch_specialConsultationFee();
        $this->data['radiology'] = $this->radiology_model->fetch_radiology_screening();
        $this->data['labtests'] = $this->lab_model->fetch_lab_tests();
        $forminput = $this->input->post();
        $this->data['patients'] = $this->queue_model->search($forminput);

        if (!$this->data['patients']) {
            $this->session->set_flashdata('error-msg', 'No records found');
            redirect('queue/search');
        }
        $this->data['pg_title'] = "Select";
        $this->data['page_content'] = 'queue/select';
        $this->load->view('layout/template', $this->data);

    }

    function add_triage(int $id, $mvtid)
    {
        $tickid = $id;
        $labdetails = $this->queue_model->ticket_labdetails_p($tickid);
        $radiologydetails = $this->queue_model->ticket_radiologydetails_p($tickid);
        $medicationdetails = $this->queue_model->ticket_prescription_p($tickid);
        $this->data['triage'] = $this->queue_model->ticket_triage($tickid); 
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

        $totcons = $this->queue_model->ticket_details($id)['cons_fee'];
        $this->data['totaldue'] = $totrad + $totlab + $totmed + $totcons-$totpaid + $totmisc + $totmisc + $totrsb;

        $this->data['ticket_details'] = $this->queue_model->ticket_details($id);
        $this->data['medicine'] = $this->pharmacy_model->fetch_medicine();
        $this->data['ticket_id'] = $id;
        $this->data['mvtid'] = $mvtid;
        $this->data['pg_title'] = "Add Triage";
        $this->data['page_content'] = 'queue/add_triage';
        $this->load->view('layout/template', $this->data);

    }

    function admit_save(int $mvtid)
    {
        $forminput = $this->input->post();
        $tickid = $forminput['ticket_id'];
        $diag = $this->queue_model->all_diagnosis($tickid);
        if ($diag) {


        } else {
            $this->session->set_flashdata('error-msg', 'You must add a diagnosis first before you perform this action!');
            redirect('queue/myqueue');
        }
        $ticketdata = $this->queue_model->fetch_ticket($tickid);
        $adm_data = ["ticket_id" => $forminput['ticket_id'], "ward_id" => $forminput['ward'], "admitted_by" => $this->session->userdata('user_aob')->id, "comments" => $forminput['notes']];
        $patient_id = $ticketdata['patient_id'];
        $tick_update = ['status' => '2'];
        $patient_update = ['type' => 'ibp'];
        $mvt_data = ['status' => 'seen', 'seen_by' => $this->session->userdata('user_aob')->id];
        // echo $mvtid;die;
        $inserted = $this->queue_model->admit($adm_data, $tick_update, $patient_update, $patient_id, $forminput['ticket_id'], $mvt_data, $mvtid);
        // echo $inserted;die;
        if ($inserted > 0) {
            $this->session->set_flashdata('success-msg', 'Success!');
        } else {
            $this->session->set_flashdata('error-msg', 'Failed, please try again');
        }
        redirect('queue/myqueue');

    }


    function diagnose_save(int $mvtid)
    {

        $forminput = $this->input->post();

        // var_dump($forminput);die;

        $data = ['ticket_id' => $forminput['ticket_id'], 'diagnosis' => $forminput['diagnosis'], 'diagnosed_by' => $this->session->userdata('user_aob')->id,'clinical_history' => $forminput['clinical_history'],'physical_findings' => $forminput['physical_findings']];

        $inserted = $this->queue_model->diagnose($data, $mvtid);
        if ($inserted > 0) {
            $this->session->set_flashdata('success-msg', 'Success!');
        } else {
            $this->session->set_flashdata('error-msg', 'Failed, please try again');
        }
        redirect('queue/consultation_send/'.$forminput['ticket_id'].'/'.$mvtid);

    }

    function appoint_save(int $mvtid)
    {
        $forminput = $this->input->post();
        $tickid = $forminput['ticket_id'];
        $diag = $this->queue_model->all_diagnosis($tickid);
        // var_dump($tickid);die;
        if ($diag) {

        } else {
            $this->session->set_flashdata('error-msg', 'You must add a diagnosis first before you perform this action!');
            redirect('queue/myqueue');
        }
        $ticketdata = $this->queue_model->fetch_ticket($tickid);
        $app_data = ["ticket_id" => $forminput['ticket_id'], "appointment_date" => $forminput['time'], "appointed_by" => $this->session->userdata('user_aob')->id, "comments" => $forminput['notes'], 'status' => 'pending'];
        $patient_id = $ticketdata['patient_id'];
        $tick_update = ['status' => '1'];
        $mvt_data = ['status' => 'seen', 'seen_by' => $this->session->userdata('user_aob')->id];
        // echo $mvtid;die;
        $inserted = $this->queue_model->appoint($app_data, $tick_update, $forminput['ticket_id'], $mvt_data, $mvtid);
        if ($inserted > 0) {
            $this->session->set_flashdata('success-msg', 'Success!');
        } else {
            $this->session->set_flashdata('error-msg', 'Failed, please try again');
        }
        redirect('queue/myqueue');

    }

    function discharge(int $tickid, int $mvtid)
    {

        $tick_update = ['status' => '1'];
        $mvt_data = ['status' => 'seen', 'seen_by' => $this->session->userdata('user_aob')->id];
        // echo $mvtid;die;
        $inserted = $this->queue_model->discharge($tick_update, $forminput['ticket_id'], $mvt_data, $mvtid);
        if ($inserted > 0) {
            $this->session->set_flashdata('success-msg', 'Success!');
        } else {
            $this->session->set_flashdata('error-msg', 'Failed, please try again');
        }
        redirect('queue/myqueue');

    }

    function save_triage(int $mvtid)
    {
        $forminput = $this->input->post();
        // $consultation_dpt = $this->dpt_byActivity(2);
        $arrindex = array_keys($forminput);
        if($forminput['pharma_direct'] == "yes"){
          $medicine = [];
         foreach ($arrindex as $key) {
                // echo substr($key, 0,8);
                if (substr($key, 0, 8) == 'medicine') {
                    $medicine[] = explode('_', $key)[1];
                }

            }
            $consultation_dpt = $this->dpt_byActivity(11);  
            $activity = 11;
        }else{
            $consultation_dpt = $this->dpt_byActivity(2);
            $activity = 2;
        }
        
        // var_dump($medicine);die;
        $prevAct_update = ['status' => 'seen', 'triage_status' => '1', 'seen_by' => $this->session->userdata('user_aob')->id];
        $triage_data = ['weight' => $forminput['weight'], 'height' => $forminput['height'], 'temperature' => $forminput['temperature'], 'blood_pressure' => $forminput['blood_pressure'], 'spo2' => $forminput['spo2'], 'rsb' => $forminput['rsb'], 'rsb_reading' => $forminput['rsb_reading'], 'resp_rate' => $forminput['resp_rate'], 'ticket_id' => $forminput['ticket_id']];

        //var_dump($triage_data);die;

        $newAct_data = ['ticket_id' => $forminput['ticket_id'], 'from_dpt' => $this->session->userdata('user_aob')->department, 'to_dpt' => $consultation_dpt, 'activity' => $activity, 'sent_by' => $this->session->userdata('user_aob')->id];

        $inserted = $this->queue_model->add_triage($prevAct_update, $newAct_data, $triage_data, $mvtid);
        if ($inserted > 0) {
            $this->session->set_flashdata('success-msg', 'Success!');
        } else {
            $this->session->set_flashdata('error-msg', 'Failed, please try again');
        }
        if ($forminput['pharma_direct'] == 'yes') {
            $this->session->set_userdata('medicine', $medicine);
            redirect('queue/prescribe/' . $forminput['ticket_id']);
        }else{
            redirect('queue/myqueue');
        }
        
    }

    function updateTriage(int $id) //update from Admin 
    {
        $forminput = $this->input->post();

        $data = ['weight' => $forminput['weight'], 'height' => $forminput['height'], 'temperature' => $forminput['temperature'], 'blood_pressure' => $forminput['blood_pressure'], 'spo2' => $forminput['spo2'], 'rsb' => $forminput['rsb'], 'rsb_reading' => $forminput['rsb_reading'], 'resp_rate' => $forminput['resp_rate'], 'ticket_id' => $forminput['ticket_id']];

        //var_dump($forminput[])

        $inserted = $this->queue_model->update_triage($id, $data);
        if ($inserted > 0) {
            $this->session->set_flashdata('success-msg', 'Success');
        }else{
            $this->session->set_flashdata('error-msg', 'Err! Failed try Again');
        }
        redirect('queue/consultation_send/'.$forminput['ticket_id'].'/'.$forminput['mvtid']);
    }

    function update_triage_data(int $id) //update from Triage 
    {
        $forminput = $this->input->post();
        // $consultation_dpt = $this->dpt_byActivity(2);
        $arrindex = array_keys($forminput);
        if($forminput['pharma_direct'] == "yes"){
          $medicine = [];
         foreach ($arrindex as $key) {
                // echo substr($key, 0,8);
                if (substr($key, 0, 8) == 'medicine') {
                    $medicine[] = explode('_', $key)[1];
                }

            }
            $consultation_dpt = $this->dpt_byActivity(11);  
            $activity = 11;
        }else{
            $consultation_dpt = $this->dpt_byActivity(2);
            $activity = 2;
        }
        
        // var_dump($medicine);die;
        $prevAct_update = ['status' => 'seen', 'triage_status' => '1', 'seen_by' => $this->session->userdata('user_aob')->id];
        $triage_data = ['weight' => $forminput['weight'], 'height' => $forminput['height'], 'temperature' => $forminput['temperature'], 'blood_pressure' => $forminput['blood_pressure'], 'spo2' => $forminput['spo2'], 'rsb' => $forminput['rsb'], 'rsb_reading' => $forminput['rsb_reading'], 'resp_rate' => $forminput['resp_rate'], 'ticket_id' => $forminput['ticket_id']];

        $newAct_data = ['ticket_id' => $forminput['ticket_id'], 'from_dpt' => $this->session->userdata('user_aob')->department, 'to_dpt' => $consultation_dpt, 'activity' => $activity, 'sent_by' => $this->session->userdata('user_aob')->id];

        $inserted = $this->queue_model->update_triageData($prevAct_update, $newAct_data, $triage_data, $mvtid);
        if ($inserted > 0) {
            $this->session->set_flashdata('success-msg', 'Success!');
        } else {
            $this->session->set_flashdata('error-msg', 'Failed, please try again');
        }
        if ($forminput['pharma_direct'] == 'yes') {
            $this->session->set_userdata('medicine', $medicine);
            redirect('queue/prescribe/' . $forminput['ticket_id']);
        }else{
            redirect('queue/myqueue');
        }
    }

    function create()
    {
        $forminput = $this->input->post();
        $arrindex = array_keys($forminput);
        // var_dump($forminput);
        $ticketdata = ['patient_id' => $forminput['patient'],'cons_fee'=> $forminput['cons_fee']];
        // var_dump($ticketdata);die;

        if ($forminput['activity'] == '8') {
            // sent to lab
            $to_dpt = $this->dpt_byActivity(8);
            
            $mvtdata = ['from_dpt' => $this->session->userdata('user_aob')->department, 'to_dpt' => $this->dpt_byActivity($forminput['activity']), 'activity' => $forminput['activity'], 'patient_notes' => $forminput['notes'], 'sent_by' => $this->session->userdata('user_aob')->id,'is_direct' => $forminput['direct']];
            $inserted = $this->queue_model->create($ticketdata, $mvtdata, 'ticket_labtests', $labtest_data);
        } else if ($forminput['activity'] == '25') {
            $to_dpt = $this->dpt_byActivity(25);
            // sent to radiology

            $mvtdata = ['from_dpt' => $this->session->userdata('user_aob')->department, 'to_dpt' => $this->dpt_byActivity($forminput['activity']), 'activity' => $forminput['activity'], 'patient_notes' => $forminput['notes'], 'sent_by' => $this->session->userdata('user_aob')->id,'is_direct' => $forminput['direct']];
            $inserted = $this->queue_model->create($ticketdata, $mvtdata, 'ticket_radiology', $radiology_data);

        } else {
            $mvtdata = ['from_dpt' => $this->session->userdata('user_aob')->department, 'to_dpt' => $this->dpt_byActivity($forminput['activity']), 'activity' => $forminput['activity'], 'patient_notes' => $forminput['notes'], 'sent_by' => $this->session->userdata('user_aob')->id,'is_direct' => $forminput['direct']];
            $inserted = $this->queue_model->create($ticketdata, $mvtdata, 'none', []);
        }

        if ($inserted > 0) {
            $this->session->set_flashdata('success-msg', 'Patient queued successfully, queue another patient!');
        } else {
            $this->session->set_flashdata('error-msg', 'Failed, please try again');
        }
        redirect('queue/search');
    }

    function myqueue()
    {
        $this->data['incoming'] = $this->queue_model->incoming_active();
        $this->data['outgoing'] = $this->queue_model->outgoing_active();
        $this->data['pg_title'] = "My Queue";
        $this->data['page_content'] = 'queue/myqueue';
        $this->load->view('layout/template', $this->data);
    }

    function seenqueue()
    {
        $this->data['incoming'] = $this->queue_model->incoming_seen();
        $this->data['outgoing'] = $this->queue_model->outgoing_seen();
        $this->data['pg_title'] = "My Queue";
        $this->data['page_content'] = 'queue/seenhistory';
        $this->load->view('layout/template', $this->data);
    }

    function consultation_send(int $id, int $mvtid)
    {
        $tickid = $id;
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

        $ticket_details = $this->queue_model->ticket_details($id);
        $this->data['anc_details'] = $this->queue_model->fetch_anc_details($ticket_details['patient_id']);
        $anc = $this->queue_model->fetch_anc_details($ticket_details['patient_id']);
        $this->data['subsequent_anc'] = $this->queue_model->fetch_subsequent_anc($anc['id']);

        $this->data['labdetails'] = $this->queue_model->ticket_labdetails($id);
        $this->data['radiologydetails'] = $this->queue_model->ticket_radiologydetails($id);
        $this->data['admissiondetails'] = $this->queue_model->ticket_admission($id);
        $this->data['treatments'] = $this->queue_model->fetch_treatments();
        $this->data['medicationdetails'] = $this->queue_model->ticket_prescription($id);
        $this->data['appointmentdetails'] = $this->queue_model->ticket_appointment($id);

        $totcons = $this->queue_model->ticket_details($id)['cons_fee'];
        $this->data['totaldue'] = $totrad + $totlab + $totmed + $totcons-$totpaid + $totmisc + $totmisc + $totrsb;
        $this->data['ticket_details'] = $this->queue_model->ticket_details($id);
        $this->data['radiology'] = $this->radiology_model->fetch_radiology_screening();
        $this->data['medicine'] = $this->pharmacy_model->fetch_medicine();
        $this->data['labtests'] = $this->lab_model->fetch_lab_tests();
        $this->data['triage'] = $this->queue_model->check_triage($id);
        $this->data['diagnosisdetails'] = $this->queue_model->check_diagnosis($id);
        $this->data['ticket_id'] = $id;
        $this->data['mvtid'] = $mvtid;
        $this->data['pg_title'] = "Select";
        $this->data['page_content'] = 'queue/consultation_send';
        $this->load->view('layout/template', $this->data);
    }

    function pre_maternity(int $id, int $mvtid)
    {
        $tickid = $id;
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

        $totcons = $this->queue_model->ticket_details($id)['cons_fee'];
        $this->data['totaldue'] = $totrad + $totlab + $totmed + $totcons-$totpaid + $totmisc;

        $this->data['ticket_details'] = $this->queue_model->ticket_details($id);
        $this->data['ticket_id'] = $id;
        $this->data['mvtid'] = $mvtid;
        $this->data['pg_title'] = "Select";
        $this->data['page_content'] = 'queue/pre_maternity';
        $this->load->view('layout/template', $this->data);
    }

    function maternity(int $id, int $mvtid)
    {
        $tickid = $id;
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

        $totcons = $this->queue_model->ticket_details($id)['cons_fee'];
        $this->data['totaldue'] = $totrad + $totlab + $totmed + $totcons-$totpaid + $totmisc + $totrsb;

        $this->data['ticket_details'] = $this->queue_model->ticket_details($id);
        $this->data['ticket_id'] = $id;
        $this->data['mvtid'] = $mvtid;
        $this->data['pg_title'] = "Select";
        $this->data['page_content'] = 'queue/maternity';
        $this->load->view('layout/template', $this->data);
    }

    function prematernity_save(int $mvtid)
    {
        $forminput = $this->input->post();
        $update = ['maternity_status' => '1'];

        $inserted = $this->queue_model->prematernity_save($update,$forminput,$mvtid);
        if ($inserted > 0) {
            $this->session->set_flashdata('success-msg', 'Success!');
        } else {
            $this->session->set_flashdata('error-msg', 'Failed, please try again');
        }
        redirect('queue/myqueue');

    }
    function maternity_costs(int $id, int $mvtid)
    {
        $tickid = $id;
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

        $totcons = $this->queue_model->ticket_details($id)['cons_fee'];
        $this->data['totaldue'] = $totrad + $totlab + $totmed + $totcons-$totpaid + $totmisc + $totrsb;

        $this->data['ticket_details'] = $this->queue_model->ticket_details($id);
        $this->data['ticket_id'] = $id;
        $this->data['mvtid'] = $mvtid;
        $this->data['pg_title'] = "Select";
        $this->data['page_content'] = 'queue/maternity_costs';
        $this->load->view('layout/template', $this->data);
    }
    function save_maternitycost()
    {
        $forminput = $this->input->post();
//        var_dump($forminput);die;
        $services = $forminput['service'];
        $cost = $forminput['cost'];
        $i = 0;
        foreach ($services as $one){
            $onecost = $cost[$i];
            $this->db->insert('ticket_misc_cost',['ticket_id' => $forminput['ticket_id'],'cost_name' => $one, 'amount' => $onecost]);
            $i++;
        }
        $this->db->where('id',$forminput['ticket_id']);
        $this->db->update('tickets',['status' => '1']);

        $this->db->where('id',$forminput['mvt_id']);
        $this->db->update('ticket_movements',['status' => 'seen']);
        $inserted = $this->db->affected_rows();
        if ($inserted > 0) {
            $this->session->set_flashdata('success-msg', 'Success!');
        } else {
            $this->session->set_flashdata('error-msg', 'Failed, please try again');
        }
        redirect('queue/myqueue');
    }
    function dentist(int $id, int $mvtid)
    {
        $tickid = $id;
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

        $totcons = $this->queue_model->ticket_details($id)['cons_fee'];
        $this->data['totaldue'] = $totrad + $totlab + $totmed + $totcons-$totpaid + $totmisc + $totrsb;

        $this->data['ticket_details'] = $this->queue_model->ticket_details($id);
        $this->data['ticket_id'] = $id;
        $this->data['mvtid'] = $mvtid;
        $this->data['pg_title'] = "Select";
        $this->data['page_content'] = 'queue/dentist';
        $this->load->view('layout/template', $this->data);
    }
    function save_dentistcost()
    {
        $forminput = $this->input->post();
//        var_dump($forminput);die;
        $services = $forminput['service'];
        $cost = $forminput['cost'];
        $i = 0;
        foreach ($services as $one){
            $onecost = $cost[$i];
            $this->db->insert('ticket_misc_cost',['ticket_id' => $forminput['ticket_id'],'cost_name' => $one, 'amount' => $onecost]);
            $i++;
        }
        $this->db->where('id',$forminput['ticket_id']);
        $this->db->update('tickets',['status' => '1']);

        $this->db->where('id',$forminput['mvt_id']);
        $this->db->update('ticket_movements',['status' => 'seen']);
        $inserted = $this->db->affected_rows();
        if ($inserted > 0) {
            $this->session->set_flashdata('success-msg', 'Success!');
        } else {
            $this->session->set_flashdata('error-msg', 'Failed, please try again');
        }
        redirect('queue/myqueue');
    }

    function dressing(int $id, int $mvtid)
    {
        $tickid = $id;
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

        $totcons = $this->queue_model->ticket_details($id)['cons_fee'];
        $this->data['totaldue'] = $totrad + $totlab + $totmed + $totcons-$totpaid + $totmisc + $totrsb;

        $this->data['ticket_details'] = $this->queue_model->ticket_details($id);
        $this->data['ticket_id'] = $id;
        $this->data['mvtid'] = $mvtid;
        $this->data['pg_title'] = "Select";
        $this->data['page_content'] = 'queue/dressing';
        $this->load->view('layout/template', $this->data);
    }

    function save_dressingcost()
    {
        $forminput = $this->input->post();
//        var_dump($forminput);die;
        $services = $forminput['service'];
        $cost = $forminput['cost'];
        $i = 0;
        foreach ($services as $one){
            $onecost = $cost[$i];
            $this->db->insert('ticket_misc_cost',[
                'ticket_id' => $forminput['ticket_id'],
                'cost_name' => $one, 
                'amount' => $onecost
            ]);
            $i++;
        }
        $this->db->where('id',$forminput['ticket_id']);
        $this->db->update('tickets',['status' => '1']);

        $this->db->where('id',$forminput['mvt_id']);
        $this->db->update('ticket_movements',['status' => 'seen']);
        $inserted = $this->db->affected_rows();
        if ($inserted > 0) {
            $this->session->set_flashdata('success-msg', 'Success!');
        } else {
            $this->session->set_flashdata('error-msg', 'Failed, please try again');
        }
        redirect('queue/myqueue');
    }
    function postmaternity_save(int $mvtid)
    {
        $forminput = $this->input->post();
        $update = ['postmaternity_status' => '1'];

        $inserted = $this->queue_model->postmaternity_save($update,$forminput,$mvtid);
        if ($inserted > 0) {
            $this->session->set_flashdata('success-msg', 'Success!');
        } else {
            $this->session->set_flashdata('error-msg', 'Failed, please try again');
        }
        redirect('queue/myqueue');

    }

    function admit(int $id, int $mvtid)
    {
        $tickid = $id;
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

        $totcons = $this->queue_model->ticket_details($id)['cons_fee'];
        $this->data['totaldue'] = $totrad + $totlab + $totmed + $totcons-$totpaid + $totmisc + $totrsb;

        $this->data['ticket_details'] = $this->queue_model->ticket_details($id);
        $this->data['ticket_id'] = $id;
        $this->data['wards'] = $this->wards_model->fetch_wards();
        $this->data['mvtid'] = $mvtid;
        $this->data['pg_title'] = "Select";
        $this->data['page_content'] = 'queue/admit';
        $this->load->view('layout/template', $this->data);
    }

    function appoint(int $id, int $mvtid)
    {
        $tickid = $id;
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

        $totcons = $this->queue_model->ticket_details($id)['cons_fee'];
        $this->data['totaldue'] = $totrad + $totlab + $totmed + $totcons-$totpaid + $totmisc + $totrsb;

        $this->data['ticket_details'] = $this->queue_model->ticket_details($id);
        $this->data['ticket_id'] = $id;
        $this->data['mvtid'] = $mvtid;
        $this->data['pg_title'] = "Select";
        $this->data['page_content'] = 'queue/appoint';
        $this->load->view('layout/template', $this->data);
    }

    function diagnose(int $id, int $mvtid)
    {
        $tickid = $id;
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

        $this->data['treatments'] = $this->queue_model->fetch_treatments();

        $totcons = $this->queue_model->ticket_details($id)['cons_fee'];
        $this->data['totaldue'] = $totrad + $totlab + $totmed + $totcons-$totpaid + $totmisc + $totrsb;

        $this->data['ticket_details'] = $this->queue_model->ticket_details($id);
        $this->data['ticket_id'] = $id;
        $this->data['mvtid'] = $mvtid;
        $this->data['pg_title'] = "Select";
        $this->data['page_content'] = 'queue/diagnose';
        $this->load->view('layout/template', $this->data);
    }

    function add_direct_labtest()
    {
        $forminput = $this->input->post();
        $tests = $forminput['labtests'];
            // var_dump($tests);die;
        $labtest_data = ['ticket_id' => $forminput['ticket_id'], 'tests' => json_encode($tests), 'requested_by' => $this->session->userdata('user_aob')->id];
        // var_dump($labtest_data);die;
        $this->queue_model->insert_tickMisc('ticket_labtests', $labtest_data);

        redirect('queue/addtest/'.$forminput['mvt_id'].'/1');
    }

    function add_direct_rad()
    {
        $forminput = $this->input->post();
        $tests = $forminput['radiology'];
            // var_dump($tests);die;
        $labtest_data = ['ticket_id' => $forminput['ticket_id'], 'radiology_screening' => json_encode($tests), 'sent_by' => $this->session->userdata('user_aob')->id];
        // var_dump($labtest_data);die;
        $this->queue_model->insert_tickMisc('ticket_radiology', $labtest_data);

        redirect('queue/addradiology/'.$forminput['mvt_id'].'/1');
    }

    function consultation_save(int $id, int $mvtid)
    {
        $forminput = $this->input->post();
        $arrindex = array_keys($forminput);
        //var_dump($forminput);die;

        if ($forminput['activity'] == '8') {
            // sent to lab
            $to_dpt = $this->dpt_byActivity(8);
            $tests = $forminput['labtests'];
            // var_dump($tests);die;
            $labtest_data = ['ticket_id' => $id, 'tests' => json_encode($tests), 'requested_by' => $this->session->userdata('user_aob')->id];
            $this->queue_model->insert_tickMisc('ticket_labtests', $labtest_data);

            $prevAct_update = ['status' => 'seen', 'seen_by' => $this->session->userdata('user_aob')->id];
            $newAct_data = ['ticket_id' => $id, 'from_dpt' => $this->session->userdata('user_aob')->department, 'to_dpt' => $to_dpt, 'activity' => $forminput['activity'], 'patient_notes' => $forminput['notes'], 'sent_by' => $this->session->userdata('user_aob')->id];

        }
        if ($forminput['activity'] == '11') {
            $to_dpt = $this->dpt_byActivity(11);
            // sent to pharmacy
            $medicine = $forminput['medicines'];
            // echo json_encode($medicine);die;
            $prevAct_update = ['status' => 'seen', 'seen_by' => $this->session->userdata('user_aob')->id];
            $newAct_data = ['ticket_id' => $id, 'from_dpt' => $this->session->userdata('user_aob')->department, 'to_dpt' => $to_dpt, 'activity' => $forminput['activity'], 'patient_notes' => $forminput['notes'], 'sent_by' => $this->session->userdata('user_aob')->id];

            if($forminput['time']) {
                $app_data = ["ticket_id" => $forminput['ticket_id'], "appointment_date" => $forminput['time'], "appointed_by" => $this->session->userdata('user_aob')->id, "comments" => $forminput['notes'], 'status' => 'pending'];
            }else{
                $app_data = [];
            }
            $treat_data = ['treatment' => $forminput['treatment']];
            $this->queue_model->custom_discharge($id,$app_data,$treat_data);

            $inserted = $this->queue_model->consultation_insert_ticket($newAct_data, $prevAct_update, $mvtid);

            if ($inserted > 0) {
                 if($forminput['next_activity'] == "admit"){
                        $admit = '1';
                    }else{
                        $admit = '0';
                    }
                $this->session->set_flashdata('success-msg', 'Success!');
                $this->session->set_userdata('medicine', $medicine);
                redirect('queue/prescribe/' . $id."/".$mvtid."/".$admit);
            } else {
                $this->session->set_flashdata('error-msg', 'Failed, please try again');
            }

        }
        if ($forminput['activity'] == '25') {
            $to_dpt = $this->dpt_byActivity(25);
            // sent to radiology
            $radiology = $forminput['radiology'];
            // echo json_encode($radiology);die;
            $radiology_data = ['ticket_id' => $id, 'radiology_screening' => json_encode($radiology), 'sent_by' => $this->session->userdata('user_aob')->id];
            $this->queue_model->insert_tickMisc('ticket_radiology', $radiology_data);

            $prevAct_update = ['status' => 'seen', 'seen_by' => $this->session->userdata('user_aob')->id];
            $newAct_data = ['ticket_id' => $id, 'from_dpt' => $this->session->userdata('user_aob')->department, 'to_dpt' => $to_dpt, 'activity' => $forminput['activity'], 'patient_notes' => $forminput['notes'], 'sent_by' => $this->session->userdata('user_aob')->id];

        }
        if ($forminput['activity'] == '10') {
            $to_dpt = $this->dpt_byActivity(10);
            // sent to maternity            
            $prevAct_update = ['status' => 'seen', 'seen_by' => $this->session->userdata('user_aob')->id];
            $newAct_data = ['ticket_id' => $id, 'from_dpt' => $this->session->userdata('user_aob')->department, 'to_dpt' => $to_dpt, 'activity' => $forminput['activity'], 'patient_notes' => $forminput['notes'], 'sent_by' => $this->session->userdata('user_aob')->id];
         
        }

        //send back to triage
        if ($forminput['activity'] == '3') {
            $to_dpt = $this->dpt_byActivity(3);
            // sent to maternity            
            $prevAct_update = ['status' => 'seen', 'seen_by' => $this->session->userdata('user_aob')->id];
            $newAct_data = ['ticket_id' => $id, 'from_dpt' => $this->session->userdata('user_aob')->department, 'to_dpt' => $to_dpt, 'activity' => $forminput['activity'], 'patient_notes' => $forminput['notes'], 'sent_by' => $this->session->userdata('user_aob')->id];
         
        }

        $inserted = $this->queue_model->consultation_insert_ticket($newAct_data, $prevAct_update, $mvtid);
        // echo $inserted;die;
        if ($inserted > 0) {
            $this->session->set_flashdata('success-msg', 'Success!');
        } else {
            $this->session->set_flashdata('error-msg', 'Failed, please try again');
        }
        redirect('queue/myqueue');

    }

    function prescribe(int $id, int $mvtid,int $admit)
    {
        $tickid = $id;
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

        $totcons = $this->queue_model->ticket_details($id)['cons_fee'];
        $this->data['totaldue'] = $totrad + $totlab + $totmed + $totcons-$totpaid + $totmisc + $totrsb;

        $medicine = $this->session->userdata('medicine');
        $med_details = [];
        foreach ($medicine as $key) {
            $med_details[] = $this->pharmacy_model->fetch_byId($key)[0];
        }
        $this->data['medicine'] = $med_details;
        $this->data['ticket_details'] = $this->queue_model->ticket_details($id);
        $this->data['ticket_id'] = $id;
        $this->data['mvtid'] = $mvtid;
        $this->data['admit'] = $admit;

        $this->data['pg_title'] = "Select";
        $this->data['page_content'] = 'queue/prescribe';
        $this->load->view('layout/template', $this->data);
    }

    function addtest(int $id, int $is_direct)
    {
        $ticket = $this->queue_model->fetch_mvt($id);
        $tickid = $ticket['ticket_id'];
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

        $totcons = $this->queue_model->ticket_details($tickid)['cons_fee'];
        $this->data['totaldue'] = $totrad + $totlab + $totmed + $totcons-$totpaid + $totmisc + $totrsb;

        $this->data['ticket_id'] = $ticket['ticket_id'];
        
        // echo $ticket['id'];die;
        $tick_tests = $this->queue_model->fetch_tests($ticket['ticket_id'])['tests'];
        // echo $tick_tests;die;
        $labtests = json_decode($tick_tests);
        $test_details = [];

        foreach ($labtests as $key) {
            $test_details[] = $this->lab_model->fetch_byId($key)[0];
        }
        $this->data['ticket_details'] = $this->queue_model->ticket_details($ticket['ticket_id']);
        $this->data['test_details'] = $test_details;
        $this->data['tick_id'] = $ticket['ticket_id'];
        $this->data['mvt_id'] = $id;
        $this->data['lab_id'] = $this->queue_model->fetch_tests($ticket['ticket_id'])['id'];
        $this->data['is_direct'] = $is_direct;
        $this->data['labtests'] = $this->lab_model->fetch_lab_tests();

        $this->data['pg_title'] = "Select";
        $this->data['page_content'] = 'queue/addtest';
        $this->load->view('layout/template', $this->data);
    }

    function addradiology(int $id, int $is_direct)
    {
        $ticket = $this->queue_model->fetch_mvt($id);
        $tickid = $ticket['ticket_id'];
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

        $totcons = $this->queue_model->ticket_details($tickid)['cons_fee'];
        $this->data['totaldue'] = $totrad + $totlab + $totmed + $totcons-$totpaid + $totmisc + $totrsb;

        $this->data['ticket_id'] = $tickid;
        $ticket = $this->queue_model->fetch_mvt($id);
        // echo $ticket['id'];die;
        $tick_tests = $this->queue_model->fetch_radiology($ticket['ticket_id'])['radiology_screening'];
        // echo $tick_tests;die;
        $labtests = json_decode($tick_tests);
        $test_details = [];

        foreach ($labtests as $key) {
            $test_details[] = $this->radiology_model->fetch_byId($key)[0];
        }
        $this->data['ticket_details'] = $this->queue_model->ticket_details($ticket['ticket_id']);
        $this->data['test_details'] = $test_details;
        $this->data['tick_id'] = $ticket['ticket_id'];
        $this->data['mvt_id'] = $id;
        $this->data['lab_id'] = $this->queue_model->fetch_radiology($ticket['ticket_id'])['id'];

        $this->data['radiology'] = $this->radiology_model->fetch_radiology_screening();
        $this->data['is_direct'] = $is_direct;
        $this->data['pg_title'] = "Select";
        $this->data['page_content'] = 'queue/addradiology';
        $this->load->view('layout/template', $this->data);
    }
    function add_prescription_direct(int $id, int $mvtid)
    {
        $forminput = $this->input->post();
        $medicine = $this->session->userdata('medicine');

        foreach ($medicine as $key) {
            $presc = 'presc_' . $key;
            $units = 'units_' . $key;
            $data = ['ticket_id' => $id, 'medicine_id' => $key, 'prescription' => $forminput[$presc], 'units' => $forminput[$units], 'offered_by' => $this->session->userdata('user_aob')->id];
            $inserted = $this->queue_model->add_prescription($data, $key);
        }

        if ($inserted > 0) {
            $this->session->set_flashdata('success-msg', 'Success!');
            $this->session->unset_userdata('medicine');
            redirect('queue/givemedicine/'.$id.'/'.$mvtid.'/1');
        } else {
            $this->session->set_flashdata('error-msg', 'Failed, please try again');
            redirect('queue/prescribe/' . $id);
        }

    }
    function mc_clinic(int $tickid, int $mvtid, int $is_direct)
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

        $totcons = $this->queue_model->ticket_details($tickid)['cons_fee'];
        $this->data['totaldue'] = $totrad + $totlab + $totmed + $totcons-$totpaid + $totmisc + $totrsb;

        $this->data['ticket_id'] = $tickid;
        $ticket = $this->queue_model->fetch_mvt($mvtid);
        
        $this->data['ticket_details'] = $this->queue_model->ticket_details($ticket['ticket_id']);
        $this->data['tick_id'] = $ticket['ticket_id'];
        $this->data['mvt_id'] = $mvtid;
        
        $this->data['is_direct'] = $is_direct;
        $this->data['pg_title'] = "Select";
        $this->data['page_content'] = 'queue/mc_clinic';
        $this->load->view('layout/template', $this->data);
    }
    function first_anc(int $tickid, int $mvtid, int $is_direct)
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

        $totcons = $this->queue_model->ticket_details($tickid)['cons_fee'];
        $this->data['totaldue'] = $totrad + $totlab + $totmed + $totcons-$totpaid + $totmisc + $totrsb;

        $this->data['ticket_id'] = $tickid;
        $ticket = $this->queue_model->fetch_mvt($mvtid);
        
        $this->data['ticket_details'] = $this->queue_model->ticket_details($ticket['ticket_id']);
        $this->data['tick_id'] = $ticket['ticket_id'];
        $this->data['mvt_id'] = $mvtid;
        
        $this->data['is_direct'] = $is_direct;
        $this->data['pg_title'] = "Select";
        $this->data['page_content'] = 'queue/firsttime_anc';
        $this->load->view('layout/template', $this->data);
    }

    function subsequent_anc(int $tickid, int $mvtid, int $is_direct)
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

        $totcons = $this->queue_model->ticket_details($tickid)['cons_fee'];
        $this->data['totaldue'] = $totrad + $totlab + $totmed + $totcons-$totpaid + $totmisc + $totrsb;

        $this->data['ticket_id'] = $tickid;
        $ticket = $this->queue_model->fetch_mvt($mvtid);
        
        $this->data['ticket_details'] = $this->queue_model->ticket_details($ticket['ticket_id']);
        $this->data['tick_id'] = $ticket['ticket_id'];
        $this->data['mvt_id'] = $mvtid;
        
        $this->data['is_direct'] = $is_direct;
        $this->data['pg_title'] = "Select";
        $this->data['page_content'] = 'queue/subsequent_anc';
        $this->load->view('layout/template', $this->data);
    }
    function save_mcclinic()
    {
        $forminput = $this->input->post();
        if ($forminput['status'] == 'first' && $forminput['service'] == 'anc') {
            $this->db->insert('ticket_misc_cost',['ticket_id' => $forminput['ticket_id'],'cost_name' => 'ANC - First visit', 'amount' => $this->MOTHER_CHILD_COST]);
        } else{
            
                if ($forminput['service'] == 'anc') {
                    $this->db->insert('ticket_misc_cost',['ticket_id' => $forminput['ticket_id'],'cost_name' => 'ANC', 'amount' => $this->ANC_COST]);
                }
                if ($forminput['service'] == 'pnc') {
                    $this->db->insert('ticket_misc_cost',['ticket_id' => $forminput['ticket_id'],'cost_name' => 'PNC', 'amount' => $this->PNC_COST]);
                }
                if ($forminput['service'] == 'cwc') {
                    $this->db->insert('ticket_misc_cost',['ticket_id' => $forminput['ticket_id'],'cost_name' => 'CWC', 'amount' => $this->CWC_COST]);
                }
                if ($forminput['service'] == 'family-planning') {
                    $this->db->insert('ticket_misc_cost',['ticket_id' => $forminput['ticket_id'],'cost_name' => 'Family Planning Consultation', 'amount' => $forminput['fam_cons']]);
                    $this->db->insert('ticket_misc_cost',['ticket_id' => $forminput['ticket_id'],'cost_name' => $forminput['plan_type'], 'amount' => $forminput['plan_cost']]);
                }
            
        }

        if ($forminput['next'] == 'appointment') {
            $app_data = ["ticket_id" => $forminput['ticket_id'], "appointment_date" => $forminput['appointment'], "appointed_by" => $this->session->userdata('user_aob')->id, 'status' => 'pending'];
            $this->db->insert('ticket_appointments', $app_data);
        }
        
        $tick_update = ['status' => '1'];
        $mvt_data = ['status' => 'seen', 'seen_by' => $this->session->userdata('user_aob')->id];
        $inserted = $this->queue_model->mcclinic($tick_update,$mvt_data,$forminput['ticket_id'],$forminput['mvt_id']);
        if ($inserted > 0) {
            $this->session->set_flashdata('success-msg', 'Success!');
            if ($forminput['status'] == 'first' && $forminput['service'] == 'anc') {
                redirect('queue/first_anc/'.$forminput['ticket_id'].'/'.$forminput['mvt_id'].'/1');
            }elseif ($forminput['status'] == 'revisit' && $forminput['service'] == 'anc') {
                redirect('queue/subsequent_anc/'.$forminput['ticket_id'].'/'.$forminput['mvt_id'].'/1');
            }else{
                $this->session->set_flashdata('error-msg', 'Failed, please try again');
            redirect('queue/myqueue');
            }
        } else {
            $this->session->set_flashdata('error-msg', 'Failed, please try again');
            redirect('queue/myqueue');
        }

    }
    function add_prescription(int $id, int $mvtid, int $admit)
    {
        $forminput = $this->input->post();
        $medicine = $this->session->userdata('medicine');

        foreach ($medicine as $key) {
            $presc = 'presc_' . $key;
            $units = 'units_' . $key;
            $data = ['ticket_id' => $id, 'medicine_id' => $key, 'prescription' => $forminput[$presc], 'units' => $forminput[$units], 'offered_by' => $this->session->userdata('user_aob')->id];
            $inserted = $this->queue_model->add_prescription($data, $key);
        }

        if ($inserted > 0) {
            $this->session->set_flashdata('success-msg', 'Success!');
            $this->session->unset_userdata('medicine');
            if($admit == "1"){
                redirect('queue/admit/'.$id."/".$mvtid);
            }else{
               redirect('queue/myqueue'); 
            }
            
        } else {
            $this->session->set_flashdata('error-msg', 'Failed, please try again');
            redirect('queue/prescribe/' . $id);
        }

    }
    function save_firsttime_anc()
    {
        $forminput = $this->input->post();
        $inserted = $this->queue_model->save_firsttime_anc($forminput);
        if ($inserted > 0) {
            $this->session->set_flashdata('success-msg', 'Success!');
        } else {
            $this->session->set_flashdata('error-msg', 'Failed, please try again');
        }
        redirect('queue/myqueue');

    }

    function save_subsequent_anc(int $pid)
    {
        $forminput = $this->input->post();
        $forminput['anc_id'] = $this->queue_model->fetch_anc_details($pid)['id'];
        $inserted = $this->queue_model->save_subsequent_anc($forminput);
        if ($inserted > 0) {
            $this->session->set_flashdata('success-msg', 'Success!');
        } else {
            $this->session->set_flashdata('error-msg', 'Failed, please try again');
        }
        redirect('queue/myqueue');

    }

    function save_labtest()
    {
        $forminput = $this->input->post();
        $tick_id = $forminput['tick_id'];
        // echo $tick_id;die;
        $mvt_id = $forminput['mvt_id'];
        $lab_id = $forminput['lab_id'];

        $tests = $forminput['tests'];
        foreach ($tests as $key) {
            // ['20','26','27','28','11','13','22']
            if($key == '20'){
                $this->db->insert('lab_thyroid_template', ['tf3' => $forminput['tf3'],'tf4' => $forminput['ft4'],'t3' => $forminput['t3'], 'tsh' => $forminput['tsh'], 'ticket_id' => $tick_id]);
            }
            if($key == '26'){
                $this->db->insert('lab_urea_template', ['urea' => $forminput['urea'],'creatinine' => $forminput['creatinine'],'sodium' => $forminput['sodium'], 'potassium' => $forminput['potassium'],'chloride' => $forminput['chloride'], 'ticket_id' => $tick_id]);
            }
            if($key == '27'){
                $this->db->insert('lab_haemogram_template', ['wbc' => $forminput['wbc'],'lymph' => $forminput['lymph'],'mid' => $forminput['mid'], 'neut_pc' => $forminput['neut_pc'], 'ticket_id' => $tick_id,'mid_pc' => $forminput['mid_pc'],'lymph_pc' => $forminput['lymph_pc'],'mid_pc' => $forminput['mid_pc'], 'neut' => $forminput['neut'],'hb' => $forminput['hb'],'rbc' => $forminput['rbc'],'hct' => $forminput['hct'], 'mcv' => $forminput['mcv'],'mch' => $forminput['mch'],'mchc' => $forminput['mchc'],'rdw_cv' => $forminput['rdw_cv'], 'rdw_sd' => $forminput['rdw_sd'],'plt' => $forminput['plt'],'mpv' => $forminput['mpv'],'pct' => $forminput['pct'], 'pdw_pc' => $forminput['pdw_pc'],'plcr_pc' => $forminput['plcr_pc']]);
            }
            if($key == '28'){
                $this->db->insert('lab_stool_template', ['stool_microscopy' => $forminput['stool_microscopy'],'stool_macroscopy' => $forminput['stool_macroscopy'], 'ticket_id' => $tick_id]);
            }
            if($key == '11'){
                $this->db->insert('lab_urinalysis_template', ['urine_macroscopy' => $forminput['urine_macroscopy'],'urine_microscopy' => $forminput['urine_microscopy'],'leuc' => $forminput['leuc'], 'nitrites' => $forminput['nitrites'],'urobilinogen' => $forminput['urobilinogen'],'protein' => $forminput['protein'],'ph' => $forminput['ph'], 'blood' => $forminput['blood'], 'sg' => $forminput['sg'],'ketons' => $forminput['ketons'],'bil' => $forminput['bil'], 'glucose' => $forminput['glucose'],'ticket_id' => $tick_id]);
            }
            if($key == '13'){
                $this->db->insert('lab_liver_template', ['albumin' => $forminput['albumin'],'alkp' => $forminput['alkp'],'bil_direct' => $forminput['bil_direct'], 'bil_total' => $forminput['bil_total'], 'got' => $forminput['got'],'gpt' => $forminput['gpt'],'protein' => $forminput['protein'], 'ggt' => $forminput['ggt'],'ticket_id' => $tick_id]);
            }

            if($key == '22'){
                $this->db->insert('lab_ancprofile_template', [ 'blood_grp' => $forminput['blood_grp'], 'rhesus' => $forminput['rhesus'], 'hb' => $forminput['hb'], 'vdrl' => $forminput['vdrl'], 'hbsag' => $forminput['hbsag'], 'hiv_aids' => $forminput['hiv_aids'], 'urine_macroscopy' => $forminput['urine_macroscopy'],'urine_microscopy' => $forminput['urine_microscopy'],'ticket_id' => $tick_id]);
            }
        }
        // die;

        $mvt = $this->queue_model->fetch_mvt($mvt_id);

        $config['max_size'] = 10000;
        $config['allowed_types'] = '*';
        $config['upload_path'] = FCPATH . 'uploads/labtests';

        if (isset($_FILES["file"]) && !empty($_FILES['file']['name'])) {
            // var_dump($_FILES);die;

            $fileInfo = pathinfo($_FILES["file"]["name"]);
            $file = $tick_id . "_" . $mvt_id . '.' . $fileInfo['extension'];

            // echo $file;die;
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            move_uploaded_file($_FILES["file"]["tmp_name"], FCPATH . "/uploads/labtests/" . $file);
        }


        if ($mvt['from_dpt'] != '1') {
            $activity = '2';
        } else {
            $activity = '1';
            $this->db->where('id',$tick_id);
            $tick_update = ['status' => '1'];
            $this->db->update('tickets', $tick_update);
        }

        // var_dump($mvt['from_dpt']);die;

        $to_dpt = $mvt['from_dpt'];


        $labtest_data = ['status' => 'seen', 'results' => $file, 'comments' => json_encode($forminput['comments']), 'results_by' => $this->session->userdata('user_aob')->id];
        $prevAct_update = ['status' => 'seen', 'labtests_status' => 1, 'seen_by' => $this->session->userdata('user_aob')->id];
        // var_dump($prevAct_update);die;
        $newAct_data = ['ticket_id' => $tick_id, 'from_dpt' => $this->session->userdata('user_aob')->department, 'to_dpt' => $to_dpt, 'activity' => $activity, 'sent_by' => $this->session->userdata('user_aob')->id];

        $inserted = $this->queue_model->add_labtest($prevAct_update, $newAct_data, $labtest_data, $mvt_id, $lab_id);

        if ($inserted > 0) {
            $this->session->set_flashdata('success-msg', 'Success!');
        } else {
            $this->session->set_flashdata('error-msg', 'Failed, please try again');
        }
        redirect('queue/myqueue');

    }

    function save_radiology()
    {
        $forminput = $this->input->post();
        $tick_id = $forminput['tick_id'];
        $mvt_id = $forminput['mvt_id'];
        $lab_id = $forminput['lab_id'];
        $mvt = $this->queue_model->fetch_mvt($mvt_id);

        $config['max_size'] = 10000;
        $config['allowed_types'] = '*';
        $config['upload_path'] = FCPATH . 'uploads/radiology';

        if (isset($_FILES["file"]) && !empty($_FILES['file']['name'])) {
            // var_dump($_FILES);die;

            $fileInfo = pathinfo($_FILES["file"]["name"]);
            $file = $tick_id . "_" . $mvt_id . '.' . $fileInfo['extension'];

            // echo $file;die;
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            move_uploaded_file($_FILES["file"]["tmp_name"], FCPATH . "/uploads/radiology/" . $file);
        }


        if ($mvt['from_dpt'] != '1') {
            $activity = '2';
        } else {
            $activity = '1';
            $this->db->where('id',$tick_id);
            $tick_update = ['status' => '1'];
            $this->db->update('tickets', $tick_update);
        }

        $to_dpt = $mvt['from_dpt'];


        $labtest_data = ['status' => 'seen', 'radiology_results' => $file, 'comments' => json_encode($forminput['comments']), 'received_by' => $this->session->userdata('user_aob')->id];
        $prevAct_update = ['status' => 'seen', 'labtests_status' => 1, 'seen_by' => $this->session->userdata('user_aob')->id];
        // var_dump($prevAct_update);die;
        $newAct_data = ['ticket_id' => $tick_id, 'from_dpt' => $this->session->userdata('user_aob')->department, 'to_dpt' => $to_dpt, 'activity' => $activity, 'sent_by' => $this->session->userdata('user_aob')->id];

        $inserted = $this->queue_model->add_radiology($prevAct_update, $newAct_data, $labtest_data, $mvt_id, $lab_id);

        if ($inserted > 0) {
            $this->session->set_flashdata('success-msg', 'Success!');
        } else {
            $this->session->set_flashdata('error-msg', 'Failed, please try again');
        }
        redirect('queue/myqueue');

    }

    function ticket_details(int $tickid, int $mvtid)
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
        $rsbpayment = $this->queue_model->ticket_triage($tickid);
        $totrsb = $rsbpayment['rsb'];
        //var_dump($totrsb);die;
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
        $this->data['totaldue'] = $totrad + $totlab + $totmed + $totcons-$totpaid + $totmisc + $totrsb;
        $ticket_details = $this->queue_model->ticket_details($tickid); 
        $this->data['ticket_details'] = $this->queue_model->fetch_mvt($mvtid);
        $this->data['anc_details'] = $this->queue_model->fetch_anc_details($ticket_details['patient_id']);
        $anc = $this->queue_model->fetch_anc_details($ticket_details['patient_id']);
        $this->data['subsequent_anc'] = $this->queue_model->fetch_subsequent_anc($anc['id']);
        // $this->data['anc_details'] = $this->queue_model->ticket_anc_details($tickid);
        $mvtdetails = $this->data['ticket_details'];

        $ticketdata = $this->queue_model->fetch_ticket($tickid);

        $this->data['patientdetails'] = $this->patients_model->fetch_byId($ticketdata['patient_id'])[0];
        $this->data['labdetails'] = $this->queue_model->ticket_labdetails($tickid);
        $this->data['radiologydetails'] = $this->queue_model->ticket_radiologydetails($tickid);
        $this->data['triagedetails'] = $this->queue_model->ticket_triage($tickid);
        $this->data['admissiondetails'] = $this->queue_model->ticket_admission($tickid);
        $this->data['diagnosisdetails'] = $this->queue_model->ticket_diagnosis($tickid);
        $this->data['medicationdetails'] = $this->queue_model->ticket_prescription($tickid);
        $this->data['appointmentdetails'] = $this->queue_model->ticket_appointment($tickid);
        $this->data['dressing'] = $this->queue_model->ticket_dressing_misc($tickid);
        $this->data['ticket_id'] = $tickid;
        $this->data['pg_title'] = "Select";
        $this->data['page_content'] = 'queue/ticket_details';
        $this->load->view('layout/template', $this->data);
    }

    function pmt_details(int $tickid, int $mvtid)
    {
        $this->data['ticket_details'] = $this->queue_model->fetch_mvt($mvtid);
        $mvtdetails = $this->data['ticket_details'];

        $ticketdata = $this->queue_model->fetch_ticket($tickid);

        $this->data['patientdetails'] = $this->patients_model->fetch_byId($ticketdata['patient_id'])[0];
        $this->data['labdetails'] = $this->queue_model->ticket_labdetails_p($tickid);
        $this->data['radiologydetails'] = $this->queue_model->ticket_radiologydetails_p($tickid);
        $this->data['medicationdetails'] = $this->queue_model->ticket_prescription_p($tickid);
        $this->data['ticket_id'] = $tickid;
        $this->data['phistory'] = $this->payments_model->fetch($tickid);
        $this->data['totcons'] = $this->queue_model->fetch_ticket($tickid)['cons_fee'];
        $this->data['totwaiver'] = $this->queue_model->fetch_ticket($tickid)['waiver_amount'];
        $this->data['miscdetails']  = $this->queue_model->mother_child_total($tickid);
        $this->data['totrsb'] = $this->queue_model->ticket_triage($tickid);     

        $this->data['pg_title'] = "Select";
        $this->data['page_content'] = 'queue/payment_details';
        $this->load->view('layout/template', $this->data);
    }

    function billWaver(int $tickid, int $mvtid)
    {
        //var_dump($tickid);die;
        $this->data['ticket_details'] = $this->queue_model->fetch_mvt($mvtid);
        $mvtdetails = $this->data['ticket_details'];

        $ticketdata = $this->queue_model->fetch_ticket($tickid);
        $this->data['waiver'] = $this->queue_model->fetch_ticket($tickid)[0];

        $this->data['patientdetails'] = $this->patients_model->fetch_byId($ticketdata['patient_id'])[0];
        $this->data['labdetails'] = $this->queue_model->ticket_labdetails_p($tickid);
        $this->data['radiologydetails'] = $this->queue_model->ticket_radiologydetails_p($tickid);
        $this->data['medicationdetails'] = $this->queue_model->ticket_prescription_p($tickid);
        $this->data['ticket_id'] = $tickid;
        $this->data['phistory'] = $this->payments_model->fetch($tickid);
        $this->data['totcons'] = $this->queue_model->fetch_ticket($tickid)['cons_fee'];
        $this->data['totwaiver'] = $this->queue_model->fetch_ticket($tickid)['waiver_amount'];
        $this->data['miscdetails']  = $this->queue_model->mother_child_total($tickid);
        $this->data['totrsb'] = $this->queue_model->ticket_triage($tickid);   

        $this->data['pg_title'] = "Select";
        $this->data['page_content'] = 'queue/billwaver';
        $this->load->view('layout/template', $this->data);
    }

    function labattachment(string $attach)
    {
        $this->data['attach'] = $attach;
        $this->data['pg_title'] = "Lab Attachment";
        $this->data['page_content'] = 'queue/labattachment';
        $this->load->view('layout/attachmenttemplate', $this->data);
    }

    function radattachment(string $attach)
    {
        $this->data['attach'] = $attach;
        $this->data['pg_title'] = "Radiology Attachment";
        $this->data['page_content'] = 'queue/radattachment';
        $this->load->view('layout/attachmenttemplate', $this->data);
    }
    function givemedicine(int $tickid, int $mvtid, int $status)
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

        // echo $total;die;

        $this->data['totpaid'] = $totpaid;
        $totcons = $this->queue_model->ticket_details($tickid)['cons_fee'];
        $this->data['total'] = $totrad + $totlab + $totmed + $totcons + $totmisc + $totrsb;

        $this->data['prescriptions'] = $this->queue_model->ticket_prescription($tickid);
        $this->data['ticket_details'] = $this->queue_model->ticket_details($tickid);
        $this->data['ticket_id'] = $tickid;
        $this->data['mvtid'] = $mvtid;
        $this->data['medicine'] = $this->pharmacy_model->fetch_medicine();
        $this->data['is_direct'] = $status;
        $this->data['pg_title'] = "Give Medicine";
        $this->data['page_content'] = 'queue/givemedicine';
        $this->load->view('layout/template', $this->data);
    }

    function save_direct_med(){
        $forminput = $this->input->post();
        $this->session->set_userdata('medicine',$forminput['medicines']);
        redirect('queue/prescribe_direct/'.$forminput['ticket_id'].'/'.$forminput['mvtid']);

    }
    function prescribe_direct(int $id,int $mvtid)
    {
        $tickid = $id;
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

        $totcons = $this->queue_model->ticket_details($id)['cons_fee'];
        $this->data['totaldue'] = $totrad + $totlab + $totmed + $totcons-$totpaid + $totmisc + $totrsb;

        $medicine = $this->session->userdata('medicine');
        $med_details = [];
        foreach ($medicine as $key) {
            $med_details[] = $this->pharmacy_model->fetch_byId($key)[0];
        }
        $this->data['medicine'] = $med_details;
        $this->data['ticket_details'] = $this->queue_model->ticket_details($id);
        $this->data['ticket_id'] = $id;
        $this->data['mvt_id'] = $mvtid;
        $this->data['pg_title'] = "Select";
        $this->data['page_content'] = 'queue/prescribe_direct';
        $this->load->view('layout/template', $this->data);
    }

    function delete_medication(int $id,  int $tickid, int $mvtid,int $status)
    {
        $meddata = $this->queue_model->fetch_medications($id);
        $medid = $meddata['medicine_id'];
        //var_dump($medid);die;
        $inserted = $this->queue_model->delete_medication($id);
        if ($inserted > 0) {
            $this->session->set_flashdata('success-msg', 'Success!');
        } else {
            $this->session->set_flashdata('error-msg', 'Failed, please try again');
        }
        redirect('queue/givemedicine/'.$tickid.'/'.$mvtid.'/'.$status);
    }

    function pharmacyclose(int $mvtid)
    {
        $forminput = $this->input->post();
        $mvt = $this->queue_model->fetch_mvt($mvtid);

        $prevAct_update = ['status' => 'seen', 'medication_status' => 1, 'seen_by' => $this->session->userdata('user_aob')->id];

        if($forminput['activity'] == 'release'){
           $inserted = $this->queue_model->pharmacy_release($mvtid,$prevAct_update,$mvt['ticket_id']);
        }else{
             $to_dpt = $this->dpt_byActivity(2);
            // var_dump($prevAct_update);die;
            $newAct_data = ['ticket_id' => $mvt['ticket_id'], 'from_dpt' => $this->session->userdata('user_aob')->department, 'to_dpt' => $to_dpt, 'activity' => '2', 'sent_by' => $this->session->userdata('user_aob')->id];
            $inserted = $this->queue_model->pharmacy_return($mvtid,$prevAct_update, $newAct_data);
        }
        if ($inserted > 0) {
            $this->session->set_flashdata('success-msg', 'Success!');
        } else {
            $this->session->set_flashdata('error-msg', 'Failed, please try again');
        }
        redirect('queue/myqueue');
    }

    function print_labtest(int $test, string $req, string $by, int $tick)
    {
        //select tests data
        // ['20','26','27','28','11','13','22']
        $ticketdata = [];
        $this_test = "";
        if ($test == '20') {
            $this->db->where('ticket_id',$tick);
            $this->db->select()->from('lab_thyroid_template');
            $query = $this->db->get();
            $ticketdata = $query->result_array()[0];
            $this_test = $this->lab_model->fetch_byId($test)[0]['name'];
        }
        if ($test == '26') {
            $this->db->where('ticket_id',$tick);
            $this->db->select()->from('lab_urea_template');
            $query = $this->db->get();
            $ticketdata = $query->result_array()[0];
            $this_test = $this->lab_model->fetch_byId($test)[0]['name'];
        }
        if ($test == '27') {
            $this->db->where('ticket_id',$tick);
            $this->db->select()->from('lab_haemogram_template');
            $query = $this->db->get();
            $ticketdata = $query->result_array()[0];
            $this_test = $this->lab_model->fetch_byId($test)[0]['name'];
        }
        if ($test == '28') {
            $this->db->where('ticket_id',$tick);
            $this->db->select()->from('lab_stool_template');
            $query = $this->db->get();
            $ticketdata = $query->result_array()[0];
            $this_test = $this->lab_model->fetch_byId($test)[0]['name'];
        }
        if ($test == '11') {
            $this->db->where('ticket_id',$tick);
            $this->db->select()->from('lab_urinalysis_template');
            $query = $this->db->get();
            $ticketdata = $query->result_array()[0];
            $this_test = $this->lab_model->fetch_byId($test)[0]['name'];
        }
        if ($test == '13') {
            $this->db->where('ticket_id',$tick);
            $this->db->select()->from('lab_liver_template');
            $query = $this->db->get();
            $ticketdata = $query->result_array()[0];
            $this_test = $this->lab_model->fetch_byId($test)[0]['name'];
        }

        if ($test == '22') {
            $this->db->where('ticket_id',$tick);
            $this->db->select()->from('lab_ancprofile_template');
            $query = $this->db->get();
            $ticketdata = $query->result_array()[0];
            $this_test = $this->lab_model->fetch_byId($test)[0]['name'];
        }

        $tdetails = $this->queue_model->ticket_details($tick);

        $data['tdetails'] = $tdetails;
        $data['ticket_data'] = $ticketdata;
        $data['requested_by'] = $req;
        $data['tests_by'] = $by;
        $data['this_test'] = $this_test;
        $data['test'] = $test;

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
        $html = $this->load->view('printfiles/labtest_templates', $data, true);
        $h = 160 + $this->pheight;
        //  $pdf->_setPageSize(array(70, $h), $this->orientation);
        // $pdf->_setPageSize(array(280, $h), $pdf->DefOrientation);
        $pdf->WriteHTML($html);
        // render the view into HTML
        // write the HTML into the PDF
        $file_name = preg_replace('/[^A-Za-z0-9]+/', '-', 'ThermalInvoice_' . $tid);
        if ($this->input->get('d')) {
            $pdf->Output($file_name . '.pdf', 'D');
        } else {
            $pdf->Output($file_name . '.pdf', 'I');
        }

        unlink('userfiles/pos_temp/' . $data['qrc']);
    }

}