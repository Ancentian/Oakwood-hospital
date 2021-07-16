<?php //var_dump($prescriptions);die; ?>
<div class="app-main__outer">
    <div class="app-main__inner">

        <div class="row">
            <div class="col-md-1"></div>
            <div class="col-md-10" style="padding-top: 20px;">
                <div class="main-card mb-3 card">
                    <div class="card-body"><h5 class="card-title">GIVE MEDICINE</h5>
                        <hr>
                            <div class="row">
                                <?php if($totpaid < $total){?>
                                <div class="col-sm-12 alert alert-danger">This patient has a balance of <b>Ksh. <?php echo abs($totpaid-$total);?></b>. You might want to send him/her to cashier first!</div>
                            <?php } ?>
                            <div class="col-sm-12 alert alert-info">
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
                        <form class="" method="post"
                              action="<?php echo base_url(); ?>queue/pharmacyclose/<?php echo $mvtid; ?>" style="width: 100%">
                                <label for="exampleEmail" class="col-sm-4 col-form-label"><b>Medicine</b></label>
                                <label for="exampleEmail" class="col-sm-2 col-form-label"><b>Prescription</b></label>
                                <label for="exampleEmail" class="col-sm-1 col-form-label"><b>Units</b></label>
                                <label for="exampleEmail" class="col-sm-1 col-form-label"><b>Available</b></label>
                                <label for="exampleEmail" class="col-sm-1 col-form-label"><b>Cost</b></label>
                                <label for="exampleEmail" class="col-sm-2 col-form-label"><b>Total</b></label>
                                <label for="exampleEmail" class="col-sm-1 col-form-label"><b>*</b></label>
                            
                            <?php $totmed = 0; foreach ($prescriptions as $one) { $totmed += $one['units']*$one['cost'];
                             ?>
                            <div class="row">
                                <label for="exampleEmail" class="col-sm-4 col-form-label"><?php echo $one['mname'];?></label>
                                <label for="exampleEmail" class="col-sm-2 col-form-label"><?php echo $one['prescription'];?></label>
                                <label for="exampleEmail" class="col-sm-1 col-form-label"><?php echo $one['units'];?></label>
                                <label for="exampleEmail" class="col-sm-1 col-form-label"><?php echo $one['qty'];?></label>
                                <label for="exampleEmail" class="col-sm-1 col-form-label"><?php echo $one['cost'];?></label>
                                <label for="exampleEmail" class="col-sm-2 col-form-label"><?php echo $one['units']*$one['cost'];?></label>
                                <label for="exampleEmail" class="col-sm-1 col-form-label"><a href="<?php echo base_url(); ?>queue/delete_medication/<?php echo $one['id'];?>/<?php echo $ticket_id;?>/<?php echo $mvtid;?>/<?php echo $is_direct;?>"><i class="fa fa-fw icon-danger"></i></a></label>
                            </div>
                        <?php } ?>
                            <hr>
                            <div class="row">
                                <label for="exampleEmail" class="col-sm-8 col-form-label"></label>
                            <label for="exampleEmail" class="col-sm-2 col-form-label"><b>Grandtotal</b></label>
                            <label for="exampleEmail" class="col-sm-2 col-form-label"><b><?php echo $totmed;?></b></label>
                            <hr>
                                    <div class="position-relative row form-group col-sm-12"><label for="exampleEmail" class="col-sm-3 col-form-label">Next Activity</label>
                                    <div class="col-sm-8">
                                        <select class="select form-control" name="activity" id="activity" class="form-control" required>
                                            <option value="">--Choose one</option>
                                            <option value="release">Release the patient</option>
                                            <option value="send">Send back to doctor</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="position-relative row form-check">
                                    <div class="col-sm-10 offset-sm-2">
                                        <button class="btn btn-success">COMPLETE</button>

                                    </div>
                                </div>
                        </form>
                    <?php }elseif ($is_direct == '1') {
                        if (sizeof($prescriptions) > 0) {?>
                            <form class="" method="post"
                              action="<?php echo base_url(); ?>queue/pharmacyclose/<?php echo $mvtid; ?>" style="width: 100%">
                              <div class="col-sm-12">
                                <label for="exampleEmail" class="col-sm-4 col-form-label"><b>Medicine</b></label>
                                <label for="exampleEmail" class="col-sm-2 col-form-label"><b>Prescription</b></label>
                                <label for="exampleEmail" class="col-sm-1 col-form-label"><b>Units</b></label>
                                <label for="exampleEmail" class="col-sm-1 col-form-label"><b>Available</b></label>
                                <label for="exampleEmail" class="col-sm-1 col-form-label"><b>Cost</b></label>
                                <label for="exampleEmail" class="col-sm-2 col-form-label"><b>Total</b></label>
                                <label for="exampleEmail" class="col-sm-1 col-form-label"><b>*</b></label>
                            </div>
                            <?php $totmed = 0; foreach ($prescriptions as $one) { $totmed += $one['units']*$one['cost'];
                             ?>
                            <div class="row">
                                <label for="exampleEmail" class="col-sm-4 col-form-label"><?php echo $one['mname'];?></label>
                                <label for="exampleEmail" class="col-sm-2 col-form-label"><?php echo $one['prescription'];?></label>
                                <label for="exampleEmail" class="col-sm-1 col-form-label"><?php echo $one['units'];?></label>
                                <label for="exampleEmail" class="col-sm-1 col-form-label"><?php echo $one['qty'];?></label>
                                <label for="exampleEmail" class="col-sm-1 col-form-label"><?php echo $one['cost'];?></label>
                                <label for="exampleEmail" class="col-sm-2 col-form-label"><?php echo $one['units']*$one['cost'];?></label>
                                <label for="exampleEmail" class="col-sm-1 col-form-label"><a href="<?php echo base_url(); ?>queue/delete_medication/<?php echo $one['id'];?>/<?php echo $ticket_id;?>/<?php echo $mvtid;?>/<?php echo $is_direct;?>"><i class="fa fa-fw icon-danger"></i></a></label>
                            </div>
                        <?php } ?>
                            <hr>
                            <div class="row">
                                <label for="exampleEmail" class="col-sm-8 col-form-label"></label>
                            <label for="exampleEmail" class="col-sm-2 col-form-label"><b>Grandtotal</b></label>
                            <label for="exampleEmail" class="col-sm-2 col-form-label"><b><?php echo $totmed;?></b></label>
                            <hr>
                                    <div class="position-relative row form-group col-sm-12"><label for="exampleEmail" class="col-sm-3 col-form-label">Next Activity</label>
                                    <div class="col-sm-8">
                                        <select class="select form-control" name="activity" id="activity" class="form-control" required>
                                            <option value="">--Choose one</option>
                                            <option value="release">Release the patient</option>
                                            <option value="send">Send back to doctor</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="position-relative row form-check">
                                    <div class="col-sm-10 offset-sm-2">
                                        <button class="btn btn-success">COMPLETE</button>

                                    </div>
                                </div>
                        </form>
                    <?php } else{?>
                <form class="" method="post" action="<?php echo base_url(); ?>queue/save_direct_med">
                     <div class="row" style="margin-left: 20px;">
                        <div class="position-relative row form-group col-sm-12" id="medicine">
                                    <div class="col-sm-12 alert alert-warning"><p>Add the medicine to give. Prescription to be defined in next step.</p></div>

                                    <label for="exampleEmail" class="col-sm-3 col-form-label">Medicine:</label>
                                    <div class="col-sm-8">
                                        <select class="select form-control" style="width: 100%;" name="medicines[]" multiple>
                                                    <option value="">--Choose one</option>
                                                    <?php foreach ($medicine as $act) {
                                                            ?>
                                                            <option value="<?php echo $act['id']; ?>"><?php echo $act['name']; ?> (Cost: Ksh.<?php echo $act['cost']; ?>, Available: <?php echo $act['qty']; ?> )</option>
                                                        <?php 
                                                    } ?>
                                        </select>
                                    </div>
                                </div>
                            
                            <input type="hidden" name="ticket_id" value="<?php echo $ticket_id; ?>" required>
                            <input type="hidden" name="mvtid" value="<?php echo $mvtid; ?>" required>
                            <div class="position-relative row form-check">
                                    <div class="col-sm-10 offset-sm-2">
                                        <button class="btn btn-success">COMPLETE</button>

                                    </div>
                                </div>
                            </div>
                        </form>
                   <?php }
                }?>
            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>