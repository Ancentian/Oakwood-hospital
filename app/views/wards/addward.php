<div class="app-main__outer">
    <div class="app-main__inner">

        <div class="row">
            <div class="col-md-1"></div>
            <div class="col-md-10" style="padding-top: 20px;">
                <div class="main-card mb-3 card">
                    <div class="card-body"><h5 class="card-title">WARD DETAILS</h5>
                        <hr>
                        <form class="" method="post" action="<?php echo base_url(); ?>wards/add">
                            <div class="row">
                                <div class="position-relative row form-group col-sm-6"><label for="exampleEmail"
                                                                                              class="col-sm-4 col-form-label">Name</label>
                                    <div class="col-sm-8"><input name="name" id="exampleEmail" placeholder=""
                                                                 type="text" class="form-control" required></div>
                                </div>
                                <div class="position-relative row form-group col-sm-6"><label for="exampleEmail"
                                                                                              class="col-sm-4 col-form-label">No
                                        of Beds</label>
                                    <div class="col-sm-8"><input name="beds" id="exampleEmail" placeholder=""
                                                                 type="number" class="form-control" required></div>
                                </div>
                                <div class="position-relative row form-group col-sm-6"><label for="exampleEmail"
                                                                                              class="col-sm-4 col-form-label">Cost</label>
                                    <div class="col-sm-8"><input name="cost" id="exampleEmail" placeholder=""
                                                                 type="number" class="form-control" required></div>
                                </div>
                                <div class="position-relative row form-group col-sm-6"><label for="examplePassword"
                                                                                              class="col-sm-4 col-form-label">Type</label>
                                    <div class="col-sm-8">
                                        <select class="select form-control" name="type" class="form-control" required>
                                            <option>--Select</option>
                                            <option>Children</option>
                                            <option>Men</option>
                                            <option>Ladies</option>
                                            <option>Special</option>

                                        </select></div>
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