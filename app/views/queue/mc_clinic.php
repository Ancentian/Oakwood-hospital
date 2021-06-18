<div class="app-main__outer">
    <div class="app-main__inner">

        <div class="row">
            <div class="col-md-1"></div>
            <div class="col-md-10" style="padding-top: 20px;">
                <div class="main-card mb-3 card">
                    <div class="card-body"><h5 class="card-title">MOTHER CHILD CLINIC</h5>
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
                        <form action="<?php echo base_url();?>queue/save_mcclinic" method="post">
                            <div class="row">
                                <input type="hidden" name="ticket_id" value="<?php echo $tick_id;?>">
                                <input type="hidden" name="mvt_id" value="<?php echo $mvt_id;?>">
                                <div class="position-relative row form-group col-sm-6"><label for="exampleEmail" class="col-sm-4 col-form-label">Activity</label>
                                    <div class="col-sm-8">
                                        <select class="form-control" id="service" name="service" class="form-control" required>
                                            <option value="">--Choose one</option>
                                            <option value="anc">ANC</option>
                                            <option value="pnc">PNC</option>
                                            <option value="cwc">CWC</option>
                                            <option value="family-planning">Family Planning</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="position-relative row form-group col-sm-6"><label for="exampleEmail" class="col-sm-4 col-form-label">Status</label>
                                    <div class="col-sm-8">
                                        <select class="select form-control" name="status" class="form-control" required>
                                            <option value="">--Choose one</option>
                                            <option value="first">First time visit</option>
                                            <option value="revisit">Revisit</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="position-relative row form-group col-sm-6"><label for="exampleEmail" class="col-sm-4 col-form-label">Next Activity</label>
                                    <div class="col-sm-8">
                                        <select class="form-control" id="next" name="next" class="form-control" required>
                                            <option value="">--Choose one</option>
                                            <option value="appointment">Book Appointment</option>
                                            <option value="release">Release Patient</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="position-relative row form-group col-sm-6" id="appointment"><label for="exampleEmail" class="col-sm-4 col-form-label">Next Appointment</label>
                                    <div class="col-sm-8">
                                        <input type="date" name="appointment" class="form-control">
                                    </div>
                                </div>
                                <div class="position-relative row form-group col-sm-12" id="family-planning">
                                    <input type="text" name="plan_type" class="form-control col-sm-5" placeholder="Family Plan Type">
                                    <input type="text" name="plan_cost" class="form-control col-sm-2" placeholder="Cost">
                                    <div class="col-sm-5">
                                        <select class="form-control" name="fam_cons" class="form-control">
                                            <option value="">--Charge Family Planning Consultation fee?</option>
                                            <option value="<?php echo $this->FAMILY_PLANNING_COST;?>">Yes</option>
                                            <option value="0">No</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <input type="submit" value="COMPLETE" class="btn btn-success">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script type="text/javascript">
        $('#appointment').hide();
        $('#next').on('change', function () {
            var activity = this.value;
            // alert(activity);
            switch (activity) {
                case 'appointment' :
                     $('#appointment').show();
                      break;
                case 'family-planning' :
                     $('#appointment').hide();
                      break;
                default :
                     $('#appointment').hide();
            }


        });
    </script>
    <script type="text/javascript">
        $('#family-planning').hide();
        $('#service').on('change', function () {
            var activity = this.value;
            // alert(activity);
            switch (activity) {
                case 'family-planning' :
                     $('#family-planning').show();
                    break;
                default :
                     $('#family-planning').hide();
            }


        });
    </script>