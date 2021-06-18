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
                    <!-- Horizontal Form -->
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title"></h3>
                        </div><!-- /.box-header -->
                        <form id="form1" action="<?php echo base_url() ?>admin/finance/pnl_display"  id="employeeform" name="employeeform" method="post" accept-charset="utf-8">
                            <div class="box-body">
                                <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">
                               
                            <div class="row">
                                <div class="form-group col-sm-6">
                                    <label for="exampleInputEmail1">Start Date</label> <small class="req">*</small>
                                    <input  name="sdate" type="date" class="form-control"  value="" required />
                                    <span class="text-danger"><?php echo form_error('sdate'); ?></span>
                                </div>
                                
                                 <div class="form-group col-sm-6">
                                    <label for="exampleInputEmail1">End Date</label> <small class="req">*</small>
                                    <input  name="edate" type="date" class="form-control"  value="" required />
                                    <span class="text-danger"><?php echo form_error('sdate'); ?></span>
                                </div>
                            </div>
                                
                            <div class="box-footer">
                                <button type="submit" class="btn btn-info pull-right">NEXT</button>
                            </div>
                                
                            </div><!-- /.box-body -->

                            
                        </form>
                    </div>

                </div><!--/.col (right) -->
                <!-- left column -->
           

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