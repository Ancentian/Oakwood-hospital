<?php $userdata = $this->session->userdata('user_aob');


?>
<div class="app-main">
    <div class="app-sidebar sidebar-shadow header-text-dark">
        <div class="app-header__logo">
            <div class="logo-src"></div>
            <div class="header__pane ml-auto">
                <div>
                    <button type="button" class="hamburger close-sidebar-btn hamburger--elastic"
                    data-class="closed-sidebar">
                    <span class="hamburger-box">
                        <span class="hamburger-inner"></span>
                    </span>
                </button>
            </div>
        </div>
    </div>
    <div class="app-header__mobile-menu">
        <div>
            <button type="button" class="hamburger hamburger--elastic mobile-toggle-nav">
                <span class="hamburger-box">
                    <span class="hamburger-inner"></span>
                </span>
            </button>
        </div>
    </div>
    <div class="app-header__menu">
        <span>
            <button type="button"
            class="btn-icon btn-icon-only btn btn-primary btn-sm mobile-toggle-header-nav">
            <span class="btn-icon-wrapper">
                <i class="fa fa-ellipsis-v fa-w-6"></i>
            </span>
        </button>
    </span>
</div>
<div class="scrollbar-sidebar" style="overflow-y: auto; ">
    <div class="app-sidebar__inner">
        <ul class="vertical-nav-menu">
            <?php if($this->session->userdata('user_aob')->role == 'admin' || $this->session->userdata('user_aob')->role =='pharmacist' || $this->session->userdata('user_aob')->role =='finance') {?>
            <li>
                <a href="#">
                    <b>
                        
                        <i style="font-size: 1.5rem; color: Mediumslateblue;" class=" pe-7s-cart"></i>
                        POS
                        <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>

                    </b>
                    </a>
                    <ul>   
                        <li>
                            <a href="<?php echo base_url();?>pos">
                                <i class="metismenu-icon pe-7s-cart">
                                </i>Pos
                            </a>
                        </li>                             
                        <li>
                            <a href="<?php echo base_url();?>pos/invoices">
                                <i class="metismenu-icon pe-7s-mouse">
                                </i>Invoices
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo base_url();?>pos/invoices?todays=yes">
                                <i class="metismenu-icon pe-7s-mouse">
                                </i>Todays Invoices
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo base_url();?>pos/payments">
                                <i class="metismenu-icon pe-7s-mouse">
                                </i>Payments
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo base_url();?>pos/payments?todays=yes">
                                <i class="metismenu-icon pe-7s-mouse">
                                </i>Todays Payments
                            </a>
                        </li>
                        <li hidden="">
                            <a href="<?php echo base_url();?>pos/collectpayment">
                                <i class="metismenu-icon pe-7s-mouse">
                                </i>Make Payment
                            </a>
                        </li>
                    </ul>
                </li>
            <?php }?>
                <?php if ($this->session->userdata('user_aob')->role == 'admin' || $this->session->userdata('user_aob')->role == 'finance'){ ?>
                <li>
                <a href="#">
                    <i style="font-size: 1.5rem; color: Mediumslateblue;" class="fa fa-dollar"></i>
                        Finance
                        <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                    </a>
                    <ul>   
                        <li>
                            <a href="<?php echo base_url();?>admin/finance/add_bill">
                                <i class="metismenu-icon pe-7s-cart">
                                </i>Add Bill
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo base_url();?>admin/finance/bills">
                                <i class="metismenu-icon pe-7s-cart">
                                </i>Bills
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo base_url();?>admin/finance/coa">
                                <i class="metismenu-icon pe-7s-cart">
                                </i>Chart of Accounts
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo base_url();?>admin/finance/coa_types">
                                <i class="metismenu-icon pe-7s-cart">
                                </i>COA Types
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo base_url();?>admin/finance/ledger">
                                <i class="metismenu-icon pe-7s-cart">
                                </i>Ledger
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo base_url();?>admin/finance/suppliers">
                                <i class="metismenu-icon pe-7s-cart">
                                </i>Suppliers
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo base_url();?>admin/finance/product_services">
                                <i class="metismenu-icon pe-7s-cart">
                                </i>Products/Services
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo base_url();?>admin/finance/pnl">
                                <i class="metismenu-icon pe-7s-cart">
                                </i>Profit & Loss
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo base_url();?>admin/finance/design_pnl">
                                <i class="metismenu-icon pe-7s-cart">
                                </i>Design P&L
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo base_url();?>admin/finance/bs_display">
                                <i class="metismenu-icon pe-7s-cart">
                                </i>Balance Sheet
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo base_url();?>admin/finance/design_bs">
                                <i class="metismenu-icon pe-7s-cart">
                                </i>Design BS
                            </a>
                        </li>
                        
                    </ul>
                </li>
                <?php } ?>
                <?php if($this->session->userdata('user_aob')->role == 'admin' || $this->session->userdata('user_aob')->role =='pharmacist') {?>
                <li>
                    <a href="#">
                        <i style="font-size: 1.5rem; color: Tomato;" class="  pe-7s-server"></i>&nbsp;
                        Pharmacy
                        <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                    </a>
                    <ul>
                        <li>
                            <a href="<?php echo base_url(); ?>pharmacy/inventory">
                                <i class="metismenu-icon pe-7s-display2"></i>
                                Inventory
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo base_url(); ?>pharmacy/addmedicine">
                                <i class="metismenu-icon pe-7s-display2"></i>
                                Add Medicine
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo base_url(); ?>pharmacy/history">
                                <i class="metismenu-icon pe-7s-display2"></i>
                                Purchase History
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo base_url(); ?>pharmacy/todaysReport">
                                <i class="metismenu-icon pe-7s-display2"></i>
                                Todays Report
                            </a>
                        </li>
                    </ul>
                </li>
            <?php }?>
                <li>
                    <a href="#">
                        <i style="font-size: 1.5rem; color: Mediumslateblue;"  class="pe-7s-car"></i>
                        <?php echo $this->session->userdata('user_aob')->dptname;?>
                        <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                    </a>
                    <ul>
                        <?php
                        $this->db->where('id', '1');
                        $this->db->select('department,is_offered')->from('work_flows');
                        $query = $this->db->get();
                        $activity = $query->result_array()[0];
                        if (($activity['is_offered'] == 'yes' && $activity['department'] == $userdata->department) || $userdata->department == '18' || $this->session->userdata('user_aob')->role == 'finance') {
                            ?>

                            <li>
                                <a href="<?php echo base_url() ?>queue/search">
                                    <i class="metismenu-icon pe-7s-display2"></i>
                                    Add Patient to Queue
                                </a>
                            </li>
                        <?php } ?>
                        <?php
                        $this->db->where('id', '5');
                        $this->db->select('department,is_offered')->from('work_flows');
                        $query = $this->db->get();
                        $activity = $query->result_array()[0];
                        if ($activity['is_offered'] == 'yes' && $activity['department'] == $userdata->department) {
                            ?>

                            <li>
                                <a href="<?php echo base_url() ?>payments/search">
                                    <i class="metismenu-icon pe-7s-display2"></i>
                                    Add Payment
                                </a>
                            </li>
                            <li>
                                <a href="<?php echo base_url() ?>queue/myqueue">
                                    <i class="metismenu-icon pe-7s-display2"></i>
                                    Active Queue
                                </a>
                            </li>
                            <li>
                                <a href="<?php echo base_url() ?>queue/seenqueue">
                                    <i class="metismenu-icon pe-7s-display2"></i>
                                    Seen Queue
                                </a>
                            </li>
                            <li>
                                <a href="<?php echo base_url(); ?>appointment/search">
                                    <i class="metismenu-icon pe-7s-display2"></i>
                                    Patient Appointments
                                </a>
                            </li>
                            
                        <?php } else{ if($this->session->userdata('user_aob')->role == 'admin' || $this->session->userdata('user_aob')->role == 'finance' || $this->session->userdata('user_aob')->role == 'receptionist'){?>
                           <li>
                            <a href="<?php echo base_url() ?>payments/search">
                                <i class="metismenu-icon pe-7s-display2"></i>
                                Add Payment
                            </a>
                        </li>
                        <?php } else{ if($this->session->userdata('user_aob')->role == 'admin'){?>
                           <li>
                                <a href="<?php echo base_url(); ?>departmental_reports/consultationIndex">
                                    <i class="metismenu-icon pe-7s-display2"></i>
                                    Today's Report
                                </a>
                            </li>
                            <?php } ?>
                    <?php } ?>
                <?php if($this->session->userdata('user_aob')->role != 'finance'){?>
                    <li>
                        <a href="<?php echo base_url() ?>queue/myqueue">
                            <i class="metismenu-icon pe-7s-display2"></i>
                            Active Queue
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo base_url() ?>queue/seenqueue">
                            <i class="metismenu-icon pe-7s-display2"></i>
                            Seen Queue
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo base_url(); ?>appointment/search">
                            <i class="metismenu-icon pe-7s-display2"></i>
                            Patient Appointments
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo base_url(); ?>inpatient/admitted">
                            <i class="metismenu-icon pe-7s-display2"></i>
                            Admitted Patients
                        </a>
                    </li>
                    <?php } ?>
            <?php } ?>
            </ul>
        </li>
        <?php if ($this->session->userdata('user_aob')->role == 'admin' || $this->session->userdata('user_aob')->role == 'receptionist' || $this->session->userdata('user_aob')->role == 'finance') { ?>
        <li>
            <a href="#">
                <i style="font-size: 1.5rem; color: Orange;" class="  pe-7s-add-user"></i>
                Patients
                <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
            </a>
            <ul>
                    <li>
                        <a href="<?php echo base_url(); ?>dashboard/addpatient">
                            <i class="metismenu-icon pe-7s-user"></i>
                            Register Patient
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo base_url(); ?>dashboard/patientslist">
                            <i class="metismenu-icon pe-7s-display2"></i>
                            Patients List
                        </a>
                    </li>
                 <li>
                    <a href="<?php echo base_url(); ?>history/search">
                        <i class="metismenu-icon pe-7s-display2"></i>
                        Patient History
                    </a>
                </li>
                <li>
                        <a href="<?php echo base_url(); ?>dashboard/todays_patients">
                            <i class="metismenu-icon pe-7s-display2"></i>
                            Today's Patients
                        </a>
                    </li>
            </ul>
        </li>
    <?php } ?>

    <?php if ($this->session->userdata('user_aob')->role == 'admin' || $this->session->userdata('user_aob')->role == 'lab') { ?>
        
        <li>
            <a href="#">
                <i style="font-size: 1.5rem; color: Mediumslateblue;" class=" fas fa-vial"></i>
                Lab
                <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
            </a>
            <ul>
                <li>
                    <a href="<?php echo base_url(); ?>labtest/index">
                        <i class="metismenu-icon pe-7s-display2">
                        </i>Lab Tests
                    </a>
                </li>
                <li>
                    <a href="<?php echo base_url(); ?>labtest/addtest">
                        <i class="metismenu-icon pe-7s-display2">
                        </i>Add Lab Tests
                    </a>
                </li>
                <li>
                    <a href="<?php echo base_url(); ?>labtest/addCategory">
                        <i class="metismenu-icon pe-7s-display2">
                        </i>Add Test Category
                    </a>
                </li>
                <li>
                    <a href="<?php echo base_url(); ?>labtest/categoryIndex">
                        <i class="metismenu-icon pe-7s-display2">
                        </i>Test Categories
                    </a>
                </li>
                <li>
                    <a href="<?php echo base_url(); ?>labtest/todaysReport">
                        <i class="metismenu-icon pe-7s-display2">
                        </i>Today's Report
                    </a>
                </li>
            </ul>
        </li>
        <li>
            <a href="#">
                <i style="font-size: 1.5rem; color: Purple;" class=" pe-7s-diamond"></i>
                Radiology
                <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
            </a>
            <ul>
                <li>
                    <a href="<?php echo base_url(); ?>radiology/index">
                        <i class="metismenu-icon pe-7s-display2">
                        </i>Radiology Tests
                    </a>
                </li>
                <li>
                    <a href="<?php echo base_url(); ?>" data-target="#radiology-category" data-toggle="modal">
                        <i class="metismenu-icon pe-7s-display2">
                        </i>Add Category
                    </a>
                </li>
                <li>
                    <a href="<?php echo base_url(); ?>radiology/categoryList">
                        <i class="metismenu-icon pe-7s-display2">
                        </i>Radiology Categories
                    </a>
                </li>
                <li>
                    <a href="<?php echo base_url(); ?>radiology/addscreening">
                        <i class="metismenu-icon pe-7s-display2">
                        </i>Add Test
                    </a>
                </li>
                <li>
                    <a href="<?php echo base_url(); ?>radiology/todaysReport">
                        <i class="metismenu-icon pe-7s-display2">
                        </i>Today's Report
                    </a>
                </li>
            </ul>
        </li>
    <?php } ?>
    <?php if ($this->session->userdata('user_aob')->role == 'admin'){ ?>
        <li>
            <a href="#">
                <i style="font-size: 1.5rem; color: #15BC7D;" class=" pe-7s-users"></i>
                Human Resource
                <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
            </a>
            <ul>
                <li>
                    <a href="<?php echo base_url(); ?>staff/index">
                        <i class="metismenu-icon pe-7s-display2">
                        </i>Staff
                    </a>
                </li>
                <li>
                    <a href="<?php echo base_url(); ?>staff/addstaff">
                        <i class="metismenu-icon pe-7s-display2">
                        </i>Add Staff
                    </a>
                </li>
            </ul>
        </li>
    <?php } ?>
    <?php if ($this->session->userdata('user_aob')->role == 'admin' || $this->session->userdata('user_aob')->role == 'finance'){ ?>

        <li>
            <a href="#">
                <i style="font-size: 1.5rem; color: Mediumslateblue;" class=" pe-7s-graph3"></i>
                Reports
                <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
            </a>
            <ul>
                <li>
                    <a href="<?php echo base_url();?>dashboard/treatment_filter">
                        <i class="metismenu-icon pe-7s-mouse">
                        </i>Treatment History
                    </a>
                </li>
                <li>
                    <a href="<?php echo base_url(); ?>pharmacy/history">
                        <i class="metismenu-icon pe-7s-mouse">
                        </i>Stock Purchases
                    </a>
                </li>

                <li>
                    <a href="<?php echo base_url(); ?>history/payments">
                        <i class="metismenu-icon pe-7s-mouse">
                        </i>Payments History
                    </a>
                </li>
                <li>
                    <a href="<?php echo base_url(); ?>dashboard/todays_patients">
                        <i class="metismenu-icon pe-7s-mouse">
                        </i>Today's Patients
                    </a>
                </li>

                <li>
                    <a href="<?php echo base_url(); ?>dashboard/todaysincome">
                        <i class="metismenu-icon pe-7s-mouse">
                        </i>Today's Income
                    </a>
                </li>
                <li>
                    <a href="<?php echo base_url(); ?>dashboard/todaysincome">
                        <i class="metismenu-icon pe-7s-mouse">
                        </i>Clinical Report
                    </a>
                </li>
            </ul>
        </li>


    <?php } ?>
    <li>
        <a href="#">
            <i style="font-size: 1.5rem; color: #CA6F1E" class=" pe-7s-graph2"></i>
            Departmental Reports
            <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
        </a>
        <ul>

            <?php
            $this->db->select()->from('departments');
            $query = $this->db->get();
            $dpts = $query->result_array();
            foreach($dpts as $one){
                ?>
                <?php if ($this->session->userdata('user_aob')->role == 'admin' || $this->session->userdata('user_aob')->department == $one['id']) { ?>
                    <li>
                        <a href="<?php echo base_url(); ?>departmental_reports/index/<?php echo $one['id'];?>">
                            <i class="metismenu-icon pe-7s-display2">
                                </i><?php echo $one['name'];?>
                            </a>
                        </li>
                    <?php }
                } ?>
            </ul>
        </li>
        <?php if ($this->session->userdata('user_aob')->role == 'admin'){ ?>
        <li>
            <a href="#">
                <i style="font-size: 1.5rem; color: Mediumslateblue;" class="fa fa-cog"></i> &nbsp;
                Settings
                <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
            </a>
            <ul>
                <li>
                    <a href="<?php echo base_url(); ?>settings/paymentSettings">
                        <i class="metismenu-icon pe-7s-mouse">
                        </i>Payment Settings
                    </a>
                </li>
                <li>
                    <a href="<?php echo base_url(); ?>settings/smsApiSettings">
                        <i class="metismenu-icon pe-7s-mouse">
                        </i>SMS API Settings
                    </a>
                </li>
                <li>
                    <a href="<?php echo base_url(); ?>settings/specialConsulatation">
                        <i class="metismenu-icon pe-7s-mouse">
                        </i>Special Con. Settings
                    </a>
                </li>
            </ul>
        </li>
    <?php }?>
    </ul>
</div>
</div>
</div>