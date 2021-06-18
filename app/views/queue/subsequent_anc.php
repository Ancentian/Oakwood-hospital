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
                        <form action="<?php echo base_url();?>queue/save_subsequent_anc/<?php echo $ticket_details['pid'];?>" method="post">
                            <div class="row">
                                <div class="position-relative row form-group col-sm-6" id="appointment"><label for="exampleEmail" class="col-sm-4 col-form-label">Urine</label>
                                    <div class="col-sm-8">
                                        <input type="text" name="urine" class="form-control" placeholder="">
                                    </div>
                                </div>
                                <div class="position-relative row form-group col-sm-6" id="appointment"><label for="exampleEmail" class="col-sm-4 col-form-label">Weight</label>
                                    <div class="col-sm-8">
                                        <input type="text" name="weight" class="form-control" placeholder="">
                                    </div>
                                </div>
                                <div class="position-relative row form-group col-sm-6" id="appointment"><label for="exampleEmail" class="col-sm-4 col-form-label">BP</label>
                                    <div class="col-sm-8">
                                        <input type="text" name="bp" class="form-control" placeholder="">
                                    </div>
                                </div>
                                <div class="position-relative row form-group col-sm-6" id="appointment"><label for="exampleEmail" class="col-sm-4 col-form-label">HB</label>
                                    <div class="col-sm-8">
                                        <input type="text" name="hb" class="form-control" placeholder="">
                                    </div>
                                </div>
                                <div class="position-relative row form-group col-sm-6" id="appointment"><label for="exampleEmail" class="col-sm-4 col-form-label">Pallor</label>
                                    <div class="col-sm-8">
                                        <input type="text" name="pallor" class="form-control" placeholder="">
                                    </div>
                                </div>
                                <div class="position-relative row form-group col-sm-6" id="appointment"><label for="exampleEmail" class="col-sm-4 col-form-label">Maturity</label>
                                    <div class="col-sm-8">
                                        <input type="text" name="maturity" class="form-control" placeholder="">
                                    </div>
                                </div>
                                <div class="position-relative row form-group col-sm-6" id="appointment"><label for="exampleEmail" class="col-sm-4 col-form-label">Fundal Height</label>
                                    <div class="col-sm-8">
                                        <input type="text" name="fundal_height" class="form-control" placeholder="">
                                    </div>
                                </div>
                                <div class="position-relative row form-group col-sm-6" id="appointment"><label for="exampleEmail" class="col-sm-4 col-form-label">Presentation</label>
                                    <div class="col-sm-8">
                                        <input type="text" name="presentation" class="form-control" placeholder="">
                                    </div>
                                </div>
                                <div class="position-relative row form-group col-sm-6" id="appointment"><label for="exampleEmail" class="col-sm-4 col-form-label">Lie</label>
                                    <div class="col-sm-8">
                                        <input type="text" name="lie" class="form-control" placeholder="">
                                    </div>
                                </div>
                                <div class="position-relative row form-group col-sm-6" id="appointment"><label for="exampleEmail" class="col-sm-4 col-form-label">Foetal Heart</label>
                                    <div class="col-sm-8">
                                        <input type="text" name="foetal_heart" class="form-control" placeholder="">
                                    </div>
                                </div>
                                <div class="position-relative row form-group col-sm-6" id="appointment"><label for="exampleEmail" class="col-sm-4 col-form-label">Foetal Movement</label>
                                    <div class="col-sm-8">
                                        <input type="text" name="foetal_mvt" class="form-control" placeholder="">
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
    