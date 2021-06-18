<?php $userdata = $this->session->userdata('user_aob'); ?>
<div class="app-main__outer">
    <div class="app-main__inner">

        <div class="row">
            <div class="col-md-1"></div>
            <div class="col-md-10" style="padding-top: 20px;">
                <div class="main-card mb-3 card">
                    <div class="card-body"><h5 class="card-title">PRE-MATERNITY OBSERVATIONS</h5>
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
                              action="<?php echo base_url(); ?>queue/prematernity_save/<?php echo $mvtid; ?>">
                            <div class="row">
                                
                                <input type="hidden" name="ticket_id" value="<?php echo $ticket_id; ?>">
                                <div class="position-relative row form-group col-sm-6">
                                    <div class="col-sm-12"><textarea name="fundus_height" class="form-control" rows="2" placeholder="Height of Fundus"></textarea>
                                    </div>

                                </div>

                                <div class="position-relative row form-group col-sm-6">
                                    <div class="col-sm-12"><textarea name="presentation" class="form-control" rows="2" placeholder="Presentation"></textarea>
                                    </div>

                                </div>

                                <div class="position-relative row form-group col-sm-6">
                                    <div class="col-sm-12"><textarea name="engagement" class="form-control" rows="2" placeholder="Engagement"></textarea>
                                    </div>

                                </div>

                                 <div class="position-relative row form-group col-sm-6">
                                    <div class="col-sm-12"><textarea name="position" class="form-control" rows="2" placeholder="Position"></textarea>
                                    </div>

                                </div>

                                <div class="position-relative row form-group col-sm-6">
                                    <div class="col-sm-12"><textarea name="foetal_heart" class="form-control" rows="2" placeholder="Foetal Heart"></textarea>
                                    </div>

                                </div>

                                <div class="position-relative row form-group col-sm-6">
                                    <div class="col-sm-12"><textarea name="vaginal_examination" class="form-control" rows="2" placeholder="Vaginal Examination"></textarea>
                                    </div>

                                </div>

                                <div class="position-relative row form-group col-sm-6">
                                    <div class="col-sm-12"><textarea name="cervical_position" class="form-control" rows="2" placeholder="Cervical Position"></textarea>
                                    </div>

                                </div>

                                <div class="position-relative row form-group col-sm-6">
                                    <div class="col-sm-12"><textarea name="consistency" class="form-control" rows="2" placeholder="Consistency"></textarea>
                                    </div>

                                </div>

                                <div class="position-relative row form-group col-sm-6">
                                    <div class="col-sm-12"><textarea name="enfacement" class="form-control" rows="2" placeholder="Enfacement"></textarea>
                                    </div>

                                </div>

                                 <div class="position-relative row form-group col-sm-6">
                                    <div class="col-sm-12"><textarea name="diatation" class="form-control" rows="2" placeholder="Diatation"></textarea>
                                    </div>

                                </div>

                                <div class="position-relative row form-group col-sm-6">
                                    <div class="col-sm-12"><textarea name="foetal_presentation" class="form-control" rows="2" placeholder="Foetal presentation"></textarea>
                                    </div>

                                </div>

                                <div class="position-relative row form-group col-sm-6">
                                    <div class="col-sm-12"><textarea name="membrane_state" class="form-control" rows="2" placeholder="State of Membrane"></textarea>
                                    </div>

                                </div>


                                <div class="position-relative row form-group col-sm-6">
                                    <div class="col-sm-12"><textarea name="rectum" class="form-control" rows="2" placeholder="Rectum"></textarea>
                                    </div>

                                </div>

                                <div class="position-relative row form-group col-sm-6">
                                    <div class="col-sm-12"><textarea name="lower_limbs" class="form-control" rows="2" placeholder="Lower Limbs"></textarea>
                                    </div>

                                </div>

                                <div class="position-relative row form-group col-sm-6">
                                    <div class="col-sm-12"><textarea name="back" class="form-control" rows="2" placeholder="Back"></textarea>
                                    </div>

                                </div>

                                 <div class="position-relative row form-group col-sm-6">
                                    <div class="col-sm-12"><textarea name="pending_investigations" class="form-control" rows="2" placeholder="Pending Investigations"></textarea>
                                    </div>

                                </div>

                                <div class="position-relative row form-group col-sm-6">
                                    <div class="col-sm-12"><textarea name="identified_problems" class="form-control" rows="2" placeholder="Identified Health Problems"></textarea>
                                    </div>

                                </div>

                                <div class="position-relative row form-group col-sm-6">
                                    <div class="col-sm-12"><textarea name="admission_category" class="form-control" rows="2" placeholder="Patient's category on admission"></textarea>
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
    