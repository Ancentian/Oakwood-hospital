<?php 
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
                            <h5 class="box-title">Bill Details</h5>
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
                            <div class="box-body row">
                                <div class="box-body col-sm-12">
                                    <h5 class="box-title">Bill Items</h5><hr>
                                    <div class="mailbox-messages table-responsive">
                                        <table class="table table-striped table-bordered table-hover example">
                                            <thead>
                                                <tr>
                                                    <th>Item</th>
                                                    <th>Type</th>
                                                    <th>Qty</th>
                                                    <th>Unit Cost</th>
                                                    <th>Total</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                foreach ($billitems as $type) {
                                                    $particulars = json_decode($type['particulars'],true);
                                                    if($particulars['qty']){
                                                        $qty = $particulars['qty'];
                                                    }else{
                                                        $qty = 1;
                                                    }
                                                    
                                                    ?>
                                                    <tr>
                                                        
                                                        <td class="mailbox-name"><?php echo $type['prodname'];?></td>
                                                        <td class="mailbox-name"><?php echo $type['type'];?></td>
                                                        <td class="mailbox-name"><?php echo $qty;?></td>
                                                        <td class="mailbox-name"><?php echo $particulars['cost'];?></td>
                                                        <td class="mailbox-name"><?php echo number_format(($particulars['cost']*$qty),'2','.',',');?></td>
                                                    </tr>
            
                                                    <?php }?>
                                                   
                                            </tbody>
                                        </table><!-- /.table -->
            
            
            
                                    </div><!-- /.mail-box-messages -->
                                </div>
                            </div>
                            
                             <div class="box-body row">
                                <div class="box-body col-sm-12">
                                    <h5 class="box-title">Bill Payments</h5><hr>
                                    <div class="mailbox-messages table-responsive">
                                        <table class="table table-striped table-bordered table-hover example">
                                            <thead>
                                                <tr>
                                                    <th>Account</th>
                                                    <th>Amount</th>
                                                    <th>Date</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                foreach ($billpayments as $type) {
                                                    
                                                    ?>
                                                    <tr>
                                                        
                                                        <td class="mailbox-name"><?php echo $type['acc_name'];?></td>
                                                        <td class="mailbox-name"><?php echo number_format($type['amount'],'2','.',',');?></td>
                                                        <td class="mailbox-name"><?php echo $type['date'];?></td>
                                                        <td class="mailbox-name">
                                                             <a data-placement="left" href="<?php echo base_url(); ?>admin/finance/edit_billPmt/<?php echo $type['id'] ?>/<?php echo $type['bill_id'] ?>" class="btn btn-info btn-xs"  data-toggle="tooltip" title="<?php echo $this->lang->line('edit'); ?>">
                                                                    <i class="fas fa-pencil-alt"></i>
                                                                </a>
                                                            <a data-placement="left" href="<?php echo base_url(); ?>admin/finance/delete_billPmt/<?php echo $type['id'] ?>/<?php echo $type['bill_id'] ?>"class="btn btn-danger btn-xs"  data-toggle="tooltip" title="<?php echo $this->lang->line('delete'); ?>" onclick="return confirm('<?php echo $this->lang->line('delete_confirm') ?>');">
                                                                    <i class="fas fa-trash"></i>
                                                                </a>
                                                        </td>
                                                    </tr>
            
                                                    <?php }?>
                                                   
                                            </tbody>
                                        </table><!-- /.table -->
            
            
            
                                    </div><!-- /.mail-box-messages -->
                                </div>
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
<script type="text/javascript">
    $(document).ready(function () {
        var date_format = '<?php echo $result = strtr($this->customlib->getSchoolDateFormat(), ['d' => 'dd', 'm' => 'mm', 'Y' => 'yyyy',]) ?>';

        $('#date').datepicker({
            //  format: "dd-mm-yyyy",
            format: date_format,
            autoclose: true
        });

        $("#btnreset").click(function () {
            $("#form1")[0].reset();
        });

    });
</script>
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
    function addProd(){
            var prod = '<?php echo json_encode($products);?>';
            var prodArr = JSON.parse(prod);
            
            var options = '<option value="">--Select one</option>';
            
            for(var i=0; i<prodArr.length; i++){
                var oneProd = prodArr[i];
                if(oneProd['type'] == 'Product'){
                    var oneOption = '<option value="' + oneProd['id'] + '">' + oneProd['name'] + '</option>';
                    options = options + oneOption;
                }
                
            }
            var html = '<div class="row" id="inputFormRow" style="margin-bottom: 10px;">' +
                            '<div class="col-sm-4 form-group">' +
                                '<select name="product[]" class="form-control added-search searchable">' + options + 
                                '</select>' +
                            '</div>' +
                            '<div class="col-sm-4 form-group">' +
                                    '<input type="number" step="0.01" class="form-control" name="prod_cost[]">' +
                            '</div>' +
                            '<div class="col-sm-3 form-group">' +
                                '<input type="number" step="0.01" class="form-control" name="prod_qty[]">' +
                            '</div>' +
                            '<div class="col-sm-1 form-group">' +
                                '<button type="button" class="btn btn-danger" id="removeRow"><i class="fa fa-minus"></i></button>' +
                            '</div>' +
                        '</div>';
            $('#prodArr').append(html);
            $('.searchable').select2();
    }
    function addServ(){
            var prod = '<?php echo json_encode($products);?>';
            var prodArr = JSON.parse(prod);
            
            var options = '<option value="">--Select one</option>';
            
            for(var i=0; i<prodArr.length; i++){
                var oneProd = prodArr[i];
                if(oneProd['type'] == 'Service'){
                    var oneOption = '<option value="' + oneProd['id'] + '">' + oneProd['name'] + '</option>';
                    options = options + oneOption;
                }
                
            }
            var html = '<div class="row" id="servRow" style="margin-bottom: 10px;">' +
                            '<div class="col-sm-6 form-group">' +
                                '<select name="service[]" class="form-control added-search searchable">' + options + 
                                '</select>' +
                            '</div>' +
                            '<div class="col-sm-5 form-group">' +
                                    '<input type="number" step="0.01" class="form-control" name="serv_cost[]">' +
                            '</div>' +
                            '<div class="col-sm-1 form-group">' +
                                '<button type="button" class="btn btn-danger" id="removeServ"><i class="fa fa-minus"></i></button>' +
                            '</div>' +
                        '</div>';
            $('#servArr').append(html);
            $('.searchable').select2();
    }
    $(document).on('click', '#removeRow', function () {
            $(this).closest('#inputFormRow').remove();
    });
    $(document).on('click', '#removeServ', function () {
            $(this).closest('#servRow').remove();
    });
    
</script>






