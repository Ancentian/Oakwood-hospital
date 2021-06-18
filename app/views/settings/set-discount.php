<?php //var_dump($admin);die; ?>
<div class="app-main__outer">
    <div class="app-main__inner">
        <div class="app-page-title">
            <div class="page-title-wrapper">
                <div class="page-title-heading">
                    <div class="page-title-icon">
                        <i class="pe-7s-graph text-success">
                        </i>
                    </div>
                    <div>Set SMS Recipients
                        <div class="page-title-subheading">Add Admin
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
        <?php if ($this->session->flashdata('success')) { ?>
            <div class="alert alert-success"><?php echo $this->session->flashdata('success'); ?></div>
        <?php } ?>
        <?php if ($this->session->flashdata('error')) { ?>
            <div class="alert alert-danger"><?php echo $this->session->flashdata('error'); ?></div>
        <?php } ?>
        <div class="tab-content">
            <div class="tab-pane tabs-animation fade show active" id="tab-content-0" role="tabpanel">
                <div class="row justify-content-center">
                    <div class="main-card mb-3 col-md-6 card">
                        <div class="card-body"><h5 class="card-title">Set Discount</h5>
                            <hr>
                            <form class="" action="<?php echo base_url('settings/updateDiscount'); ?>" method="post" enctype="multipart/form-data" >
                                <div class="list_wrapper">  
                                    <div class="row">                            
                                        <div class="col-xs-5 col-sm-5 col-md-5">
                                            <div class="form-group">
                                                <label for="examplePassword11" class="">Discount</label>
                                                <input name="discount" type="text" value="<?php echo $discount['discount'] ?>" class="form-control"/>  
                                            </div>
                                        </div>    
                                    </div>
                                </div>
                                <button type="submit" class="mt-2 btn btn-primary">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>  
        </div>
    </div>