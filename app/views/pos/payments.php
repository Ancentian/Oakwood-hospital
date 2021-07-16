<?php $todays = $_GET['todays'];
    $edate = $_GET['edate'];
    $sdate = $_GET['sdate'];

    $enddate = $edate;
    $startdate = $sdate;

    if ($todays) {
        $enddate = date('Y-m-d');
        $startdate = date('Y-m-d');
    }
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
                    <div class="card-header"><i class="header-icon lnr-license icon-gradient bg-plum-plate"> </i>PAYMENTS HISTORY
                    </div>
                    <div class="card-body">
                        <form method="get" action="<?php echo base_url();?>pos/payments">
                            <div class="row" style="margin-bottom: 10px">
                                <div class="col-sm-5">
                                    <input type="date" style="<?php if($startdate) echo 'color: red;';?>" name="sdate" class="form-control" value="<?php echo $startdate;?>">
                                </div>
                                <div class="col-sm-5">
                                    <input type="date" style="<?php if($enddate) echo 'color: red;';?>" name="edate" class="form-control" value="<?php echo $enddate;?>">
                                </div>
                                <div class="col-sm-2">
                                    <button class="btn btn-success">FILTER</button>
                                </div>
                            </div>
                        </form>
                        <table class="mb-0 table table-striped">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Patient Name</th>
                                <th>Amount</th>
                                <th>Mode</th>
                                <th>Date</th>
                                <th>*</th>
                            </tr>
                            </thead>
                            <tbody>

                            <?php $i = 1;$tot = 0;
                            foreach ($pmts as $one) {
                                // echo strtotime($edate)." ";echo strtotime($one['created_at'])."<br>";
                                if($todays == "yes"){if(date('Y-m-d',strtotime($one['created_at'])) == date('Y-m-d')){
                                    $tot += $one['amount']; 
                                ?>
                                <tr>
                                    <th scope="row"><?php echo $i; ?></th>
                                    <td><?php echo $one['name']." ".$one['lname']; ?></td>
                                    <td><?php echo $one['amount']; ?></td>
                                    <td><?php echo $one['mode']; ?></td>
                                    <td><?php echo date('Y-m-d H:i',strtotime($one['created_at']));?></td>                
                                    <td>
                                        <a href="<?php echo base_url(); ?>pos/printpmt/<?php echo $one['id']; ?>"><i class="fa fa-print icon-success" aria-hidden="true"></i></a>
                                        &nbsp;
                                        <a href="<?php echo base_url(); ?>pos/editpayments/<?php echo $one['id']; ?>"><i class="fa fa-fw icon-custom" aria-hidden="true"></i></a>
                                        &nbsp;
                                        <a href="<?php echo base_url(); ?>pos/deletepayments/<?php echo $one['id']; ?>"><i
                                                    class="fa fa-fw icon-danger"></i></a></td>
                                </tr>
                                <?php }
                            }elseif($sdate){
                                if(strtotime($one['created_at']) >= strtotime($sdate) && strtotime($one['created_at']) < strtotime($edate)+86400){
                                 $tot += $one['amount']; $mode = ""; foreach(json_decode($one['mode'],true) as $key){$mode .= $key.", ";}?>
                                <tr>
                                    <th scope="row"><?php echo $i; ?></th>
                                    <td><?php echo $one['name']." ".$one['lname']; ?></td>
                                    <td><?php echo $one['amount']; ?></td>
                                    <td><?php echo $mode; ?></td>
                                    <td><?php echo date('Y-m-d H:i',strtotime($one['created_at']));?></td>                
                                    <td>
                                        <a href="<?php echo base_url(); ?>pos/printpmt/<?php echo $one['id']; ?>"><i class="fa fa-print icon-success" aria-hidden="true"></i></a>
                                        &nbsp;
                                        <a href="<?php echo base_url(); ?>pos/editpayments/<?php echo $one['id']; ?>"><i class="fa fa-fw icon-custom" aria-hidden="true"></i></a>
                                        &nbsp;
                                        <a href="<?php echo base_url(); ?>pos/deletepayments/<?php echo $one['id']; ?>"><i
                                                    class="fa fa-fw icon-danger"></i></a></td>
                                </tr>
                            <?php } } else{
                             $tot += $one['amount']; $mode = ""; foreach(json_decode($one['mode'],true) as $key){$mode .= $key.", ";}?>
                                <tr>
                                    <th scope="row"><?php echo $i; ?></th>
                                    <td><?php echo $one['name']." ".$one['lname']; ?></td>
                                    <td><?php echo $one['amount']; ?></td>
                                    <td><?php echo $mode; ?></td>
                                    <td><?php echo date('Y-m-d H:i',strtotime($one['created_at']));?></td>                
                                    <td>
                                        <a href="<?php echo base_url(); ?>pos/printpmt/<?php echo $one['id']; ?>"><i class="fa fa-print icon-success" aria-hidden="true"></i></a>
                                        &nbsp;
                                        <a href="<?php echo base_url(); ?>pos/editpayments/<?php echo $one['id']; ?>"><i class="fa fa-fw icon-custom" aria-hidden="true"></i></a>
                                        &nbsp;
                                        <a href="<?php echo base_url(); ?>pos/deletepayments/<?php echo $one['id']; ?>"><i
                                                    class="fa fa-fw icon-danger"></i></a></td>
                                </tr>
                            <?php } $i++;} ?>

                            </tbody>
                             <tfoot>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <th><?php echo $tot;?></th>
                                    <th></th>
                                    <th></th>
                                    <td></td>
                                </tr>
                            </tfoot>
                        </table>

                    </div>

                </div>
            </div>

        </div>
    </div>