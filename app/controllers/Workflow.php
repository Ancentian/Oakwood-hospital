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
class Workflow extends BASE_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('user_aob')) {
            $this->session->set_flashdata('error-msg', "You must login to continue!");
            redirect('user/index');
        }
        $this->load->model('workflow_model');
        $this->load->model('departments_model');

    }

    function index()
    {
        $this->data['dpts'] = $this->departments_model->fetch_departments();
        $this->data['workflow'] = $this->workflow_model->fetch_workflow();
        $this->data['pg_title'] = "workflow";
        $this->data['page_content'] = 'workflow/index';
        $this->load->view('layout/template', $this->data);
    }

    function update()
    {
        //before making the update, first reset all the settings to default
        $updated = 0;
        $updated = $this->workflow_model->reset();
        $forminput = $this->input->post();

        $input = array_keys($forminput);
        $arr_offered = [];
        foreach ($input as $key) {
            $arr = explode('_', $key);
            if ($arr[0] == "offered") {
                $arr_offered[] = $arr[1];
            }
        }
        foreach ($arr_offered as $val) {
            $dpt_key = "department_" . $val;
            $data = ['is_offered' => "yes", "department" => $forminput[$dpt_key]];
            $updated = $this->workflow_model->update($val, $data);
        }
        if ($updated > 0) {
            $this->session->set_flashdata('success-msg', 'Workflow added successfully');
        } else {
            $this->session->set_flashdata('error-msg', 'Failed, please try again');
        }

        redirect('workflow/index');
    }


}