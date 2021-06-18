<div class="app-main__outer">
    <div class="app-main__inner">

        <div class="row">
            <div class="col-md-1"></div>
            <div class="col-md-10" style="padding-top: 20px;">
                <?php if ($this->session->flashdata('success-msg')) { ?>
                    <div class="alert alert-success"><?php echo $this->session->flashdata('success-msg'); ?></div>
                <?php } ?>
                <?php if ($this->session->flashdata('error-msg')) { ?>
                    <div class="alert alert-danger"><?php echo $this->session->flashdata('error-msg'); ?></div>
                <?php } ?>
                <div class="main-card mb-3 card">
                    <div class="card-body"><h5 class="card-title">SEARCH PATIENT</h5>
                        <hr>
                        <form class="" method="post" action="<?php echo base_url(); ?>history/select">
                            <div class="row">
                                <div class="position-relative row form-group col-sm-12">
                                    <p style="padding-left: 25px;">Search by first name,middle name, last name, ID number, patient number or phone number</p>
                                </div>

                                <div class="position-relative row form-group col-sm-8"><div class="col-sm-12"><input name="name" id="exampleEmail" placeholder="" type="text" class="form-control" required></div>
                                </div>
                                <div class="position-relative row form-check">
                                    <div class="col-sm-10 offset-sm-2">
                                        <button class="btn btn-success">SEARCH</button>

                                    </div>
                                </div>

                            </div>


                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>