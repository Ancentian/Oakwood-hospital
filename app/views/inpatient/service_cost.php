<div class="app-main__outer">
    <div class="app-main__inner">

        <div class="row">
            <div class="col-md-1"></div>
            <div class="col-md-10" style="padding-top: 20px;">
                <div class="main-card mb-3 card">
                    <div class="card-body"><h5 class="card-title">ADD INPATIENT COSTS</h5>
                        <div class="col-sm-12 alert alert-info">
                            <?php if ($this->session->flashdata('success-msg')) { ?>
                                <div class="alert alert-success"><?php echo $this->session->flashdata('success-msg'); ?></div>
                            <?php } ?>
                            <?php if ($this->session->flashdata('error-msg')) { ?>
                                <div class="alert alert-danger"><?php echo $this->session->flashdata('error-msg'); ?></div>
                            <?php } ?>
                        <form action="<?php echo base_url();?>inpatient/save_cost" method="post">
                            <div class="row">
                                <input type="hidden" name="ticket_id" value="<?php echo $tickid;?>">
                                <div class="col-sm-12 row cost-item">
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control" name="service[]" placeholder="Service offered" required>
                                    </div>
                                    <div class="col-sm-4">
                                        <input type="number" class="form-control" name="cost[]" placeholder="Cost" required>
                                    </div>
                                    <div class="col-sm-1">
                                        <a role="button" id="add-item" class="btn btn-success">ADD</a>
                                    </div>
                                </div>
                            </div>
                            <div class="row" id="added-items"></div>
                            <input type="submit" value="COMPLETE" class="btn btn-success">&nbsp;
                            <a href="<?php echo base_url();?>inpatient/services/<?php echo $tickid;?>" class="btn btn-danger" role="button">BACK</a>
                        </form>
                    </div>
                    <div class="alert alert-warning">The charges displayed here are only for the Inpatient services. The patient might have other charges. Select individual tickests from the Patient's history to view their total due.</div>
                    <table class="mb-0 table table-striped">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Cost Name</th>
                                <th>Amount</th>
                                <th>Date</th>
                                <th>*</th>
                            </tr>
                            </thead>
                            <tbody>

                            <?php $i = 1;$total = 0;foreach ($costs as $one) {$total += $one['amount']; ?>
                                <tr>
                                    <th scope="row"><?php echo $i; ?></th>
                                    <td><?php echo $one['cost_name']; ?></td>
                                    <td><?php echo $one['amount']; ?></td>
                                    <td><?php echo $one['created_at']; ?></td>
                                    <td></td>
                                </tr>
                                <?php $i++;
                            } ?>

                            </tbody>
                            <tfoot>
                                <tr>
                                    <th></th>
                                    <th>TOTAL</th>
                                    <th><?php echo $total;?></th>
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $(document).on('click','#add-item',function() {
//                alert('clicked');
                var html = '<div class="col-sm-12 row cost-item"><div class="col-sm-6"><input type="text" class="form-control" name="service[]" placeholder="Service offered" required> </div><div class="col-sm-4"> <input type="number" class="form-control" name="cost[]" placeholder="Cost" required> </div> <a role="button"  class="btn btn-danger remove-item">REMOVE</a>  </div>';
                $('#added-items').append(html);
            });
        });

        $(document).ready(function() {
            $(document).on('click','.remove-item',function(e) {
                e.preventDefault();
                $(this).parent().remove();
            });
        });
    </script>