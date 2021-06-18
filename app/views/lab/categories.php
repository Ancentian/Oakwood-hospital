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
                    <div class="card-header"><i class="header-icon lnr-license icon-gradient bg-plum-plate"> </i>
                        TEST Categories

                    </div>
                    <div class="card-body">
                        <table class="mb-0 table table-striped">
                            <thead>
                                <tr>
                                    <th class="text-center">#</th>
                                    <th class="text-center">Category Name</th>
                                    <th class="text-center">*</th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php $i = 1;
                                foreach ($category as $one) {
                                    ?>
                                    <tr>
                                        <th scope="row" class="text-center"><?php echo $i; ?></th>
                                        <td class="text-center"><?php echo $one['cat_name']; ?></td>
                                        <td class="text-center">
                                            <?php if($one['id'] != '1') { ?>
                                            <a href="<?php echo base_url(); ?>labtest/editCategory/<?php echo $one['id']; ?>"><i class="fa fa-fw icon-custom" aria-hidden="true"></i></a>
                                            &nbsp;
                                            
                                                <a href="<?php echo base_url(); ?>labtest/deleteCategory/<?php echo $one['id']; ?>">
                                                <i class="fa fa-fw icon-danger"></i></a>
                                           <?php } ?>
                                            
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