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
class Appointment extends BASE_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('user_aob')) {
            $this->session->set_flashdata('error-msg', "You must login to continue!");
            redirect('user/index');
        }
        $this->load->model('appointment_model');
        $this->load->model('queue_model');
        $this->load->model('patients_model');

    }

    function search()
    {
        $this->data['pg_title'] = "Search";
        $this->data['page_content'] = 'appointment/search';
        $this->load->view('layout/template', $this->data);
    }

    function select()
    {
        $forminput = $this->input->post();
        $this->data['patients'] = $this->queue_model->search($forminput);

        if (!$this->data['patients']) {
            $this->session->set_flashdata('error-msg', 'No records found');
            redirect('queue/search');
        }
        $this->data['pg_title'] = "Select";
        $this->data['page_content'] = 'appointment/select';
        $this->load->view('layout/template', $this->data);
    }

    function patient_apps(int $id)
    {
        $this->data['history'] = $this->appointment_model->fetch_tickets($id);

        $this->data['pg_title'] = "History";
        $this->data['page_content'] = 'appointment/index';
        $this->load->view('layout/template', $this->data);
    }
}