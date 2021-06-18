<?php $userdata = $this->session->userdata('user_aob'); ?>
<div class="app-main__outer">
    <div class="app-main__inner">

        <div class="row">
            <div class="col-md-1"></div>
            <div class="col-md-10" style="padding-top: 20px;">
                <div class="main-card mb-3 card">
                    <div class="card-body"><h5 class="card-title">FILTER TREATMENT HISTORY</h5>
                        <hr>
                        <form class="" method="post"
                              action="<?php echo base_url(); ?>dashboard/patient_treatment">
                            <div class="row">

                                <div class="position-relative row form-group col-sm-6">
                                    <div class="col-sm-4">Age</div>
                                    <div class="col-sm-8">
                                        <select class="form-control" name="age" required>
                                            <option value="">--Choose one</option>
                                            <option value="under">Under 5 years</option>
                                            <option value="over">Over 5 years</option>
                                        </select>
                                    </div>

                                </div>
                                <div class="position-relative row form-group col-sm-6">
                                    <div class="col-sm-4">Gender</div>
                                    <div class="col-sm-8">
                                        <select class="form-control" name="gender" required>
                                            <option value="">--Choose one</option>
                                            <option value="Male">Male</option>
                                            <option value="Female">Female</option>
                                        </select>
                                    </div>

                                </div>
                                <div class="position-relative row form-check">
                                    <div class="col-sm-10 offset-sm-2">
                                        <button class="btn btn-success">FILTER</button>

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
    