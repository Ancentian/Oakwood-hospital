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
                    <div class="card-header"><i class="header-icon lnr-license icon-gradient bg-plum-plate"> </i>RADIOLOGY
                        <div class="btn-actions-pane-right" hidden="">
                            <div class="nav">
                                <a data-toggle="tab" href="#all"
                                   class="btn-pill btn-wide active btn btn-outline-alternate btn-sm">ALL</a>
                                <a data-toggle="tab" href="#x-ray"
                                   class="btn-pill btn-wide mr-1 ml-1  btn btn-outline-alternate btn-sm">X-PAY</a>
                                <a data-toggle="tab" href="#sonography"
                                   class="btn-pill btn-wide mr-1 ml-1  btn btn-outline-alternate btn-sm">SONOGRAPHY</a>

                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="tab-content">
                            <div class="tab-pane active" id="all" role="tabpanel">
                        <table class="mb-0 table table-striped">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Test</th>
                                <th>Category</th>
                                <th>Cost</th>
                                <th>*</th>
                            </tr>
                            </thead>
                            <tbody>

                            <?php $i = 1; foreach ($tests as $one) {?>
                                <tr>
                                    <th scope="row"><?php echo $i; ?></th>
                                    <td><?php echo $one['name']; ?></td>
                                    <td><?php echo $one['cat_name']; ?></td>
                                    <td><?php echo $one['cost']; ?> </td>
                                    <td>
                                        <a href="<?php echo base_url(); ?>radiology/editscreening/<?php echo $one['id']; ?>"><i
                                                    class="fa fa-fw icon-custom" aria-hidden="true"></i></a>
                                        &nbsp;
                                        <a href="<?php echo base_url(); ?>radiology/delete/<?php echo $one['id']; ?>"><i
                                                    class="fa fa-fw icon-danger"></i></a></td>

                                </tr>
                                <?php $i++; } ?>

                            </tbody>
                        </table>
                    </div>
                    <div class="tab-pane" id="x-ray" role="tabpanel">
                        <table class="mb-0 table table-striped">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Test</th>
                                <th>Category</th>
                                <th>Cost</th>
                                <th>*</th>
                            </tr>
                            </thead>
                            <tbody>

                            <?php $i = 1;  foreach($tests as $one) { if($one['cat_name'] == 'X-Ray') ?>
                                <tr>
                                    <th scope="row"><?php echo $i; ?></th>
                                    <td><?php echo $one['name']; ?></td>
                                    <td><?php echo $one['cat_name']; ?></td>
                                    <td><?php echo $one['cost']; ?> </td>
                                    <td>
                                        <a href="<?php echo base_url(); ?>radiology/editscreening/<?php echo $one['id']; ?>"><i
                                                    class="fa fa-fw icon-custom" aria-hidden="true"></i></a>
                                        &nbsp;
                                        <a href="<?php echo base_url(); ?>radiology/delete/<?php echo $one['id']; ?>"><i
                                                    class="fa fa-fw icon-danger"></i></a></td>
                                </tr>
                                <?php $i++; } ?>

                            </tbody>
                        </table>
                    </div>
                    <div class="tab-pane" id="sonography" role="tabpanel">
                        <table class="mb-0 table table-striped">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Test</th>
                                <th>Category</th>
                                <th>Cost</th>
                                <th>*</th>
                            </tr>
                            </thead>
                            <tbody>

                            <?php $i = 1; foreach($tests as $one) { if($one['cat_name'] == 'Sonography') ?>                               
                                <tr>
                                    <th scope="row"><?php echo $i; ?></th>
                                    <td><?php echo $one['name']; ?></td>
                                    <td><?php echo $one['cat_name']; ?></td>
                                    <td><?php echo $one['cost']; ?> </td>
                                    <td>
                                        <a href="<?php echo base_url(); ?>radiology/editscreening/<?php echo $one['id']; ?>"><i
                                                    class="fa fa-fw icon-custom" aria-hidden="true"></i></a>
                                        &nbsp;
                                        <a href="<?php echo base_url(); ?>radiology/delete/<?php echo $one['id']; ?>"><i
                                                    class="fa fa-fw icon-danger"></i></a></td>

                                </tr>
                            
                                <?php $i++; } ?>

                            </tbody>
                        </table>
                    </div>
                </div>

                    </div>

                </div>
            </div>

        </div>
    </div>