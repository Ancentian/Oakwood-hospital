<?php 
$pterms = $this->finance_model->get_paymentTermsID($thisbill['payment_terms']);
$discount = $pterms['discount'];
$ddays = $pterms['discount_days'];

$difference = strtotime($thisbill['date'])-strtotime(date('Y-m-d'));

$duetimestamp = $ddays*86400;

if($difference <= $ddays && $discount > 0 && $ddays > 0){
    $eligible = "yes";
}else{
    $eligible = "no";
}

$totpaid = $this->finance_model->billPaymentTot($id);
$balance = $thisbill['amount'] - $totpaid-$thisbill['discount'];

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
                            <h5 class="box-title">Pay Bill</h5>
                        </div><!-- /.box-header -->
                        <form id="form1" action="<?php echo base_url() ?>admin/finance/edit_bill/<?php echo $id;?>"  id="employeeform" name="employeeform" method="post" accept-charset="utf-8">
                            <div class="box-body row">
                                <?php if ($this->session->flashdata('msg')) { ?>
                                    <?php echo $this->session->flashdata('msg') ?>
                                <?php } ?>
                                <?php
                                if (isset($error_message)) {
                                    echo "<div class='alert alert-danger'>" . $error_message . "</div>";
                                }
                                ?>
                                
                                <div class="form-group col-sm-3">
                                    <label for="exampleInputEmail1">Memo</label> <small class="req">*</small>
                                    <input autofocus="" id="name" name="description" type="text" class="form-control"  value="<?php echo $thisbill['description']; ?>"  disabled/>
                                    <span class="text-danger"><?php echo form_error('description'); ?></span>
                                </div>
                                
                                <div class="form-group col-sm-3">
                                    <label for="exampleInputEmail1">Date</label> <small class="req">*</small>
                                    <input autofocus="" id="name" name="date" type="date" class="form-control"  value="<?php echo $thisbill['date']; ?>"  disabled/>
                                    <span class="text-danger"><?php echo form_error('date'); ?></span>
                                </div>
                                
                                <div class="form-group col-sm-3">
                                    <label for="exampleInputEmail1">Supplier</label> <small class="req">*</small>
                                    <select name="supplier_id" class="form-control searchable" required disabled>
                                        <option value="">--Choose one</option>
                                        <?php foreach($suppliers as $one){?>
                                        <option value="<?php echo $one['id'];?>" <?php if($one['id'] == $thisbill['supp_id']) echo "selected";?>><?php echo $one['name'];?></option>
                                        <?php } ?>
                                    </select>
                                    <span class="text-danger"><?php echo form_error('supplier_id'); ?></span>
                                </div>
                                
                                <div class="form-group col-sm-3">
                                    <label for="exampleInputEmail1">Payment Terms</label> <small class="req">*</small>
                                    <select name="payment_terms" class="form-control searchable" required disabled>
                                        <option value="">--Choose one</option>
                                        <?php foreach($payment_terms as $one){?>
                                        <option value="<?php echo $one['id'];?>" <?php if($one['id'] == $thisbill['payment_terms']) echo "selected";?>><?php echo $one['name'];?></option>
                                        <?php } ?>
                                    </select>
                                    <span class="text-danger"><?php echo form_error('payment_terms'); ?></span>
                                </div>
                                
                                <div class="form-group col-sm-3">
                                    <label for="exampleInputEmail1">Reference No</label>
                                    <input autofocus="" id="reference_no" name="reference_no" type="text" class="form-control"  value="<?php echo $thisbill['reference_no']; ?>"  disabled/>
                                    <span class="text-danger"><?php echo form_error('reference_no'); ?></span>
                                </div>
                                <div class="form-group col-sm-3">
                                    <label for="exampleInputEmail1">Total Payable</label> <small class="req">*</small>
                                    <input autofocus="" id="name" name="description" type="text" class="form-control"  value="<?php echo $thisbill['amount']; ?>"  disabled/>
                                    <span class="text-danger"><?php echo form_error('description'); ?></span>
                                </div>
                                <div class="form-group col-sm-3">
                                    <label for="exampleInputEmail1">Total Paid</label> <small class="req">*</small>
                                    <input autofocus="" id="name" name="description" type="text" class="form-control"  value="<?php echo $totpaid; ?>"  disabled/>
                                    <span class="text-danger"><?php echo form_error('description'); ?></span>
                                </div>
                                <div class="form-group col-sm-3">
                                    <label for="exampleInputEmail1">Total Due</label> <small class="req">*</small>
                                    <input autofocus="" id="name" name="description" type="text" class="form-control"  value="<?php echo $balance; ?>"  disabled/>
                                    <span class="text-danger"><?php echo form_error('description'); ?></span>
                                </div>
                                
                            </div><!-- /.box-body -->
                        </form>
                        <form id="form1" action="<?php echo base_url() ?>admin/finance/pay_bill/<?php echo $id;?>"  id="employeeform" name="employeeform" method="post" accept-charset="utf-8">
                            <div class="box-body row">
                                <?php if ($this->session->flashdata('msg')) { ?>
                                    <?php echo $this->session->flashdata('msg') ?>
                                <?php } ?>
                                <?php
                                if (isset($error_message)) {
                                    echo "<div class='alert alert-danger'>" . $error_message . "</div>";
                                }
                                ?>
                                
                                <div class="form-group col-sm-3">
                                    <label for="exampleInputEmail1">Amount</label> <small class="req">*</small>
                                    <input autofocus="" id="amount" max="<?php echo $balance; ?>" name="amount" type="number" step="0.01" <?php if($thisbill['discount'] == 0){?> onkeyup="computeDisc()" onkeydown="computeDisc()" <?php } ?> class="form-control"/>
                                    <span class="text-danger"><?php echo form_error('amount'); ?></span>
                                </div>
                                
                                <div class="form-group col-sm-3">
                                    <label for="exampleInputEmail1">Discount</label>
                                    <input autofocus="" id="discount" name="discount" type="number" step="0.01" class="form-control" <?php if($thisbill['discount'] > 0){ echo "disabled value='".$thisbill['discount']."'";}else{ echo "readonly value='0'"; } ?>/>
                                    <span class="text-danger"><?php echo form_error('discount'); ?></span>
                                </div>
                                
                                <div class="form-group col-sm-3">
                                    <label for="exampleInputEmail1">Date</label> <small class="req">*</small>
                                    <input name="date" type="date" class="form-control" required/>
                                    <span class="text-danger"><?php echo form_error('date'); ?></span>
                                </div>
                                
                                <div class="form-group col-sm-3">
                                    <label for="exampleInputEmail1">Account</label> <small class="req">*</small>
                                    <select name="acc_id" class="form-control searchable" required>
                                        <option value="">--Choose one</option>
                                        <?php foreach($coa as $one){?>
                                        <option value="<?php echo $one['id'];?>"><?php echo $one['acc_name'];?></option>
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






