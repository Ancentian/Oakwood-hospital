<?php $userdata = $this->session->userdata('user_aob'); ?>
<div class="app-main__outer">
    <div class="app-main__inner">

        <div class="row">
            <div class="col-md-1"></div>
            <div class="col-md-10" style="padding-top: 20px;">
                <div class="main-card mb-3 card">
                    <div class="card-body"><h5 class="card-title">DIAGNOSE PATIENT</h5>
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
                              action="<?php echo base_url(); ?>queue/diagnose_save/<?php echo $mvtid; ?>">
                            <div class="row">
                                
                                <input type="hidden" name="ticket_id" value="<?php echo $ticket_id; ?>">
                                <div class="position-relative row form-group col-sm-12">
                                    <div class="col-sm-2">Clinical History</div>
                                    <div class="col-sm-10"><textarea name="clinical_history" class="form-control" rows="5"></textarea>
                                    </div>

                                </div>

                                <div class="position-relative row form-group col-sm-12">
                                    <div class="col-sm-2">Physical Findings</div>
                                    <div class="col-sm-10"><textarea name="physical_findings" class="form-control" rows="5"></textarea>
                                    </div>

                                </div>

                                <div class="position-relative row form-group col-sm-12">
                                    <div class="col-sm-2">Impressions & Diagnosis</div>
                                    <div class="col-sm-10"><textarea name="diagnosis" class="form-control" rows="5"></textarea>
                                    </div>

                                </div>

                                <div class="position-relative row form-group col-sm-12"><label for="exampleEmail" class="col-sm-2 col-form-label">Treatment:</label>
                                    <div class="col-sm-10">
                                        <input list="treatments" type="text" class="form-control" autocomplete="off" required name="treatment">
                                          <datalist id="treatments">
                                            <?php foreach($treatments as $one){?>
                                            <option value="<?php echo $one['name'];?>">
                                            <?php } ?>
                                          </datalist>
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
    