<div class="app-main__outer">
    <div class="app-main__inner">

        <div class="row">
            <div class="col-md-1"></div>
            <div class="col-md-10" style="padding-top: 20px;">
                <div class="main-card mb-3 card">
                    <div class="card-body"><h5 class="card-title">ADD TRIAGE</h5>
                        <hr>
                        <?php if($totaldue > 0){ ?>
                            <div class="alert alert-warning"> This patient's total due balance: <b>Ksh <?php echo $totaldue;?></b></div>
                        <?php } else if($totaldue == '0'){ ?>
                            <div class="alert alert-success"> This patient's total due balance: <b>Ksh <?php echo $totaldue;?></b></div>
                        <?php } ?>
                        <div class="alert alert-info">
                            <table width="100%">
                                <tr>
                                    <th>Name:</th>
                                    <td><?php echo $ticket_details['pname']." ".$ticket_details['mname']." ".$ticket_details['lname'];?></td>
                                    <td></td>
                                    <th>Patient No:</th>
                                    <td><?php echo str_pad( $ticket_details['pid'], 4, "0", STR_PAD_LEFT ); ?></td>
                                </tr>
                            </table>
                        </div>
                        <form class="" method="post"
                              action="<?php echo base_url(); ?>queue/save_triage/<?php echo $mvtid; ?>">
                            <div class="row">
                                <div class="position-relative row form-group col-sm-6"><label for="exampleEmail" class="col-sm-4 col-form-label">Weight(Kgs)</label>
                                    <div class="col-sm-8"><input name="weight" placeholder="" type="text" class="form-control"></div>
                                </div>
                                <div class="position-relative row form-group col-sm-6"><label for="exampleEmail" class="col-sm-4 col-form-label">Height(cm)</label>
                                    <div class="col-sm-8"><input name="height" placeholder="" type="text" class="form-control"></div>
                                </div>
                                <div class="position-relative row form-group col-sm-6"><label for="exampleEmail" class="col-sm-4 col-form-label">Temperature (&deg;)</label>
                                    <div class="col-sm-8"><input name="temperature" placeholder="" type="text" class="form-control"></div>
                                </div>
                                <div class="position-relative row form-group col-sm-6"><label for="exampleEmail" class="col-sm-4 col-form-label">Blood
                                        Pressure</label>
                                    <div class="col-sm-8"><input name="blood_pressure" type="text" placeholder="hbp/lbp eg 120/80" class="form-control"></div>
                                </div>
                                <div class="position-relative row form-group col-sm-6"><label for="exampleEmail" class="col-sm-4 col-form-label">SPO2 (%)</label>
                                    <div class="col-sm-8"><input name="spo2" placeholder="" type="text" class="form-control"></div>
                                </div>
                                <!-- <div class="position-relative row form-group col-sm-6"><label for="exampleEmail" class="col-sm-4 col-form-label">RBS</label>
                                    <div class="col-sm-8"><input name="rsb" placeholder="" type="text" class="form-control"></div>
                                </div> -->
                                <div class="position-relative row form-group col-sm-6"><label for="exampleEmail" class="col-sm-4 col-form-label">Pulse
                                        Rate</label>
                                    <div class="col-sm-8"><input name="resp_rate" placeholder="" type="text" class="form-control">
                                        <input name="ticket_id" placeholder="" type="hidden"
                                               value="<?php echo $ticket_id; ?>" class="form-control"></div>
                                </div>

                                <div class="position-relative row form-group col-sm-6"><label for="exampleEmail" class="col-sm-4 col-form-label">Send to Pharmacy?</label>
                                    <div class="col-sm-8"><select class="select form-control" name="pharma_direct" id="pharma_direct" class="form-control" required>
                                        <option value="no">No</option>
                                        <option value="yes">Yes</option>
                                    </select></div>
                                </div>

                                <!-- <div class="position-relative form-check col-sm-6">
                                    <label class="form-check-label">
                                        <input type="checkbox" name="rsb" value="100" class="form-check-input">RSB <small>(If checked Patient will be charged Ksh. 100/-) </small> </label>
                                </div> -->

                                <div class="col-sm-6 position-relative form-group" >
                                        <label for="chkPassport" >
                                            <input type="checkbox" name="rsb" value="100" id="chkPassport" />
                                            RBS <small>(If checked Patient will be charged Ksh. 100/-) </small>
                                        </label>
                                    </div>
                                    <div id="dvPassport" class="row col-md-12" style="display: none">
                                        <div class="position-relative row form-group col-md-6">
                                                <label for="examplePassword" class="col-sm-4 col-form-label">RSB Reading</label>
                                                <div class="col-sm-8">
                                                    <input name="rsb_reading" placeholder="RSB Reading" type="text" class="form-control">
                                                </div>
                                            </div>
                                    </div>

                                <div class="position-relative row form-group col-sm-12 " id="medicine"
                                     style="margin-left: 10px;">
                                    <div class="col-sm-12 alert alert-info"><p>Check the medicine to give. Prescription to be defined in next step.</p></div>
                                    <div class="tab-pane col-sm-12" id="obp" role="tabpanel">
                                        <table class="mb-0 table table-striped">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Medicine</th>
                                        <th>Available Qty</th>
                                        <th>Check</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php $i = 1; foreach ($medicine as $test) {
                                        ?>
                                        <tr>
                                            <th scope="row"><?php echo $i; ?></th>
                                            <td><?php echo $test['name']; ?></td>
                                            <td><?php echo $test['qty']; ?></td>
                                            <td><input type="checkbox" name="<?php echo 'medicine_' . $test['id']; ?>" class="form-check-input"></td>
                                        </tr>
                                       
                                    <?php $i++; } ?>
                                    </tbody>
                                </table>
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script type="text/javascript">
        $('#medicine').hide();

        $('#pharma_direct').on('change', function () {
            var activity = this.value;
            // alert(activity);
            switch (activity) {
                case 'yes' :
                    $('#medicine').show();
                    break;
                default :
                    $('#medicine').hide();
            }

        });
        $(function () {
            $("#chkPassport").click(function () {
                if ($(this).is(":checked")) {
                    $("#dvPassport").show();
                } else {
                    $("#dvPassport").hide();
                }
            });
        });
    </script>