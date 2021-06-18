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
                        <?php if($is_direct == '0'){?>
                        <form class="" method="post" action="<?php echo base_url(); ?>queue/save_radiology"
                              enctype="multipart/form-data">
                            <div class="row">
                                <div class="alert alert-info col-sm-12" style="text-align: center;">Add lab results and
                                    attach a file(optional)
                                </div>
                                <?php foreach ($test_details as $key) { ?>
                                    <div class="position-relative row form-group col-sm-12"><label for="exampleEmail" class="col-sm-4 col-form-label"><?php echo $key['name'] ?></label>
                                        <div class="col-sm-8">
                                            <textarea name="comments[]" class="form-control" rows="5"
                                                      placeholder="<?php echo $key['name'] ?> results"></textarea>
                                        </div>
                                    </div>
                                <?php } ?>

                                <div class="position-relative row form-group col-sm-12"><label for="exampleEmail" class="col-sm-4 col-form-label">Attach
                                        file(optional)</label>
                                    <div class="col-sm-8">
                                        <input class="form-control" data-height="40" type='file' name='file' id="file"
                                               size='2000'
                                               style=" border: 1px !important;outline: 1 !important; opacity: 1 !important;"/>
                                    </div>
                                </div>

                                <input type="hidden" name="tick_id" value="<?php echo $tick_id; ?>" required>
                                <input type="hidden" name="lab_id" value="<?php echo $lab_id; ?>" required>
                                <input type="hidden" name="mvt_id" value="<?php echo $mvt_id; ?>" required>
                                <div class="position-relative row form-check">
                                    <div class="col-sm-10 offset-sm-2">
                                        <button class="btn btn-success">COMPLETE</button>

                                    </div>
                                </div>

                            </div>


                        </form>
                    <?php }else{
                        if (sizeof($test_details) > 0) {?>
                            <form class="" method="post" action="<?php echo base_url(); ?>queue/save_radiology"
                              enctype="multipart/form-data">
                            <div class="row">
                                <div class="alert alert-info col-sm-12" style="text-align: center;">Add lab results and
                                    attach a file(optional)
                                </div>
                                <?php foreach ($test_details as $key) { ?>
                                    <div class="position-relative row form-group col-sm-12"><label for="exampleEmail" class="col-sm-4 col-form-label"><?php echo $key['name'] ?></label>
                                        <div class="col-sm-8">
                                            <textarea name="comments[]" class="form-control" rows="5"
                                                      placeholder="<?php echo $key['name'] ?> results"></textarea>
                                        </div>
                                    </div>
                                <?php } ?>

                                <div class="position-relative row form-group col-sm-12"><label for="exampleEmail" class="col-sm-4 col-form-label">Attach
                                        file(optional)</label>
                                    <div class="col-sm-8">
                                        <input class="form-control" data-height="40" type='file' name='file' id="file"
                                               size='2000'
                                               style=" border: 1px !important;outline: 1 !important; opacity: 1 !important;"/>
                                    </div>
                                </div>

                                <input type="hidden" name="tick_id" value="<?php echo $tick_id; ?>" required>
                                <input type="hidden" name="lab_id" value="<?php echo $lab_id; ?>" required>
                                <input type="hidden" name="mvt_id" value="<?php echo $mvt_id; ?>" required>
                                <div class="position-relative row form-check">
                                    <div class="col-sm-10 offset-sm-2">
                                        <button class="btn btn-success">COMPLETE</button>

                                    </div>
                                </div>

                            </div>


                        </form>
                    <?php } else{ ?>
                        <form class="" method="post" action="<?php echo base_url(); ?>queue/add_direct_rad">
                        <div class="position-relative row form-group col-sm-12" id="radiology">
                                    <div class="col-sm-12 alert alert-warning"><p>Choose radiology screening to carry on this patient</p></div>

                                    <label for="exampleEmail" class="col-sm-3 col-form-label">Radiology:</label>
                                    <div class="col-sm-8">
                                        <select class="select form-control" style="width: 100%;" name="radiology[]" multiple>
                                                    <option value="">--Choose one</option>
                                                    <?php foreach ($radiology as $act) {
                                                            ?>
                                                            <option value="<?php echo $act['id']; ?>"><?php echo $act['name']; ?> (Cost: Ksh.<?php echo $act['cost']; ?> )</option>
                                                        <?php 
                                                    } ?>
                                        </select>
                                    </div>
                                </div>
                                <input type="hidden" name="ticket_id" value="<?php echo $tick_id; ?>" required>
                                <input type="hidden" name="mvt_id" value="<?php echo $mvt_id; ?>" required>
                                <div class="position-relative row form-check">
                                    <div class="col-sm-10 offset-sm-2">
                                        <button class="btn btn-success">ADD TESTS</button>

                                    </div>
                                </div>
                            </form>
                     <?php    }
                    } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>