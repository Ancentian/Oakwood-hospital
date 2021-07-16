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
                    <div class="card-header"><i class="header-icon lnr-license icon-gradient bg-plum-plate"> </i>PATIENTS
                        IN QUEUE
                        <div class="btn-actions-pane-right">
                            <div class="nav">
                                <a data-toggle="tab" href="#ibp"
                                   class="btn-pill btn-wide active btn btn-outline-alternate btn-sm">INCOMING</a>
                                <a data-toggle="tab" href="#obp"
                                   class="btn-pill btn-wide mr-1 ml-1  btn btn-outline-alternate btn-sm">OUTGOING</a>

                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="tab-content">
                            <div class="tab-pane active" id="ibp" role="tabpanel">
                                <table class="mb-0 table table-striped">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>P/No</th>
                                        <th>Name</th>
                                        <th>Sent From</th>
                                        <th>Activity</th>
                                        <th>Sent By</th>
                                        <th>Time</th>
                                        <th>Ticket Details</th>
                                        <th>*</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    <?php $i = 1;
                                    foreach ($incoming as $one) {
                                        ?>
                                        <tr style="<?php if($one['from_dpt'] == "9" || $one['from_dpt'] == "10"){ ?>background-color: yellow;<?php } ?>">
                                            <th scope="row"><?php echo $i; ?></th>
                                            <td><?php echo str_pad( $one['pid'], 4, "0", STR_PAD_LEFT ); ?></td>
                                            <td><?php echo $one['pname']." ".$one['lname']; ?></td>
                                            <td><?php echo $one['dname']; ?></td>
                                            <td><?php echo $one['wname']; if($one['is_direct'] == '1'){?> <span class="badge badge-warning">DIRECT PATIENT</span><?php } ?></td>
                                            <td><?php echo $one['uname']; ?></td>
                                            <td><?php echo $one['created_at']; ?></td>
                                            <td>
                                                <a href="<?php echo base_url(); ?>queue/ticket_details/<?php echo $one['ticket_id'] . '/' . $one['mvtid']; ?>"><span
                                                            class="badge badge-success"><small>View</small></span></a>
                                            </td>
                                            <td><?php
                                                if ($one['activity'] == '3' && $one['triage_status'] == '0') { ?>
                                                    <a href="<?php echo base_url(); ?>queue/add_triage/<?php echo $one['ticket_id'] . '/' . $one['mvtid']; ?>"><i
                                                                class="fa fa-fw" aria-hidden="true"
                                                                title="Click to add triage"
                                                                style="font-size: 24px;"></i></a>
                                                <?php } ?>

                                                <?php
                                                if ($one['activity'] == '2') { ?>
                                                    <a href="<?php echo base_url(); ?>queue/consultation_send/<?php echo $one['ticket_id'] . '/' . $one['mvtid']; ?>"><i
                                                                class="fa fa-fw" aria-hidden="true"
                                                                title=""
                                                                style="font-size: 24px;"></i></a>
                                                <?php } ?>
                                                <?php
                                                if ($one['activity'] == '8') { ?>
                                                    <a href="<?php echo base_url(); ?>queue/addtest/<?php echo $one['mvtid']. '/' . $one['is_direct']; ?>"><i
                                                                class="fa fa-fw" aria-hidden="true" title="Add Lab Test"
                                                                style="font-size: 24px;"></i></a>
                                                <?php } ?>
                                                <?php
                                                if ($one['activity'] == '6') { ?>
                                                    <a href="<?php echo base_url(); ?>queue/mc_clinic/<?php echo $one['ticket_id'] . '/' . $one['mvtid'].'/'.$one['is_direct']; ?>"><i
                                                                class="fa fa-fw" aria-hidden="true" title="Mother & Child Clinic"
                                                                style="font-size: 24px;color: green"></i></a>
                                                <?php } ?>
                                                <?php
                                                if ($one['activity'] == '10') { 
                                                        if($one['maternity_status'] == '0'){
                                                    ?>

                                                    <a href="<?php echo base_url(); ?>queue/pre_maternity/<?php echo $one['ticket_id'] . '/' . $one['mvtid']; ?>"><i
                                                                class="fa fa-fw" aria-hidden="true" title="Add Pre maternity examinations"
                                                                style="font-size: 24px;"></i></a>
                                                <?php }elseif ($one['maternity_status'] == '1' && $one['postmaternity_status'] == '0') {
                                                   ?>
                                                   <a href="<?php echo base_url(); ?>queue/maternity/<?php echo $one['ticket_id'] . '/' . $one['mvtid']; ?>"><i
                                                                class="fa fa-fw" aria-hidden="true" title="Maternity"
                                                                style="font-size: 24px;color: green"></i></a>

                                               <?php }elseif ($one['maternity_status'] == '1' && $one['postmaternity_status'] == '1') {?>
                                                <a href="<?php echo base_url(); ?>queue/maternity_costs/<?php echo $one['ticket_id'] . '/' . $one['mvtid']; ?>" class="badge badge-danger"><i
                                                            aria-hidden="true" title="Add maternity costs"
                                                            >Add Cost</i></a>
                                                <?php }} ?>
                                                <?php
                                                if ($one['activity'] == '25') { ?>
                                                    <a href="<?php echo base_url(); ?>queue/addradiology/<?php echo $one['mvtid']. '/' . $one['is_direct']; ?>"><i
                                                                class="fa fa-fw" aria-hidden="true"
                                                                title="Add Radiology" style="font-size: 24px;"></i></a>
                                                <?php } ?>

                                                <?php
                                                if ($one['activity'] == '9' || $one['activity'] == '4' || $one['activity'] == '7' || $one['activity'] == '23') { ?>
                                                    <a href="<?php echo base_url(); ?>queue/dentist/<?php echo $one['ticket_id'] . '/' . $one['mvtid']; ?>"><i
                                                                class="fa fa-fw" aria-hidden="true"
                                                                title="Add Services" style="font-size: 24px;"></i></a>
                                                <?php } ?>

                                                <?php
                                                if ($one['activity'] == '9' || $one['activity'] == '4' || $one['activity'] == '26' || $one['activity'] == '23') { ?>
                                                    <a href="<?php echo base_url(); ?>queue/dressing/<?php echo $one['ticket_id'] . '/' . $one['mvtid']; ?>"><i
                                                                class="fa fa-fw" aria-hidden="true"
                                                                title="Add Services" style="font-size: 24px;"></i></a>
                                                <?php } ?>

                                                <?php
                                                if ($one['activity'] == '11') { ?>
                                                    <a href="<?php echo base_url(); ?>queue/givemedicine/<?php echo $one['ticket_id'] . '/' . $one['mvtid']. '/' . $one['is_direct']; ?>"><i
                                                                class="fa fa-plus-circle" aria-hidden="true"
                                                                title="Give medicine" style="font-size: 24px;"></i></a>
                                                <?php } ?>
                                            </td>
                                        </tr>
                                        <?php $i++;
                                    } ?>

                                    </tbody>
                                </table>
                            </div>
                            <div class="tab-pane" id="obp" role="tabpanel">
                                <table class="mb-0 table table-striped">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>P/No</th>
                                        <th>Name</th>
                                        <th>Sent To</th>
                                        <th>Activity</th>
                                        <th>Sent By</th>
                                        <th>Time</th>
                                        <th>Ticket Details</th>
                                        <th>*</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php $i = 1;
                                    foreach ($outgoing as $one) {
                                        ?>
                                        <tr style="<?php if($one['from_dpt'] == "4" && $one['to_dpt'] == "24"){ ?>background-color: yellow;<?php } ?>">
                                            <th scope="row"><?php echo $i; ?></th>
                                            <td><?php echo str_pad( $one['pid'], 4, "0", STR_PAD_LEFT ); ?></td>
                                            <td><?php echo $one['pname']; ?></td>
                                            <td><?php echo $one['dname']; ?></td>
                                            <td><?php echo $one['wname']; ?></td>
                                            <td><?php echo $one['uname']; ?></td>
                                            <td><?php echo $one['created_at']; ?></td>
                                            <td>
                                                <a href="<?php echo base_url(); ?>queue/ticket_details/<?php echo $one['ticket_id'] . '/' . $one['mvtid']; ?>"><span
                                                            class="badge badge-success"><small>View</small></span></a>
                                            </td>
                                            <td>
                                                <?php if($one['from_dpt'] == '4' && $one['to_dpt'] == '24') {?>
                                                
                                                    <a href="<?php echo base_url(); ?>queue/givemedicine/<?php echo $one['ticket_id'] . '/' . $one['mvtid']. '/' . $one['is_direct']; ?>"><i
                                                                class="fa fa-plus-circle" aria-hidden="true"
                                                                title="Give medicine" style="font-size: 24px;"></i></a>
                                                <?php } ?>
                                            </td>
                                            </td>
                                        </tr>
                                        <?php $i++;
                                    } ?>
                                    </tbody>
                                </table>
                            </div>

                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>