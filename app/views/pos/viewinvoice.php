<div class="app-main__outer">
    <div class="app-main__inner">

        <div class="row">
            <div class="col-md-1"></div>
            <div class="col-md-10" style="padding-top: 20px;">
                <div class="main-card mb-3 card">
                    <div class="card-body"><h5 class="card-title">INVOICE DETAILS</h5>
                        <hr>
                        <form class="" >
                            <div class="row" >
                                <div class="position-relative row form-group col-sm-6"><label for="exampleEmail"  class="col-sm-4 col-form-label">Client</label>
                                    <div class="col-sm-8"><input name="amount" value="<?php echo $pmts['name'].' '.$pmts['lname']; ?>" type="text" class="form-control" required disabled></div>
                                </div>
                                <div class="position-relative row form-group col-sm-6"><label for="exampleEmail"  class="col-sm-4 col-form-label">Amount Billed</label>
                                    <div class="col-sm-8"><input name="amount" value="<?php echo $pmts['amount_payable']+$pmts['discount']; ?>" type="text" class="form-control" required disabled></div>
                                </div>
                                <div class="position-relative row form-group col-sm-6"><label for="exampleEmail"  class="col-sm-4 col-form-label">Discount</label>
                                    <div class="col-sm-8"><input name="amount" value="<?php echo $pmts['discount']; ?>" type="text" class="form-control" required disabled></div>
                                </div>
                                <div class="position-relative row form-group col-sm-6"><label for="exampleEmail"  class="col-sm-4 col-form-label">Amount Payable</label>
                                    <div class="col-sm-8"><input name="amount" value="<?php echo $pmts['amount_payable']; ?>" type="text" class="form-control" required disabled></div>
                                </div>

                            </div>
                            <div class="row" style="padding-left: 10px;">
                                <div class="position-relative row form-group col-sm-6">
                                    <h5>Medicine</h5>
                                </div>
                                <div class="position-relative row form-group col-sm-1">
                                    <h5>Qty</h5>
                                </div>
                                <div class="position-relative row form-group col-sm-2">
                                    <h5>Cost</h5>
                                </div>
                                <div class="position-relative row form-group col-sm-2">
                                    <h5>Total</h5>
                                </div>
                                <div class="position-relative row form-group col-sm-1">
                                    <h5>Discount</h5>
                                </div>
                            </div>
                            <?php foreach(json_decode($pmts['particulars'],true) as $one){?>
                                <div class="row" style="padding-left: 10px;">
                                <div class="position-relative row form-group col-sm-6">
                                    <p><?php echo $one['prodName'];?></p>
                                </div>
                                <div class="position-relative row form-group col-sm-1">
                                    <p><?php echo $one['prodQty'];?></p>
                                </div>
                                <div class="position-relative row form-group col-sm-2">
                                    <p><?php echo $one['prodCost'];?></p>
                                </div>
                                <div class="position-relative row form-group col-sm-2">
                                    <p><?php echo $one['prodCost']*$one['prodQty'];?></p>
                                </div>
                                <div class="position-relative row form-group col-sm-1">
                                    <p><?php echo ceil($one['prodCost']*$one['prodQty']*$one['prodDisc']/100);?></p>
                                </div>
                            </div>
                            <?php } ?>


                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>