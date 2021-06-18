<?php 

$totincome = 0;
foreach($incomes as $one){
    $totincome += $one['amount'];
}

$totexp = 0;
foreach($expenses as $one){
    $totexp += $one['amount'];
}

if(sizeof($incomes) >0){
    $inc = sizeof($incomes);
}else{
    $inc = 1;
}

if(sizeof($expenses) >0){
    $exp = sizeof($expenses);
}else{
    $exp = 1;
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
                    
                    <div class="card-body">
        <div class="row">
            
               
            <div class="col-md-12">
                <!-- general form elements -->
                <div class="box box-primary">
                    <div class="box-header ptbnull">
                        <h5 class="box-title titlefix">BALANCE SHEET AS AT <?php echo date('Y-m-d');?> <a href="<?php echo base_url();?>admin/finance/print_bs" class="btn btn-warning">PRINT</a></h5>
                        <div class="box-tools pull-right">
                        </div><!-- /.box-tools -->
                    </div><!-- /.box-header -->
                    <div class="box-body">
                        <div class="row">
                            <div class="col-sm-6">
                                <h5 class="box-title titlefix">Assets</h5>
                                <?php $totass = 0; foreach($assets as $one){ $totass +=$one['amount'];  ?>
                                <div class="row">
                                    <div class="col-sm-7"><?php echo $one['account'];?></div>
                                    <div class="col-sm-5"><?php echo number_format($one['amount'],2,'.',',');?></div>
                                </div>
                                    
                                <?php } ?>
                                <div class="row">
                                    <div class="col-sm-7"><b>Total Assets</b></div>
                                    <div class="col-sm-5"><?php echo number_format($totass,2,'.',',');?></div>
                                </div>
                            </div>
                            
                            <div class="col-sm-6">
                                <h5 class="box-title titlefix">Liabilities</h5>
                                <?php $totli = 0; foreach($liabilities as $one){ $totli +=$one['amount'];  ?>
                                <div class="row">
                                    <div class="col-sm-7"><?php echo $one['account'];?></div>
                                    <div class="col-sm-5"><?php echo number_format($one['amount'],2,'.',',');?></div>
                                </div>
                                    
                                <?php } ?>
                                <div class="row">
                                    <div class="col-sm-7"><b>Total</b></div>
                                    <div class="col-sm-5"><?php echo number_format($totli,2,'.',',');?></div>
                                </div>
                                <hr>
                                <h5 class="box-title titlefix">Shareholders Equity</h5>
                                <?php $toteq = 0; foreach($equity as $one){ $totli +=$one['amount'];  ?>
                                <div class="row">
                                    <div class="col-sm-7"><?php echo $one['account'];?></div>
                                    <div class="col-sm-5"><?php echo number_format($one['amount'],2,'.',',');?></div>
                                </div>
                                    
                                <?php } ?>
                                <div class="row">
                                    <div class="col-sm-7"><b>Total Equity</b></div>
                                    <div class="col-sm-5"><?php echo number_format($toteq,2,'.',',');?></div>
                                </div>
                                <hr>
                                
                            </div>
                           
                        </div><!-- /.mail-box-messages -->
                        <div class="row">
                               <div class="col-sm-6">
                                    <div class="col-sm-7"><b>TOTALS</b></div>
                                    <div class="col-sm-5"><?php echo number_format($totass,2,'.',',');?></div>
                                </div>
                                 <div class="col-sm-6">
                                    <div class="col-sm-7"><b>TOTALS</b></div>
                                    <div class="col-sm-5"><?php echo number_format($toteq+$totli,2,'.',',');?></div>
                                </div>
                            </div>
                    </div><!-- /.box-body -->
                </div>
            </div><!--/.col (left) -->
            <!-- right column -->

        </div>
        </div>

                </div>
            </div>

        </div>
    </div>
<script>
    $(document).ready(function () {
        $('.detail_popover').popover({
            placement: 'right',
            trigger: 'hover',
            container: 'body',
            html: true,
            content: function () {
                return $(this).closest('td').find('.fee_detail_popover').html();
            }
        });
    });
</script>