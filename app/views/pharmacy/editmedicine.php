<div class="app-main__outer">
    <div class="app-main__inner">

        <div class="row">
            <div class="col-md-1"></div>
            <div class="col-md-10" style="padding-top: 20px;">
                <div class="main-card mb-3 card">
                    <div class="card-body"><h5 class="card-title">MEDICINE DETAILS</h5>
                        <hr>
                        <form class="" method="post" action="<?php echo base_url(); ?>pharmacy/edit/<?php echo $id; ?>">
                            <div class="row">
                                <div class="position-relative row form-group col-sm-6"><label for="exampleEmail"  class="col-sm-4 col-form-label">Name</label>
                                    <div class="col-sm-8"><input name="name" id="exampleEmail" placeholder="" value="<?php echo $medicine['name']; ?>" type="text"
                                                                 class="form-control" required></div>
                                </div>

                                <div class="position-relative row form-group col-sm-6"><label for="examplePassword" class="col-sm-4 col-form-label">Cost</label>
                                    <div class="col-sm-8"><input name="cost" placeholder=""
                                                                 value="<?php echo $medicine['cost']; ?>" type="number"
                                                                 class="form-control" required></div>
                                </div>
                                <div class="position-relative row form-group col-sm-6"><label for="examplePassword" class="col-sm-4 col-form-label">Available
                                        Stock</label>
                                    <div class="col-sm-8"><input name="qty" placeholder=""
                                                                 value="<?php echo $medicine['qty']; ?>" type="number"
                                                                 class="form-control"></div>
                                </div>
                                <div class="position-relative row form-group col-sm-6"><label for="examplePassword"  class="col-sm-4 col-form-label">Alert Qty</label>
                                    <div class="col-sm-8"><input name="alert_qty" placeholder="" type="number" class="form-control" value="<?php echo $medicine['alert_qty']; ?>"  required></div>
                                </div>

                                <div class="position-relative row form-group col-sm-6"><label for="examplePassword"  class="col-sm-4 col-form-label">Discount Rate</label>
                                    <div class="col-sm-8"><input name="disc_perc" placeholder="" type="number" class="form-control" value="<?php echo $medicine['disc_perc']; ?>" required></div>
                                </div>

                                <div class="position-relative row form-group col-sm-6"><label for="examplePassword"  class="col-sm-4 col-form-label">Expiry</label>
                                    <div class="col-sm-8"><input name="expiry" placeholder="" type="date" value="<?php echo date('Y-m-d',strtotime($medicine['expiry']));?>" class="form-control" required></div>
                                </div>

                                <div class="position-relative row form-check">
                                    <div class="col-sm-10 offset-sm-2">
                                        <button class="btn btn-success">COMPLETE</button>

                                    </div>
                                </div>

                            </div>


                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>