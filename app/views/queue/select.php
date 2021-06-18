<?php $userdata = $this->session->userdata('user_aob'); ?>
<div class="app-main__outer">
    <div class="app-main__inner">

        <div class="row">
            <div class="col-md-1"></div>
            <div class="col-md-10" style="padding-top: 20px;">
                <div class="main-card mb-3 card">
                    <div class="card-body"><h5 class="card-title">SELECT PATIENT</h5>
                        <hr>
                        <form class="" method="post" action="<?php echo base_url(); ?>queue/create">
                            <div class="row">
                                <div class="position-relative row form-group col-sm-12">
                                    <p style="padding-left: 25px;">Select patient then choose the activity
                                        appropriately!</p>
                                </div>

                                <div class="position-relative row form-group col-sm-6"><label for="exampleEmail" class="col-sm-4 col-form-label">Patient</label>
                                    <div class="col-sm-8">
                                        <select class="select form-control" name="patient" class="form-control" required>
                                            <option value="">--Choose one</option>
                                            <?php foreach ($patients as $patient) { ?>
                                                <option value="<?php echo $patient['id']; ?>"><?php echo $patient['name']." ".$patient['mid_name']." ".$patient['lname']; ?>
                                                    ( <?php echo $patient['phone']; ?> )
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="position-relative row form-group col-sm-6"><label for="exampleEmail" class="col-sm-4 col-form-label">Activity</label>
                                    <div class="col-sm-8">
                                        <select class="select form-control" name="activity" id="activity" class="form-control" required>
                                            <option value="">--Choose one</option>
                                            <?php foreach ($active_act as $act) {
                                                
                                                    ?>
                                                    <option value="<?php echo $act['id']; ?>"><?php echo $act['name']; ?></option>
                                                <?php 
                                            } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="position-relative row form-group col-sm-6"><label for="exampleEmail" class="col-sm-4 col-form-label">Consultation Fee</label>
                                    <div class="col-sm-8">
                                        <select class="select form-control" name="cons_fee" id="cons_fee" class="form-control" required>
                                            <option value="">--Choose one</option>
                                            <option value="0">Zero consultation fee</option>
                                            <option value="100">Normal consultation fee</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="position-relative row form-group col-sm-6"><label for="exampleEmail" class="col-sm-4 col-form-label">Is Direct</label>
                                    <div class="col-sm-8">
                                        <select class="select form-control" name="direct" id="direct" class="form-control" required>
                                            <option value="">--Choose one</option>
                                            <option value="1">YES</option>
                                            <option value="0">NO</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="position-relative row form-group col-sm-12">
                                    <div class="col-sm-12"><textarea name="notes" class="form-control" rows="5"
                                                                     placeholder="Notes/ Comments"></textarea></div>
                                </div>


                                <div class="position-relative row form-check">
                                    <div class="col-sm-10 offset-sm-2">
                                        <button class="btn btn-success">ADD</button>

                                    </div>
                                </div>

                            </div>


                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script type="text/javascript">
        $('#direct').on('change', function () {
            var activity = this.value;
            // alert(activity);
            switch (activity) {
                case '1' :
                        $('#cons_fee').val('0');
                    break;
                case '0' :
                        $('#cons_fee [value=100]').attr('selected', 'true');
                    break;
                default :
                        $('#cons_fee [value=100]').attr('selected', 'true');
            }


        });
    </script>