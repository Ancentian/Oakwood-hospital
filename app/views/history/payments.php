<?php 
    $url = "https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
    $url_components = parse_url($url);
    parse_str($url_components['query'], $params);

    $date = $params['date'];
    $sdate = $params['sdate'];
    $edate = $params['edate'];
?>

<div class="app-main__outer">
    <div class="app-main__inner">

        <div class="row">
            <div class="col-lg-12">
                <?php if ($this->session->flashdata('success-msg')) { ?>
                    <div class="alert alert-success"><?php echo $this->session->flashdata('success-msg'); ?></div>
                <?php } ?>
                <?php if ($this->session->flashdata('error-msg')) { ?>
                    <div class="alert alert-danger"><?php echo $this->session->flashdata('error-msg'); ?></div>
                <?php } ?>
                <div class="main-card mb-3 card">
                    <div class="card-header"><i class="header-icon lnr-license icon-gradient bg-plum-plate"> </i>FILTERS
                        <div class="btn-actions-pane-right">
                            <div class="nav">
                                <a data-toggle="tab" href="#date"
                                   class="btn-pill btn-wide active btn btn-outline-success btn-sm">SPECIFIC DATE</a>
                                <a data-toggle="tab" href="#range"
                                   class="btn-pill btn-wide mr-1 ml-1  btn btn-outline-success btn-sm">DATE RANGE</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="tab-content">
                        <div class="tab-pane active" id="date" role="tabpanel">
                            <form>
                                <div class="row">
                                    <div class="col-sm-6 form-group">
                                        <label>Date</label>
                                        <input type="date" name="date" <?php if($date != ""){?> value="<?php echo $date;?>" style="background-color: yellow;" <?php } ?> class="form-control" required>
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="submit" value="FILTER" class="btn btn-success" style="margin-top: 30px;"></div>
                                </div>
                            </form>
                        </div>
                        <div class="tab-pane" id="range" role="tabpanel">
                            <form>
                                <div class="row">
                                    <div class="col-sm-6 form-group">
                                        <label>Start Date</label>
                                        <input type="date" name="sdate" class="form-control" <?php if($sdate != ""){?> value="<?php echo $sdate;?>" style="background-color: yellow;" <?php } ?> >
                                    </div>
                                    <div class="col-sm-6 form-group">
                                        <label>End Date</label>
                                        <input type="date" name="edate" class="form-control" <?php if($edate != ""){?> value="<?php echo $edate;?>" style="background-color: yellow;" <?php } ?> >
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="submit" value="FILTER" class="btn btn-success" style="margin-top: 10px;"></div>
                                </div>
                            </form>
                        </div>
                    </div>
                    </div>
                </div>
                <div class="main-card mb-3 card">
                    <div class="card-header"><i class="header-icon lnr-license icon-gradient bg-plum-plate"> </i>PAYMENTS HISTORY
                        <div class="btn-actions-pane-right">
                            <div class="nav">
                                <a data-toggle="tab" href="#all"
                                   class="btn-pill btn-wide active btn btn-outline-alternate btn-sm">ALL</a>
                                <a data-toggle="tab" href="#cash"
                                   class="btn-pill btn-wide mr-1 ml-1  btn btn-outline-alternate btn-sm">CASH</a>
                                <a data-toggle="tab" href="#mpesa"
                                   class="btn-pill btn-wide btn btn-outline-alternate btn-sm">MPESA</a>&nbsp;
                                <a data-toggle="tab" href="#debitcard"
                                   class="btn-pill btn-wide btn btn-outline-alternate btn-sm">Credit/Debit Card</a>
                                <a data-toggle="tab" href="#insurance"
                                   class="btn-pill btn-wide mr-1 ml-1  btn btn-outline-alternate btn-sm">INSURANCE</a>

                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="tab-content">
                            <div class="tab-pane active" id="all" role="tabpanel">
                            <table class="mb-0 table table-striped">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Patient</th>
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

                                <?php $i = 1;$totpaid = 0;
                                foreach ($phistory as $one) {
                                    if($date != ""){
                                        if(date('Y-m-d',strtotime($date)) == date('Y-m-d',strtotime($one['created_at']))){
                                    $totpaid += $one['amount'];
                                    ?>
                                    <tr>
                                        <th scope="row"><?php echo $i; ?></th>
                                        <td><?php echo $one['pname']." ".$one['mname']." ".$one['lname'];?></td>
                                        <td><?php echo $one['amount']; ?></td>
                                        <td><?php echo $one['mode']; ?></td>
                                        <td><?php if ($one['mode'] == 'mpesa' || $one['mode'] == 'till') {
                                                echo $one['transaction_id'];
                                            } else { ?>
                                                --
                                            <?php } ?>
                                        </td>
                                        <td><?php if ($one['mode'] == 'mpesa' || $one['mode'] == 'till') {
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
                                            <a href="<?php echo base_url(); ?>payments/h_delete/<?php echo $one['id'];?>"><i
                                                            class="fa fa-fw icon-danger"></i></a>
                                        &nbsp;
                                            <a href="<?php echo base_url(); ?>payments/r_print/<?php echo $one['id'].'/'.$one['ticket_id']; ?>"
                                               target="popup"
                                               onclick="window.open('<?php echo base_url(); ?>payments/r_print/<?php echo $one['id'].'/'.$one['ticket_id']; ?>','popup','width=600,height=600'); return false;"
                                            ><i class="fa fa-fw icon-success" aria-hidden="true" title="Print"></i></a>
                                        </td>

                                    </tr>
                                    <?php $i++;
                                } }}?>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                </tbody>
                                <tfoot>
                                    <tr class="alert alert-danger">
                                    <th>#</th>
                                    <th>TOTAL</th>
                                    <th><?php echo $totpaid;?></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                </tr>
                                </tfoot>
                            </table>
                            </div>
                            <div class="tab-pane" id="cash" role="tabpanel">
                            <table class="mb-0 table table-striped">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Patient</th>
                                    <th>Amount</th>
                                    <th>Paid At</th>
                                    <th>*</th>
                                </tr>
                                </thead>
                                <tbody>

                                <?php $i = 1;$totpaid = 0;
                                foreach ($phistory as $one) {
                                    if($one['mode'] == 'cash') {
                                    $totpaid += $one['amount'];
                                    ?>
                                    <tr>
                                        <th scope="row"><?php echo $i; ?></th>
                                        <td><?php echo $one['pname']." ".$one['mname']." ".$one['lname'];?></td>
                                        <td><?php echo $one['amount']; ?></td>
                                        <td><?php echo date('d/m/Y H:i', strtotime($one['created_at'])); ?> </td>
                                        <td>
                                            <a href="<?php echo base_url(); ?>payments/h_delete/<?php echo $one['id'];?>"><i
                                                            class="fa fa-fw icon-danger"></i></a>
                                        &nbsp;
                                            <a href="<?php echo base_url(); ?>payments/r_print/<?php echo $one['id'].'/'.$one['ticket_id']; ?>"
                                               target="popup"
                                               onclick="window.open('<?php echo base_url(); ?>payments/r_print/<?php echo $one['id'].'/'.$one['ticket_id']; ?>','popup','width=600,height=600'); return false;"
                                            ><i class="fa fa-fw icon-success" aria-hidden="true" title="Print"></i></a>
                                        </td>

                                    </tr>
                                    <?php $i++;
                                } } ?>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                </tbody>
                                <tfoot>
                                    <tr class="alert alert-danger">
                                    <th>#</th>
                                    <th>TOTAL</th>
                                    <th><?php echo $totpaid;?>
                                    <th></th>
                                    <th></th>
                                </tr>
                                </tfoot>
                            </table>                                
                            </div>
                            <div class="tab-pane" id="mpesa" role="tabpanel">
                                 <table class="mb-0 table table-striped">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Patient</th>
                                    <th>Amount</th>
                                    <th>Transaction</th>
                                    <th>Phone No</th>
                                    <th>Paid At</th>
                                    <th>*</th>
                                </tr>
                                </thead>
                                <tbody>

                                <?php $i = 1;$totpaid = 0;
                                foreach ($phistory as $one) {
                                    if($one['mode'] == 'mpesa') {
                                    $totpaid += $one['amount'];
                                    ?>
                                    <tr>
                                        <th scope="row"><?php echo $i; ?></th>
                                        <td><?php echo $one['pname']." ".$one['mname']." ".$one['lname'];?></td>
                                        <td><?php echo $one['amount']; ?></td>
                                        <td><?php if ($one['mode'] == 'mpesa') {
                                                echo $one['transaction_id'];
                                            } else { ?>
                                                --
                                            <?php } ?>
                                        </td>
                                        <td><?php if ($one['mode'] == 'mpesa') {
                                                echo $one['phone_no'];
                                            } else { ?>
                                                --
                                            <?php } ?>
                                        </td>
                                        <td><?php echo date('d/m/Y H:i', strtotime($one['created_at'])); ?> </td>
                                        <td>
                                            <a href="<?php echo base_url(); ?>payments/h_delete/<?php echo $one['id'];?>"><i
                                                            class="fa fa-fw icon-danger"></i></a>
                                        &nbsp;
                                            <a href="<?php echo base_url(); ?>payments/r_print/<?php echo $one['id'].'/'.$one['ticket_id']; ?>"
                                               target="popup"
                                               onclick="window.open('<?php echo base_url(); ?>payments/r_print/<?php echo $one['id'].'/'.$one['ticket_id']; ?>','popup','width=600,height=600'); return false;"
                                            ><i class="fa fa-fw icon-success" aria-hidden="true" title="Print"></i></a>
                                        </td>

                                    </tr>
                                    <?php $i++;
                                } } ?>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    
                                </tr>
                                </tbody>
                                <tfoot>
                                    <tr class="alert alert-danger">
                                    <th>#</th>
                                    <th>TOTAL</th>
                                    <th><?php echo $totpaid;?></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    
                                </tr>
                                </tfoot>
                            </table>                                
                            </div>
                            <div class="tab-pane" id="debitcard" role="tabpanel">
                            <table class="mb-0 table table-striped">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Patient</th>
                                    <th>Amount</th>
                                    <th>Card No.</th>
                                    <th>Phone No</th>
                                    <th>Paid At</th>
                                    <th>*</th>
                                </tr>
                                </thead>
                                <tbody>

                                <?php $i = 1;$totpaid = 0;
                                foreach ($phistory as $one) {
                                    if($one['mode'] == 'debit/credit card') {
                                    $totpaid += $one['amount'];
                                    ?>
                                    <tr>
                                        <th scope="row"><?php echo $i; ?></th>
                                        <td><?php echo $one['pname']." ".$one['mname']." ".$one['lname'];?></td>
                                        <td><?php echo $one['amount']; ?></td>
                                        <td><?php if ($one['mode'] == 'debit/credit card') {
                                                echo $one['transaction_id'];
                                            } else { ?>
                                                --
                                            <?php } ?>
                                        </td>
                                        <td><?php if ($one['mode'] == 'debit/credit card') {
                                                echo $one['phone_no'];
                                            } else { ?>
                                                --
                                            <?php } ?>
                                        </td>
                                        <td><?php echo date('d/m/Y H:i', strtotime($one['created_at'])); ?> </td>
                                        <td>
                                            <a href="<?php echo base_url(); ?>payments/h_delete/<?php echo $one['id'];?>"><i
                                                            class="fa fa-fw icon-danger"></i></a>
                                        &nbsp;
                                            <a href="<?php echo base_url(); ?>payments/r_print/<?php echo $one['id'].'/'.$one['ticket_id']; ?>"
                                               target="popup"
                                               onclick="window.open('<?php echo base_url(); ?>payments/r_print/<?php echo $one['id'].'/'.$one['ticket_id']; ?>','popup','width=600,height=600'); return false;"
                                            ><i class="fa fa-fw icon-success" aria-hidden="true" title="Print"></i></a>
                                        </td>

                                    </tr>
                                    <?php $i++;
                                } } ?>
                                 <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    
                                </tr>
                                </tbody>
                                <tfoot>
                                    <tr class="alert alert-danger">
                                    <th>#</th>
                                    <th>TOTAL</th>
                                    <th><?php echo $totpaid;?></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    
                                </tr>
                                </tfoot>
                            </table>                                
                            </div>
                            <div class="tab-pane" id="insurance" role="tabpanel">
                                 <table class="mb-0 table table-striped">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Patient</th>
                                    <th>Amount</th>
                                    <th>Company</th>
                                    <th>Card</th>
                                    <th>Code</th>
                                    <th>Paid At</th>
                                    <th>*</th>
                                </tr>
                                </thead>
                                <tbody>

                                <?php $i = 1;$totpaid = 0;
                                foreach ($phistory as $one) {
                                    if($one['mode'] == 'insurance') {
                                    $totpaid += $one['amount'];
                                    ?>
                                    <tr>
                                        <th scope="row"><?php echo $i; ?></th>
                                        <td><?php echo $one['pname']." ".$one['mname']." ".$one['lname'];?></td>
                                        <td><?php echo $one['amount']; ?></td>
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
                                            <a href="<?php echo base_url(); ?>payments/h_delete/<?php echo $one['id'];?>"><i
                                                            class="fa fa-fw icon-danger"></i></a>
                                        &nbsp;
                                            <a href="<?php echo base_url(); ?>payments/r_print/<?php echo $one['id'].'/'.$one['ticket_id']; ?>"
                                               target="popup"
                                               onclick="window.open('<?php echo base_url(); ?>payments/r_print/<?php echo $one['id'].'/'.$one['ticket_id']; ?>','popup','width=600,height=600'); return false;"
                                            ><i class="fa fa-fw icon-success" aria-hidden="true" title="Print"></i></a>
                                        </td>

                                    </tr>
                                    <?php $i++;
                                } } ?>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    
                                </tr>
                                </tbody>
                                <tfoot>
                                    <tr class="alert alert-danger">
                                    <th>#</th>
                                    <th>TOTAL</th>
                                    <th><?php echo $totpaid;?></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    
                                </tr>
                                </tfoot>
                            </table>
                                
                            </div>

                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>