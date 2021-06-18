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
                            <h5 class="box-title">Add Bill</h5>
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
                                
                                <div class="form-group col-sm-4">
                                    <label for="exampleInputEmail1">Memo</label> <small class="req">*</small>
                                    <input autofocus="" id="name" name="description" type="text" class="form-control"  value="<?php echo $thisbill['description']; ?>" />
                                    <span class="text-danger"><?php echo form_error('description'); ?></span>
                                </div>
                                
                                <div class="form-group col-sm-4">
                                    <label for="exampleInputEmail1">Date</label> <small class="req">*</small>
                                    <input autofocus="" id="name" name="date" type="date" class="form-control"  value="<?php echo $thisbill['date']; ?>" />
                                    <span class="text-danger"><?php echo form_error('date'); ?></span>
                                </div>
                                
                                <div class="form-group col-sm-4">
                                    <label for="exampleInputEmail1">Supplier</label> <small class="req">*</small>
                                    <select name="supplier_id" class="form-control searchable" required>
                                        <option value="">--Choose one</option>
                                        <?php foreach($suppliers as $one){?>
                                        <option value="<?php echo $one['id'];?>" <?php if($one['id'] == $thisbill['supp_id']) echo "selected";?>><?php echo $one['name'];?></option>
                                        <?php } ?>
                                    </select>
                                    <span class="text-danger"><?php echo form_error('supplier_id'); ?></span>
                                </div>
                                
                                <div class="form-group col-sm-4">
                                    <label for="exampleInputEmail1">Payment Terms</label> <small class="req">*</small>
                                    <select name="payment_terms" class="form-control searchable" required>
                                        <option value="">--Choose one</option>
                                        <?php foreach($payment_terms as $one){?>
                                        <option value="<?php echo $one['id'];?>" <?php if($one['id'] == $thisbill['payment_terms']) echo "selected";?>><?php echo $one['name'];?></option>
                                        <?php } ?>
                                    </select>
                                    <span class="text-danger"><?php echo form_error('payment_terms'); ?></span>
                                </div>
                                
                                <div class="form-group col-sm-4">
                                    <label for="exampleInputEmail1">Reference No</label>
                                    <input autofocus="" id="reference_no" name="reference_no" type="text" class="form-control"  value="<?php echo $thisbill['reference_no']; ?>" />
                                    <span class="text-danger"><?php echo form_error('reference_no'); ?></span>
                                </div>
                                
                            </div><!-- /.box-body -->
                            <div class="box-body row">
                                <h5 class="box-title col-sm-12">Add Bill Items</h5><hr>
                                <div class="col-sm-6 alert alert-warning">
                                    <h5 class="box-title">Products<button type="button" class="btn btn-success" onclick="addProd()"><i class="fa fa-plus"></i></button></h5><hr>
                                    <div class="row">
                                        <div class="col-sm-4"><label><b>Item</b></label></div>
                                        <div class="col-sm-4"><label><b>Cost</b></label></div>
                                        <div class="col-sm-4"><label><b>Qty</b></label></div>
                                    </div>
                                    <?php
                                    $prods = 0;
                                    foreach($billitems as $item){
                                        if($item['type'] == "product"){
                                            $prods ++;
                                        $particulars = json_decode($item['particulars'],true);
                                    ?>
                                    <div class="row" style="margin-bottom: 10px;" id="inputFormRow">
                                        <div class="col-sm-4 form-group">
                                            <select name="product[]" class="form-control searchable">
                                                <option value="">--Choose one</option>
                                                <?php foreach($products as $one){
                                                        if($one['type'] == 'Product'){?>
                                                <option value="<?php echo $one['id'];?>" <?php if($one['id'] == $item['item_id']) echo "selected";?>><?php echo $one['name'];?></option>
                                                <?php }} ?>
                                            </select>
                                        </div>
                                        <div class="col-sm-4 form-group">
                                            <input type="number" step="0.01" class="form-control" value="<?php echo $particulars['cost'];?>" name="prod_cost[]">
                                        </div>
                                        <div class="col-sm-3 form-group">
                                            <input type="number" step="0.01" class="form-control" value="<?php echo $particulars['qty'];?>" name="prod_qty[]">
                                        </div>
                                        <div class="col-sm-1 form-group">
                                            <button type="button" class="btn btn-danger" id="removeRow"><i class="fa fa-minus"></i></button>
                                        </div>'
                                    </div>
                                    <?php }
                                    }?>
                                    
                                    <?php if($prods > 0 ){}else{?>
                                    <div class="row" style="margin-bottom: 10px;">
                                        <div class="col-sm-4 form-group">
                                            <select name="product[]" class="form-control searchable">
                                                <option value="">--Choose one</option>
                                                <?php foreach($products as $one){
                                                        if($one['type'] == 'Product'){?>
                                                <option value="<?php echo $one['id'];?>" ><?php echo $one['name'];?></option>
                                                <?php }} ?>
                                            </select>
                                        </div>
                                        <div class="col-sm-4 form-group">
                                            <input type="number" step="0.01" class="form-control" name="prod_cost[]">
                                        </div>
                                        <div class="col-sm-3 form-group">
                                            <input type="number" step="0.01" class="form-control" name="prod_qty[]">
                                        </div>
                                        <div class="col-sm-1 form-group">
                                            <button type="button" class="btn btn-success" onclick="addProd()"><i class="fa fa-plus"></i></button>
                                        </div>
                                    </div>
                                    <?php } ?>
                                    
                                    <div id="prodArr"></div>
                                    
                                </div>
                                <div class="col-sm-6 alert alert-info">
                                    <h5 class="box-title">Services <button type="button" class="btn btn-success" onclick="addServ()"><i class="fa fa-plus"></i></button></h5><hr>
                                    <div class="row">
                                        <div class="col-sm-6"><label><b>Service</b></label></div>
                                        <div class="col-sm-6"><label><b>Cost</b></label></div>
                                    </div>
                                    
                                     <?php
                                     $servcs = 0;
                                    foreach($billitems as $item){
                                        if($item['type'] == "service"){
                                            $servcs ++;
                                        $particulars = json_decode($item['particulars'],true);
                                    ?>
                                    <div class="row" style="margin-bottom: 10px;" id="servRow">
                                        <div class="col-sm-6 form-group">
                                            <select name="service[]" class="form-control searchable"  style="width: 100%" >
                                                <option value="">--Choose one</option>
                                                <?php foreach($products as $one){
                                                        if($one['type'] == 'Service'){?>
                                                <option value="<?php echo $one['id'];?>" <?php if($one['id'] == $item['item_id']) echo "selected";?>><?php echo $one['name'];?></option>
                                                <?php }} ?>
                                            </select>
                                        </div>
                                        <div class="col-sm-5 form-group">
                                            <input type="number" step="0.01" class="form-control" value="<?php echo $particulars['cost'];?>" name="serv_cost[]">
                                        </div>
                                        <div class="col-sm-1 form-group">
                                            <button type="button" class="btn btn-danger" id="removeServ"><i class="fa fa-minus"></i></button>
                                        </div>
                                    </div>
                                     <?php }
                                    }?>
                                    
                                    <?php if($servcs > 0 ){}else{?>
                                    <div class="row" style="margin-bottom: 10px;">
                                        <div class="col-sm-6 form-group">
                                            <select name="service[]" class="form-control searchable"  style="width: 100%" >
                                                <option value="">--Choose one</option>
                                                <?php foreach($products as $one){
                                                        if($one['type'] == 'Service'){?>
                                                <option value="<?php echo $one['id'];?>"><?php echo $one['name'];?></option>
                                                <?php }} ?>
                                            </select>
                                        </div>
                                        <div class="col-sm-5 form-group">
                                            <input type="number" step="0.01" class="form-control" name="serv_cost[]">
                                        </div>
                                        <div class="col-sm-1 form-group">
                                            <button type="button" class="btn btn-success" onclick="addServ()"><i class="fa fa-plus"></i></button>
                                        </div>
                                    </div>
                                    <?php } ?>
                                    <div id="servArr"></div>
                                </div>
                            </div>

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
   var addedprod = 1;
   var addedserv = 1;
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
            addedprod ++;
            addedprodid = "added-search_" + addedprod;
            addedproddom = "#" + addedprodid;
            var html = '<div class="row" id="inputFormRow" style="margin-bottom: 10px;">' +
                            '<div class="col-sm-4 form-group">' +
                                '<select name="product[]" class="form-control"  style="width: 100%"  id="' + addedprodid + '">' + options + 
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
            $(addedproddom).select2();
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
            addedserv ++;
            addedservid = "added-servsearch_" + addedserv;
            addedservdom = "#" + addedservid;
            var html = '<div class="row" id="servRow" style="margin-bottom: 10px;">' +
                            '<div class="col-sm-6 form-group">' +
                                '<select name="service[]" class="form-control" id="' + addedservid + '">' + options + 
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
            $(addedservdom).select2();
    }
    $(document).on('click', '#removeRow', function () {
            $(this).closest('#inputFormRow').remove();
    });
    $(document).on('click', '#removeServ', function () {
            $(this).closest('#servRow').remove();
    });
    
</script>






