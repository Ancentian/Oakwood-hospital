   <?php //var_dump($pharmacy);die; ?>
   <div class="app-main__outer">
    <div class="app-main__inner">
        <div class="app-page-title">
            <div class="page-title-wrapper">
                <div class="page-title-heading">
                    <div class="page-title-icon">
                        <i class="pe-7s-car icon-gradient bg-mean-fruit">
                        </i>
                    </div>
                    <div>Todays Pharmacy Report
                        <div class="page-title-subheading">
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
        <?php if ($this->session->flashdata('success-msg')) { ?>
            <div class="alert alert-success"><?php echo $this->session->flashdata('success-msg'); ?></div>
        <?php } ?>
        <?php if ($this->session->flashdata('error-msg')) { ?>
            <div class="alert alert-danger"><?php echo $this->session->flashdata('error-msg'); ?></div>
        <?php } ?>
        <div class="row">
            <div class="col-md-12">
                <div class="main-card mb-3 card">
                    <div class="card-header">Details</div>
                    <div class="card-body">
<!--                        <h5 class="card-title"></h5>-->
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
                            foreach ($pharmacy as $one) {
                                ?>
                                <tr>
                                    <th scope="row"><?php echo $i; ?></th>
                                    <td><?php echo $one['id']; ?></td>
                                    <td><?php echo $one['patient_id']; ?></td>
                                    <td><?php echo $one['patfname']." ".$one['patlname']; ?></td>
                                    <td><?php echo $one['staffname']; ?></td>
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
