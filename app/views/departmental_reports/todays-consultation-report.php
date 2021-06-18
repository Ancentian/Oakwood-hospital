
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
                    <div class="card-header"><i class="header-icon lnr-license icon-gradient bg-plum-plate"> </i><?php echo $dpt['name'];?> DEPARTMENT REPORT
                    </div>
                    <div class="card-body">
                        <table class="mb-0 table table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Ticket ID</th>
                                    <th>Patient ID</th>
                                    <th>Patient Name</th>
                                    <th>Seen By</th>
                                    <th>Date</th>
                                    <th>*</th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php $i = 1;
                                foreach ($consultation as $one) {
                                    ?>
                                    <tr>
                                        <th scope="row"><?php echo $i; ?></th>
                                        <td><?php echo $one['ticket_id']; ?></td>
                                        <td><?php echo $one['patient_id']; ?></td>
                                        <td><?php echo $one['pname']." ".$one['mid_name']."".$one['lname']; ?></td>
                                        <td><?php echo $one['name']; ?></td>
                                        <td><?php echo date('d/m/Y H:i', strtotime($one['created_at'])); ?> </td>
                                        <td>
                                            <a href="<?php echo base_url(); ?>queue/ticket_details/<?php echo $one['ticket_id'] . '/0'; ?>"><span
                                                class="badge badge-success"><small>View</small></span></a>
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