<div class="app-main__outer">
    <div class="app-main__inner">

        <div class="row">
            <div class="col-md-1"></div>
            <div class="col-md-10" style="padding-top: 20px;">
                <div class="main-card mb-3 card">
                    <div class="card-body"><h5 class="card-title">TEST DETAILS</h5>
                        <hr>
                        <form class="" method="post" action="<?php echo base_url(); ?>labtest/edit/<?php echo $test['id']; ?>">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="position-relative form-group">
                                        <label for="examplePassword11" class="">Name</label>
                                        <input name="name" id="name" value="<?php echo $test['name']; ?>" type="text" class="form-control" >
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="position-relative form-group">
                                        <label for="examplePassword11" class="">Category</label>
                                        <select name="cat_id" class="form-control select">
                                            <option >--Choose here--</option>
                                            <?php foreach ($category as $one) {?>
                                                <option value="<?php echo $one['id']?>"<?php if ($test['cat_id'] == $one['id']) { echo "selected"; } ?>><?php echo $one['cat_name']?></option>
                                            <?php }?>

                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="position-relative form-group">
                                        <label for="examplePassword11" class="">Cost</label>
                                        <input name="cost" id="cost" value="<?php echo $test['cost']; ?>" type="number" class="form-control" >
                                    </div>
                                </div>

                                <div class="position-relative row form-check">
                                    <div class="col-sm-10 offset-sm-2">
                                        <button class="btn btn-success">COMPLETE</button>

                                    </div>
                                </div>

                            </div>


                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>