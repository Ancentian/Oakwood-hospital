<?php $userdata = $this->session->userdata('user_aob'); ?>
<div class="app-main__outer">
    <div class="app-main__inner">

        <div class="row">
            <div class="col-md-1"></div>
            <div class="col-md-10" style="padding-top: 20px;">
                <div class="main-card mb-3 card">
                    <div class="card-body"><h5 class="card-title">REPORT ON LABOUR</h5>
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
                              action="<?php echo base_url(); ?>queue/postmaternity_save/<?php echo $mvtid; ?>">
                            <div class="row">
                                
                                <input type="hidden" name="ticket_id" value="<?php echo $ticket_id; ?>" required>
                                <div class="position-relative row form-group col-sm-6">
                                    <label class="col-sm-4">Labour Began at:</label>
                                    <div class="col-sm-8"><input type="datetime-local" class="form-control" name="labour_began">
                                    </div>
                                </div>
                                <div class="position-relative row form-group col-sm-6">
                                    <label class="col-sm-4">Membrane Rptured at:</label>
                                    <div class="col-sm-8"><input type="datetime-local" class="form-control" name="membrane_raptured">
                                    </div>
                                </div>
                                <div class="position-relative row form-group col-sm-6">
                                    <label class="col-sm-4">Full Dilated at:</label>
                                    <div class="col-sm-8"><input type="datetime-local" class="form-control" name="full_dilated">
                                    </div>
                                </div>
                                <div class="position-relative row form-group col-sm-6">
                                    <label class="col-sm-4">Baby Born at:</label>
                                    <div class="col-sm-8"><input type="datetime-local" class="form-control" name="baby_born">
                                    </div>
                                </div>
                                <div class="position-relative row form-group col-sm-6">
                                    <label class="col-sm-4">Placenta Expelled at:</label>
                                    <div class="col-sm-8"><input type="datetime-local" class="form-control" name="placenta_expelled">
                                    </div>
                                </div>
                                <div class="position-relative row form-group col-sm-6">
                                    <label class="col-sm-4">1<sup>st</sup> Stage Duration:</label>
                                    <div class="col-sm-8"><input type="number" class="form-control" name="firststage_duration">
                                    </div>
                                </div>
                                <div class="position-relative row form-group col-sm-6">
                                    <label class="col-sm-4">2<sup>nd</sup> Stage Duration:</label>
                                    <div class="col-sm-8"><input type="number" class="form-control" name="secstage_duration">
                                    </div>
                                </div>
                                <div class="position-relative row form-group col-sm-6">
                                    <label class="col-sm-4">3<sup>rd</sup> Stage Duration:</label>
                                    <div class="col-sm-8"><input type="number" class="form-control" name="thirdstage_duration">
                                    </div>
                                </div>
                                <div class="position-relative row form-group col-sm-6">
                                    <label class="col-sm-4">Delivery Type:</label>
                                    <div class="col-sm-8"><input type="text" class="form-control" name="delivery_type">
                                    </div>
                                </div>
                                <div class="position-relative row form-group col-sm-6">
                                    <label class="col-sm-4">Placenta Weight:</label>
                                    <div class="col-sm-8"><input type="text" class="form-control" name="placenta_weight">
                                    </div>
                                </div>
                                <div class="position-relative row form-group col-sm-6">
                                    <label class="col-sm-4">Blood Loss:</label>
                                    <div class="col-sm-8"><input type="text" class="form-control" name="blood_loss">
                                    </div>
                                </div>

                                <div class="position-relative row form-group col-sm-6">
                                    <div class="col-sm-12"><textarea name="mother_condition" class="form-control" rows="2" placeholder="Mother Condition"></textarea>
                                    </div>

                                </div>

                                <div class="position-relative row form-group col-sm-6">
                                    <div class="col-sm-12"><textarea name="fundus" class="form-control" rows="2" placeholder="Fundus"></textarea>
                                    </div>

                                </div>
                                <div class="position-relative row form-group col-sm-6">
                                    <label class="col-sm-4">Temperature:</label>
                                    <div class="col-sm-8"><input type="text" class="form-control" name="temp">
                                    </div>
                                </div>
                                <div class="position-relative row form-group col-sm-6">
                                    <label class="col-sm-4">Pulse:</label>
                                    <div class="col-sm-8"><input type="text" class="form-control" name="pulse">
                                    </div>
                                </div>
                                <div class="position-relative row form-group col-sm-6">
                                    <label class="col-sm-4">Resp:</label>
                                    <div class="col-sm-8"><input type="text" class="form-control" name="resp">
                                    </div>
                                </div>
                                <div class="position-relative row form-group col-sm-6">
                                    <label class="col-sm-4">BP:</label>
                                    <div class="col-sm-8"><input type="text" class="form-control" name="bp">
                                    </div>
                                </div>

                                 <div class="position-relative row form-group col-sm-6">
                                    <div class="col-sm-12"><textarea name="baby_condition" class="form-control" rows="2" placeholder="Baby Condition"></textarea>
                                    </div>

                                </div>

                                <div class="position-relative row form-group col-sm-6">
                                    <div class="col-sm-12"><textarea name="apgar_score" class="form-control" rows="2" placeholder="Apgar Score"></textarea>
                                    </div>

                                </div>

                                <div class="position-relative row form-group col-sm-6">
                                    <label class="col-sm-4">Sex:</label>
                                    <div class="col-sm-8"><select class="form-control" name="sex">
                                            <option>Male</option>
                                            <option>Female</option>
                                            <option>Other</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="position-relative row form-group col-sm-6">
                                    <label class="col-sm-4">Birth Weight:</label>
                                    <div class="col-sm-8"><input type="text" class="form-control" name="birth_weight">
                                    </div>
                                </div>

                                <div class="position-relative row form-group col-sm-6">
                                    <div class="col-sm-12"><textarea name="abnormalities" class="form-control" rows="2" placeholder="Abnormalities"></textarea>
                                    </div>

                                </div>

                                <div class="position-relative row form-group col-sm-6">
                                    <div class="col-sm-12"><textarea name="drugs_given" class="form-control" rows="2" placeholder="Drugs Given"></textarea>
                                    </div>
                                </div>

                                <div class="position-relative row form-group col-sm-6">
                                    <div class="col-sm-12"><textarea name="remarks" class="form-control" rows="2" placeholder="Remarks"></textarea>
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
    