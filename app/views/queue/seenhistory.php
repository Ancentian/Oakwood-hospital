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
                    <div class="card-header"><i class="header-icon lnr-license icon-gradient bg-plum-plate"> </i>SERVED
                        PATIENTS
                        <div class="btn-actions-pane-right">
                            <div class="nav">
                                <a data-toggle="tab" href="#ibp" class="btn-pill btn-wide active btn
                                                        btn-outline-alternate btn-sm">INCOMING</a>
                                <a data-toggle="tab" href="#obp"
                                   class="btn-pill btn-wide mr-1 ml-1  btn btn-outline-alternate btn-sm">OUTGOING</a>

                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="tab-content">
                            <div class="tab-pane active" id="ibp" role="tabpanel">
                                <table class="mb-0 table table-striped">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>P/No</th>
                                        <th>Name</th>
                                        <th>Sent From</th>
                                        <th>Activity</th>
                                        <th>Sent By</th>
                                        <th>Time</th>
                                        <th>Ticket Details</th>

                                    </tr>
                                    </thead>
                                    <tbody>

                                    <?php $i = 1;
                                    foreach ($incoming as $one) {
                                        ?>
                                        <tr>
                                            <th scope="row"><?php echo $i; ?></th>
                                            <td><?php echo $one['pid']; ?></td>
                                            <td><?php echo $one['pname']; ?></td>
                                            <td><?php echo $one['dname']; ?></td>
                                            <td><?php echo $one['wname']; ?></td>
                                            <td><?php echo $one['uname']; ?></td>
                                            <td><?php echo $one['created_at']; ?></td>
                                            <td>
                                                <a href="<?php echo base_url(); ?>queue/ticket_details/<?php echo $one['ticket_id'] . '/' . $one['mvtid']; ?>"><span
                                                            class="badge badge-success"><small>View</small></span></a>
                                            </td>

                                        </tr>
                                        <?php $i++;
                                    } ?>

                                    </tbody>
                                </table>
                            </div>
                            <div class="tab-pane" id="obp" role="tabpanel">
                                <table class="mb-0 table table-striped">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>P/No</th>
                                        <th>Name</th>
                                        <th>Sent To</th>
                                        <th>Activity</th>
                                        <th>Sent By</th>
                                        <th>Time</th>
                                        <th>Ticket Details</th>

                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php $i = 1;
                                    foreach ($outgoing as $one) {
                                        ?>
                                        <tr>
                                            <th scope="row"><?php echo $i; ?></th>
                                            <td><?php echo $one['pid']; ?></td>
                                            <td><?php echo $one['pname']; ?></td>
                                            <td><?php echo $one['dname']; ?></td>
                                            <td><?php echo $one['wname']; ?></td>
                                            <td><?php echo $one['uname']; ?></td>
                                            <td><?php echo $one['created_at']; ?></td>
                                            <td>
                                                <a href="<?php echo base_url(); ?>queue/ticket_details/<?php echo $one['ticket_id'] . '/' . $one['mvtid']; ?>"><span
                                                            class="badge badge-success"><small>View</small></span></a>
                                            </td>

                                            </td>
                                        </tr>
                                        <?php $i++;
                                    } ?>
                                    </tbody>
                                </table>
                            </div>

                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>