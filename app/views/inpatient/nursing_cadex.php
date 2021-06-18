<style type="text/css">
    .inpatient-items{
        font-size: 22px;
        margin-bottom: 10px;
    }
</style>
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
                    <div class="card-header"><i class="header-icon lnr-license icon-gradient bg-plum-plate"> </i>NURSING CADEX
                    </div>
                    <div class="card-body">
                        <div class="col-sm-12 alert alert-info">
                            <form method="post" action="<?php echo base_url();?>inpatient/add_cadex">
                                <div class="row">
                                    <div class="col-sm-12">
                                    <textarea name="nursing_notes" class="form-control" required placeholder="Nursing Notes"></textarea>
                                </div>
                                <div class="col-sm-6">
                                    <input type="hidden" name="ticket_id" value="<?php echo $tickid;?>">
                                    <label>Date</label>
                                    <input type="datetime-local" name="created_at" class="form-control" required>
                                </div>
                                <div class="col-sm-6">
                                    <input type="submit" value="ADD NURSING CADEX" class="btn btn-success" style="margin-top: 30px;">
                                    &nbsp;
                                    <a href="<?php echo base_url();?>inpatient/services/<?php echo $tickid;?>" class="btn btn-danger" role="button" style="margin-top: 30px;">BACK</a>
                                </div>
                                </div>
                                
                            </form>
                        </div>
                            <table class="mb-0 table table-striped">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Date</th>
                                <th>Time</th>
                                <th>Nursing Notes</th>
                                <th>*</th>
                            </tr>
                            </thead>
                            <tbody>

                            <?php $i = 1;
                            foreach ($nursing_cadex as $one) {
                                $data = json_decode($one['operation_data'],true);
                                ?>
                                <tr>
                                    <th scope="row"><?php echo $i; ?></th>
                                    <td><?php echo date('d/m/Y',strtotime($data['created_at'])); ?></td>
                                    <td><?php echo date('H:i',strtotime($data['created_at'])); ?></td>
                                    <td><textarea class="form-control" disabled><?php echo $data['nursing_notes']; ?></textarea></td>
                                    <td></td>
                                    
                                </tr>
                                <?php $i++; } ?>

                            </tbody>
                        </table>
                    </div>

                </div>
            </div>

        </div>
    </div>