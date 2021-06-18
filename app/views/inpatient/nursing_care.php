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
                    <div class="card-header"><i class="header-icon lnr-license icon-gradient bg-plum-plate"> </i>NURSING CARE PLAN
                    </div>
                    <div class="card-body">
                        <div class="col-sm-12 alert alert-info">
                            <form method="post" action="<?php echo base_url();?>inpatient/add_care">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <textarea name="assessment" class="form-control" required placeholder="Assessment"></textarea>
                                    </div>
                                    <div class="col-sm-6">
                                        <textarea name="nursing_diagnosis" class="form-control" required placeholder="Nursing Diagnosis"></textarea>
                                    </div>
                                    <div class="col-sm-6">
                                        <textarea name="outcome_criteria" class="form-control" required placeholder="Goal and Outcome Criteria"></textarea>
                                    </div>
                                    <div class="col-sm-6">
                                        <textarea name="nursing_intervention" class="form-control" required placeholder="Nursing Plane of Action"></textarea>
                                    </div>
                                    <div class="col-sm-6">
                                        <textarea name="scientific_rationale" class="form-control" required placeholder="Scientific Rationale"></textarea>
                                    </div>
                                    <div class="col-sm-6">
                                        <textarea name="implementation" class="form-control" required placeholder="Implementation"></textarea>
                                    </div>
                                    <div class="col-sm-6">
                                        <textarea name="evaluation" class="form-control" required placeholder="Evaluation"></textarea>
                                    </div>
                                <div class="col-sm-6">
                                    <input type="hidden" name="ticket_id" value="<?php echo $tickid;?>">
                                    <label>Date</label>
                                    <input type="datetime-local" name="created_at" class="form-control" required>
                                </div>
                                <div class="col-sm-6">
                                    <input type="submit" value="ADD NURSING CADE PLAN" class="btn btn-success">&nbsp;
                                    <a href="<?php echo base_url();?>inpatient/services/<?php echo $tickid;?>" class="btn btn-danger" role="button">BACK</a>
                                </div>
                                </div>
                                
                            </form>
                        </div>
                            <table class="mb-0 table table-striped">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Date</th>
                                <th>Assessment</th>
                                <th>Nursing Diagnosis</th>
                                <th>Goal/outcome Criteria</th>
                                <th>Nursing Intervention</th>
                                <th>Scientific Rationale</th>
                                <th>Implementation</th>
                                <th>Evaluation</th>
                                <th>*</th>
                            </tr>
                            </thead>
                            <tbody>

                            <?php $i = 1;
                            foreach ($nursing_care as $one) {
                                $data = json_decode($one['operation_data'],true);
                                ?>
                                <tr>
                                    <th scope="row"><?php echo $i; ?></th>
                                    <td><?php echo date('d/m/Y H:i',strtotime($data['created_at'])); ?></td>
                                    <td><textarea class="form-control" disabled><?php echo $data['assessment']; ?></textarea></td>
                                    <td><textarea class="form-control" disabled><?php echo $data['nursing_diagnosis']; ?></textarea></td>
                                    <td><textarea class="form-control" disabled><?php echo $data['outcome_criteria']; ?></textarea></td>
                                    <td><textarea class="form-control" disabled><?php echo $data['nursing_intervention']; ?></textarea></td>
                                    <td><textarea class="form-control" disabled><?php echo $data['scientific_rationale']; ?></textarea></td>
                                    <td><textarea class="form-control" disabled><?php echo $data['implementation']; ?></textarea></td>
                                    <td><textarea class="form-control" disabled><?php echo $data['evaluation']; ?></textarea></td>
                                    <td></td>
                                    
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