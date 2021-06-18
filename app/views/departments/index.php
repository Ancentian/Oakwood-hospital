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
                    <div class="card-header"><i class="header-icon lnr-license icon-gradient bg-plum-plate"> </i>DEPARTMENTS
                        &nbsp;&nbsp;
                        <a href="<?php echo base_url(); ?>departments/adddpt" class="btn btn-warning" role="button">Add
                            New</a>

                    </div>
                    <div class="card-body">
                        <table class="mb-0 table table-striped">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Department</th>
                                <th>Created At</th>
                                <th>*</th>
                            </tr>
                            </thead>
                            <tbody>

                            <?php $i = 1;
                            foreach ($dpts as $one) {
                                ?>
                                <tr>
                                    <th scope="row"><?php echo $i; ?></th>
                                    <td><?php echo $one['name']; ?></td>
                                    <td><?php echo date('d/m/Y H:i', strtotime($one['created_at'])); ?> </td>
                                    <td>
                                        <a href="<?php echo base_url(); ?>departments/editdpt/<?php echo $one['id']; ?>"><i
                                                    class="fa fa-fw icon-custom" aria-hidden="true"></i></a>
                                        &nbsp;
                                        <a href="<?php echo base_url(); ?>departments/delete/<?php echo $one['id']; ?>"><i
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