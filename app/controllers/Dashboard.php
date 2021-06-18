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
class Dashboard extends BASE_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('user_aob')) {
            $this->session->set_flashdata('error-msg', "You must login to continue!");
            redirect('user/index');
        }
        $this->load->model('patients_model');
        $this->load->model('users_model');
        $this->load->model('summary_model');

    }

    /*
     * Default method for this controller - Login
     */
    function index()
    {
        $this->data['totalincome'] = $this->summary_model->total_income();
        $this->data['todaysincome'] = $this->summary_model->todays_income();
        $this->data['totalincomeP'] = $this->summary_model->total_incomeP();
        $this->data['todaysincomeP'] = $this->summary_model->todays_incomeP();
        $this->data['totalpmtsP'] = $this->summary_model->total_pmtsP();
        $this->data['todayspmtsP'] = $this->summary_model->todays_pmtsP();
        $this->data['ibp'] = $this->summary_model->admitted_patients();
        $this->data['ptoday'] = $this->summary_model->patients_today();
        $this->data['pg_title'] = "Dashboard";
        $this->data['page_content'] = 'admin/dashboard';
        $this->load->view('layout/template', $this->data);

    }

    function todaysincome()
    {
        $this->data['phistory'] = $this->summary_model->all_todays_income();
        $this->data['pg_title'] = "Dashboard";
        $this->data['page_content'] = 'payments/todaysincome';
        $this->load->view('layout/template', $this->data);
    }

    function patientslist()
    {
        $this->data['ibp'] = $this->patients_model->fetch_ibp();
        $this->data['obp'] = $this->patients_model->fetch_obp();
        $this->data['pg_title'] = "Patients";
        $this->data['page_content'] = 'patients/patientlist';
        $this->load->view('layout/template', $this->data);
    }
    function todays_patients()
    {
        $this->data['patients'] = $this->summary_model->all_patients_today();
        $this->data['pg_title'] = "Patients";
        $this->data['page_content'] = 'patients/patientstoday';
        $this->load->view('layout/template', $this->data);
    }

    function patientsqueue()
    {
        $this->data['pg_title'] = "Incoming Patients";
        $this->data['page_content'] = 'patients/patientqueue';
        $this->load->view('layout/template', $this->data);
    }

    function addpatient()
    {
        $this->data['pg_title'] = "Add Patient";
        $this->data['page_content'] = 'patients/addpatient';
        $this->load->view('layout/template', $this->data);
    }

    function myprofile()
    {
        $this->data['pg_title'] = "My Profile";
        $this->data['page_content'] = 'admin/myprofile';
        $this->load->view('layout/template', $this->data);
    }

    function editpatient(int $id)
    {
        $patient = $this->patients_model->fetch_byId($id);
        if ($patient) {
            $this->data['patient'] = $patient[0];
        } else {
            $this->data['patient'] = [];
        }
        $this->data['pid'] = $id;
        $this->data['pg_title'] = "Edit Patient";
        $this->data['page_content'] = 'patients/editpatient';
        $this->load->view('layout/template', $this->data);
    }

    function treatment_filter()
    {
        $this->data['pg_title'] = "Treatment History";
        $this->data['page_content'] = 'treatment_history/filter';
        $this->load->view('layout/template', $this->data);
    }

    function patient_treatment()
    {
        $forminput = $this->input->post();
//        var_dump(time());die;
        $treatment = $this->summary_model->patient_treatment($forminput['age'],$forminput['gender']);
//        var_dump($treatment);die;
        $this->data['treatment'] = $treatment;
        $this->data['pg_title'] = "Treatment History";
        $this->data['page_content'] = 'treatment_history/index';
        $this->load->view('layout/template', $this->data);
    }

    function updatepass()
    {
        $forminput = $this->input->post();
        // echo $forminput['pconfirm']."<br>".$forminput['password'];
        // die;
        if ($forminput['password'] != $forminput['pconfirm']) {
            $this->session->set_flashdata('error-msg', 'Passwords do not match!');
            redirect('dashboard/myprofile');
        }
        $inserted = $this->users_model->updatepass($forminput['password']);
        if ($inserted > 0) {
            $this->session->set_flashdata('success-msg', 'Password updated successfully');
        } else {
            $this->session->set_flashdata('error-msg', 'Failed, please try again');
        }
        redirect('dashboard/myprofile');
    }


}