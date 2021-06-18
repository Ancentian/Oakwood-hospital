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
class Departments extends BASE_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('user_aob')) {
            $this->session->set_flashdata('error-msg', "You must login to continue!");
            redirect('user/index');
        }
        $this->load->model('departments_model');

    }

    function index()
    {
        $this->data['dpts'] = $this->departments_model->fetch_departments();
        $this->data['pg_title'] = "Departments";
        $this->data['page_content'] = 'departments/index';
        $this->load->view('layout/template', $this->data);
    }


    function adddpt()
    {
        $this->data['pg_title'] = "Departments";
        $this->data['page_content'] = 'departments/adddpt';
        $this->load->view('layout/template', $this->data);
    }

    function editdpt(int $id)
    {
        $dpt = $this->departments_model->fetch_byId($id);
        if ($dpt) {
            $this->data['dpt'] = $dpt[0];
        } else {
            $this->data['dpt'] = [];
        }
        $this->data['id'] = $id;
        $this->data['pg_title'] = "Departments";
        $this->data['page_content'] = 'departments/editdpt';
        $this->load->view('layout/template', $this->data);
    }

    function add()
    {
        $forminput = $this->input->post();

        $inserted = $this->departments_model->add_department($forminput);
        if ($inserted > 0) {
            $this->session->set_flashdata('success-msg', 'Department added successfully');
        } else {
            $this->session->set_flashdata('error-msg', 'Failed, please try again');
        }
        redirect('departments/index');

    }

    function edit(int $id)
    {
        $forminput = $this->input->post();

        $inserted = $this->departments_model->edit_department($id, $forminput);
        if ($inserted > 0) {
            $this->session->set_flashdata('success-msg', 'Department updated successfully');
        } else {
            $this->session->set_flashdata('error-msg', 'Failed, please try again');
        }
        redirect('departments/index');
    }

    function delete(int $id)
    {
        $inserted = $this->departments_model->delete_department($id);
        if ($inserted > 0) {
            $this->session->set_flashdata('success-msg', 'Department deleted successfully');
        } else {
            $this->session->set_flashdata('error-msg', 'Failed, please try again');
        }
        redirect('departments/index');
    }

}