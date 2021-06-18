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
            
                <div class="col-md-4">
                    <!-- Horizontal Form -->
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h5 class="box-title"></h5>
                        </div><!-- /.box-header -->
                        <form id="form1" action="<?php echo base_url() ?>admin/finance/pnl"  id="employeeform" name="employeeform" method="post" accept-charset="utf-8">
                            <div class="box-body">
                                <?php if ($this->session->flashdata('msg')) { ?>
                                    <?php echo $this->session->flashdata('msg') ?>
                                <?php } ?>
                                <?php
                                if (isset($error_message)) {
                                    echo "<div class='alert alert-danger'>" . $error_message . "</div>";
                                }
                                ?>
                                <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">
                               

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Start Date</label> <small class="req">*</small>
                                    <input  name="sdate" type="date" style="<?php if($sdate){ echo 'background-color: yellow;'; }?>" value="<?php if($sdate){ echo $sdate;}?>" class="form-control"  value="" disabled />
                                    <span class="text-danger"><?php echo form_error('sdate'); ?></span>
                                </div>
                                
                                 <div class="form-group">
                                    <label for="exampleInputEmail1">End Date</label> <small class="req">*</small>
                                    <input  name="edate" type="date" style="<?php if($edate){ echo 'background-color: yellow;'; }?>" value="<?php if($edate){ echo $edate;}?>" class="form-control"  value="" disabled />
                                    <span class="text-danger"><?php echo form_error('sdate'); ?></span>
                                </div>
                                
                                <a href="<?php echo base_url();?>admin/finance/print_pnl/<?php echo $sdate;?>/<?php echo $edate;?>" class="btn btn-warning">PRINT</a>

                            </div><!-- /.box-body -->

                            
                        </form>
                    </div>

                </div><!--/.col (right) -->
                <!-- left column -->
           
            <div class="col-md-8">
                <!-- general form elements -->
                <div class="box box-primary">
                    <div class="box-header ptbnull">
                        <h5 class="box-title titlefix">P & L</h5>
                        <div class="box-tools pull-right">
                        </div><!-- /.box-tools -->
                    </div><!-- /.box-header -->
                    <div class="box-body">
                        <div class="download_label">P & L</div>
                        <div class="mailbox-messages table-responsive">
                            <table class="table table-striped table-bordered table-hover example">
                                <thead>
                                    <tr>
                                        <th>Type</th>
                                        <th>Accounts</th>
                                        <th>Amount</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th rowspan="<?php echo $inc+1;?>">Income</th>
                                        <td><?php echo $incomes[0]['account'];?></td>
                                        <td><?php echo number_format($incomes[0]['amount'],2,'.',',');?></td>
                                    </tr>
                                    <?php for($i=1;$i<sizeof($incomes);$i++){$one = $incomes[$i];
                                        
                                    ?>
                                    <tr>
                                        <td><?php echo $incomes[$i]['account'];?></td>
                                        <td><?php echo number_format($incomes[$i]['amount'],2,'.',',');?></td>
                                    </tr>
                                    <?php } ?>
                                    <tr>
                                        <th>TOTAL</th>
                                        <th><?php echo number_format($totincome,2,'.',',');?></th>
                                    </tr>
                                    <tr>
                                        <th rowspan="<?php echo $exp+1;?>">Expense</th>
                                        <td><?php echo $expenses[0]['account'];?></td>
                                        <td><?php echo number_format($expenses[0]['amount'],2,'.',',');?></td>
                                    </tr>
                                    <?php for($i=1;$i<sizeof($expenses);$i++){$one = $expenses[$i];
                                        
                                    ?>
                                    <tr>
                                        <td><?php echo $expenses[$i]['account'];?></td>
                                        <td><?php echo number_format($expenses[$i]['amount'],2,'.',',');?></td>
                                    </tr>
                                    <?php } ?>
                                    <tr>
                                        <th>TOTAL</th>
                                        <th><?php echo number_format($totexp,2,'.',',');?></th>
                                    </tr>
                                     <tr>
                                        <th>NET INCOME</th>
                                        <td></td>
                                        <th><?php echo number_format($totincome-$totexp,2,'.',',');?></th>
                                    </tr>
                                </tbody>
                            </table><!-- /.table -->



                        </div><!-- /.mail-box-messages -->
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