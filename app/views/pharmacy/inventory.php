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
                    <div class="card-header"><i class="header-icon lnr-license icon-gradient bg-plum-plate"> </i>MEDICINE

                    </div>
                    <div class="card-body">
                        <table class="mb-0 table table-striped">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Cost</th>
                                <th>Available Qty</th>
                                <th>Expiry</th>
                                <th>*</th>
                            </tr>
                            </thead>
                            <tbody>

                            <?php $i = 1;
                            foreach ($medicine as $one) {
                                ?>
                                <tr>
                                    <th scope="row"><?php echo $i; ?></th>
                                    <td><?php echo $one['name']; ?></td>
                                    <td><?php echo $one['cost']; ?></td>
                                    <td><?php echo $one['qty']; ?> &nbsp;<?php if($one['qty'] <= $one['alert_qty']){?>
                                        <span class="badge badge-danger"><small>Out of stock</small></span><?php } ?>&nbsp;
                                        <a
                                                href="<?php echo base_url(); ?>pharmacy/stockmedicine/<?php echo $one['id']; ?>"><span
                                                    class="badge badge-success"><small>Add Stock</small></span></a> </td>
                                    <td><?php echo date('Y-m-d',strtotime($one['expiry']));if(strtotime(date('Y-m-d')) > strtotime($one['expiry'])){?>&nbsp;<span class="badge badge-danger"><small>expired</small></span><?php } ?></td>                
                                    <td>
                                        <a href="<?php echo base_url(); ?>pharmacy/editmedicine/<?php echo $one['id']; ?>"><i
                                                    class="fa fa-fw icon-custom" aria-hidden="true"></i></a>
                                        &nbsp;
                                        <a href="<?php echo base_url(); ?>pharmacy/delete/<?php echo $one['id']; ?>"><i
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