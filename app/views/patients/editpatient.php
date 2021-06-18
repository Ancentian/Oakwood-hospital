<div class="app-main__outer">
    <div class="app-main__inner">

        <div class="row">
            <div class="col-md-1"></div>
            <div class="col-md-10" style="padding-top: 20px;">
                <div class="main-card mb-3 card">
                    <div class="card-body"><h5 class="card-title">PATIENT DETAILS</h5>
                        <hr>
                        <form class="" method="post"
                              action="<?php echo base_url(); ?>patients/edit/<?php echo $pid; ?>">
                            <div class="row">
                                <div class="position-relative row form-group col-sm-6"><label for="exampleEmail" class="col-sm-4 col-form-label">First Name</label>
                                    <div class="col-sm-8"><input name="name" id="exampleEmail" placeholder="" value="<?php echo $patient['name']; ?>" type="text" class="form-control" required></div>
                                </div>
                                <div class="position-relative row form-group col-sm-6"><label for="exampleEmail" class="col-sm-4 col-form-label">Middle Name</label>
                                    <div class="col-sm-8"><input name="mid_name" id="exampleEmail" value="<?php echo $patient['mid_name']; ?>" placeholder="" type="text" class="form-control"></div>
                                </div>
                                <div class="position-relative row form-group col-sm-6"><label for="exampleEmail" class="col-sm-4 col-form-label">Last Name</label>
                                    <div class="col-sm-8"><input name="lname" id="exampleEmail" value="<?php echo $patient['lname']; ?>" placeholder="" type="text" class="form-control" required></div>
                                </div>
                                <div class="position-relative row form-group col-sm-6"><label for="exampleEmail" class="col-sm-4 col-form-label">ID/Passport No</label>
                                    <div class="col-sm-8"><input name="id_no" id="exampleEmail" value="<?php echo $patient['name']; ?>" placeholder="" type="text" class="form-control" required></div>
                                </div>
                                <div class="position-relative row form-group col-sm-6"><label for="examplePassword"                                                                                              class="col-sm-4 col-form-label">DoB</label>
                                    <div class="col-sm-8"><input name="dob" placeholder="" type="date"
                                                                 value="<?php echo $patient['dob']; ?>"
                                                                 class="form-control" required></div>
                                </div>

                                <div class="position-relative row form-group col-sm-6"><label for="examplePassword"                                                                                              class="col-sm-4 col-form-label">Gender</label>
                                    <div class="col-sm-8">
                                        <select class="select form-control" name="gender" class="form-control" required>
                                            <option  value="">--Select</option>
                                            <option <?php if ($patient['gender'] == "Male") {
                                                echo "selected";
                                            } ?>>Male
                                            </option>
                                            <option <?php if ($patient['gender'] == "Female") {
                                                echo "selected";
                                            } ?>>Female
                                            </option>
                                            <option <?php if ($patient['gender'] == "Other") {
                                                echo "selected";
                                            } ?>>Other
                                            </option>

                                        </select></div>
                                </div>
                                <div class="position-relative row form-group col-sm-6"><label for="examplePassword"                                                                                              class="col-sm-4 col-form-label">Marital
                                        Status</label>
                                    <div class="col-sm-8">
                                        <select class="select form-control" name="marital_status" class="form-control">
                                            <option  value="">--Select</option>
                                            <option <?php if ($patient['marital_status'] == "Single") {
                                                echo "selected";
                                            } ?>>Single
                                            </option>
                                            <option <?php if ($patient['marital_status'] == "Married") {
                                                echo "selected";
                                            } ?>>Married
                                            </option>
                                            <option <?php if ($patient['marital_status'] == "Divorced") {
                                                echo "selected";
                                            } ?>>Divorced
                                            </option>
                                            <option <?php if ($patient['marital_status'] == "Widowed") {
                                                echo "selected";
                                            } ?>>Widowed
                                            </option>
                                        </select></div>
                                </div>
                                <div class="position-relative row form-group col-sm-6"><label for="examplePassword"                                                                                             class="col-sm-4 col-form-label">Blood
                                        Group</label>
                                    <div class="col-sm-8">
                                        <select class="select form-control" name="blood_group" class="form-control">
                                            <option  value="">--Select</option>
                                            <option <?php if ($patient['blood_group'] == "A") {
                                                echo "selected";
                                            } ?>>A
                                            </option>
                                            <option <?php if ($patient['blood_group'] == "B") {
                                                echo "selected";
                                            } ?>>B
                                            </option>
                                            <option <?php if ($patient['blood_group'] == "AB") {
                                                echo "selected";
                                            } ?>>AB
                                            </option>
                                            <option <?php if ($patient['blood_group'] == "O") {
                                                echo "selected";
                                            } ?>>O
                                            </option>
                                        </select></div>
                                </div>
                                <div class="position-relative row form-group col-sm-6"><label for="examplePassword"                                                                                              class="col-sm-4 col-form-label">Phone</label>
                                    <div class="col-sm-8"><input name="phone" placeholder=""
                                                                 value="<?php echo $patient['phone']; ?>" type="text"
                                                                 class="form-control" required></div>
                                </div>
                                <div class="position-relative row form-group col-sm-6"><label for="examplePassword"                                                                                              class="col-sm-4 col-form-label">Residence</label>
                                    <div class="col-sm-8"><input name="address" placeholder=""
                                                                 value="<?php echo $patient['address']; ?>" type="text"
                                                                 class="form-control"></div>
                                </div>
                                <div class="position-relative row form-group col-sm-6"><label for="examplePassword"                                                                                              class="col-sm-4 col-form-label">District</label>
                                    <div class="col-sm-8"><input name="district" placeholder="" type="text"
                                                                 value="<?php echo $patient['district']; ?>"
                                                                 class="form-control"></div>
                                </div>

                                <div class="position-relative row form-group col-sm-6"><label for="examplePassword"                                                                                              class="col-sm-4 col-form-label">Location</label>
                                    <div class="col-sm-8"><input name="location" placeholder="" type="text"
                                                                 value="<?php echo $patient['location']; ?>"
                                                                 class="form-control"></div>
                                </div>

                                <div class="position-relative row form-group col-sm-6"><label for="examplePassword"                                                                                              class="col-sm-4 col-form-label">Sub-location</label>
                                    <div class="col-sm-8"><input name="sublocation" placeholder="" type="text"
                                                                 value="<?php echo $patient['sublocation']; ?>"
                                                                 class="form-control"></div>
                                </div>

                                <div class="position-relative row form-group col-sm-6"><label for="examplePassword"                                                                                              class="col-sm-4 col-form-label">Village</label>
                                    <div class="col-sm-8"><input name="village" placeholder="" type="text"
                                                                 value="<?php echo $patient['village']; ?>"
                                                                 class="form-control"></div>
                                </div>

                                <div class="position-relative row form-group col-sm-6"><label for="examplePassword"                                                                                              class="col-sm-4 col-form-label">Chief</label>
                                    <div class="col-sm-8"><input name="chief" placeholder="" type="text"
                                                                 value="<?php echo $patient['chief']; ?>"
                                                                 class="form-control"></div>
                                </div>

                                <div class="position-relative row form-group col-sm-6"><label for="examplePassword"                                                                                              class="col-sm-4 col-form-label">Sub
                                        Chief</label>
                                    <div class="col-sm-8"><input name="subchief" placeholder="" type="text"
                                                                 value="<?php echo $patient['subchief']; ?>"
                                                                 class="form-control"></div>
                                </div>
                                <div class="position-relative row form-group col-sm-6"><label for="examplePassword"                                                                                              class="col-sm-4 col-form-label">Next
                                        of Kin</label>
                                    <div class="col-sm-8"><input name="nok" placeholder="" type="text"
                                                                 value="<?php echo $patient['nok']; ?>"
                                                                 class="form-control"></div>
                                </div>
                                <div class="position-relative row form-group col-sm-6"><label for="examplePassword"                                                                                              class="col-sm-4 col-form-label">NoK
                                        Relationship</label>
                                    <div class="col-sm-8"><input name="nok_relationship" placeholder="" type="text"
                                                                 value="<?php echo $patient['nok_relationship']; ?>"
                                                                 class="form-control"></div>
                                </div>
                                <div class="position-relative row form-group col-sm-6"><label for="examplePassword"                                                                                              class="col-sm-4 col-form-label">NoK
                                        Phone</label>
                                    <div class="col-sm-8"><input name="nok_phone" placeholder=""
                                                                 value="<?php echo $patient['nok_phone']; ?>"
                                                                 type="text" class="form-control"></div>
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