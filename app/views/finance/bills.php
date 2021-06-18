<style>
    td{
        padding: 1px !important; 
    }
</style>
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
                    
                    <div class="card-body">
        <div class="row">
            
                
            <div class="col-md-12">
                <!-- general form elements -->
                <div class="box box-primary">
                    <div class="box-header ptbnull">
                        <h5 class="box-title titlefix">Bills</h5>
                        <div class="box-tools pull-right">
                        </div><!-- /.box-tools -->
                    </div><!-- /.box-header -->
                    <div class="box-body">
                        <div class="mailbox-messages table-responsive">
                            <table class="table table-striped table-bordered table-hover example" data-ordering="false">
                                <thead>
                                    <tr>
                                        <th>Date</th>
                                        <th>Supplier</th>
                                        <th>Due Date</th>
                                        <th>Billed</th>
                                        <th>Discount</th>
                                        <th>Paid</th>
                                        <th>Balance</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    foreach ($bills as $type) {
                                        $totpaid = $this->finance_model->billPaymentTot($type['id']);
                                        $balance = $type['amount'] - $totpaid-$type['discount'];
                                        if($balance == 0){
                                            $class = "success";
                                            $cname = "Paid";
                                        }elseif($totpaid == 0){
                                            $class = "danger";
                                            $cname = "Unpaid";
                                        }elseif($totpaid > 0 && $balance > 0){
                                            $class = "warning";
                                            $cname = "Partial";
                                        }else{
                                            $class = "primary";
                                            $cname = "over-paid";
                                        }
                                        ?>
                                        <tr>
                                            <td class="mailbox-name">
                                                <a href="#" data-toggle="popover" class="detail_popover"><b><?php echo $type['date'] ?></b></a>
                                                <div class="fee_detail_popover" style="display: none">
                                                    <?php
                                                    if ($type['description'] == "") {
                                                        ?>
                                                        <p class="text text-danger"><?php echo $this->lang->line('no_description'); ?></p>
                                                        <?php
                                                    } else {
                                                        ?>
                                                        <p class="text text-info"><?php echo $type['description']; ?></p>
                                                        <?php
                                                    }
                                                    ?>
                                                </div>
                                            </td>
                                            <td class="mailbox-name"><?php echo $type['suppname'];?></td>
                                            <td class="mailbox-name"><?php echo $type['due_date'];?></td>
                                            <td class="mailbox-name"><?php echo number_format($type['amount'],'2','.',',');?></td>
                                            <td class="mailbox-name"><?php echo number_format($type['discount'],'2','.',',');?></td>
                                            <td class="mailbox-name"><?php echo number_format($totpaid,'2','.',',');?></td>
                                            <td class="mailbox-name"><?php echo number_format($balance,'2','.',',');?></td>
                                            <td class="mailbox-name"><span style="padding : 2px !important;font-size: 11px;" class="btn btn-<?php echo $class;?>"><?php echo $cname;?></span></td>
                                            <td class="mailbox-name">
                                                <a data-placement="left" href="<?php echo base_url(); ?>admin/finance/view_bill/<?php echo $type['id'] ?>" class="btn btn-info btn-xs"  data-toggle="tooltip" title="<?php echo $this->lang->line('view'); ?>">
                                                        <i class="fa fa-eye"></i>
                                                    </a>
                                                <a data-placement="left" href="<?php echo base_url(); ?>admin/finance/edit_bill/<?php echo $type['id'] ?>" class="btn btn-warning btn-xs"  data-toggle="tooltip" title="<?php echo $this->lang->line('edit'); ?>">
                                                        <i class="fas fa-pencil-alt"></i>
                                                    </a>
                                                <a data-placement="left" href="<?php echo base_url(); ?>admin/finance/delete_bill/<?php echo $type['id'] ?>"class="btn btn-danger btn-xs"  data-toggle="tooltip" title="<?php echo $this->lang->line('delete'); ?>" onclick="return confirm('<?php echo $this->lang->line('delete_confirm') ?>');">
                                                        <i class="fas fa-trash"></i>
                                                    </a>
                                                <?php if($balance > 0){?>
                                                <a data-placement="left" href="<?php echo base_url(); ?>admin/finance/pay_bill/<?php echo $type['id'] ?>" class="btn btn-success btn-xs"  data-toggle="tooltip" title="Pay">
                                                        <i class="fas fa-dollar-sign"></i>
                                                    </a>
                                                <?php } ?>
                                            </td>
                                        </tr>

                                        <?php }?>
                                       
                                </tbody>
                            </table><!-- /.table -->



                        </div><!-- /.mail-box-messages -->
                    </div><!-- /.box-body -->
                </div>
            </div><!--/.col (left) -->
            <!-- right column -->

        </div>
       </div>

                </div>
            </div>

        </div>
    </div>
<script>
    $(document).ready(function () {
        $('.detail_popover').popover({
            placement: 'right',
            trigger: 'hover',
            container: 'body',
            html: true,
            content: function () {
                return $(this).closest('td').find('.fee_detail_popover').html();
            }
        });
    });
</script>