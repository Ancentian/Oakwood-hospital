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
class Patients extends BASE_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('user_aob')) {
            $this->session->set_flashdata('error-msg', "You must login to continue!");
            redirect('user/index');
        }
        $this->load->model('patients_model');

    }

    /*
     * Default method for this controller - Login
     */
    function add()
    {
        $forminput = $this->input->post();

        $inserted = $this->patients_model->add_patient($forminput);
        if ($inserted > 0) {
            $this->session->set_flashdata('success-msg', 'Patient registered successfully');
            redirect('queue/direct_queue/'.$inserted);
        } else {
            $this->session->set_flashdata('error-msg', 'Failed, please try again');
        }
        redirect('dashboard/patientslist');

    }

    function edit(int $id)
    {
        $forminput = $this->input->post();

        $inserted = $this->patients_model->edit_patient($id, $forminput);
        if ($inserted > 0) {
            $this->session->set_flashdata('success-msg', 'Patient updated successfully');
        } else {
            $this->session->set_flashdata('error-msg', 'Failed, please try again');
        }
        redirect('dashboard/patientslist');
    }

    function delete(int $id)
    {
        $inserted = $this->patients_model->delete_patient($id);
        if ($inserted > 0) {
            $this->session->set_flashdata('success-msg', 'Patient deleted successfully');
        } else {
            $this->session->set_flashdata('error-msg', 'Failed, please try again');
        }
        redirect('dashboard/patientslist');
    }

}