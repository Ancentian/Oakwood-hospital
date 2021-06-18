<div class="app-main__outer">
    <div class="app-main__inner">

        <div class="row">
            <div class="col-md-1"></div>
            <div class="col-md-10" style="padding-top: 20px;">
                <div class="main-card mb-3 card">
                    <div class="card-body"><h5 class="card-title">MEDICINE DETAILS</h5>
                        <hr>
                        <form class="" method="post"
                              action="<?php echo base_url(); ?>pharmacy/stock/<?php echo $id; ?>">
                            <div class="row">

                                <div class="position-relative row form-group col-sm-6"><label for="examplePassword"
                                                                                              class="col-sm-4 col-form-label">Incoming
                                        Qty</label>
                                    <div class="col-sm-8"><input name="qty" placeholder="" type="number"
                                                                 class="form-control"></div>
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