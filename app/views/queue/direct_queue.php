<?php $userdata = $this->session->userdata('user_aob'); ?>
<div class="app-main__outer">
    <div class="app-main__inner">

        <div class="row">
            <div class="col-md-1"></div>
            <div class="col-md-10" style="padding-top: 20px;">
                <div class="main-card mb-3 card">
                    <div class="card-body"><h5 class="card-title">SELECT PATIENT</h5>
                        <hr>
                        <form class="" method="post" action="<?php echo base_url(); ?>queue/create">
                            <div class="row">
                                <div class="position-relative row form-group col-sm-12">
                                    <p style="padding-left: 25px;">Choose the activity
                                        appropriately!</p>
                                </div>

                                <input type="hidden" name="patient" value="<?php echo $pid;?>" required>
                                <div class="position-relative row form-group col-sm-6"><label for="exampleEmail" class="col-sm-4 col-form-label">Activity</label>
                                    <div class="col-sm-8">
                                        <select class="select form-control" name="activity" id="activity" class="form-control" required>
                                            <option value="">--Choose one</option>
                                            <?php foreach ($active_act as $act) {
                                                
                                                    ?>
                                                    <option value="<?php echo $act['id']; ?>"><?php echo $act['name']; ?></option>
                                                <?php 
                                            } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="position-relative row form-group col-sm-6"><label for="exampleEmail" class="col-sm-4 col-form-label">Consultation Fee</label>
                                    <div class="col-sm-8">
                                        <select class="select form-control" name="cons_fee" id="cons_fee" class="form-control" required>
                                            <option value="">--Choose one</option>
                                            <option value="0">Zero consultation fee</option>
                                            <option value="100">Normal consultation fee</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="position-relative row form-group col-sm-6"><label for="exampleEmail" class="col-sm-4 col-form-label">Is Direct</label>
                                    <div class="col-sm-8">
                                        <select class="select form-control" name="direct" id="direct" class="form-control" required>
                                            <option value="">--Choose one</option>
                                            <option value="1">YES</option>
                                            <option value="0">NO</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="position-relative row form-group col-sm-6">
                                        <label for="exampleEmail" class="col-sm-4 col-form-label">Payment Method:</label>
                                        <div class="col-sm-8">
                                            <select class="select form-control" name="payment_mode" id="payment_mode" class="form-control" required>
                                            <option value="">--Choose one</option>
                                            <option value="cash">Cash</option>
                                            <option value="mpesa">Mpesa</option>
                                            <!-- <?php //foreach ($paymentMode as $mode) {?>
                                                <?php //if($mode['status'] == '1') {?>
                                                <option value="<?php echo $mode['payment_mode']?>"><?php //echo $mode['payment_mode']?></option>
                                            <?php //}?>
                                            <?php //} ?> -->
                                        </select>
                                        </div>

                                </div>


                                <div class="position-relative row form-check">
                                    <div class="col-sm-10 offset-sm-2">
                                        <button class="btn btn-success">ADD</button>

                                    </div>
                                </div>

                            </div>


                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script type="text/javascript">
        $('#direct').on('change', function () {
            var activity = this.value;
            // alert(activity);
            switch (activity) {
                case '1' :
                        $('#cons_fee').val('0');
                    break;
                case '0' :
                        $('#cons_fee [value=100]').attr('selected', 'true');
                    break;
                default :
                        $('#cons_fee [value=100]').attr('selected', 'true');
            }


        });
    </script>