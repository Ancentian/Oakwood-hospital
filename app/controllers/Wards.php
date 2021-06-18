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
class Wards extends BASE_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('user_aob')) {
            $this->session->set_flashdata('error-msg', "You must login to continue!");
            redirect('user/index');
        }
        $this->load->model('wards_model');

    }

    function index()
    {
        $this->data['wards'] = $this->wards_model->fetch_wards();
        $this->data['pg_title'] = "Wards";
        $this->data['page_content'] = 'wards/index';
        $this->load->view('layout/template', $this->data);
    }


    function addward()
    {
        $this->data['pg_title'] = "Wards";
        $this->data['page_content'] = 'wards/addward';
        $this->load->view('layout/template', $this->data);
    }

    function editward(int $id)
    {
        $ward = $this->wards_model->fetch_byId($id);
        if ($ward) {
            $this->data['ward'] = $ward[0];
        } else {
            $this->data['ward'] = [];
        }
        $this->data['id'] = $id;
        $this->data['pg_title'] = "Wards";
        $this->data['page_content'] = 'wards/editward';
        $this->load->view('layout/template', $this->data);
    }

    function add()
    {
        $forminput = $this->input->post();

        $inserted = $this->wards_model->add_ward($forminput);
        if ($inserted > 0) {
            $this->session->set_flashdata('success-msg', 'Ward added successfully');
        } else {
            $this->session->set_flashdata('error-msg', 'Failed, please try again');
        }
        redirect('wards/index');

    }

    function edit(int $id)
    {
        $forminput = $this->input->post();

        $inserted = $this->wards_model->edit_ward($id, $forminput);
        if ($inserted > 0) {
            $this->session->set_flashdata('success-msg', 'Ward updated successfully');
        } else {
            $this->session->set_flashdata('error-msg', 'Failed, please try again');
        }
        redirect('wards/index');
    }

    function delete(int $id)
    {
        $inserted = $this->wards_model->delete_ward($id);
        if ($inserted > 0) {
            $this->session->set_flashdata('success-msg', 'Ward deleted successfully');
        } else {
            $this->session->set_flashdata('error-msg', 'Failed, please try again');
        }
        redirect('wards/index');
    }

}