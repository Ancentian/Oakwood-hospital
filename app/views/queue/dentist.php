<div class="app-main__outer">
    <div class="app-main__inner">

        <div class="row">
            <div class="col-md-1"></div>
            <div class="col-md-10" style="padding-top: 20px;">
                <div class="main-card mb-3 card">
                    <div class="card-body"><h5 class="card-title">ADD COSTS</h5>
                        <hr>
                        <?php if($totaldue > 0){ ?>
                            <div class="alert alert-warning"> This patient's total due balance: <b>Ksh <?php echo $totaldue;?></b></div>
                        <?php } else if($totaldue == '0'){ ?>
                            <div class="alert alert-success"> This patient's total due balance: <b>Ksh <?php echo $totaldue;?></b></div>
                        <?php } ?>
                        <div class="alert alert-info">
                            <table width="100%">
                                <tr>
                                    <th>Name:</th>
                                    <td><?php echo $ticket_details['pname']." ".$ticket_details['mname']." ".$ticket_details['lname'];?></td>
                                    <td></td>
                                    <th>Patient No:</th>
                                    <td><?php echo str_pad( $ticket_details['pid'], 4, "0", STR_PAD_LEFT ); ?></td>
                                </tr>
                            </table>
                        </div>
                        <form action="<?php echo base_url();?>queue/save_dentistcost" method="post">
                            <div class="row">
                                <input type="hidden" name="ticket_id" value="<?php echo $ticket_id;?>">
                                <input type="hidden" name="mvt_id" value="<?php echo $mvtid;?>">
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
                            <input type="submit" value="COMPLETE" class="btn btn-success">
                        </form>
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