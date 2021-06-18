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
        <div class="row">
            
                <div class="col-md-3">
                    <!-- Horizontal Form -->
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h5 class="box-title">Add COA</h5>
                        </div><!-- /.box-header -->
                        <form id="form1" action="<?php echo base_url() ?>admin/finance/edit_coa/<?php echo $id;?>"  id="employeeform" name="employeeform" method="post" accept-charset="utf-8">
                            <div class="box-body">
                                <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Name</label> <small class="req">*</small>
                                    <input autofocus="" id="name" name="name" type="text" class="form-control"  value="<?php echo $thiscoa['acc_name']; ?>" />
                                    <span class="text-danger"><?php echo form_error('name'); ?></span>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Type</label> <small class="req">*</small>
                                    <select class="form-control" name="type" required>
                                        <option value="">--Select one</option>
                                        <?php foreach($coa_types as $one){?>
                                        <option value="<?php echo $one['id'];?>" <?php if($one['id'] == $thiscoa['type'])echo "selected"; ?>><?php echo $one['type_name'];?></option>
                                        <?php } ?>
                                    </select>
                                    <span class="text-danger"><?php echo form_error('type'); ?></span>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Account for POS Sales ?</label> <small class="req">*</small>
                                    <select class="form-control" name="is_fees" required>
                                        <option value="">--Select one</option>
                                        <option value="0" <?php if($thiscoa['is_fees'] == "0")echo "selected"; ?>>No</option>
                                        <option value="1" <?php if($thiscoa['is_fees'] == "1")echo "selected"; ?>>Yes</option>
                                    </select>
                                    <span class="text-danger"><?php echo form_error('is_fees'); ?></span>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Category</label> <small class="req">*</small>
                                    <select class="form-control" name="is_or_bs" required>
                                        <option value="">--Select one</option>
                                        <option value="is" <?php if($thiscoa['is_or_bs'] == "is")echo "selected"; ?>>Income Statement Account</option>
                                        <option value="bs" <?php if($thiscoa['is_or_bs'] == "bs")echo "selected"; ?>>Balance Sheet Account</option>
                                        <option value="bt" <?php if($thiscoa['is_or_bs'] == "bt")echo "selected"; ?>>Both</option>
                                    </select>
                                    <span class="text-danger"><?php echo form_error('is_or_bs'); ?></span>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Debit of Credit?</label> <small class="req">*</small>
                                    <select class="form-control" name="credit_debit" required>
                                        <option value="">--Select one</option>
                                        <option value="debit" <?php if($thiscoa['credit_debit'] == "debit")echo "selected"; ?>>Debit</option>
                                        <option value="credit" <?php if($thiscoa['credit_debit'] == "credit")echo "selected"; ?>>Credit</option>
                                    </select>
                                    <span class="text-danger"><?php echo form_error('is_or_bs'); ?></span>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Is Sub Account Of:</label> <small class="req">*</small>
                                    <select class="form-control" name="parent_id">
                                        <option value="0">None</option>
                                        <?php foreach($coa as $one){if($one['id'] != $thiscoa['id']){?>
                                        <option value="<?php echo $one['id'];?>" <?php if($one['id'] == $thiscoa['parent_id'])echo "selected"; ?>><?php echo $one['acc_name'];?></option>
                                        <?php }} ?>
                                    </select>
                                    <span class="text-danger"><?php echo form_error('parent_id'); ?></span>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Description:</label> <small class="req">*</small>
                                    <textarea class="form-control" name="description"><?php echo $thiscoa['description']; ?></textarea>
                                    <span class="text-danger"><?php echo form_error('description'); ?></span>
                                </div>
                                
                            </div><!-- /.box-body -->

                            <div class="box-footer">
                                <button type="submit" class="btn btn-info pull-right">SAVE</button>
                            </div>
                        </form>
                    </div>

                </div><!--/.col (right) -->
                <!-- left column -->
           
            <div class="col-md-9">
                <!-- general form elements -->
                <div class="box box-primary">
                    <div class="box-header ptbnull">
                        <h5 class="box-title titlefix">Chart Of Accounts</h5>
                        <div class="box-tools pull-right">
                        </div><!-- /.box-tools -->
                    </div><!-- /.box-header -->
                    <div class="box-body">
                        <div class="mailbox-messages table-responsive">
                            <table class="table table-striped table-bordered table-hover example"  data-ordering="false" >
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Type</th>
                                        <th>Balance</th>
                                        
                                        <th class="text-right">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    foreach ($coa as $type) {
                                        $subaccs = $this->finance_model->get_subaccs($type['id']);
                                        $debits_p =  $this->finance_model->get_totDebitP($type['id']);
                                        $credits_p = $this->finance_model->get_totCreditP($type['id']);
                                        $balance_p =number_format(($debits_p-$credits_p),'2','.',',');
                                        ?>
                                        <tr>
                                            <td class="mailbox-name">
                                                <a href="#" data-toggle="popover" class="detail_popover"><b><?php echo $type['acc_name'] ?></b></a>
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
                                            <td class="mailbox-name"><b><?php echo $type['type_name'];?></b></td>
                                            <td class="mailbox-name"><b>Ksh. <?php echo $balance_p;?></b></td>
                                            <td class="mailbox-date">
                                                <a data-placement="left" href="<?php echo base_url(); ?>admin/finance/edit_coa/<?php echo $type['id'] ?>" class="btn btn-info btn-xs"  data-toggle="tooltip" title="<?php echo $this->lang->line('edit'); ?>">
                                                        <i class="fas fa-pencil-alt"></i>
                                                    </a>
                                               
                                               <?php if($type['is_system'] == "0"){?>
                                                <a data-placement="left" href="<?php echo base_url(); ?>admin/finance/delete_coa/<?php echo $type['id'] ?>"class="btn btn-danger btn-xs"  data-toggle="tooltip" title="<?php echo $this->lang->line('delete'); ?>" onclick="return confirm('<?php echo $this->lang->line('delete_confirm') ?>');">
                                                        <i class="fas fa-trash"></i>
                                                    </a>
                                                    <?php } ?>
                                            </td>
                                        </tr>
                                        <?php if(sizeof($subaccs > 0)){?>
                                        
                                        <?php $i=0; foreach($subaccs as $single){ $i++;
                                        $debits =  $this->finance_model->get_totDebit($single['id']);
                                        $credits = $this->finance_model->get_totCredit($single['id']);
                                        $balance = number_format(($debits-$credits),'2','.',',');?>
                                        <tr>
                                            <td class="mailbox-name" style="padding-left: 30px;">
                                                <a href="#" data-toggle="popover" class="detail_popover"><?php echo $i.") ".$single['acc_name'] ?></a>
                                                <div class="fee_detail_popover" style="display: none">
                                                    <?php
                                                    if ($single['description'] == "") {
                                                        ?>
                                                        <p class="text text-danger"><?php echo $this->lang->line('no_description'); ?></p>
                                                        <?php
                                                    } else {
                                                        ?>
                                                        <p class="text text-info"><?php echo $single['description']; ?></p>
                                                        <?php
                                                    }
                                                    ?>
                                                </div>
                                            </td>
                                            <td class="mailbox-name"><?php echo $single['type_name'];?></td>
                                            <td class="mailbox-name">Ksh. <?php echo $balance;?></td>
                                            <td class="mailbox-date">
                                                <a data-placement="left" href="<?php echo base_url(); ?>admin/finance/edit_coa/<?php echo $single['id'] ?>" class="btn btn-info btn-xs"  data-toggle="tooltip" title="<?php echo $this->lang->line('edit'); ?>">
                                                        <i class="fas fa-pencil-alt"></i>
                                                    </a>
                                               <?php if($single['is_system'] != 1){?>
                                                <a data-placement="left" href="<?php echo base_url(); ?>admin/finance/delete_coa/<?php echo $single['id'] ?>"class="btn btn-danger btn-xs"  data-toggle="tooltip" title="<?php echo $this->lang->line('delete'); ?>" onclick="return confirm('<?php echo $this->lang->line('delete_confirm') ?>');">
                                                        <i class="fas fa-trash"></i>
                                                    </a>
                                                <?php } ?>
                                            </td>
                                        </tr>
                                        
                                        <?php }} ?>
                                        <?php
                                    }
                                    ?>

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
<script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
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