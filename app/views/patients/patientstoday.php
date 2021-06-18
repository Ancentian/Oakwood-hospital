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
                                        <th>Phone</th>
                                        <th>Age</th>
                                        <th>Gender</th>
                                        <th>NoK</th>
                                        <th>NoK Phone</th>
                                        <th>*</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    <?php $i = 1;
                                    foreach ($patients as $one) {
                                        ?>
                                        <tr>
                                            <th scope="row"><?php echo $i; ?></th>
                                            <td><?php echo str_pad( $one['id'], 4, "0", STR_PAD_LEFT ); ?></td>
                                            <td><?php echo $one['name']; ?></td>
                                            <td><?php echo $one['phone']; ?></td>
                                            <td><?php echo(date('Y-m-d') - $one['dob']); ?></td>
                                            <td><?php echo $one['gender']; ?></td>
                                            <td><?php echo $one['nok']; ?></td>
                                            <td><?php echo $one['nok_phone']; ?></td>
                                            <td>
                                                <a href="<?php echo base_url(); ?>dashboard/editpatient/<?php echo $one['id']; ?>"><i
                                                            class="fa fa-fw icon-custom" aria-hidden="true"></i></a>
                                                &nbsp;
                                                <a href="<?php echo base_url(); ?>patients/delete/<?php echo $one['id']; ?>"><i
                                                            class="fa fa-fw icon-danger"></i></a></td>
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