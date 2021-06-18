<?php
$totlab = 0;
$totrad = 0;
$totmed = 0;
$totpaid = 0;
$totmisc = 0;

foreach ($miscdetails as $key) {
    $totmisc += $key['amount'];
}
?>
<div class="app-main__outer">
    <div class="app-main__inner">

        <div class="row">
            <div class="col-md-1"></div>
            <div class="col-md-10" style="padding-top: 20px;">
                <div class="main-card mb-3 card">
                    <?php if ($this->session->flashdata('success-msg')) { ?>
                        <div class="alert alert-success"><?php echo $this->session->flashdata('success-msg'); ?></div>
                    <?php } ?>
                    <?php if ($this->session->flashdata('error-msg')) { ?>
                        <div class="alert alert-danger"><?php echo $this->session->flashdata('error-msg'); ?></div>
                    <?php } ?>
                    <div class="card-body">
                        <div class="card-body"><h5 class="card-title">1) LABTESTS DETAILS</h5>
                            <hr>
                            <?php
                            if (sizeof($labdetails) > 0) {
                                ?>
                                <div class="row alert alert-info">
                                    <div class="position-relative row form-group col-sm-6"><label for="exampleEmail"                                                                                                  class="col-sm-5 col-form-label"><b>Status:</b></label>
                                        <label for="exampleEmail"
                                               class="col-sm-7 col-form-label"><?php if ($labdetails[0]['labstatus'] == "seen") { ?>
                                                <span class="badge badge-success">seen</span>
                                            <?php } else { ?><span class="badge badge-danger">pending</span> <?php } ?>
                                        </label>
                                    </div>

                                    <div class="position-relative row form-group col-sm-6"><label for="exampleEmail"                                                                                                  class="col-sm-5 col-form-label"><b>Results
                                                By:</b></label>
                                        <label for="exampleEmail"
                                               class="col-sm-7 col-form-label"><?php if ($labdetails[0]['labstatus'] == "seen") {
                                                echo $labdetails[0]['tests_by']; ?>

                                            <?php } else { ?><span class="badge badge-danger">In Queue</span> <?php } ?>
                                        </label>
                                    </div>

                                    <div class="position-relative row form-group col-sm-6"><label for="exampleEmail"                                                                                                  class="col-sm-5 col-form-label"><b>Requested
                                                By:</b></label>
                                        <label for="exampleEmail"
                                               class="col-sm-7 col-form-label"><?php echo $labdetails[0]['requested_by']; ?></label>
                                    </div>


                                </div>
                                <div class="row">
                                    <div class="position-relative row form-group col-sm-12">
                                        <div class="col-sm-2"></div>
                                        <label for="exampleEmail" class="col-sm-3 col-form-label"><b>Test</b></label>
                                        <label for="exampleEmail" class="col-sm-7 col-form-label"><b>Cost(@)</b></label>

                                    </div>

                                </div>

                                <?php
                                foreach ($labdetails as $key) {
                                    $totlab += $key['cost'];
                                    ?>
                                    <div class="row">
                                        <div class="position-relative row form-group col-sm-12">
                                            <div class="col-sm-2"></div>
                                            <label for="exampleEmail"
                                                   class="col-sm-3 col-form-label"><?php echo $key['test_name']; ?></label>
                                            <label for="exampleEmail"
                                                   class="col-sm-3 col-form-label"><?php echo $key['cost']; ?></label>

                                        </div>
                                    </div>

                                <?php } ?>
                                <div class="row">
                                    <div class="position-relative row form-group col-sm-12">
                                        <div class="col-sm-2"></div>
                                        <label for="exampleEmail" class="col-sm-3 col-form-label"><b>Total</b></label>
                                        <label for="exampleEmail"
                                               class="col-sm-7 col-form-label"><b>Ksh. <?php echo $totlab; ?></b></label>

                                    </div>

                                </div>
                            <?php } else {
                                ?>
                                <div class="col-sm-12 alert alert-danger">No lab tests were found for this ticket</div>
                            <?php } ?>


                        </div>

                        <div class="card-body"><h5 class="card-title">2) RADIOLOGY DETAILS</h5>
                            <hr>

                            <?php
                            if (sizeof($radiologydetails) > 0) {
                                ?>
                                <div class="row alert alert-info">
                                    <div class="position-relative row form-group col-sm-6"><label for="exampleEmail"                                                                                                  class="col-sm-5 col-form-label"><b>Status:</b></label>
                                        <label for="exampleEmail"
                                               class="col-sm-7 col-form-label"><?php if ($radiologydetails[0]['labstatus'] == "seen") { ?>
                                                <span class="badge badge-success">seen</span>
                                            <?php } else { ?><span class="badge badge-danger">pending</span> <?php } ?>
                                        </label>
                                    </div>

                                    <div class="position-relative row form-group col-sm-6"><label for="exampleEmail"                                                                                                  class="col-sm-5 col-form-label"><b>Results
                                                By:</b></label>
                                        <label for="exampleEmail"
                                               class="col-sm-7 col-form-label"><?php if ($radiologydetails[0]['labstatus'] == "seen") {
                                                echo $radiologydetails[0]['tests_by']; ?>

                                            <?php } else { ?><span class="badge badge-danger">In Queue</span> <?php } ?>
                                        </label>
                                    </div>

                                    <div class="position-relative row form-group col-sm-6"><label for="exampleEmail"                                                                                                  class="col-sm-5 col-form-label"><b>Requested
                                                By:</b></label>
                                        <label for="exampleEmail"
                                               class="col-sm-7 col-form-label"><?php echo $radiologydetails[0]['requested_by']; ?></label>
                                    </div>


                                </div>
                                <div class="row">
                                    <div class="position-relative row form-group col-sm-12">
                                        <div class="col-sm-2"></div>
                                        <label for="exampleEmail" class="col-sm-3 col-form-label"><b>Radiology Test</b></label>
                                        <label for="exampleEmail" class="col-sm-4 col-form-label"><b>Cost</b></label>
                                    </div>

                                </div>

                                <?php
                                foreach ($radiologydetails as $key) {
                                    $totrad += $key['cost'];
                                    ?>
                                    <div class="row">
                                        <div class="position-relative row form-group col-sm-12">
                                            <div class="col-sm-2"></div>
                                            <label for="exampleEmail"
                                                   class="col-sm-3 col-form-label"><?php echo $key['test_name']; ?></label>
                                            <label for="exampleEmail"
                                                   class="col-sm-3 col-form-label"><?php echo $key['cost']; ?></label>
                                        </div>
                                    </div>
                                <?php } ?>
                                <div class="row">
                                    <div class="position-relative row form-group col-sm-12">
                                        <div class="col-sm-2"></div>
                                        <label for="exampleEmail" class="col-sm-3 col-form-label"><b>Total</b></label>
                                        <label for="exampleEmail"
                                               class="col-sm-4 col-form-label"><b>Ksh. <?php echo $totrad; ?></b></label>
                                    </div>

                                </div>
                            <?php } else {
                                ?>
                                <div class="col-sm-12 alert alert-danger">No radiology screening were found for this
                                    ticket
                                </div>
                            <?php } ?>


                        </div>


                        <div class="card-body"><h5 class="card-title">3) PRESCRIPTION DETAILS</h5>
                            <hr>
                            <?php if (sizeof($medicationdetails) > 0) { ?>
                                <div class="row">
                                    <div class="position-relative row form-group col-sm-12"><label for="exampleEmail"                                                                                                   class="col-sm-3 col-form-label"><b>Medicine</b></label>
                                        <label for="exampleEmail" class="col-sm-3 col-form-label"><b>Units</b></label>
                                        <label for="exampleEmail" class="col-sm-3 col-form-label"><b>Cost</b></label>
                                        <label for="exampleEmail" class="col-sm-3 col-form-label"><b>Total</b></label>
                                    </div>

                                </div>

                                <?php
                                foreach ($medicationdetails as $key) {
                                    $totmed += ($key['units'] * $key['cost']);
                                    ?>
                                    <div class="row">
                                        <div class="position-relative row form-group col-sm-12"><label
                                                    for="exampleEmail"
                                                    class="col-sm-3 col-form-label"><?php echo $key['mname']; ?></label>
                                            <label for="exampleEmail"
                                                   class="col-sm-3 col-form-label"><?php echo $key['units']; ?></label>
                                            <label for="exampleEmail"
                                                   class="col-sm-3 col-form-label"><?php echo $key['cost']; ?></label>
                                            <label for="exampleEmail"
                                                   class="col-sm-3 col-form-label"><?php echo $key['units'] * $key['cost']; ?></label>
                                        </div>
                                    </div>
                                <?php } ?>
                                <div class="row">
                                    <div class="position-relative row form-group col-sm-12">
                                        <div class="col-sm-3"></div>
                                        <label for="exampleEmail" class="col-sm-3 col-form-label"><b>Total</b></label>
                                        <label for="exampleEmail"
                                               class="col-sm-3 col-form-label"><b>Ksh. <?php echo $totmed; ?></b></label>
                                    </div>

                                </div>
                            <?php } else { ?>
                                <div class="col-sm-12 alert alert-danger">No prescription for this patient on this
                                    ticket
                                </div>
                            <?php } ?>
                        </div>

                        <div class="card-body"><h5 class="card-title">4) PAYMENT DETAILS</h5>
                            <hr>
                            <table class="mb-0 table table-striped">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Amount</th>
                                    <th>Mode</th>
                                    <th>Transaction</th>
                                    <th>Phone No</th>
                                    <th>Company</th>
                                    <th>Card</th>
                                    <th>Code</th>
                                    <th>Paid At</th>
                                    <th>*</th>
                                </tr>
                                </thead>
                                <tbody>

                                <?php $i = 1;
                                foreach ($phistory as $one) {
                                    $totpaid += $one['amount'];
                                    ?>
                                    <tr>
                                        <th scope="row"><?php echo $i; ?></th>
                                        <td><?php echo $one['amount']; ?></td>
                                        <td><?php echo $one['mode']; ?></td>
                                        <td><?php if ($one['mode'] == 'mpesa' || $one['mode'] == 'till') {
                                                echo $one['transaction_id'];
                                            } else { ?>
                                                --
                                            <?php } ?>
                                        </td>
                                        <td><?php if ($one['mode'] == 'mpesa'  || $one['mode'] == 'till') {
                                                echo $one['phone_no'];
                                            } else { ?>
                                                --
                                            <?php } ?>
                                        </td>
                                        <td><?php if ($one['mode'] == 'insurance') {
                                                echo $one['insurance_company'];
                                            } else { ?>
                                                --
                                            <?php } ?>
                                        </td>
                                        <td><?php if ($one['mode'] == 'insurance') {
                                                echo $one['card_no'];
                                            } else { ?>
                                                --
                                            <?php } ?>
                                        </td>
                                        <td><?php if ($one['mode'] == 'insurance') {
                                                echo $one['confirmation_code'];
                                            } else { ?>
                                                --
                                            <?php } ?>
                                        </td>
                                        <td><?php echo date('d/m/Y H:i', strtotime($one['created_at'])); ?> </td>
                                        <td>
                                            <?php if($this->session->userdata('user_aob')->role == 'admin'){?>
                                            <a href="<?php echo base_url(); ?>payments/delete/<?php echo $one['id'].'/'.$ticket_id; ?>"><i class="fa fa-fw icon-danger"></i></a><?php } ?>
                                        &nbsp;
                                            <a href="<?php echo base_url(); ?>payments/r_print/<?php echo $one['id'].'/'.$ticket_id; ?>"
                                               target="popup"
                                               onclick="window.open('<?php echo base_url(); ?>payments/r_print/<?php echo $one['id'].'/'.$ticket_id; ?>','popup','width=600,height=600'); return false;"
                                            ><i class="fa fa-fw icon-success" aria-hidden="true" title="Print"></i></a>
                                        </td>

                                    </tr>
                                    <?php $i++;
                                } ?>

                                </tbody>
                            </table>

                        </div>


                        <div class="card-body">
                            <div class="row">
                                <div class="position-relative row form-group col-sm-12"><label for="exampleEmail"                                                                                               class="col-sm-2 col-form-label"><b>Total
                                            Billed: </b></label>
                                    <label for="exampleEmail" class="col-sm-2 col-form-label"><span
                                                class="badge badge-info">Ksh. <?php echo $totmed + $totrad + $totlab + $totcons + $totrsb['rsb'] + $totmisc; ?></span></label>
                                    <label for="exampleEmail" class="col-sm-2 col-form-label"><b>Total
                                            Paid: </b></label>
                                    <label for="exampleEmail" class="col-sm-2 col-form-label"><span
                                                class="badge badge-success">Ksh. <?php echo $totpaid; ?></span></label>
                                    <label for="exampleEmail" class="col-sm-2 col-form-label"><b>Total Due: </b></label>
                                    <label for="exampleEmail" class="col-sm-2 col-form-label"><span
                                                class="badge badge-danger">Ksh. <?php echo $totmed + $totrad + $totlab + $totcons + $totrsb['rsb'] - $totpaid + $totmisc; ?></span></label>
                                </div>
                            </div>
                            <div class="row alert alert-success">
                                <a href="<?php echo base_url(); ?>payments/i_print<?php echo '/'.$ticket_id; ?>"
                                   target="popup"
                                   class="btn btn-warning"
                                   onclick="window.open('<?php echo base_url(); ?>payments/i_print<?php echo '/'.$ticket_id; ?>','popup','width=600,height=600'); return false;"
                                >PRINT INVOICE</a>
                            </div>
                            <hr>
                            <div class="col-sm-12">
                                <div class="row alert alert-info">Add New Payment</div>
                                <form class="" method="post" action="<?php echo base_url(); ?>payments/add">
                                    <div class="row">

                                        <div class="position-relative row form-group col-sm-6"><label for="exampleEmail"                                                                                                      class="col-sm-4 col-form-label">Mode</label>
                                            <div class="col-sm-8">
                                                <select class="select form-control" class="form-control" id="pmt-mode" required name="mode">
                                                    <option value="">--Choose</option>
                                                    <!-- <option value="mpesa">Mpesa</option> -->
                                                    <option value="till">Till</option>
                                                    <option value="insurance">Insurance</option>
                                                    <option value="cash">Cash</option>
                                                </select>
                                                <input type="hidden" name="ticket_id" value="<?php echo $ticket_id;?>" required>
                                            </div>
                                        </div>
                                        <div class="position-relative row form-group col-sm-6"><label for="exampleEmail"                                                                                                      class="col-sm-4 col-form-label">Amount</label>
                                            <div class="col-sm-8"><input name="amount" id="exampleEmail" placeholder="Amount"
                                                                         type="number" class="form-control" required></div>
                                        </div>
                                        <div class="position-relative row form-group col-sm-12" id="mpesa-pmt"><div class="col-sm-6"><input name="phone_no" id="exampleEmail" placeholder="Phone no"
                                                                         type="text" class="form-control"></div>
                                            <div class="col-sm-6"><input name="transaction_id" id="exampleEmail" placeholder="Transaction ID"
                                                                         type="text" class="form-control"></div>

                                        </div>
                                        <div class="position-relative row form-group col-sm-12" id="insurance-pmt"><div class="col-sm-4"><input name="insurance_company" id="exampleEmail" placeholder="Company"
                                                                         type="text" class="form-control"></div>
                                            <div class="col-sm-4"><input name="card_no" id="exampleEmail" placeholder="Card No"
                                                                         type="text" class="form-control"></div>
                                            <div class="col-sm-4"><input name="confirmation_code" id="exampleEmail" placeholder="Code"
                                                                         type="text" class="form-control"></div>
                                        </div>
                                        <input type="submit" value="ADD PAYMENT" class="btn btn-success">
                                    </div>
                                </form>
                            </div>
                        </div>


                    </div>
                </div>
            </div>
        </div>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
        <script type="text/javascript">
            $('#insurance-pmt').hide();
            $('#mpesa-pmt').hide();

            $('#pmt-mode').on('change', function () {
                var activity = this.value;
                // alert(activity);
                switch (activity) {
                    case 'mpesa' :
                        $('#insurance-pmt').hide();
                        $('#mpesa-pmt').show();
                        break;
                    case 'till' :
                        $('#insurance-pmt').hide();
                        $('#mpesa-pmt').show();
                        break;
                    case 'insurance' :
                        $('#insurance-pmt').show();
                        $('#mpesa-pmt').hide();
                        break;
                    default :
                        $('#insurance-pmt').hide();
                        $('#mpesa-pmt').hide();
                }


            });
        </script>