<div class="app-main__outer">
    <div class="app-main__inner">
        <?php if($this->session->userdata('user_aob')->role == 'admin' || $this->session->userdata('user_aob')->role == 'finance'){ ?>
            <div class="row">
                <div class="col-lg-6 col-xl-4">
                    <div class="dropdown btn-group-lg">
                        <button type="button" style="width: 100%; height: 75px;" aria-haspopup="true" aria-expanded="false" data-toggle="dropdown" class="mb-3 mr-2 dropdown-toggle btn btn-info"><i style="font-size: 1.5rem; color: white;" class=" pe-7s-cart"></i> &nbsp; POS</button>
                        <div tabindex="-1" role="menu" aria-hidden="true" class="dropdown-menu">
                            <ul class="nav flex-column">
                                <li class="nav-item-header nav-item">Activity</li>
                                <li class="nav-item"><a href="<?php echo base_url();?>pos" class="nav-link">POS</a></li>
                                <li class="nav-item"><a href="<?php echo base_url();?>pos/invoices" class="nav-link">Invoices</a></li>
                                <li class="nav-item"><a href="<?php echo base_url();?>pos/invoices?todays=yes" class="nav-link">Todays Invoices</a></li>
                                <li class="nav-item"><a href="<?php echo base_url();?>pos/payments" class="nav-link">Payments</a></li>
                                <li class="nav-item"><a href="<?php echo base_url();?>pos/payments?todays=yes" class="nav-link">Todays Payments</a></li>
                                <li class="nav-item"><a href="<?php echo base_url();?>pos/collectpayment" class="nav-link">Make Payment</a></li>  
                            </ul>
                        </div>
                    </div>
                </div>
                <?php if ($this->session->userdata('user_aob')->role == 'admin'){ ?>
                    <div class="col-lg-6 col-xl-4">
                        <div class="dropdown btn-group-lg">
                            <button type="button" style="width: 100%; height: 75px;" aria-haspopup="true" aria-expanded="false" data-toggle="dropdown" class="mb-3 mr-2 dropdown-toggle btn btn-dark">
                                <i style="font-size: 1.5rem; color: gold;" class="fa fa-dollar"></i> &nbsp; Finance</button>
                                <div tabindex="-1" role="menu" aria-hidden="true" class="dropdown-menu">
                                    <ul class="nav flex-column">
                                        <li class="nav-item-header nav-item">Finance Modules</li>
                                        <li class="nav-item"><a href="<?php echo base_url();?>admin/finance/add_bill" class="nav-link">Add Bill</a></li>
                                        <li class="nav-item"><a href="<?php echo base_url();?>admin/finance/bills" class="nav-link">Bills</a></li>
                                        <li class="nav-item"><a href="<?php echo base_url();?>admin/finance/coa" class="nav-link">Chart Of Accounts</a></li>
                                        <li class="nav-item"><a href="<?php echo base_url();?>admin/finance/coa_types" class="nav-link">COA Types</a></li>
                                        <li class="nav-item"><a href="<?php echo base_url();?>admin/finance/ledger" class="nav-link">Ledger</a></li>
                                        <li class="nav-item"><a href="<?php echo base_url();?>admin/finance/suppliers" class="nav-link">Suppliers</a></li>
                                        <li class="nav-item"><a href="<?php echo base_url();?>admin/finance/product_services" class="nav-link">Product/Services</a></li>
                                        <li class="nav-item"><a href="<?php echo base_url();?>admin/finance/pnl" class="nav-link">Profit & Loss</a></li>
                                        <li class="nav-item"><a href="<?php echo base_url();?>admin/finance/design_pnl" class="nav-link">Design P&L</a></li>
                                        <li class="nav-item"><a href="<?php echo base_url();?>admin/finance/bs_display" class="nav-link">Balance Sheet</a></li>
                                        <li class="nav-item"><a href="<?php echo base_url();?>admin/finance/design_bs" class="nav-link">Design BS</a></li>    
                                    </ul>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                    <div class="col-lg-6 col-xl-4">
                        <div class="dropdown btn-group-lg">
                            <button type="button" style="width: 100%; height: 75px;" aria-haspopup="true" aria-expanded="false" data-toggle="dropdown" class="mb-3 mr-2 dropdown-toggle btn btn-alternate"><i style="font-size: 1.5rem; color: Tomato;" class="  pe-7s-server"></i>&nbsp; Pharmacy</button>
                            <div tabindex="-1" role="menu" aria-hidden="true" class="dropdown-menu">
                                <ul class="nav flex-column">
                                    <li class="nav-item-header nav-item">Modules</li>
                                    <li class="nav-item"><a href="<?php echo base_url(); ?>pharmacy/inventory" class="nav-link">Inventory</a></li>
                                    <li class="nav-item"><a href="<?php echo base_url(); ?>pharmacy/addmedicine" class="nav-link">Add Medicine</a></li>
                                    <li class="nav-item"><a href="<?php echo base_url(); ?>pharmacy/history" class="nav-link">Purchase History</a></li>
                                    <li class="nav-item"><a href="<?php echo base_url(); ?>pharmacy/todaysReport" class="nav-link">Todays Report</a></li>   
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6 col-xl-4">
                        <div class="dropdown btn-group-lg">
                            <button type="button" style="width: 100%; height: 75px;" aria-haspopup="true" aria-expanded="false" data-toggle="dropdown" class="mb-3 mr-2 dropdown-toggle btn btn-light"><i style="font-size: 1.5rem; color: Mediumslateblue;" class="  pe-7s-car"></i>&nbsp; Consultation</button>
                            <div tabindex="-1" role="menu" aria-hidden="true" class="dropdown-menu">
                                <ul class="nav flex-column">
                                    <li class="nav-item-header nav-item">Modules</li>
                                    <li class="nav-item"><a href="<?php echo base_url() ?>payments/search" class="nav-link">Add Payment</a></li>
                                    <li class="nav-item"><a href="<?php echo base_url() ?>queue/myqueue" class="nav-link">Active Queue</a></li>
                                    <li class="nav-item"><a href="<?php echo base_url() ?>queue/seenqueue" class="nav-link">Seen Queue</a></li>
                                    <li class="nav-item"><a href="<?php echo base_url(); ?>appointment/search" class="nav-link">Patient Appointments</a></li>
                                    
                                    <li class="nav-item"><a href="<?php echo base_url() ?>payments/search" class="nav-link">Add Payment</a></li>
                                    <li class="nav-item"><a href="<?php echo base_url(); ?>departmental_reports/consultationIndex" class="nav-link">Today's Report</a></li>
                                    
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6 col-xl-4">
                        <div class="dropdown btn-group-lg">
                            <button type="button" style="width: 100%; height: 75px;" aria-haspopup="true" aria-expanded="false" data-toggle="dropdown" class="mb-3 mr-2 dropdown-toggle btn btn-success"><i style="font-size: 1.5rem; color: white;" class="  pe-7s-add-user"></i>&nbsp; Patients</button>
                            <div tabindex="-1" role="menu" aria-hidden="true" class="dropdown-menu">
                                <ul class="nav flex-column">
                                    <li class="nav-item-header nav-item">Modules</li>
                                    <?php if ($this->session->userdata('user_aob')->role == 'admin' || $this->session->userdata('user_aob')->role == 'receptionist') { ?>
                                        <li class="nav-item"><a href="<?php echo base_url(); ?>dashboard/addpatient" class="nav-link">Register Patient</a></li>
                                        <li class="nav-item"><a href="<?php echo base_url(); ?>dashboard/patientslist" class="nav-link">Patient List</a></li>
                                    <?php } ?>
                                    <?php if ($this->session->userdata('user_aob')->role == 'admin' || $this->session->userdata('depart')->department == '4') { ?>
                                        <li class="nav-item"><a href="<?php echo base_url(); ?>history/search" class="nav-link">Patient History</a></li>
                                        <li class="nav-item"><a href="<?php echo base_url(); ?>dashboard/todays_patients" class="nav-link">Today's Patients</a></li>
                                    <?php } ?>     
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6 col-xl-4">
                        <div class="dropdown btn-group-lg">
                            <button type="button" style="width: 100%; height: 75px;" aria-haspopup="true" aria-expanded="false" data-toggle="dropdown" class="mb-3 mr-2 dropdown-toggle btn btn-danger"><i style="font-size: 1.5rem; color: white;" class="fas fa-vial"></i>&nbsp; Laboratory</button>
                            <div tabindex="-1" role="menu" aria-hidden="true" class="dropdown-menu">
                                <ul class="nav flex-column">
                                    <li class="nav-item-header nav-item">Modules</li>
                                    <li class="nav-item"><a href="<?php echo base_url(); ?>labtest/index" class="nav-link">Lab Tests</a></li>
                                    <li class="nav-item"><a href="<?php echo base_url(); ?>pharmacy/addmedicine" class="nav-link">Add Lab Tests</a></li>
                                    <li class="nav-item"><a href="<?php echo base_url(); ?>labtest/addCategory" class="nav-link">Add Test Category</a></li>
                                    <li class="nav-item"><a href="<?php echo base_url(); ?>labtest/categoryIndex" class="nav-link">Test Categories</a></li>
                                    <li class="nav-item"><a href="<?php echo base_url(); ?>labtest/todaysReport" class="nav-link">Today's Report</a></li>  
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6 col-xl-4">
                        <div class="dropdown btn-group-lg">
                            <button type="button" style="width: 100%; height: 75px;" aria-haspopup="true" aria-expanded="false" data-toggle="dropdown" class="mb-3 mr-2 dropdown-toggle btn btn-primary"><i style="font-size: 1.5rem; color: white;" class="pe-7s-diamond"></i>&nbsp; Radiology</button>
                            <div tabindex="-1" role="menu" aria-hidden="true" class="dropdown-menu">
                                <ul class="nav flex-column">
                                    <li class="nav-item-header nav-item">Modules</li>
                                    <li class="nav-item"><a href="<?php echo base_url(); ?>radiology/index" class="nav-link">Radiology Screening</a></li>
                                    <li class="nav-item"><a href="<?php echo base_url(); ?>radiology/addscreening" class="nav-link">Add Screening</a></li>
                                    
                                    <li class="nav-item"><a href="<?php echo base_url(); ?>radiology/todaysReport" class="nav-link">Today's Report</a></li>  
                                </ul>
                            </div>
                        </div>
                    </div>
                    <?php if ($this->session->userdata('user_aob')->role == 'admin'){ ?>
                        <div class="col-lg-6 col-xl-4">
                            <div class="dropdown btn-group-lg">
                                <button type="button" style="width: 100%; height: 75px;" aria-haspopup="true" aria-expanded="false" data-toggle="dropdown" class="mb-3 mr-2 dropdown-toggle btn btn-warning"><i style="font-size: 1.5rem; color: white;" class="fas fa-users"></i>&nbsp; Human Resource</button>
                                <div tabindex="-1" role="menu" aria-hidden="true" class="dropdown-menu">
                                    <ul class="nav flex-column">
                                        <li class="nav-item-header nav-item">Modules</li>
                                        <li class="nav-item"><a href="<?php echo base_url(); ?>staff/index" class="nav-link">Staff</a></li>
                                        <li class="nav-item"><a href="<?php echo base_url(); ?>staff/addstaff" class="nav-link">Add Staff</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    <?php } ?>

                    <?php if ($this->session->userdata('user_aob')->role == 'admin' || $this->session->userdata('user_aob')->role == 'receptionist'){ ?>
                        <div class="col-lg-6 col-xl-4">
                            <div class="dropdown btn-group-lg">
                                <button type="button" style="width: 100%; height: 75px;" aria-haspopup="true" aria-expanded="false" data-toggle="dropdown" class="mb-3 mr-2 dropdown-toggle btn btn-secondary"><i style="font-size: 1.5rem; color: white;" class="pe-7s-graph3"></i>&nbsp; Reports</button>
                                <div tabindex="-1" role="menu" aria-hidden="true" class="dropdown-menu">
                                    <ul class="nav flex-column">
                                        <li class="nav-item-header nav-item">Modules</li>
                                        <li class="nav-item"><a href="<?php echo base_url();?>dashboard/treatment_filter" class="nav-link">Treatment History</a></li>
                                        <li class="nav-item"><a href="<?php echo base_url(); ?>pharmacy/history" class="nav-link">Stock Purchases</a></li>
                                        <li class="nav-item"><a href="<?php echo base_url(); ?>history/payments" class="nav-link">Payment History</a></li>
                                        <li class="nav-item"><a href="<?php echo base_url(); ?>dashboard/todays_patients" class="nav-link">Today's Patients</a></li>
                                        
                                        <li class="nav-item"><a href="<?php echo base_url(); ?>dashboard/todaysincome" class="nav-link">Today's Income</a></li>
                                        <li class="nav-item-header nav-item">Departmental Reports</li>
                                        <?php
                                        $this->db->select()->from('departments');
                                        $query = $this->db->get();
                                        $dpts = $query->result_array();
                                        foreach($dpts as $one){
                                            ?>
                                            <?php if ($this->session->userdata('user_aob')->role == 'admin' || $this->session->userdata('user_aob')->department == $one['id']) { ?>
                                                <li class="nav-item"><a href="<?php echo base_url(); ?>departmental_reports/index/<?php echo $one['id'];?>" class="nav-link"><?php echo $one['name'];?></a></li>
                                            <?php }
                                        } ?>

                                    </ul>
                                </div>
                            </div>
                        </div>
                    <?php } ?>

                    <div class="col-lg-6 col-xl-4" hidden="">
                        <a href="<?php echo base_url();?>pos">
                            <div class="card mb-3 widget-content bg-night-fade">
                                <div class="widget-content-wrapper text-white">
                                    <div class="widget-content-left">
                                        <div class="widget-heading">POS</div>
                                        <div class="widget-subheading">Make a Sale</div>
                                    </div>
                                    <div class="widget-content-right">
                                        <div class="widget-numbers text-white"><span></span></div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-lg-6 col-xl-4" hidden="">
                        <a href="<?php echo base_url();?>admin/finance/coa">
                            <div class="card mb-3 widget-content bg-premium-dark">
                                <div class="widget-content-wrapper text-white">
                                    <div class="widget-content-left">
                                        <div class="widget-heading">Finance</div>
                                        <div class="widget-subheading">All Accounts</div>
                                    </div>
                                    <div class="widget-content-right">
                                        <div class="widget-numbers text-warning"><span></span></div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-6 col-xl-4" hidden="">
                        <div class="card mb-3 widget-content bg-midnight-bloom">
                            <div class="widget-content-outer text-white">
                                <div class="widget-content-wrapper">
                                    <div class="widget-content-left">
                                        <div class="widget-heading">Pharmacy Payments</div>
                                        <div class="widget-subheading">Total Pharmacy payments</div>
                                    </div>
                                    <div class="widget-content-right">
                                        <div class="widget-numbers text-success"><?php echo number_format($totalpmtsP);?></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-xl-4" hidden="">
                        <a href="<?php echo base_url(); ?>pharmacy/todaysReport">
                            <div class="card mb-3 widget-content">
                                <div class="widget-content-outer">
                                    <div class="widget-content-wrapper">
                                        <div class="widget-content-left">
                                            <div class="widget-heading">Todays Pharmacy Sales</div>
                                            <div class="widget-subheading">Todays Pharmacy sales</div>
                                        </div>
                                        <div class="widget-content-right">
                                            <div class="widget-numbers text-success"><?php echo number_format($todaysincomeP);?></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>    
                    </div>
                    <div class="col-md-6 col-xl-4" hidden="">
                        <a href="<?php echo base_url(); ?>history/payments">
                            <div class="card mb-3 widget-content bg-midnight-bloom">
                                <div class="widget-content-wrapper text-white">
                                    <div class="widget-content-left">
                                        <div class="widget-heading">Total Clinic Income</div>
                                        <div class="widget-subheading">Total clinic income</div>
                                    </div>
                                    <div class="widget-content-right">
                                        <div class="widget-numbers text-white"><span><?php echo number_format($totalincome);?></span></div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-6 col-xl-4" hidden="">
                        <a href="<?php echo base_url(); ?>dashboard/todaysincome">
                            <div class="card mb-3 widget-content bg-arielle-smile">
                                <div class="widget-content-wrapper text-white">
                                    <div class="widget-content-left">
                                        <div class="widget-heading">Today's Clinic Income</div>
                                        <div class="widget-subheading">Today's Clinic Income</div>
                                    </div>
                                    <div class="widget-content-right">
                                        <div class="widget-numbers text-white"><span><?php echo number_format($todaysincome);?></span></div>
                                    </div>
                                </div>
                            </div>
                        </a>     
                    </div>
                    <div class="col-md-6 col-xl-4" hidden="">
                        <div class="card mb-3 widget-content bg-grow-early">
                            <div class="widget-content-wrapper text-white">
                                <div class="widget-content-left">
                                    <div class="widget-heading">Admitted Patients</div>
                                    <div class="widget-subheading">Total patients in wards</div>
                                </div>
                                <div class="widget-content-right">
                                    <div class="widget-numbers text-white"><span><?php echo $ibp;?></span></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-xl-4" hidden="">
                        <a href="<?php echo base_url(); ?>dashboard/todays_patients">
                            <div class="card mb-3 widget-content bg-happy-green">
                                <div class="widget-content-wrapper text-white">
                                    <div class="widget-content-left">
                                        <div class="widget-heading">Patients Today</div>
                                        <div class="widget-subheading">Registered today</div>
                                    </div>
                                    <div class="widget-content-right">
                                        <div class="widget-numbers text-dark"><span><?php echo $ptoday;?></span></div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-6 col-xl-4" hidden="">
                        <a href="<?php echo base_url(); ?>labtest/todaysReport">
                            <div class="card mb-3 widget-content bg-danger">
                                <div class="widget-content-wrapper text-white">
                                    <div class="widget-content-left">
                                        <div class="widget-heading">Labalatory</div>
                                        <div class="widget-subheading">Today's Report</div>
                                    </div>
                                    <div class="widget-content-right">
                                        <div class="widget-numbers text-white"><span></span></div>
                                    </div>
                                </div>
                            </div>
                        </a>     
                    </div>
                    <div class="col-md-6 col-xl-4" hidden="">
                        <a href="<?php echo base_url(); ?>radiology/todaysReport">
                            <div class="card mb-3 widget-content bg-arielle-smile">
                                <div class="widget-content-wrapper text-white">
                                    <div class="widget-content-left">
                                        <div class="widget-heading">Radiology</div>
                                        <div class="widget-subheading">Today's Report</div>
                                    </div>
                                    <div class="widget-content-right">
                                        <div class="widget-numbers text-white"><span></span></div>
                                    </div>
                                </div>
                            </div>
                        </a>     
                    </div>
                    <div class="col-lg-6 col-xl-4" hidden="" >
                        <div class="card mb-3 widget-content bg-premium-dark">
                            <div class="widget-content-wrapper text-white">
                                <div class="widget-content-left">
                                    <div class="widget-heading">Total Pharmacy Sales</div>
                                    <div class="widget-subheading">Total Pharmacy Sales</div>
                                </div>
                                <div class="widget-content-right">
                                    <div class="widget-numbers text-warning"><span><?php echo number_format($totalincomeP);?></span></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    
                    <div class="col-md-6 col-xl-4" hidden="">
                        <a href="<?php echo base_url(); ?>pharmacy/todaysReport">
                            <div class="card mb-3 widget-content bg-midnight-bloom">
                                <div class="widget-content-wrapper text-white">
                                    <div class="widget-content-left">
                                        <div class="widget-heading">Todays Pharmacy Payments</div>
                                        <div class="widget-subheading">Todays Pharmacy payments</div>
                                    </div>
                                    <div class="widget-content-right">
                                        <div class="widget-numbers text-white"><span><?php echo number_format($todayspmtsP);?></span></div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-6 col-xl-4" hidden="">
                        <a href="">
                            <div class="card mb-3 widget-content bg-warning">
                                <div class="widget-content-wrapper text-black">
                                    <div class="widget-content-left">
                                        <div class="widget-heading">Reports</div>
                                        <div class="widget-subheading">Departments Reports</div>
                                    </div>
                                    <div class="widget-content-right">
                                        <div class="widget-numbers text-white"><span></span></div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="d-xl-none d-lg-block col-md-6 col-xl-4">
                        <div class="card mb-3 widget-content">
                            <div class="widget-content-outer">
                                <div class="widget-content-wrapper">
                                    <div class="widget-content-left">
                                        <div class="widget-heading">Income</div>
                                        <div class="widget-subheading">Expected totals</div>
                                    </div>
                                    <div class="widget-content-right">
                                        <div class="widget-numbers text-focus">$147</div>
                                    </div>
                                </div>
                                <div class="widget-progress-wrapper">
                                    <div class="progress-bar-sm progress-bar-animated-alt progress">
                                        <div class="progress-bar bg-info" role="progressbar" aria-valuenow="54"
                                        aria-valuemin="0" aria-valuemax="100" style="width: 54%;"></div>
                                    </div>
                                    <div class="progress-sub-label">
                                        <div class="sub-label-left">Expenses</div>
                                        <div class="sub-label-right">100%</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>