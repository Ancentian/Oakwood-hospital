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
class Pharmacy extends BASE_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('user_aob')) {
            $this->session->set_flashdata('error-msg', "You must login to continue!");
            redirect('user/index');
        }
        $this->load->model('pharmacy_model');

    }

    /*
     * Default method for this controller - Login
     */
    function inventory()
    {
        $this->data['medicine'] = $this->pharmacy_model->fetch_medicine();
        $this->data['pg_title'] = "Pharmacy";
        $this->data['page_content'] = 'pharmacy/inventory';
        $this->load->view('layout/template', $this->data);
    }

    function history()
    {
        $this->data['history'] = $this->pharmacy_model->fetch_history();
        $this->data['pg_title'] = "Pharmacy";
        $this->data['page_content'] = 'pharmacy/history';
        $this->load->view('layout/template', $this->data);
    }

    function addmedicine()
    {
        $this->data['pg_title'] = "Pharmacy";
        $this->data['page_content'] = 'pharmacy/addmedicine';
        $this->load->view('layout/template', $this->data);
    }

     function todaysReport()
    {
        $this->data['pharmacy'] = $this->pharmacy_model->fetch_todaysReport();
        $this->data['pg_title'] = "Pharmacy";
        $this->data['page_content'] = 'pharmacy/todays-report';
        $this->load->view('layout/template', $this->data);
    }

    function editmedicine(int $id)
    {
        $pharmacy = $this->pharmacy_model->fetch_byId($id);
        if ($pharmacy) {
            $this->data['medicine'] = $pharmacy[0];
        } else {
            $this->data['medicine'] = [];
        }
        $this->data['id'] = $id;
        $this->data['pg_title'] = "Pharmacy";
        $this->data['page_content'] = 'pharmacy/editmedicine';
        $this->load->view('layout/template', $this->data);
    }

    function stockmedicine(int $id)
    {
        $this->data['id'] = $id;
        $this->data['pg_title'] = "Pharmacy";
        $this->data['page_content'] = 'pharmacy/stockmedicine';
        $this->load->view('layout/template', $this->data);
    }

    function stock(int $id)
    {
        $forminput = $this->input->post();

        $inserted = $this->pharmacy_model->stock_medicine($id, $forminput['qty']);
        if ($inserted > 0) {
            $this->session->set_flashdata('success-msg', 'Stock updated successfully');
        } else {
            $this->session->set_flashdata('error-msg', 'Failed, please try again');
        }
        redirect('pharmacy/inventory');

    }

    function add()
    {
        $forminput = $this->input->post();

        $inserted = $this->pharmacy_model->add_medicine($forminput);
        if ($inserted > 0) {
            $this->session->set_flashdata('success-msg', 'Medicine added successfully');
        } else {
            $this->session->set_flashdata('error-msg', 'Failed, please try again');
        }
        redirect('pharmacy/inventory');

    }

    function edit(int $id)
    {
        $forminput = $this->input->post();

        $inserted = $this->pharmacy_model->edit_medicine($id, $forminput);
        if ($inserted > 0) {
            $this->session->set_flashdata('success-msg', 'Medicine updated successfully');
        } else {
            $this->session->set_flashdata('error-msg', 'Failed, please try again');
        }
        redirect('pharmacy/inventory');
    }

    function delete(int $id)
    {
        $inserted = $this->pharmacy_model->delete_medicine($id);
        if ($inserted > 0) {
            $this->session->set_flashdata('success-msg', 'Medicine deleted successfully');
        } else {
            $this->session->set_flashdata('error-msg', 'Failed, please try again');
        }
        redirect('pharmacy/inventory');
    }

    function historydelete(int $id)
    {
        $inserted = $this->pharmacy_model->delete_history($id);
        if ($inserted > 0) {
            $this->session->set_flashdata('success-msg', 'Deleted successfully');
        } else {
            $this->session->set_flashdata('error-msg', 'Failed, please try again');
        }
        redirect('pharmacy/history');
    }


}