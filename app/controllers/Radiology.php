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
class Radiology extends BASE_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('user_aob')) {
            $this->session->set_flashdata('error-msg', "You must login to continue!");
            redirect('user/index');
        }
        $this->load->model('radiology_model');

    }

    function index()
    {
        $this->data['tests'] = $this->radiology_model->fetch_radiology_screening();
        $this->data['pg_title'] = "Radiology";
        $this->data['page_content'] = 'radiology/index';
        $this->load->view('layout/template', $this->data);
    }

    function addscreening()
    {
        $this->data['category'] = $this->radiology_model->fetch_radiology_categories();
        $this->data['pg_title'] = "Radiology";
        $this->data['page_content'] = 'radiology/addscreening';
        $this->load->view('layout/template', $this->data);
    }

    function categoryList()
    {
        $this->data['category'] = $this->radiology_model->fetch_radiology_categories();
        $this->data['pg_title'] = "Radiology";
        $this->data['page_content'] = 'radiology/categories';
        $this->load->view('layout/template', $this->data);
    }

    function todaysReport()
    {
        $this->data['radiology'] = $this->radiology_model->fetch_todaysReport();
        $this->data['pg_title'] = "Radiology";
        $this->data['page_content'] = 'radiology/todays-report';
        $this->load->view('layout/template', $this->data);
    }

    function editscreening(int $id)
    {
        $this->data['category'] = $this->radiology_model->fetch_radiology_categories();
        $test = $this->radiology_model->fetch_byId($id);
        if ($test) {
            $this->data['test'] = $test[0];
        } else {
            $this->data['test'] = [];
        }
        $this->data['id'] = $id;
        $this->data['pg_title'] = "Radiology";
        $this->data['page_content'] = 'radiology/editscreening';
        $this->load->view('layout/template', $this->data);
    }

    function editCategory(int $id)
    {  
        $this->data['category'] = $this->radiology_model->fetch_catById($id);
        $this->data['pg_title'] = "Radiology";
        $this->data['page_content'] = 'radiology/editcategory';
        $this->load->view('layout/template', $this->data);
    }

    function add()
    {
        $forminput = $this->input->post();

        $inserted = $this->radiology_model->add_screening($forminput);
        if ($inserted > 0) {
            $this->session->set_flashdata('success-msg', 'Screening added successfully');
        } else {
            $this->session->set_flashdata('error-msg', 'Failed, please try again');
        }
        redirect('radiology/index');

    }

    function addCategory()
    {
        $this->form_validation->set_rules('cat_name', 'Category Name', 'required|is_unique[radiology_categories.cat_name]');

        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('error-msg', validation_errors());
            redirect(base_url('radiology/categoryList'));
        }else{
            $data = array(
                'cat_name' => $this->input->post('cat_name'),
            );
            //var_dump($data);die;
            $this->radiology_model->add_category($data);
            $this->session->set_flashdata('success-msg', 'Category added Successfully');
            redirect('radiology/categoryList');
        }
    }

    function edit(int $id)
    {
        $forminput = $this->input->post();

        $inserted = $this->radiology_model->edit_screening($id, $forminput);
        if ($inserted > 0) {
            $this->session->set_flashdata('success-msg', 'Screening updated successfully');
        } else {
            $this->session->set_flashdata('error-msg', 'Failed, please try again');
        }
        redirect('radiology/index');
    }

    function editCat(int $id)
    {
        $forminput = $this->input->post();

        $inserted = $this->radiology_model->edit_category($id, $forminput);
        if ($inserted > 0) {
            $this->session->set_flashdata('success-msg', 'Category updated successfully');
        } else {
            $this->session->set_flashdata('error-msg', 'Failed, please try again');
        }
        redirect('radiology/categoryList');
    }

    function delete(int $id)
    {
        $inserted = $this->radiology_model->delete_screening($id);
        if ($inserted > 0) {
            $this->session->set_flashdata('success-msg', 'Screening deleted successfully');
        } else {
            $this->session->set_flashdata('error-msg', 'Failed, please try again');
        }
        redirect('radiology/index');
    }

    function deleteCategory(int $id)
    {
        $inserted = $this->radiology_model->delete_category($id);
        if ($inserted > 0) {
            $this->session->set_flashdata('success-msg', 'Category deleted successfully');
        } else {
            $this->session->set_flashdata('error-msg', 'Failed, please try again');
        }
        redirect('radiology/categoryList');
    }

}