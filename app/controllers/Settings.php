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
class Settings extends BASE_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('user_aob')) {
            $this->session->set_flashdata('error-msg', "You must login to continue!");
            redirect('user/index');
        }
        $this->load->model('settings_model');

    }

    function index()
    {
        $this->data['pg_title'] = "Settings";
        $this->data['page_content'] = 'settings/index';
        $this->load->view('layout/template', $this->data);
    }

    function paymentSettings()
    {
        $this->data['paymentMode'] = $this->settings_model->fetch_paymentModes();
        $this->data['pg_title'] = "Settings";
        $this->data['page_content'] = 'settings/payment';
        $this->load->view('layout/template', $this->data);
    }

    function smsApiSettings()
    {
        $this->data['admin'] = $this->settings_model->fetch_admin();
        $this->data['pg_title'] = "Dashboard";
        $this->data['page_content'] = 'settings/set-admin';
        $this->load->view('layout/template', $this->data);
    }

    function discountSettings()
    {
        $this->data['discount'] = $this->settings_model->fetch_discounts();
        $this->data['pg_title'] = "Dashboard";
        $this->data['page_content'] = 'settings/set-discount';
        $this->load->view('layout/template', $this->data);
    }

     function specialConsulatation()
    {
        $this->data['special'] = $this->settings_model->fetch_specialConsultationFee();
        $this->data['pg_title'] = "Dashboard";
        $this->data['page_content'] = 'settings/special-con';
        $this->load->view('layout/template', $this->data);
    }

    function add_paymentMode()
    {
       $forminput = $this->input->post();

       $inserted = $this->settings_model->add_paymentMode($forminput);

       if ($inserted > 0) {
           $this->session->set_flashdata('success-msg', 'Payment Mode Created Successfully');
       }else{
            $this->session->set_flashdata('error-msg', 'Err! Failed Please Try Again');
       }

       redirect('settings/paymentSettings');
    }

    function activatePaymentMode(int $id)
    {
        $status = "1";

        $data = array('status' => $status);
        $inserted = $this->settings_model->update_paymentMode($id, $data);

        if ($inserted > 0) {
            $this->session->set_flashdata('success-msg', 'Payment Mode Activated successfully');
        } else {
            $this->session->set_flashdata('error-msg', 'Failed, please try again');
        }
        redirect('settings/paymentSettings'); 
    }

    function deactivatePaymentMode(int $id)
    {
        $status = "0";

        $data = array('status' => $status);
        $inserted = $this->settings_model->update_paymentMode($id, $data);

        if ($inserted > 0) {
            $this->session->set_flashdata('success-msg', 'Payment Mode De-activated successfully');
        } else {
            $this->session->set_flashdata('error-msg', 'Failed, please try again');
        }
        redirect('settings/paymentSettings'); 
    }

    function updateSetAdmin()
    {
        $forminput = $this->input->post();

        $data = array( 'api_key' => $forminput['api_key'], 'password' => $forminput['password'], 'recipients' => $forminput['recipients']);

        $inserted = $this->settings_model->update_setAdmin($data);

        if ($inserted > 0) {
            $this->session->set_flashdata('success-msg', 'Admins Added successfully');
        } else {
            $this->session->set_flashdata('error-msg', 'Failed, please try again');
        }
        redirect('settings/smsApiSettings'); 
    }

    function updateDiscount()
    {
        $forminput = $this->input->post();

        $data = array('discount' => $forminput['discount']);

        $inserted = $this->settings_model->update_discount($data);

        if ($inserted > 0) {
            $this->session->set_flashdata('success-msg', 'Discount defined successfully');
        } else {
            $this->session->set_flashdata('error-msg', 'Failed, please try again');
        }
        redirect('settings/discountSettings'); 
    }

    function updateSpecialFee()
    {
        $forminput = $this->input->post();

        $data = array('special_fee' => $forminput['special_fee']);

        //var_dump($data);die;

        $inserted = $this->settings_model->update_specialConsFee($data);

        if ($inserted > 0) {
            $this->session->set_flashdata('success-msg', 'Special Fee defined successfully');
        } else {
            $this->session->set_flashdata('error-msg', 'Failed, please try again');
        }
        redirect('settings/specialConsulatation'); 
    }

    function deletePaymentMode($id)
    {
        $inserted = $this->settings_model->add_deletePaymentMode($id);

       if ($inserted > 0) {
           $this->session->set_flashdata('success-msg', 'Payment Mode Deleted Successfully');
       }else{
            $this->session->set_flashdata('error-msg', 'Err! Failed Please Try Again');
       }

       redirect('settings/paymentSettings');
    }
}