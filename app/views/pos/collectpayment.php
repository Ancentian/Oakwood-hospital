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
                    <div class="card-header"><i class="header-icon lnr-license icon-gradient bg-plum-plate"> </i>COLLECT PAYMENTS
                        
                    </div>
                    <div class="card-body">
                        <table class="mb-0 table table-striped">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>P/No</th>
                                        <th>Name</th>
                                        <th>Phone</th>
                                        <th>Age</th>
                                        <th>Gender</th>
                                        <th>Due</th>
                                        <th>*</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    <?php $i = 1;
                                    foreach ($clientArr as $one) {
                                        $key = array_search($one['id'],array_column($dueArr, 'patient_id'));
                                        ?>
                                        <tr>
                                            <th scope="row"><?php echo $i; ?></th>
                                            <td><?php echo str_pad( $one['id'], 4, "0", STR_PAD_LEFT ); ?></td>
                                            <td><?php echo $one['name']; ?></td>
                                            <td><?php echo $one['phone']; ?></td>
                                            <td><?php echo(date('Y-m-d') - $one['dob']); ?></td>
                                            <td><?php echo $one['gender']; ?></td>
                                            <td style="color: <?php if($dueArr[$key]['due'] > 0){ echo 'red';}else{echo 'green';}?>"><?php echo abs($dueArr[$key]['due']); ?></td>
                                            
                                            <td>
                                                <a href="<?php echo base_url(); ?>pos/addpmt/<?php echo $one['id']; ?>"><i
                                                            class="fa fa-plus icon-custom" aria-hidden="true"></i></a>

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