<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Finance extends BASE_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('finance_model');
    }

    function coa_types() {
        // if (!$this->rbac->hasPrivilege('fees_type', 'can_view')) {
        //     access_denied();
        // }
        $this->session->set_userdata('top_menu', 'Finance');
        $this->session->set_userdata('sub_menu', 'finance/coa_types');
        $this->data['title'] = 'COA Type';
        $this->data['title_list'] = 'COA Type';

        
        $this->form_validation->set_rules('type_name', 'Type name', 'required');
        if ($this->form_validation->run() == FALSE) {
            
        } else {
            $data = array(
                'type_name' => $this->input->post('type_name')
            );
            $this->finance_model->add_coaType($data);
            $this->session->set_flashdata('msg', '<div class="alert alert-success text-left">' . $this->lang->line('success_message') . '</div>');
            redirect('admin/finance/coa_types');
        }
        $coa_types = $this->finance_model->get_coaTypes();
        $this->data['coa_types'] = $coa_types;
        $this->data['page_content'] = 'finance/coa_types';
        $this->load->view('layout/template', $this->data);
    }
    function design_pnl() {
        // if (!$this->rbac->hasPrivilege('fees_type', 'can_view')) {
        //     access_denied();
        // }
        $this->session->set_userdata('top_menu', 'Finance');
        $this->session->set_userdata('sub_menu', 'finance/design_pnl');
        $this->data['title'] = 'Desing P&L';
        $this->data['title_list'] = 'Desing P&L';

        
        $this->form_validation->set_rules('name', 'Name', 'required');
        if ($this->form_validation->run() == FALSE) {
            
        } else {
            $data = array(
                'type' => $this->input->post('type'),
                'name' => $this->input->post('name'),
                'accounts' => json_encode($this->input->post('accounts'))
            );
            $this->finance_model->design_pnl($data);
            $this->session->set_flashdata('msg', '<div class="alert alert-success text-left">' . $this->lang->line('success_message') . '</div>');
            redirect('admin/finance/design_pnl');
        }
        $coa_types = $this->finance_model->all_coa();
        $this->data['coa'] = $coa_types;
        $this->data['designs'] = $this->finance_model->fetch_pnlDesigns();

        $this->data['page_content'] = 'finance/design_pnl';
        $this->load->view('layout/template', $this->data);
    }
    function edit_pnl($id) {
        // if (!$this->rbac->hasPrivilege('fees_type', 'can_view')) {
        //     access_denied();
        // }
        $this->session->set_userdata('top_menu', 'Finance');
        $this->session->set_userdata('sub_menu', 'finance/design_pnl');
        $this->data['title'] = 'Desing P&L';
        $this->data['title_list'] = 'Desing P&L';

        
        $this->form_validation->set_rules('name', 'Name', 'required');
        if ($this->form_validation->run() == FALSE) {
            
        } else {
            $data = array(
                'type' => $this->input->post('type'),
                'name' => $this->input->post('name'),
                'accounts' => json_encode($this->input->post('accounts'))
            );
            $this->finance_model->edit_pnl($id,$data);
            $this->session->set_flashdata('msg', '<div class="alert alert-success text-left">' . $this->lang->line('success_message') . '</div>');
            redirect('admin/finance/design_pnl');
        }
        $this->data['id'] = $id;
        $coa_types = $this->finance_model->all_coa();
        $this->data['coa'] = $coa_types;
        $this->data['designs'] = $this->finance_model->fetch_pnlDesigns();
        $this->data['thisdesign'] = $this->finance_model->fetch_pnlDesignsID($id);
        // var_dump($this->data['thisdesign']);die;


    
        $this->data['page_content'] = 'finance/edit_pnl';
        $this->load->view('layout/template', $this->data);
    }
    
   
    
    function design_bs() {
        // if (!$this->rbac->hasPrivilege('fees_type', 'can_view')) {
        //     access_denied();
        // }
        $this->session->set_userdata('top_menu', 'Finance');
        $this->session->set_userdata('sub_menu', 'finance/design_bs');
        $this->data['title'] = 'Desing P&L';
        $this->data['title_list'] = 'Desing P&L';

        
        $this->form_validation->set_rules('name', 'Name', 'required');
        if ($this->form_validation->run() == FALSE) {
            
        } else {
            $data = array(
                'type' => $this->input->post('type'),
                'name' => $this->input->post('name'),
                'accounts' => json_encode($this->input->post('accounts'))
            );
            $this->finance_model->design_bs($data);
            $this->session->set_flashdata('msg', '<div class="alert alert-success text-left">' . $this->lang->line('success_message') . '</div>');
            redirect('admin/finance/design_bs');
        }
        $coa_types = $this->finance_model->all_coa();
        $this->data['coa'] = $coa_types;
        $this->data['designs'] = $this->finance_model->fetch_bsDesigns();

    
        $this->data['page_content'] = 'finance/design_bs';
        $this->load->view('layout/template', $this->data);
    }
    function edit_bs($id) {
        // if (!$this->rbac->hasPrivilege('fees_type', 'can_view')) {
        //     access_denied();
        // }
        $this->session->set_userdata('top_menu', 'Finance');
        $this->session->set_userdata('sub_menu', 'finance/design_bs');
        $this->data['title'] = 'Desing P&L';
        $this->data['title_list'] = 'Desing P&L';

        
        $this->form_validation->set_rules('name', 'Name', 'required');
        if ($this->form_validation->run() == FALSE) {
            
        } else {
            $data = array(
                'type' => $this->input->post('type'),
                'name' => $this->input->post('name'),
                'accounts' => json_encode($this->input->post('accounts'))
            );
            $this->finance_model->edit_bs($id,$data);
            $this->session->set_flashdata('msg', '<div class="alert alert-success text-left">' . $this->lang->line('success_message') . '</div>');
            redirect('admin/finance/design_bs');
        }
        $this->data['id'] = $id;
        $coa_types = $this->finance_model->all_coa();
        $this->data['coa'] = $coa_types;
        $this->data['designs'] = $this->finance_model->fetch_bsDesigns();
        $this->data['thisdesign'] = $this->finance_model->fetch_bsDesignsID($id);
        // var_dump($this->data['thisdesign']);die;


    
        $this->data['page_content'] = 'finance/edit_bs';
        $this->load->view('layout/template', $this->data);
    }
    
    function pnl() {
        // if (!$this->rbac->hasPrivilege('fees_type', 'can_view')) {
        //     access_denied();
        // }
        $this->session->set_userdata('top_menu', 'Finance');
        $this->session->set_userdata('sub_menu', 'finance/pnl');
        $this->data['title'] = 'Profit & Loss';
        $this->data['title_list'] = 'Profit & Loss';

    
        $this->data['page_content'] = 'finance/pnl';
        $this->load->view('layout/template', $this->data);
    }
    function pnl_display() {
        // if (!$this->rbac->hasPrivilege('fees_type', 'can_view')) {
        //     access_denied();
        // }
        $this->session->set_userdata('top_menu', 'Finance');
        $this->session->set_userdata('sub_menu', 'finance/pnl');
        $this->data['title'] = 'Profit & Loss';
        $this->data['title_list'] = 'Profit & Loss';

        
        $this->form_validation->set_rules('sdate', 'Start Date', 'required');
        $this->form_validation->set_rules('edate', 'End Date', 'required');
        if ($this->form_validation->run() == FALSE) {
            
        } else {
            $forminput = $this->input->post();
            $sdate = $forminput['sdate'];
            $edate = $forminput['edate'];
            
            $this->data['edate'] = $edate;
            $this->data['sdate'] = $sdate;
            $this->data['incomes'] = $this->finance_model->get_incomes($sdate,$edate);
            $this->data['expenses'] = $this->finance_model->get_expenses($sdate,$edate);
    
        
            $this->data['page_content'] = 'finance/pnl_display';
            $this->load->view('layout/template', $this->data);
        }
    }
      function print_pnl($sdate,$edate)
    {
        $data['edate'] = $edate;
            $data['sdate'] = $sdate;
            $data['incomes'] = $this->finance_model->get_incomes($sdate,$edate);
            $data['expenses'] = $this->finance_model->get_expenses($sdate,$edate);
            
         // boost the memory limit if it's low ;)
        ini_set('memory_limit', '64M');
        // load library
        $this->load->library('pdf');
        $this->pheight = 0;
        $this->load->library('pdf');
        $pdf = $this->pdf->load();
        // retrieve data from model or just static date
        $this->data['title'] = "items";
        $pdf->allow_charset_conversion = true;  // Set by default to TRUE
        $pdf->charset_in = 'UTF-8';
        //   $pdf->SetDirectionality('rtl'); // Set lang direction for rtl lang
        $pdf->autoLangToFont = true;
        $html = $this->load->view('printfiles/pnl', $data, true);
        $h = 160 + $this->pheight;
        //  $pdf->_setPageSize(array(70, $h), $this->orientation);
        // $pdf->_setPageSize(array(280, $h), $pdf->DefOrientation);
        $pdf->WriteHTML($html);
        // render the view into HTML
        // write the HTML into the PDF
        $file_name = preg_replace('/[^A-Za-z0-9]+/', '-', 'ThermalInvoice_' . $tid);
        if ($this->input->get('d')) {
            $pdf->Output($file_name . '.pdf', 'D');
        } else {
            $pdf->Output($file_name . '.pdf', 'I');
        }

        unlink('userfiles/pos_temp/' . $this->data['qrc']);
    }
    function bs_display() {
        // if (!$this->rbac->hasPrivilege('fees_type', 'can_view')) {
        //     access_denied();
        // }
        $this->session->set_userdata('top_menu', 'Finance');
        $this->session->set_userdata('sub_menu', 'finance/bs_display');
        $this->data['title'] = 'Balance Sheet';
        $this->data['title_list'] = 'Balance Sheet';

        
        
            $this->data['assets'] = $this->finance_model->get_Assets();
            $this->data['liabilities'] = $this->finance_model->get_Liabilities();
            $this->data['equity'] = $this->finance_model->get_Equity();
    
        
            $this->data['page_content'] = 'finance/bs_display';
            $this->load->view('layout/template', $this->data);
        
    }
     function print_bs()
    {
        $data['assets'] = $this->finance_model->get_Assets();
        $data['liabilities'] = $this->finance_model->get_Liabilities();
        $data['equity'] = $this->finance_model->get_Equity();
            
         // boost the memory limit if it's low ;)
        ini_set('memory_limit', '64M');
        // load library
        $this->load->library('pdf');
        $this->pheight = 0;
        $this->load->library('pdf');
        $pdf = $this->pdf->load();
        // retrieve data from model or just static date
        $this->data['title'] = "items";
        $pdf->allow_charset_conversion = true;  // Set by default to TRUE
        $pdf->charset_in = 'UTF-8';
        //   $pdf->SetDirectionality('rtl'); // Set lang direction for rtl lang
        $pdf->autoLangToFont = true;
        $html = $this->load->view('printfiles/bs', $data, true);
        $h = 160 + $this->pheight;
        //  $pdf->_setPageSize(array(70, $h), $this->orientation);
        // $pdf->_setPageSize(array(280, $h), $pdf->DefOrientation);
        $pdf->WriteHTML($html);
        // render the view into HTML
        // write the HTML into the PDF
        $file_name = preg_replace('/[^A-Za-z0-9]+/', '-', 'ThermalInvoice_' . $tid);
        if ($this->input->get('d')) {
            $pdf->Output($file_name . '.pdf', 'D');
        } else {
            $pdf->Output($file_name . '.pdf', 'I');
        }

        unlink('userfiles/pos_temp/' . $this->data['qrc']);
    }
    function product_services() {
        // if (!$this->rbac->hasPrivilege('fees_type', 'can_view')) {
        //     access_denied();
        // }
        $this->session->set_userdata('top_menu', 'Finance');
        $this->session->set_userdata('sub_menu', 'finance/product_services');
        $this->data['title'] = 'Products & Services';
        $this->data['title_list'] = 'Products & Services';

        
        $this->form_validation->set_rules('name', 'Name', 'required');
        if ($this->form_validation->run() == FALSE) {
            
        } else {
            $data = array(
                'name' => $this->input->post('name'),
                'acc_no' => $this->input->post('acc_no'),
                'type' => $this->input->post('type')
            );
            $this->finance_model->add_product($data);
            $this->session->set_flashdata('msg', '<div class="alert alert-success text-left">' . $this->lang->line('success_message') . '</div>');
            redirect('admin/finance/product_services');
        }
        $coa_types = $this->finance_model->get_products();
        $this->data['products'] = $coa_types;
        $this->data['coa'] = $this->finance_model->all_coa();

    
        $this->data['page_content'] = 'finance/product_services';
        $this->load->view('layout/template', $this->data);
    }
    function suppliers() {
        // if (!$this->rbac->hasPrivilege('fees_type', 'can_view')) {
        //     access_denied();
        // }
        $this->session->set_userdata('top_menu', 'Finance');
        $this->session->set_userdata('sub_menu', 'finance/suppliers');
        $this->data['title'] = 'Suppliers';
        $this->data['title_list'] = 'Suppliers';

        
        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('phone', 'Phone number', 'required');
        if ($this->form_validation->run() == FALSE) {
            
        } else {
            $data = array(
                'name' => $this->input->post('name'),
                'phone' => $this->input->post('phone'),
                'email' => $this->input->post('email'),
                'address' => $this->input->post('address')
            );
            $this->finance_model->add_suppliers($data);
            $this->session->set_flashdata('msg', '<div class="alert alert-success text-left">' . $this->lang->line('success_message') . '</div>');
            redirect('admin/finance/suppliers');
        }
        $coa_types = $this->finance_model->get_suppliers();
        $this->data['suppliers'] = $coa_types;

    
        $this->data['page_content'] = 'finance/suppliers';
        $this->load->view('layout/template', $this->data);
    }
    function edit_supplier($id) {
        // if (!$this->rbac->hasPrivilege('fees_type', 'can_view')) {
        //     access_denied();
        // }
        $this->session->set_userdata('top_menu', 'Finance');
        $this->session->set_userdata('sub_menu', 'finance/suppliers');
        $this->data['title'] = 'Suppliers';
        $this->data['title_list'] = 'Suppliers';

        
        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('phone', 'Phone number', 'required');
        if ($this->form_validation->run() == FALSE) {
            
        } else {
            $data = array(
                'name' => $this->input->post('name'),
                'phone' => $this->input->post('phone'),
                'email' => $this->input->post('email'),
                'address' => $this->input->post('address')
            );
            $this->finance_model->edit_suppliers($data,$id);
            $this->session->set_flashdata('msg', '<div class="alert alert-success text-left">' . $this->lang->line('success_message') . '</div>');
            redirect('admin/finance/suppliers');
        }
        $coa_types = $this->finance_model->get_suppliers();
        $this->data['suppliers'] = $coa_types;
        $this->data['thissupp'] = $this->finance_model->get_suppliersID($id);
        $this->data['id'] = $id;
        
        // var_dump( $this->data['thissupp']);die;

    
        $this->data['page_content'] = 'finance/edit_suppliers';
        $this->load->view('layout/template', $this->data);
    }
    function edit_product($id) {
        // if (!$this->rbac->hasPrivilege('fees_type', 'can_view')) {
        //     access_denied();
        // }
        $this->session->set_userdata('top_menu', 'Finance');
        $this->session->set_userdata('sub_menu', 'finance/product_services');
        $this->data['title'] = 'Products & Services';
        $this->data['title_list'] = 'Products & Services';

        
        $this->form_validation->set_rules('name', 'Name', 'required');
        if ($this->form_validation->run() == FALSE) {
            
        } else {
            $data = array(
                'name' => $this->input->post('name'),
                'acc_no' => $this->input->post('acc_no'),
                'type' => $this->input->post('type')
            );
            $this->finance_model->edit_product($data,$id);
            $this->session->set_flashdata('msg', '<div class="alert alert-success text-left">' . $this->lang->line('success_message') . '</div>');
            redirect('admin/finance/product_services');
        }
        $coa_types = $this->finance_model->get_products();
        $this->data['products'] = $coa_types;
        $this->data['coa'] = $this->finance_model->all_coa();
        $this->data['id'] = $id;
        $this->data['thisproduct'] = $this->finance_model->get_productsID($id);

    
        $this->data['page_content'] = 'finance/edit_product';
        $this->load->view('layout/template', $this->data);
    }
    function coa() {
        // if (!$this->rbac->hasPrivilege('fees_type', 'can_view')) {
        //     access_denied();
        // }
        $this->session->set_userdata('top_menu', 'Finance');
        $this->session->set_userdata('sub_menu', 'finance/coa');
        $this->data['title'] = 'COA Type';
        $this->data['title_list'] = 'COA Type';

        
        $this->form_validation->set_rules('name', 'Name', 'required');
        if ($this->form_validation->run() == FALSE) {
            
        } else {
            $data = array(
                'acc_name' => $this->input->post('name'),
                'type' => $this->input->post('type'),
                'is_fees' => $this->input->post('is_fees'),
                'is_or_bs' => $this->input->post('is_or_bs'),
                'parent_id' => $this->input->post('parent_id'),
                'credit_debit' => $this->input->post('credit_debit'),
                'description' => $this->input->post('description'),
                'is_parent' => '1'
                
            );
            $this->finance_model->add_coa($data);
            $this->session->set_flashdata('msg', '<div class="alert alert-success text-left">' . $this->lang->line('success_message') . '</div>');
            redirect('admin/finance/coa');
        }
        $coa_types = $this->finance_model->get_coaTypes();
        $this->data['coa_types'] = $coa_types;
        $this->data['coa'] = $this->finance_model->get_coa();

    
        $this->data['page_content'] = 'finance/coa';
        $this->load->view('layout/template', $this->data);
    }
    
    function ledger() {
        // if (!$this->rbac->hasPrivilege('fees_type', 'can_view')) {
        //     access_denied();
        // }
        $this->session->set_userdata('top_menu', 'Finance');
        $this->session->set_userdata('sub_menu', 'finance/ledger');
        $this->data['title'] = 'The Ledger';
        $this->data['title_list'] = 'The Ledger';

        
        $this->form_validation->set_rules('name', 'Name', 'required');
        if ($this->form_validation->run() == FALSE) {
            
        } else {
            $data_1 = array(
                'acc_id' => $this->input->post('debit'),
                'type' => "Debit",
                'amount' => $this->input->post('amount'),
                'name' => $this->input->post('name'),
                'date' => $this->input->post('date_trans')
            );
            
            $data_2 = array(
                'acc_id' => $this->input->post('credit'),
                'type' => "Credit",
                'amount' => $this->input->post('amount'),
                'name' => $this->input->post('name'),
                'date' => $this->input->post('date_trans')
            );
            $this->finance_model->add_ledger($data_1);
            $this->finance_model->add_ledger($data_2);
            $this->session->set_flashdata('msg', '<div class="alert alert-success text-left">' . $this->lang->line('success_message') . '</div>');
            redirect('admin/finance/ledger');
        }
        $this->data['ledger'] = $this->finance_model->get_ledger();
        $this->data['coa'] = $this->finance_model->all_coa();

    
        $this->data['page_content'] = 'finance/ledger';
        $this->load->view('layout/template', $this->data);
    }
    
    function edit_ledger($id) {
        // if (!$this->rbac->hasPrivilege('fees_type', 'can_view')) {
        //     access_denied();
        // }
        $this->session->set_userdata('top_menu', 'Finance');
        $this->session->set_userdata('sub_menu', 'finance/ledger');
        $this->data['title'] = 'The Ledger';
        $this->data['title_list'] = 'The Ledger';

        
        $this->form_validation->set_rules('name', 'Name', 'required');
        if ($this->form_validation->run() == FALSE) {
            
        } else {
            $data = array(
                'acc_id' => $this->input->post('acc_id'),
                'amount' => $this->input->post('amount'),
                'name' => $this->input->post('name'),
                'date' => $this->input->post('date_trans')
            );
            
            $this->finance_model->update_ledger($id,$data);
            $this->session->set_flashdata('msg', '<div class="alert alert-success text-left">' . $this->lang->line('success_message') . '</div>');
            redirect('admin/finance/ledger');
        }
        $this->data['ledger'] = $this->finance_model->get_ledger();
        $this->data['thisledger'] = $this->finance_model->get_ledgerID($id);
        $this->data['coa'] = $this->finance_model->all_coa();
        $this->data['id'] = $id;

    
        $this->data['page_content'] = 'finance/edit_ledger';
        $this->load->view('layout/template', $this->data);
    }
    
    function edit_coa($id) {
        // if (!$this->rbac->hasPrivilege('fees_type', 'can_view')) {
        //     access_denied();
        // }
        $this->session->set_userdata('top_menu', 'Finance');
        $this->session->set_userdata('sub_menu', 'finance/coa');
        $this->data['title'] = 'COA';
        $this->data['title_list'] = 'COA';

        
        $this->form_validation->set_rules('name', 'Name', 'required');
        if ($this->form_validation->run() == FALSE) {
            
        } else {
            $data = array(
                'acc_name' => $this->input->post('name'),
                'type' => $this->input->post('type'),
                'is_fees' => $this->input->post('is_fees'),
                'is_or_bs' => $this->input->post('is_or_bs'),
                'parent_id' => $this->input->post('parent_id'),
                'credit_debit' => $this->input->post('credit_debit'),
                'description' => $this->input->post('description'),
                'is_parent' => '1'
                
            );
            $this->finance_model->edit_coa($id,$data);
            $this->session->set_flashdata('msg', '<div class="alert alert-success text-left">' . $this->lang->line('success_message') . '</div>');
            redirect('admin/finance/coa');
        }
        $coa_types = $this->finance_model->get_coaTypes();
        $this->data['coa_types'] = $coa_types;
        $this->data['coa'] = $this->finance_model->get_coa();
        $this->data['thiscoa'] = $this->finance_model->get_coaID($id);
        $this->data['id'] = $id;

    
        $this->data['page_content'] = 'finance/edit_coa';
        $this->load->view('layout/template', $this->data);
    }
    function edit_coaType($id) {
        // if (!$this->rbac->hasPrivilege('fees_type', 'can_view')) {
        //     access_denied();
        // }
        $this->session->set_userdata('top_menu', 'Finance');
        $this->session->set_userdata('sub_menu', 'finance/coa_types');
        $this->data['title'] = 'COA Type';
        $this->data['title_list'] = 'COA Type';

        
        $this->form_validation->set_rules('type_name', 'Type name', 'required');
        if ($this->form_validation->run() == FALSE) {
            
        } else {
            $data = array(
                'type_name' => $this->input->post('type_name')
            );
            $this->finance_model->edit_coaType($id,$data);
            $this->session->set_flashdata('msg', '<div class="alert alert-success text-left">' . $this->lang->line('success_message') . '</div>');
            redirect('admin/finance/coa_types');
        }
        $coa_types = $this->finance_model->get_coaTypes();
        $this->data['thistype'] = $this->finance_model->get_coaTypesbyID($id);
        $this->data['coa_types'] = $coa_types;
        $this->data['id'] = $id;

    
        $this->data['page_content'] = 'finance/edit_coatypes';
        $this->load->view('layout/template', $this->data);
    }
    function bills() {
        // if (!$this->rbac->hasPrivilege('fees_type', 'can_view')) {
        //     access_denied();
        // }
        $this->session->set_userdata('top_menu', 'Finance');
        $this->session->set_userdata('sub_menu', 'finance/bills');
        $this->data['title'] = 'Bills';
        $this->data['title_list'] = 'Bills';

        $this->data['bills'] = $this->finance_model->get_bills();
        
        // var_dump($this->data['bills']);die;

    
        $this->data['page_content'] = 'finance/bills';
        $this->load->view('layout/template', $this->data);
    }
    function add_bill() {
        // if (!$this->rbac->hasPrivilege('fees_type', 'can_view')) {
        //     access_denied();
        // }
        $this->session->set_userdata('top_menu', 'Finance');
        $this->session->set_userdata('sub_menu', 'finance/add_bill');
        $this->data['title'] = 'Add Bill';
        $this->data['title_list'] = 'Add Bill';

        
        $this->form_validation->set_rules('description', 'Description', 'required');
        if ($this->form_validation->run() == FALSE) {
            
        } else {
            // 					
            $bill_data = array(
                'description' => $this->input->post('description'),
                'supp_id' => $this->input->post('supplier_id'),
                'payment_terms' => $this->input->post('payment_terms'),
                'date' => $this->input->post('date'),
                'reference_no' => $this->input->post('reference_no')
            );
            $products = $this->input->post('product');
            $services = $this->input->post('service');
            $prod_cost = $this->input->post('prod_cost');
            $serv_cost = $this->input->post('serv_cost');
            $prod_qty = $this->input->post('prod_qty');
            $totcost = 0;
            $items_data = array();
            if(sizeof($products) > 0 || sizeof($services) > 0){
                for($i=0;$i<sizeof($products); $i++){
                // $prod == $products['$i'];
                $totcost += $prod_cost[$i] * $prod_qty[$i];
                $particulars = array("cost" => $prod_cost[$i], "qty" => $prod_qty[$i]);
                $items_data[] = array("item_id" => $products[$i],"type" =>"product","particulars" => json_encode($particulars));
                }
                for($i=0;$i<sizeof($services); $i++){
                    // $prod == $products['$i'];
                    $totcost += $serv_cost[$i];
                    $particulars = array("cost" => $serv_cost[$i]);
                    $items_data[] = array("item_id" => $services[$i],"type" =>"service","particulars" => json_encode($particulars));
                }
                
                $bill_data['amount'] = $totcost;
                
                // var_dump($items_data);die;
                $this->finance_model->add_bill($bill_data,$items_data);
                $this->session->set_flashdata('msg', '<div class="alert alert-success text-left">' . $this->lang->line('success_message') . '</div>');
                redirect('admin/finance/bills');
            }else{
                $this->session->set_flashdata('msg', '<div class="alert alert-danger text-left">You must add a product or service!</div>');
                redirect('admin/finance/add_bill');
            }
            
        }
        $this->data['products'] = $this->finance_model->get_products();
        $this->data['suppliers'] = $this->finance_model->get_suppliers();
        $this->data['payment_terms'] = $this->finance_model->get_paymentTerms();
        $this->data['products'] = $this->finance_model->get_products();

    
        $this->data['page_content'] = 'finance/add_bill';
        $this->load->view('layout/template', $this->data);
    }
    function view_bill($id) {
        // if (!$this->rbac->hasPrivilege('fees_type', 'can_view')) {
        //     access_denied();
        // }
        $this->session->set_userdata('top_menu', 'Finance');
        $this->session->set_userdata('sub_menu', 'finance/edit_bill');
        $this->data['title'] = 'View Bill';
        $this->data['title_list'] = 'View Bill';

        
        $this->form_validation->set_rules('description', 'Description', 'required');
        if ($this->form_validation->run() == FALSE) {
            
        } else {
            // 					
            $bill_data = array(
                'description' => $this->input->post('description'),
                'supp_id' => $this->input->post('supplier_id'),
                'payment_terms' => $this->input->post('payment_terms'),
                'date' => $this->input->post('date'),
                'reference_no' => $this->input->post('reference_no')
            );
            $products = $this->input->post('product');
            $services = $this->input->post('service');
            $prod_cost = $this->input->post('prod_cost');
            $serv_cost = $this->input->post('serv_cost');
            $prod_qty = $this->input->post('prod_qty');
            $totcost = 0;
            $items_data = array();
            if(sizeof($products) > 0 || sizeof($services) > 0){
                // echo "greater";die;
                for($i=0;$i<sizeof($products); $i++){
                // $prod == $products['$i'];
                $totcost += $prod_cost[$i] * $prod_qty[$i];
                $particulars = array("cost" => $prod_cost[$i], "qty" => $prod_qty[$i]);
                $items_data[] = array("item_id" => $products[$i],"type" =>"product","particulars" => json_encode($particulars));
                }
                for($i=0;$i<sizeof($services); $i++){
                    // $prod == $products['$i'];
                    $totcost += $serv_cost[$i];
                    $particulars = array("cost" => $serv_cost[$i]);
                    $items_data[] = array("item_id" => $services[$i],"type" =>"service","particulars" => json_encode($particulars));
                }
                
                $bill_data['amount'] = $totcost;
                
                // var_dump($items_data);die;
                $this->finance_model->edit_bill($id,$bill_data,$items_data);
                $this->session->set_flashdata('msg', '<div class="alert alert-success text-left">' . $this->lang->line('success_message') . '</div>');
                redirect('admin/finance/bills');
            }else{
                // echo "less";die;
                $this->session->set_flashdata('msg', '<div class="alert alert-danger text-left">You must add a product or service!</div>');
                redirect('admin/finance/edit_bill/'.$id);
            }
        }
        $this->data['billitems'] = $this->finance_model->get_billItems($id);
        $this->data['thisbill'] = $this->finance_model->get_billsID($id);
        $this->data['id'] = $id;
        $this->data['suppliers'] = $this->finance_model->get_suppliers();
        $this->data['payment_terms'] = $this->finance_model->get_paymentTerms();
        $this->data['billpayments'] = $this->finance_model->get_billPayment();
        
        
        // var_dump($this->data['billitems']);die;

    
        $this->data['page_content'] = 'finance/view_bill';
        $this->load->view('layout/template', $this->data);
    }
    function edit_bill($id) {
        // if (!$this->rbac->hasPrivilege('fees_type', 'can_view')) {
        //     access_denied();
        // }
        $this->session->set_userdata('top_menu', 'Finance');
        $this->session->set_userdata('sub_menu', 'finance/edit_bill');
        $this->data['title'] = 'Edit Bill';
        $this->data['title_list'] = 'Edit Bill';

        
        $this->form_validation->set_rules('description', 'Description', 'required');
        if ($this->form_validation->run() == FALSE) {
            
        } else {
            // 					
            $bill_data = array(
                'description' => $this->input->post('description'),
                'supp_id' => $this->input->post('supplier_id'),
                'payment_terms' => $this->input->post('payment_terms'),
                'date' => $this->input->post('date'),
                'reference_no' => $this->input->post('reference_no')
            );
            $products = $this->input->post('product');
            $services = $this->input->post('service');
            $prod_cost = $this->input->post('prod_cost');
            $serv_cost = $this->input->post('serv_cost');
            $prod_qty = $this->input->post('prod_qty');
            $totcost = 0;
            $items_data = array();
            if(sizeof($products) > 0 || sizeof($services) > 0){
                // echo "greater";die;
                for($i=0;$i<sizeof($products); $i++){
                // $prod == $products['$i'];
                $totcost += $prod_cost[$i] * $prod_qty[$i];
                $particulars = array("cost" => $prod_cost[$i], "qty" => $prod_qty[$i]);
                $items_data[] = array("item_id" => $products[$i],"type" =>"product","particulars" => json_encode($particulars));
                }
                for($i=0;$i<sizeof($services); $i++){
                    // $prod == $products['$i'];
                    $totcost += $serv_cost[$i];
                    $particulars = array("cost" => $serv_cost[$i]);
                    $items_data[] = array("item_id" => $services[$i],"type" =>"service","particulars" => json_encode($particulars));
                }
                
                $bill_data['amount'] = $totcost;
                
                // var_dump($items_data);die;
                $this->finance_model->edit_bill($id,$bill_data,$items_data);
                $this->session->set_flashdata('msg', '<div class="alert alert-success text-left">' . $this->lang->line('success_message') . '</div>');
                redirect('admin/finance/bills');
            }else{
                // echo "less";die;
                $this->session->set_flashdata('msg', '<div class="alert alert-danger text-left">You must add a product or service!</div>');
                redirect('admin/finance/edit_bill/'.$id);
            }
        }
        $this->data['products'] = $this->finance_model->get_products();
        $this->data['suppliers'] = $this->finance_model->get_suppliers();
        $this->data['payment_terms'] = $this->finance_model->get_paymentTerms();
        $this->data['products'] = $this->finance_model->get_products();
        $this->data['billitems'] = $this->finance_model->get_billItems($id);
        $this->data['thisbill'] = $this->finance_model->get_billsID($id);
        $this->data['id'] = $id;
        
        // var_dump($this->data['billitems']);die;

    
        $this->data['page_content'] = 'finance/edit_bill';
        $this->load->view('layout/template', $this->data);
    }
    function pay_bill($id) {
        // if (!$this->rbac->hasPrivilege('fees_type', 'can_view')) {
        //     access_denied();
        // }
        $this->session->set_userdata('top_menu', 'Finance');
        $this->session->set_userdata('sub_menu', 'finance/pay_bill');
        $this->data['title'] = 'Pay Bill';
        $this->data['title_list'] = 'Pay Bill';

        
        $this->form_validation->set_rules('amount', 'Amount', 'required');
        if ($this->form_validation->run() == FALSE) {
            
        } else {
            
            $forminput = $this->input->post();
            $amount = $forminput['amount'];
            $discount = $forminput['discount'];
            $account = $forminput['acc_id'];
            $thisbill = $this->finance_model->get_billsID($id);
            $date = $forminput['date'];
            
            $data = array(
                'acc_id' => $account,
                'type' => "Credit",
                'amount' => $amount,
                'name' => $thisbill['description'],
                'date' => $date,
                'bill_id' => $id
            );
            
            $billinsert = array('bill_id' => $id,'acc_id' => $account, 'amount' => $amount, 'date' => $date);
            $insid = $this->finance_model->insert_billPayment($billinsert);
            $this->data['pmt_id'] = $insid;
            
            // var_dump($data);die;
            
            $this->finance_model->add_ledger($data);
            
            if($thisbill['discount'] == 0){
               $billdta = array('discount' => $discount);
               $this->finance_model->add_discount($id,$billdta); 
            }
            
            redirect('admin/finance/bills');
           
        }
        $this->data['products'] = $this->finance_model->get_products();
        $this->data['suppliers'] = $this->finance_model->get_suppliers();
        $this->data['payment_terms'] = $this->finance_model->get_paymentTerms();
        $this->data['thisbill'] = $this->finance_model->get_billsID($id);
        $this->data['id'] = $id;
        $this->data['coa'] = $this->finance_model->all_coa();
        
        // var_dump($this->data['billitems']);die;

    
        $this->data['page_content'] = 'finance/pay_bill';
        $this->load->view('layout/template', $this->data);
    }
    function edit_billPmt($id,$bid) {
        // if (!$this->rbac->hasPrivilege('fees_type', 'can_view')) {
        //     access_denied();
        // }
        $this->session->set_userdata('top_menu', 'Finance');
        $this->session->set_userdata('sub_menu', 'finance/edit_payment');
        $this->data['title'] = 'Edit Payment';
        $this->data['title_list'] = 'Edit Payment';

        
        $this->form_validation->set_rules('amount', 'Amount', 'required');
        if ($this->form_validation->run() == FALSE) {
            
        } else {
            
            $forminput = $this->input->post();
            $amount = $forminput['amount'];
            $account = $forminput['acc_id'];
            $date = $forminput['date'];
            
            $billinsert = array('acc_id' => $account, 'amount' => $amount, 'date' => $date);
            $ledger = array('amount'=> $amount);
            $insid = $this->finance_model->update_billPayment($id,$billinsert,$ledger);
            
            redirect('admin/finance/view_bill/'.$bid);
           
        }
        $this->data['thispmt'] = $this->finance_model->get_billPaymentID($id);
        $this->data['id'] = $id;
        $this->data['coa'] = $this->finance_model->all_coa();
        $this->data['bid'] = $bid;
        // var_dump($this->data['billitems']);die;

    
        $this->data['page_content'] = 'finance/edit_billPmt';
        $this->load->view('layout/template', $this->data);
    }
    public function delete_coaType($id)
    {
        $this->finance_model->delete_coaType($id);
        redirect('admin/finance/coa_types');
    }
    
     public function delete_ledger($id)
    {
        $this->finance_model->delete_ledger($id);
        redirect('admin/finance/ledger');
    }
    public function delete_coa($id)
    {
        $this->finance_model->delete_coa($id);
        redirect('admin/finance/coa');
    }
    
    public function delete_product($id)
    {
        $this->finance_model->delete_product($id);
        redirect('admin/finance/product_services');
    }
    
    public function delete_billPmt($id,$bid)
    {
        $this->finance_model->delete_billPayment($id);
        redirect('admin/finance/view_bill/'.$bid);
    }
    
    public function delete_supplier($id)
    {
        $this->finance_model->delete_suppliers($id);
        redirect('admin/finance/suppliers');
    }
    public function delete_bill($id)
    {
        $this->finance_model->delete_bill($id);
        redirect('admin/finance/bills');
    }
    
    public function delete_pnl($id)
    {
        $this->finance_model->delete_pnlDesigns($id);
        redirect('admin/finance/design_pnl');
    }
    public function delete_bs($id)
    {
        $this->finance_model->delete_bsDesigns($id);
        redirect('admin/finance/design_bs');
    }

   
}

?>