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
            
                <div class="col-md-3">
                    <!-- Horizontal Form -->
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h5 class="box-title">Add an Entry</h5>
                        </div><!-- /.box-header -->
                        <form id="form1" action="<?php echo base_url() ?>admin/finance/ledger"  id="employeeform" name="employeeform" method="post" accept-charset="utf-8">
                            <div class="box-body">
                                <?php if ($this->session->flashdata('msg')) { ?>
                                    <?php echo $this->session->flashdata('msg') ?>
                                <?php } ?>
                                <?php
                                if (isset($error_message)) {
                                    echo "<div class='alert alert-danger'>" . $error_message . "</div>";
                                }
                                ?>
                               <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">
                                    
                                
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Name of Transaction</label> <small class="req">*</small>
                                    <input autofocus="" id="name" name="name" type="text" class="form-control"  value="<?php echo set_value('name'); ?>" />
                                    <span class="text-danger"><?php echo form_error('name'); ?></span>
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Date of Transaction</label> <small class="req">*</small>
                                    <input type="date" name="date_trans" class="form-control" required />
                                    <span class="text-danger"><?php echo form_error('date'); ?></span>
                                </div>
                                
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Amount</label> <small class="req">*</small>
                                    <input autofocus="" id="amount" name="amount" type="number" class="form-control" step="0.01"  value="<?php echo set_value('amount'); ?>" />
                                    <span class="text-danger"><?php echo form_error('amount'); ?></span>
                                </div>
                               
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Debit Account:</label> <small class="req">*</small>
                                    <select class="form-control searchable" name="debit" required>
                                        <option value="">--Choose one</option>
                                        <?php foreach($coa as $one){?>
                                        <option value="<?php echo $one['id'];?>"><?php echo $one['acc_name'];?></option>
                                        <?php } ?>
                                    </select>
                                    <span class="text-danger"><?php echo form_error('debit'); ?></span>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Credit Account:</label> <small class="req">*</small>
                                    <select class="form-control searchable" name="credit" required>
                                        <option value="">--Choose one</option>
                                        <?php foreach($coa as $one){?>
                                        <option value="<?php echo $one['id'];?>"><?php echo $one['acc_name'];?></option>
                                        <?php } ?>
                                    </select>
                                    <span class="text-danger"><?php echo form_error('credit'); ?></span>
                                </div>
                                
                            </div><!-- /.box-body -->

                            <div class="box-footer">
                                <button type="submit" class="btn btn-info pull-right">Save</button>
                            </div>
                        </form>
                    </div>

                </div><!--/.col (right) -->
                <!-- left column -->
           
            <div class="col-md-9">
                <!-- general form elements -->
                <div class="box box-primary">
                    <div class="box-header ptbnull">
                        <h5 class="box-title titlefix">The Ledger</h5>
                        <div class="box-tools pull-right">
                        </div><!-- /.box-tools -->
                    </div><!-- /.box-header -->
                    <div class="box-body">
                        <div class="mailbox-messages table-responsive">
                            <table class="table table-striped table-bordered table-hover example" data-ordering="false">
                                <thead>
                                    <tr>
                                        <th>Date</th>
                                        <th>Particulars</th>
                                        <th>DR or CR</th>
                                        <th>Acc Name</th>
                                        <th>Debit</th>
                                        <th>Credit</th>
                                        <th class="text-right">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    foreach ($ledger as $type) {
                                        ?>
                                        <tr>
                                            <td class="mailbox-name"><?php echo $type['date'];?></td>
                                            <td class="mailbox-name"><?php echo $type['name'];?></td>
                                            <td class="mailbox-name"><?php echo $type['type'];?></td>
                                            <td class="mailbox-name">
                                                <a href="#" data-toggle="popover" class="detail_popover"><?php echo $type['acc_name'] ?></a>
                                            </td>
                                            <td class="mailbox-name"><?php if($type['type'] =="Debit") echo "Ksh. ".number_format($type['amount'],'2','.',',');?></td>
                                            <td class="mailbox-name"><?php if($type['type'] =="Credit") echo "Ksh. ".number_format($type['amount'],'2','.',',');?></td>
                                            <td class="mailbox-date">
                                                <a data-placement="left" href="<?php echo base_url(); ?>admin/finance/edit_ledger/<?php echo $type['id'] ?>" class="btn btn-info btn-xs"  data-toggle="tooltip" title="<?php echo $this->lang->line('edit'); ?>">
                                                        <i class="fas fa-pencil-alt"></i>
                                                    </a>
                                               
                                                <a data-placement="left" href="<?php echo base_url(); ?>admin/finance/delete_ledger/<?php echo $type['id'] ?>"class="btn btn-danger btn-xs"  data-toggle="tooltip" title="<?php echo $this->lang->line('delete'); ?>" onclick="return confirm('<?php echo $this->lang->line('delete_confirm') ?>');">
                                                        <i class="fas fa-trash"></i>
                                                    </a>
                                            </td>
                                        </tr>
                                        
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