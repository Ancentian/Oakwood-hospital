<style>
    /* Chrome, Safari, Edge, Opera */
    input::-webkit-outer-spin-button,
    input::-webkit-inner-spin-button {
      -webkit-appearance: none;
      margin: 0;
    }
    
    /* Firefox */
    input[type=number] {
      -moz-appearance: textfield;
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
                    <div class="card-header"><i class="header-icon lnr-license icon-gradient bg-plum-plate"> </i>POS

                    </div>
                    <div class="card-body">
                        <div class="card-content" id="mainbody" style="display:none">

                            <a href="<?php echo base_url('pos/summaryReport');?>" class="btn btn-info"></a>

            <div id="invoice-template" class="card-body">
                <div class="row">
                    <div class="col-sm-8" >
                        <div class="row">
                            <div class="form-group col-sm-8">
                                <select class="form-control custom-select" id="cName" name="cName" style="width: 100%;">
                                    <option value="">Choose customer here</option>
                                <?php if ($clientArr){
                                    
                                    foreach ($clientArr as $client) {
                                       
                                        ?>
                                    <option value="<?php echo $client['id']?>" <?php if($client['is_walkin']==1){ echo "selected"; } ?> data-string="<?php echo $client['is_walkin'];?>"><?php echo $client['name']." ".$client['lname']?></option>
                                    <?php
                                    }
                                } ?>
                                    ?>
                                </select>
                                
                                </div>
                                 <div class="form-group col-sm-4"><a href="<?php echo base_url();?>dashboard/addpatient" class="btn btn-info">ADD NEW</a></div>
                               
                        
                        </div>
                        
                        <div class="form-bordered" style="min-height: 470px; max-height: 470px;overflow-y: auto;">
                            <table class="table table-striped table-bordered zero-configuration" cellspacing="0"
                                   width="100%" id="cartTable">
                                <div class="row">
                                    <div class="col-sm-3"><b>Name</b></div>
                                    <div class="col-sm-2"><b>Qty</b></div>
                                    <div class="col-sm-2"><b>Cost</b></div>
                                    <div class="col-sm-2"><b>Total</b></div>
                                    <div class="col-sm-2"><b>Disc</b></div>
                                    <div class="col-sm-1"><b>*</b></div>
                                </div>
                                    <form id="cartform" >
                                        <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">
                                        <div class="row" id="prodrow">
                                        </div>
                                    </form>
                            </table>
                            <div class="row">
                                <div class="col-sm-4"><h5><b>Total: </b></h5></div>
                                <div class="col-sm-4"><h5 style="color: green;"><span id="grandTotal"><?php echo $grandTot; ?></span></h5></div>
                            </div>
                            
                            <div class="row">
                                <div class="col-sm-4"><h5><b>Discount: </b></h5></div>
                                <div class="col-sm-4"><h5 style="color: green;"><input type="text" class="form-control" id="granddiscount" value="0" onkeyup="computediscount()"><span id="grandDisc"><?php echo $grandDisc; ?></span></h5></div>
                            </div>
                            <div class="row">
                                <div class="col-sm-4"><h5><b>Grand Total: </b></h5></div>
                                <div class="col-sm-4"><h5 style="color: green;"><span id="tot"></span></h5></div>
                            </div>
                            <div class="row" hidden>
                                <div class="col-sm-4"><h5><b>VAT: </b></h5></div>
                                <div class="col-sm-4"><h5 style="color: green;"><span id="grandTax"><?php echo $grandTax; ?></span></h5></div>
                            </div>
                        </div>
                        <button class="btn btn-success" id="btnNow" onclick="readTable(1)">PAY NOW</button>
                        <button class="btn btn-danger" id="btnCredit" onclick="readTable(2)">CREDIT PAYMENT</button>
                    </div>
                    <div class="col-sm-4" style="min-height: 470px; max-height: 470px;overflow-y: auto;">
                        <div class="row" style="margin: 10px;">
                            <input type="text" id="searchbox" class="form-control" placeholder="Search by Item name">
                        </div>
                        <div class="row">
                            
                         <?php
                            
                            foreach($prodArr as $oneProd){
                                // var_dump($oneProd);die;
                                ?>
                                <div class="col-sm-6 single-prod" style="line-height: 15px;" data-string="<?php echo $oneProd['name'];?>">
                                    <div class="card card-block" style="border: 1px solid grey;">
                                        <div class="card-body">
                                            <h5 class="card-title" style="font-size: 15px"><?php echo $oneProd['name']; ?></h5>
                                            <h6 class="card-text" style="margin-top: 5px">Ksh <?php echo $oneProd['cost']; ?></h6>
                                            <i style="color: <?php if($oneProd['qty'] < 0){ echo 'red'; } else{echo 'blue'; }?>;">Stock: <?php echo $oneProd['qty']; ?></i>
                                            <button id="add_<?php echo $oneProd['id'];?>" data-value="<?php echo $oneProd['id'];?>" class="btn btn-success" onclick="addToCart(this.id)"><i class="fas fa-plus"></i></button>
                                        </div>
                                    </div>
                                </div>
                            <?php }
                            if (sizeof($prodArr) <= 0){
                                ?>
                                <div class="card-body">
                                    <div class="alert alert-danger">You do not have products to sell</div>
                                    <a href="#" class="btn btn-primary" role="button">
                                        ADD PRODUCTS
                                    </a>
                                </div> <?php
                            }
                            ?>
                        </div>
                    </div>
                </div>

            </div>
        </div>

                    </div>

                </div>
            </div>

        </div>
    </div>
