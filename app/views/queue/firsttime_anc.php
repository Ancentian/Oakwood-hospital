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
                        <form action="<?php echo base_url();?>queue/save_firsttime_anc" method="post">
                            <div class="row">
                                <div class="position-relative row form-group col-sm-6" id="appointment"><label for="exampleEmail" class="col-sm-4 col-form-label">General</label>
                                    <div class="col-sm-8">
                                        <input type="text" name="general" class="form-control" placeholder="">
                                        <input type="hidden" name="patient_id" class="form-control" value="<?php echo $ticket_details['pid'];?>">
                                        <input type="hidden" name="ticket_id" class="form-control" value="<?php echo $ticket_id;?>">
                                    </div>
                                </div>

                                <div class="position-relative row form-group col-sm-6" id="appointment"><label for="exampleEmail" class="col-sm-4 col-form-label">BP</label>
                                    <div class="col-sm-8">
                                        <input type="text" name="bp" class="form-control" placeholder="">
                                    </div>
                                </div>
                                <div class="position-relative row form-group col-sm-6" id="appointment"><label for="exampleEmail" class="col-sm-4 col-form-label">Height</label>
                                    <div class="col-sm-8">
                                        <input type="text" name="height" class="form-control" placeholder="">
                                    </div>
                                </div>
                                
                                <div class="position-relative row form-group col-sm-6" id="appointment"><label for="exampleEmail" class="col-sm-4 col-form-label">CVS</label>
                                    <div class="col-sm-8">
                                        <input type="text" name="cvs" class="form-control" placeholder="">
                                    </div>
                                </div>
                                <div class="position-relative row form-group col-sm-6" id="appointment"><label for="exampleEmail" class="col-sm-4 col-form-label">Resp</label>
                                    <div class="col-sm-8">
                                        <input type="text" name="resp" class="form-control" placeholder="">
                                    </div>
                                </div>
                                <div class="position-relative row form-group col-sm-6" id="appointment"><label for="exampleEmail" class="col-sm-4 col-form-label">Breasts</label>
                                    <div class="col-sm-8">
                                        <input type="text" name="breasts" class="form-control" placeholder="">
                                    </div>
                                </div>
                                <div class="position-relative row form-group col-sm-6" id="appointment"><label for="exampleEmail" class="col-sm-4 col-form-label">Abdomen</label>
                                    <div class="col-sm-8">
                                        <input type="text" name="abdomen" class="form-control" placeholder="">
                                    </div>
                                </div>
                                <div class="position-relative row form-group col-sm-6" id="appointment"><label for="exampleEmail" class="col-sm-4 col-form-label">Vaginal Examination</label>
                                    <div class="col-sm-8">
                                        <input type="text" name="vaginal_examination" class="form-control" placeholder="">
                                    </div>
                                </div>
                                <div class="position-relative row form-group col-sm-6" id="appointment"><label for="exampleEmail" class="col-sm-4 col-form-label">Discharge</label>
                                    <div class="col-sm-8">
                                        <input type="text" name="discharge" class="form-control" placeholder="">
                                    </div>
                                </div>
                                <div class="position-relative row form-group col-sm-6" id="appointment"><label for="exampleEmail" class="col-sm-4 col-form-label">HB</label>
                                    <div class="col-sm-8">
                                        <input type="text" name="hb" class="form-control" placeholder="">
                                    </div>
                                </div>
                                <div class="position-relative row form-group col-sm-6" id="appointment"><label for="exampleEmail" class="col-sm-4 col-form-label">Blood Group</label>
                                    <div class="col-sm-8">
                                        <input type="text" name="blood_grp" class="form-control" placeholder="">
                                    </div>
                                </div>

                                <div class="position-relative row form-group col-sm-6" id="appointment"><label for="exampleEmail" class="col-sm-4 col-form-label">Rhesus</label>
                                    <div class="col-sm-8">
                                        <input type="text" name="rhesus" class="form-control" placeholder="">
                                    </div>
                                </div>
                                <div class="position-relative row form-group col-sm-6" id="appointment"><label for="exampleEmail" class="col-sm-4 col-form-label">Urinalysis</label>
                                    <div class="col-sm-8">
                                        <input type="text" name="urinalysis" class="form-control" placeholder="">
                                    </div>
                                </div>
                                <div class="position-relative row form-group col-sm-6" id="appointment"><label for="exampleEmail" class="col-sm-4 col-form-label">TB Screening</label>
                                    <div class="col-sm-8">
                                        <input type="text" name="tb_screening" class="form-control" placeholder="">
                                    </div>
                                </div>
                                <div class="position-relative row form-group col-sm-6" id="appointment"><label for="exampleEmail" class="col-sm-4 col-form-label">IPT Date</label>
                                    <div class="col-sm-8">
                                        <input type="date" name="ipt_date" class="form-control" placeholder="">
                                    </div>
                                </div>
                                <div class="position-relative row form-group col-sm-6" id="appointment"><label for="exampleEmail" class="col-sm-4 col-form-label">Dual Testing Date</label>
                                    <div class="col-sm-8">
                                        <input type="date" name="dualtesting_date" class="form-control" placeholder="">
                                    </div>
                                </div>
                                <div class="position-relative row form-group col-sm-6" id="appointment"><label for="exampleEmail" class="col-sm-4 col-form-label">HIV Counselling</label>
                                    <div class="col-sm-8">
                                        <input type="text" name="hiv_counselling" class="form-control" placeholder="">
                                    </div>
                                </div>
                                <div class="position-relative row form-group col-sm-6" id="appointment"><label for="exampleEmail" class="col-sm-4 col-form-label">Partner HIV Status</label>
                                    <div class="col-sm-8">
                                        <input type="text" name="partner_hiv" class="form-control" placeholder="">
                                    </div>
                                </div>
                                <div class="position-relative row form-group col-sm-6" id="appointment"><label for="exampleEmail" class="col-sm-4 col-form-label">Infant Feeding</label>
                                    <div class="col-sm-8">
                                        <input type="text" name="infant_feeding" class="form-control" placeholder="">
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
    