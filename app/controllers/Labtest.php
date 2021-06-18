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
class Labtest extends BASE_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('user_aob')) {
            $this->session->set_flashdata('error-msg', "You must login to continue!");
            redirect('user/index');
        }
        $this->load->model('lab_model');

    }

    function index()
    {
        $this->data['tests'] = $this->lab_model->fetch_lab_tests();
        $this->data['pg_title'] = "Lab";
        $this->data['page_content'] = 'lab/index';
        $this->load->view('layout/template', $this->data);
    }

    function categoryIndex()
    {
        $this->data['category'] = $this->lab_model->fetch_labTestCategories();
        $this->data['pg_title'] = "Lab";
        $this->data['page_content'] = 'lab/categories';
        $this->load->view('layout/template', $this->data);
    }

    function addtest()
    {
        $this->data['category'] = $this->lab_model->fetch_labTestCategories();
        $this->data['pg_title'] = "Lab";
        $this->data['page_content'] = 'lab/addtest';
        $this->load->view('layout/template', $this->data);
    }

    function addCategory()
    {
        $this->data['pg_title'] = "Lab";
        $this->data['page_content'] = 'lab/add-category';
        $this->load->view('layout/template', $this->data);
    }

    function todaysReport()
    {
        $this->data['labtests'] = $this->lab_model->fetch_todaysReport();
        $this->data['pg_title'] = "Lab";
        $this->data['page_content'] = 'lab/todays-report';
        $this->load->view('layout/template', $this->data);
    }

    function edittest(int $id)
    {
        
        $test = $this->lab_model->fetch_byId($id);
        if ($test) {
            $this->data['test'] = $test[0];
        } else {
            $this->data['test'] = [];
        }
        $this->data['category'] = $this->lab_model->fetch_labTestCategories();
        $this->data['id'] = $id;
        $this->data['pg_title'] = "Lab";
        $this->data['page_content'] = 'lab/edittest';
        $this->load->view('layout/template', $this->data);
    }

    function editCategory($id)
    {
        $this->data['category'] = $this->lab_model->fetch_categorybyId($id);
        $this->data['pg_title'] = "Lab";
        $this->data['page_content'] = 'lab/editcategory';
        $this->load->view('layout/template', $this->data);
    }

    function add()
    {
        $forminput = $this->input->post();

        $inserted = $this->lab_model->add_test($forminput);
        if ($inserted > 0) {
            $this->session->set_flashdata('success-msg', 'Lab test added successfully');
        } else {
            $this->session->set_flashdata('error-msg', 'Failed, please try again');
        }
        redirect('labtest/index');

    }

    function store()
    {
        $forminput = $this->input->post();

        $inserted = $this->lab_model->add_category($forminput);
        if ($inserted > 0) {
            $this->session->set_flashdata('success-msg', 'Category added successfully');
        } else {
            $this->session->set_flashdata('error-msg', 'Failed, please try again');
        }
        redirect('labtest/categoryIndex');

    }

    function edit(int $id)
    {
        $forminput = $this->input->post();

        //var_dump($forminput);die;

        $inserted = $this->lab_model->edit_test($id, $forminput);
        if ($inserted > 0) {
            $this->session->set_flashdata('success-msg', 'Lab test updated successfully');
        } else {
            $this->session->set_flashdata('error-msg', 'Failed, please try again');
        }
        redirect('labtest/index');
    }

    function updateCategory(int $id)
    {
        $forminput = $this->input->post();

        $inserted = $this->lab_model->edit_category($id, $forminput);

        if ($inserted > 0) {
            $this->session->set_flashdata('success-msg', 'Category Updated successfully');
        }else{
            $this->session->set_flashdata('error-msg', 'Err! Failed Try Again');
        }

        redirect('labtest/categoryIndex');
    }

    function delete(int $id)
    {
        $inserted = $this->lab_model->delete_test($id);
        if ($inserted > 0) {
            $this->session->set_flashdata('success-msg', 'Lab test deleted successfully');
        } else {
            $this->session->set_flashdata('error-msg', 'Failed, please try again');
        }
        redirect('labtest/index');
    }

    function deleteCategory($id)
    {
        $inserted = $this->lab_model->delete_category($id);

        if ($inserted > 0) {
            $this->session->set_flashdata('success-msg', 'Category Deleted successfully');
        }else{
            $this->session->set_flashdata('error-msg', 'Err! Failed Try Again');
        }

        redirect('labtest/categoryIndex');
    }
}