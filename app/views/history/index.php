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
                    <div class="card-header"><i class="header-icon lnr-license icon-gradient bg-plum-plate"> </i>PATIENT
                        HISTORY

                    </div>
                    <div class="card-body">
                        <table class="mb-0 table table-striped">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Ticket ID</th>
                                <th>Date</th>
                                <th>Status</th>
                                <th>Discharge Date</th>
                                <th>*</th>
                            </tr>
                            </thead>
                            <tbody>

                            <?php $i = 1;
                            foreach ($history as $one) {
                                ?>
                                <tr>
                                    <th scope="row"><?php echo $i; ?></th>
                                    <td><?php echo str_pad( $one['id'], 4, "0", STR_PAD_LEFT ); ?></td>
                                    <td><?php echo date('d/m/Y H:i', strtotime($one['created_at'])); ?> </td>
                                    <td><?php if ($one['status'] == '1') { ?>
                                            <span class="badge badge-success">discharged</span>
                                        <?php } else { ?>
                                            <span class="badge badge-danger">pending</span>
                                        <?php } ?>
                                    </td>
                                    <td><?php if ($one['status'] == '1') {
                                            echo date('d/m/Y H:i', strtotime($one['closed_at']));
                                        } ?></td>
                                    <td>
                                        <a href="<?php echo base_url(); ?>queue/ticket_details/<?php echo $one['id']; ?>/0" class="btn btn-info" Title="View"><i class="fa fa-eye"></i></a>
                                        &nbsp;
                                        <a href="<?php echo base_url(); ?>inpatient/services/<?php echo $one['id']; ?>/0" class="btn btn-dark" ><i class="fa fa-history" title="History"></i></a>
                                        &nbsp;
                                        <a href="<?php echo base_url(); ?>history/print_patientHistory/<?php echo $one['id']; ?>/0" target="_blank" class="btn btn-light" ><i class="fa fa-print" title="History"></i></a>
                                        &nbsp;
                                        <?php if($this->session->userdata('user_aob')->role == 'admin') {?>
                                        <a href="<?php echo base_url(); ?>history/deleteTicket/<?php echo $one['id']; ?>/0" class="btn btn-danger" ><i class="fa fa-trash" title="Delete Ticket"></i></a>
                                        <?php }?>

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