<?php $userdata = $this->session->userdata('user_aob'); ?>
<div class="app-main__outer">
    <div class="app-main__inner">

        <div class="row">
            <div class="col-md-1"></div>
            <div class="col-md-10" style="padding-top: 20px;">
                <div class="main-card mb-3 card">
                    <div class="card-body"><h5 class="card-title">SELECT PATIENT</h5>
                        <hr>
                        <form class="" method="post" action="<?php echo base_url(); ?>history/patient_history">
                            <div class="row">
                                <div class="position-relative row form-group col-sm-12">
                                    <p style="padding-left: 25px;">Select patient the continue to view his history!</p>
                                </div>

                                <div class="position-relative row form-group col-sm-6"><label for="exampleEmail"
                                                                                              class="col-sm-4 col-form-label">Patient</label>
                                    <div class="col-sm-8">
                                        <?php foreach ($patients as $patient) { ?>
                                            <a href="<?php echo base_url('history/patient_history/') . $patient['id']; ?>"><?php echo $patient['name']; ?>
                                                ( <?php echo $patient['phone']; ?> )</a><br>
                                        <?php } ?>
                                    </div>
                                </div>


                            </div>


                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    