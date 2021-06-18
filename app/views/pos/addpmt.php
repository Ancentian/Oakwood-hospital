<div class="app-main__outer">
    <div class="app-main__inner">

        <div class="row">
            <div class="col-md-1"></div>
            <div class="col-md-10" style="padding-top: 20px;">
                <div class="main-card mb-3 card">
                    <div class="card-body"><h5 class="card-title">MEDICINE DETAILS</h5>
                        <hr>
                        <form class="" method="post" action="<?php echo base_url(); ?>pos/addpmt_post/<?php echo $id; ?>">
                            <div class="row">
                                <div class="position-relative row form-group col-sm-6"><label for="exampleEmail"  class="col-sm-4 col-form-label">Amount</label>
                                    <div class="col-sm-8"><input name="amount" value="<?php echo $pmts['amount']; ?>" type="text" class="form-control" required></div>
                                </div>

                                <div class="position-relative row form-group col-sm-6"><label for="examplePassword" class="col-sm-4 col-form-label">Mode</label>
                                    <div class="col-sm-8">
                                        <select class="form-control" name="mode" id="mode" required>
                                            <option value="">--select</option>
                                            <option value="mpesa" <?php if($pmts['mode'] == "mpesa") echo "selected";?>>MPESA</option>
                                            <option value="cash" <?php if($pmts['mode'] == "cash") echo "selected";?>>CASH</option>
                                            <option value="Family Bank" <?php if($pmts['mode'] == "Family Bank") echo "selected";?>>FAMILY BANK</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row col-sm-12" id="mpesadetails" style="padding-left: 10px;">
                                    <div class="position-relative row form-group col-sm-6">
                                        <label for="examplePassword" class="col-sm-4 col-form-label">Phone Number</label>
                                        <div class="col-sm-8">
                                            <input type="text" name="phone_no" class="form-control" placeholder="Phone Number">
                                        </div>
                                    </div>
                                    <div class="position-relative row form-group col-sm-6">
                                        <label for="examplePassword" class="col-sm-4 col-form-label">Transaction</label>
                                        <div class="col-sm-8">
                                            <input type="text" name="transaction" class="form-control" placeholder="Transaction">
                                        </div>
                                    </div>
                                </div>
                                <div class="row col-sm-12" id="bankdetails" style="padding-left: 10px;">
                                    
                                    <div class="position-relative row form-group col-sm-6">
                                        <label for="examplePassword" class="col-sm-4 col-form-label">Transaction</label>
                                        <div class="col-sm-8">
                                            <input type="text" name="transaction" class="form-control" placeholder="Transaction">
                                        </div>
                                    </div>
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
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script type="text/javascript">
        $('#mpesadetails').hide();
        $('#bankdetails').hide();

        $('#mode').on('change', function () {
            var activity = this.value;
            console.log(activity);
            switch (activity) {
                case 'mpesa' :
                    $('#mpesadetails').show();
                    $('#bankdetails').hide();
                    break;
                case 'cash' :
                    $('#bankdetails').hide();
                    $('#mpesadetails').hide();
                    break;
                case 'Family Bank' :
                    $('#mpesadetails').hide();
                    $('#bankdetails').show();
                    break;
                default :
                    $('#mpesadetails').hide();
                    $('#bankdetails').hide();
            }


        });
    </script>