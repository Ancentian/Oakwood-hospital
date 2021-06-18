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
class Departmental_reports extends BASE_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('user_aob')) {
            $this->session->set_flashdata('error-msg', "You must login to continue!");
            redirect('user/index');
        }
        $this->load->model('departmentalreports_model');
        $this->load->model('departments_model');

    }

    function index(int $id)
    {
        $sdate = "";$edate = "";
        $forminput = $this->input->get();
        $sdate = $forminput['sdate'];
        $edate = $forminput['edate'];
        
        $this->data['dpt'] = $this->departments_model->fetch_byId($id)[0];
        $this->data['report'] = $this->departmentalreports_model->fetch_report($sdate,$edate,$id);
        $this->data['pg_title'] = "Departments";
        $this->data['page_content'] = 'departmental_reports/index';
        $this->load->view('layout/template', $this->data);
    }

    function consultationIndex()//Daily Consultation Report
    {
        $this->data['consultation'] = $this->departmentalreports_model->fetch_todaysConsultationReport();
        $this->data['pg_title'] = "Consultation";
        $this->data['page_content'] = 'departmental_reports/todays-consultation-report';
        $this->load->view('layout/template', $this->data);
    }



}