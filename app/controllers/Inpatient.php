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
class Inpatient extends BASE_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('user_aob')) {
            $this->session->set_flashdata('error-msg', "You must login to continue!");
            redirect('user/index');
        }
        
        $this->load->model('inpatient_model');
        $this->load->model('patients_model');
        $this->load->model('queue_model');

    }

    function admitted()
    {
        $this->data['ibp'] = $this->patients_model->fetch_ibp();
        $this->data['pg_title'] = "Admitted";
        $this->data['page_content'] = 'inpatient/admitted';
        $this->load->view('layout/template', $this->data);
    }
    function services(int $tickid)
    {
        $this->data['tickid'] = $tickid;
        $this->data['pid'] = $this->inpatient_model->get_pid($tickid);
        $this->data['pg_title'] = "Inpatient";
        $this->data['page_content'] = 'inpatient/services';
        $this->load->view('layout/template', $this->data);
    }
    function nursing_cadex(int $tickid)
    {
        $this->data['tickid'] = $tickid;
        $this->data['nursing_cadex'] = $this->inpatient_model->fetch_nursingCadex($tickid);
        $this->data['pg_title'] = "Inpatient";
        $this->data['page_content'] = 'inpatient/nursing_cadex';
        $this->load->view('layout/template', $this->data);
    }
    function observations(int $tickid)
    {
        $this->data['tickid'] = $tickid;
        $this->data['observations'] = $this->inpatient_model->fetch_Observations($tickid);
        $this->data['pg_title'] = "Inpatient";
        $this->data['page_content'] = 'inpatient/observations';
        $this->load->view('layout/template', $this->data);
    }
    function transfusions(int $tickid)
    {
        $this->data['tickid'] = $tickid;
        $this->data['transfusions'] = $this->inpatient_model->fetch_transfusions($tickid);
        $this->data['pg_title'] = "Inpatient";
        $this->data['page_content'] = 'inpatient/blood_transfusion';
        $this->load->view('layout/template', $this->data);
    }
    function nursing_care(int $tickid)
    {
        $this->data['tickid'] = $tickid;
        $this->data['nursing_care'] = $this->inpatient_model->fetch_nursingCare($tickid);
        $this->data['pg_title'] = "Inpatient";
        $this->data['page_content'] = 'inpatient/nursing_care';
        $this->load->view('layout/template', $this->data);
    }
    function costs(int $tickid)
    {
        $this->data['tickid'] = $tickid;
        $this->data['costs'] = $this->inpatient_model->fetch_costs($tickid);
        $this->data['pg_title'] = "Inpatient";
        $this->data['page_content'] = 'inpatient/service_cost';
        $this->load->view('layout/template', $this->data);
    }

    function medication(int $tickid)
    {
        $this->data['tickid'] = $tickid;
        $this->data['meds'] = $this->inpatient_model->fetch_medication($tickid);
        $this->data['medicine'] = $this->inpatient_model->fetch_medicine();
        $this->data['pg_title'] = "Inpatient";
        $this->data['page_content'] = 'inpatient/medication';
        $this->load->view('layout/template', $this->data);
    }

    function add_prescription(int $tickid)
    {
        $forminput = $this->input->post();
        $medicine = json_decode($forminput['medicines'],true);
        foreach ($medicine as $key) {
            $presc = 'presc_' . $key;
            $units = 'units_' . $key;
            $data = ['ticket_id' => $tickid, 'medicine_id' => $key, 'prescription' => $forminput[$presc], 'units' => $forminput[$units], 'offered_by' => $this->session->userdata('user_aob')->id];
            $inserted = $this->queue_model->add_prescription($data, $key);
        }

        if ($inserted > 0) {
            $this->session->set_flashdata('success-msg', 'Success!');
            redirect('inpatient/medication/'.$tickid);
        } else {
            $this->session->set_flashdata('error-msg', 'Failed, please try again');
            redirect('inpatient/medication/'.$tickid);
        }

    }

    function save_medication()
    {
        $forminput = $this->input->post();
        $this->data['meds'] = $this->inpatient_model->fetch_meds($forminput['medicines']);
        $this->data['tickid'] = $forminput['ticket_id'];
        $this->data['medsid'] = $forminput['medicines'];
        $this->data['pg_title'] = "Inpatient";
        $this->data['page_content'] = 'inpatient/prescribe';
        $this->load->view('layout/template', $this->data);
    }

    function discharge(int $tickid)
    {
        $discharged = $this->inpatient_model->discharge($tickid);
        if ($discharged['status'] > 0) {
            $this->session->set_flashdata('success-msg', "Success");
        }else{
            $this->session->set_flashdata('error-msg','Failed,try again');
        }

        redirect('history/patient_history/'.$discharged['pid']);
    }
    function add_cadex()
    {
        $forminput = $this->input->post();
        $inserted = $this->inpatient_model->add_cadex($forminput);
        if ($inserted > 0) {
           $this->session->set_flashdata('success-msg','Success');
        }else{
            $this->session->set_flashdata('error-msg','Failed, please try again');
        }

        redirect('inpatient/nursing_cadex/'.$forminput['ticket_id']);
    }
    function save_cost()
    {
        $forminput = $this->input->post();
        $inserted = $this->inpatient_model->save_cost($forminput);
        if ($inserted > 0) {
           $this->session->set_flashdata('success-msg','Success');
        }else{
            $this->session->set_flashdata('error-msg','Failed, please try again');
        }

        redirect('inpatient/costs/'.$forminput['ticket_id']);
    }
    function add_observation()
    {
        $forminput = $this->input->post();
        $inserted = $this->inpatient_model->add_observation($forminput);
        if ($inserted > 0) {
           $this->session->set_flashdata('success-msg','Success');
        }else{
            $this->session->set_flashdata('error-msg','Failed, please try again');
        }

        redirect('inpatient/observations/'.$forminput['ticket_id']);
    }

    function add_transfusion()
    {
        $forminput = $this->input->post();
        $inserted = $this->inpatient_model->add_transfusion($forminput);
        if ($inserted > 0) {
           $this->session->set_flashdata('success-msg','Success');
        }else{
            $this->session->set_flashdata('error-msg','Failed, please try again');
        }

        redirect('inpatient/transfusions/'.$forminput['ticket_id']);
    }

    function add_care()
    {
        $forminput = $this->input->post();
        $inserted = $this->inpatient_model->add_care($forminput);
        if ($inserted > 0) {
           $this->session->set_flashdata('success-msg','Success');
        }else{
            $this->session->set_flashdata('error-msg','Failed, please try again');
        }

        redirect('inpatient/nursing_care/'.$forminput['ticket_id']);
    }
}