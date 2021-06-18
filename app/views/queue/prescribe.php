<?php $userdata = $this->session->userdata('user_aob'); ?>
<div class="app-main__outer">
    <div class="app-main__inner">

        <div class="row">
            <div class="col-md-1"></div>
            <div class="col-md-10" style="padding-top: 20px;">
                <div class="main-card mb-3 card">
                    <div class="card-body"><h5 class="card-title">PRESCRIPTION DETAILS</h5>
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
                              action="<?php echo base_url(); ?>queue/add_prescription/<?php echo $ticket_id; ?>/<?php echo $mvtid; ?>/<?php echo $admit; ?>">
                            <div class="row">
                                <div class="position-relative row form-group col-sm-12">
                                    <p style="padding-left: 25px;">Please fill in the prescription details, taking to
                                        account the available quantities!</p>
                                </div>

                                <?php foreach ($medicine as $one) { ?>
                                    <div class="position-relative row form-group col-sm-12">
                                        <div class="col-sm-4"><textarea placeholder="" type="text" class="form-control" disabled><?php echo $one['name']; ?></textarea></div>
                                        <div class="col-sm-3"><input placeholder="" type="text"
                                                                     value="Available qty: <?php echo $one['qty']; ?>"
                                                                     class="form-control" disabled></div>
                                        <div class="col-sm-3"><input name="presc_<?php echo $one['id']; ?>"
                                                                     placeholder="Prescription eg 1x3." type="text"
                                                                     class="form-control" required></div>
                                        <div class="col-sm-2"><input name="units_<?php echo $one['id']; ?>"
                                                                     placeholder="Units." type="number"
                                                                     max="<?php echo $one['qty']; ?>"
                                                                     class="form-control" required></div>
                                    </div>

                                <?php } ?>

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