<div class="app-main__outer">
    <div class="app-main__inner">

        <div class="row">
            <div class="col-md-1"></div>
            <div class="col-md-10" style="padding-top: 20px;">
                <div class="main-card mb-3 card">
                    <div class="card-body"><h5 class="card-title">MEDICATIONS</h5>
                        <div class="col-sm-12 alert alert-info">
                            <?php if ($this->session->flashdata('success-msg')) { ?>
                                <div class="alert alert-success"><?php echo $this->session->flashdata('success-msg'); ?></div>
                            <?php } ?>
                            <?php if ($this->session->flashdata('error-msg')) { ?>
                                <div class="alert alert-danger"><?php echo $this->session->flashdata('error-msg'); ?></div>
                            <?php } ?>
                        <form action="<?php echo base_url();?>inpatient/save_medication" method="post">
                            <div class="row">
                                <input type="hidden" name="ticket_id" value="<?php echo $tickid;?>">
                                <div class="col-sm-12 row cost-item">
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
                                    <div class="col-sm-4">
                                        <input type="submit" value="COMPLETE" class="btn btn-success">&nbsp;
                                        <a href="<?php echo base_url();?>inpatient/services/<?php echo $tickid;?>" class="btn btn-danger" role="button">BACK</a>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <table class="mb-0 table table-striped">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Medicine</th>
                                <th>Prescription</th>
                                <th>Cost</th>
                                <th>Units</th>
                                <th>Total</th>
                                <th>*</th>
                            </tr>
                            </thead>
                            <tbody>

                            <?php $i = 1;$total = 0;
                            foreach ($meds as $one) {
                                $total += $one['units']*$one['cost'];
                                ?>
                                <tr>
                                    <th scope="row"><?php echo $i; ?></th>
                                    <td><?php echo $one['name']; ?></td>
                                    <td><?php echo $one['prescription']; ?></td>
                                    <td><?php echo $one['cost']; ?></td>
                                    <td><?php echo $one['units']; ?></td>
                                    <td><?php echo $one['units']*$one['cost']; ?></td>
                                    <td></td>
                                </tr>
                                <?php $i++;
                            } ?>

                            </tbody>
                            <tfoot>
                                <tr>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th>TOTAL</th>
                                    <th><?php echo $total;?></th>
                                    <td></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>