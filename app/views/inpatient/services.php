<style type="text/css">
    .inpatient-items{
        font-size: 22px;
        margin-bottom: 10px;
    }
</style>
<div class="app-main__outer">
    <div class="app-main__inner">

        <div class="row">
            <div class="col-lg-12">
                <?php if ($this->session->flashdata('success-msg')) { ?>
                    <div class="alert alert-success"><?php echo $this->session->flashdata('success-msg'); ?></div>
                <?php } ?>
                <?php if ($this->session->flashdata('error-msg')) { ?>
                    <div class="alert alert-danger"><?php echo $this->session->flashdata('error-msg'); ?></div>
                <?php } ?>
                <div class="main-card mb-3 card">
                    <div class="card-header"><i class="header-icon lnr-license icon-gradient bg-plum-plate"> </i>IN PATIENT SERVICES
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-4 inpatient-items">
                                <a href="<?php echo base_url();?>inpatient/medication/<?php echo $tickid;?>" class="btn btn-danger btn-block">MEDICATION</a>
                            </div>
                            <div class="col-sm-4 inpatient-items">
                                <a href="<?php echo base_url();?>inpatient/nursing_cadex/<?php echo $tickid;?>" class="btn btn-danger btn-block">NURSING CADEX</a>
                            </div>
                            <div class="col-sm-4 inpatient-items">
                                <a href="<?php echo base_url();?>inpatient/observations/<?php echo $tickid;?>" class="btn btn-danger btn-block">RECORD OF OBSERVATION</a>
                            </div>
                            <div class="col-sm-4 inpatient-items">
                                <a href="<?php echo base_url();?>inpatient/transfusions/<?php echo $tickid;?>" class="btn btn-danger btn-block">BLOOD TRANSFUSION</a>
                            </div>
                            <div class="col-sm-4 inpatient-items">
                                <a href="<?php echo base_url();?>inpatient/nursing_care/<?php echo $tickid;?>" class="btn btn-danger btn-block">NURSING CARE PLAN</a>
                            </div>
                            <div class="col-sm-4 inpatient-items">
                                <a href="<?php echo base_url();?>inpatient/costs/<?php echo $tickid;?>" class="btn btn-danger btn-block">DEFINE OTHER CHARGES</a>
                            </div>
                            <div class="col-sm-4 inpatient-items">
                                <a href="<?php echo base_url();?>inpatient/discharge/<?php echo $tickid;?>" class="btn btn-primary btn-block">DISCHARGE</a>
                            </div>
                            <div class="col-sm-4 inpatient-items">
                                <a href="<?php echo base_url();?>history/patient_history/<?php echo $pid;?>" class="btn btn-warning btn-block">BACK</a>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>