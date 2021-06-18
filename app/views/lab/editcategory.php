<div class="app-main__outer">
    <div class="app-main__inner">

        <div class="row justify-content-center">
            <div class="col-md-1"></div>
            <div class="col-md-6" style="padding-top: 20px;">
                <div class="main-card mb-3 card">
                    <div class="card-body"><h5 class="card-title">Edit Category</h5>
                        <hr>
                        <form class="" method="post" action="<?php echo base_url('labtest/updateCategory/'. $category['id']); ?>">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="position-relative form-group">
                                        <label for="examplePassword11" class="">Category Name</label>
                                        <input name="cat_name" id="name" value="<?php echo $category['cat_name']; ?>" type="text" class="form-control" >
                                    </div>
                                </div>
                            </div>
                            <div class="position-relative row form-check">
                                <div class="col-sm-10 offset-sm-2">
                                    <button class="btn btn-success">Update</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>