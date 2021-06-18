<?php 
?>
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
                    <!-- Horizontal Form -->
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h5 class="box-title">Edit Bill Payment</h5>
                        </div><!-- /.box-header -->
                        <form id="form1" action="<?php echo base_url() ?>admin/finance/edit_billPmt/<?php echo $id;?>/<?php echo $bid;?>"  id="employeeform" name="employeeform" method="post" accept-charset="utf-8">
                            <div class="box-body row">
                                <?php if ($this->session->flashdata('msg')) { ?>
                                    <?php echo $this->session->flashdata('msg') ?>
                                <?php } ?>
                                <?php
                                if (isset($error_message)) {
                                    echo "<div class='alert alert-danger'>" . $error_message . "</div>";
                                }
                                ?>
                                
                                <div class="form-group col-sm-4">
                                    <label for="exampleInputEmail1">Amount</label> <small class="req">*</small>
                                    <input autofocus="" id="amount" name="amount" type="number" value="<?php echo $thispmt['amount'];?>" class="form-control"/>
                                    <span class="text-danger"><?php echo form_error('amount'); ?></span>
                                </div>
        
                                <div class="form-group col-sm-4">
                                    <label for="exampleInputEmail1">Date</label> <small class="req">*</small>
                                    <input name="date" type="date" class="form-control" value="<?php echo $thispmt['date'];?>" required/>
                                    <span class="text-danger"><?php echo form_error('date'); ?></span>
                                </div>
                                
                                <div class="form-group col-sm-4">
                                    <label for="exampleInputEmail1">Account</label> <small class="req">*</small>
                                    <select name="acc_id" class="form-control searchable" required>
                                        <option value="">--Choose one</option>
                                        <?php foreach($coa as $one){?>
                                        <option value="<?php echo $one['id'];?>" <?php if($one['id'] == $thispmt['acc_id']) echo "selected"; ?>><?php echo $one['acc_name'];?></option>
                                        <?php } ?>
                                    </select>
                                    <span class="text-danger"><?php echo form_error('amount'); ?></span>
                                </div>
                                
                            </div><!-- /.box-body -->
                           
                            <div class="box-footer">
                                <button type="submit" class="btn btn-info pull-right">SAVE</button>
                            </div>
                        </form>
                    </div>

                </div><!--/.col (right) -->
                <!-- left column -->
        </div>
        </div>

                </div>
            </div>

        </div>
    </div>
<link rel="stylesheet" href="<?php echo base_url(); ?>backend/plugins/select2/select2.min.css">
<script src="<?php echo base_url(); ?>backend/plugins/select2/select2.full.min.js"></script>


<script>
   
    
    function computeDisc()
    {
        var amt = $('#amount').val();
        var php_amt = "<?php echo ceil($thisbill['amount']);?>";
        var eligible = "<?php echo $eligible;?>";
        var disc_rate = "<?php echo $discount;?>";
        var disc = 0;
        var amt_afterDisc = (100-disc_rate)*php_amt/100;
        // console.log(php_amt);
        if(amt_afterDisc <= amt){
            if(eligible == "yes"){
               disc = disc_rate*php_amt/100;
               $('#discount').val(disc);
            }
        }else{
            $('#discount').val(0); 
        }
    }
    
</script>






