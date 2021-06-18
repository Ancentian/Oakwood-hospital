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
                        Payment Modes &nbsp;&nbsp;
                        <a href="" class="btn btn-primary float-right" data-toggle="modal" data-target="#addPaymentMode" role="button" ><i class="fa fa-plus"></i>&nbsp; Add Mode</a>
                    </div>
                    <div class="card-body">
                        <table class="mb-0 table table-striped">
                            <thead>
                                <tr>
                                    <th class="text-center">#</th>
                                    <th class="text-center">Payment Mode</th>
                                    <th class="text-center">Status</th>
                                    <th class="text-center">*</th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php $i = 1;
                                foreach ($paymentMode as $one) {
                                    ?>
                                    <tr>
                                        <th scope="row" class="text-center"><?php echo $i; ?></th>
                                        <td class="text-center"><?php echo $one['payment_mode']; ?></td>
                                        <td class="text-center">
                                            <?php if($one['status'] == '1') {?>
                                                <div class="badge badge-success">Activated</div>
                                              <?php }?> 
                                              <?php if($one['status'] == '0') {?>
                                                <div class="badge badge-warning">Deactivated</div>
                                              <?php }?> 
                                            </td>
                                        <td class="text-center">
                                            <a href="<?php echo base_url(); ?>settings/activatePaymentMode/<?php echo $one['id']; ?>" class="btn btn-success"><i class="fa fa-check" aria-hidden="true"></i></a>
                                            &nbsp;
                                            <a href="<?php echo base_url(); ?>settings/deactivatePaymentMode/<?php echo $one['id']; ?>" class="btn btn-danger"><i class="fa fa-times" aria-hidden="true"></i></a>
                                            &nbsp;
                                            
                                                <a href="<?php echo base_url(); ?>settings/deletePaymentMode/<?php echo $one['id']; ?>" class="btn btn-light">
                                               <i class="fa fa-trash"></i></a>   
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