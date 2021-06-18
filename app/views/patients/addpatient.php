<div class="app-main__outer">
    <div class="app-main__inner">

        <div class="row">
            <div class="col-md-1"></div>
            <div class="col-md-10" style="padding-top: 20px;">
                <div class="main-card mb-3 card">
                    <div class="card-body"><h5 class="card-title">1)PATIENT DETAILS</h5>
                        <hr>
                        <form class="" method="post" action="<?php echo base_url(); ?>patients/add">
                            <div class="row">
                                <div class="position-relative row form-group col-sm-6">
                                    <label for="exampleEmail" class="col-sm-4 col-form-label">First Name</label>
                                    <div class="col-sm-8">
                                        <input name="name" id="exampleEmail" placeholder="" type="text" class="form-control" required>
                                    </div>
                                </div>
                                <div class="position-relative row form-group col-sm-6">
                                    <label for="exampleEmail" class="col-sm-4 col-form-label">Middle Name</label>
                                    <div class="col-sm-8">
                                        <input name="mid_name" id="exampleEmail" placeholder="" type="text" class="form-control">
                                    </div>
                                </div>
                                <div class="position-relative row form-group col-sm-6">
                                    <label for="exampleEmail" class="col-sm-4 col-form-label">Last Name</label>
                                    <div class="col-sm-8">
                                        <input name="lname" id="exampleEmail" placeholder="" type="text" class="form-control" required>
                                    </div>
                                </div>
                                <div class="position-relative row form-group col-sm-6">
                                    <label for="exampleEmail" class="col-sm-4 col-form-label">ID/Passport No</label>
                                    <div class="col-sm-8">
                                        <input name="id_no" id="exampleEmail" placeholder="" type="text" class="form-control" >
                                    </div>
                                </div>
                                <div class="position-relative row form-group col-sm-6">
                                    <label for="examplePassword" class="col-sm-4 col-form-label">Phone</label>
                                    <div class="col-sm-8">
                                        <input name="phone" placeholder="" type="text" class="form-control" required>
                                    </div>
                                </div>
                                <div class="position-relative row form-group col-sm-6">
                                    <label for="examplePassword"  class="col-sm-4 col-form-label">DoB</label>
                                    <div class="col-sm-8">
                                        <input name="dob" placeholder="" type="date" class="form-control">
                                    </div>
                                </div>

                                <div class="position-relative row form-group col-sm-6">
                                    <label for="examplePassword" class="col-sm-4 col-form-label">Gender</label>
                                    <div class="col-sm-8">
                                        <select class="select form-control" name="gender" class="form-control" required>
                                            <option value="">--Select</option>
                                            <option>Male</option>
                                            <option>Female</option>
                                            <option>Other</option>

                                        </select>
                                    </div>
                                </div>

                                <div class="position-relative row form-group col-sm-6">
                                    <label for="examplePassword" class="col-sm-4 col-form-label">Marital Status</label>
                                    <div class="col-sm-8">
                                        <select class="select form-control" name="marital_status" class="form-control">
                                            <option value="">--Select</option>
                                            <option>Single</option>
                                            <option>Married</option>
                                            <option>Divorced</option>
                                            <option>Widowed</option>
                                        </select></div>
                                    </div>
                                    
                                    <!-- Residence -->
                                    <div class="col-md-6 position-relative form-group" style="margin-left: 15%">
                                        <label for="chkPassport" >
                                            <input type="checkbox" id="chkPassport" />
                                            Others E.g. Residence
                                        </label>
                                    </div>
                                </div>
                                <div id="dvPassport" class="row col-md-12" style="display: none">
                                    <div class="card-body">
                                        <h5 class="card-title">2) Residence</h5>
                                        <hr>
                                        <div class="row">
                                            <div class="position-relative row form-group col-md-6">
                                                <label for="examplePassword" class="col-sm-4 col-form-label">Blood
                                                Group</label>
                                                <div class="col-md-6">
                                                    <select class="select form-control" name="blood_group" class="form-control">
                                                        <option value="">--Select</option>
                                                        <option>A</option>
                                                        <option>B</option>
                                                        <option>AB</option>
                                                        <option>O</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="position-relative row form-group col-md-6">
                                                <label for="examplePassword" class="col-sm-4 col-form-label">Residence</label>
                                                <div class="col-sm-8">
                                                    <input name="address" placeholder="" type="text" class="form-control">
                                                </div>
                                            </div>
                                            <div class="position-relative row form-group col-sm-6">
                                                <label for="examplePassword" class="col-sm-4 col-form-label">District</label>
                                                <div class="col-sm-8">
                                                    <input name="district" placeholder="" type="text" class="form-control">
                                                </div>
                                            </div>
                                            <div class="position-relative row form-group col-sm-6">
                                                <label for="examplePassword" class="col-sm-4 col-form-label">Location</label>
                                                <div class="col-sm-8">
                                                    <input name="location" placeholder="" type="text" class="form-control">
                                                </div>
                                            </div>

                                            <div class="position-relative row form-group col-sm-6">
                                                <label for="examplePassword" class="col-sm-4 col-form-label">Sub-location</label>
                                                <div class="col-sm-8">
                                                    <input name="sublocation" placeholder="" type="text" class="form-control"></div>
                                                </div>

                                                <div class="position-relative row form-group col-sm-6">
                                                    <label for="examplePassword" class="col-sm-4 col-form-label">Village</label>
                                                    <div class="col-sm-8">
                                                        <input name="village" placeholder="" type="text" class="form-control">
                                                    </div>
                                                </div>

                                                <div class="position-relative row form-group col-sm-6">
                                                    <label for="examplePassword" class="col-sm-4 col-form-label">Chief</label>
                                                    <div class="col-sm-8">
                                                        <input name="chief" placeholder="" type="text" class="form-control">
                                                    </div>
                                                </div>

                                                <div class="position-relative row form-group col-sm-6">
                                                    <label for="examplePassword" class="col-sm-4 col-form-label">Sub
                                                    Chief</label>
                                                    <div class="col-sm-8">
                                                        <input name="subchief" placeholder="" type="text" class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-body"><h5 class="card-title">3) Next Of Kin</h5>
                                            <hr>
                                            <div class="row">
                                                <div class="position-relative row form-group col-sm-6">
                                                    <label for="examplePassword" class="col-sm-4 col-form-label">Next
                                                    of Kin</label>
                                                    <div class="col-sm-8">
                                                        <input name="nok" placeholder="" type="text" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="position-relative row form-group col-sm-6">
                                                    <label for="examplePassword" class="col-sm-4 col-form-label">NoK
                                                    Relationship</label>
                                                    <div class="col-sm-8">
                                                        <input name="nok_relationship" placeholder="" type="text" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="position-relative row form-group col-sm-6">
                                                    <label for="examplePassword" class="col-sm-4 col-form-label">NoK
                                                    Phone</label>
                                                    <div class="col-sm-8">
                                                        <input name="nok_phone" placeholder="" type="text" class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <h5 class="card-title">4) Social Economic History</h5>
                                            <hr>
                                            <div class="row">
                                                <div class="position-relative row form-group col-sm-6">
                                                    <label for="examplePassword" class="col-sm-4 col-form-label">Occupation</label>
                                                    <div class="col-sm-8">
                                                        <input name="occupation" placeholder="" type="text" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="position-relative row form-group col-sm-6">
                                                    <label for="examplePassword" class="col-sm-4 col-form-label">Education Level</label>
                                                    <div class="col-sm-8">
                                                        <input name="ed_level" placeholder="" type="text" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="position-relative row form-group col-sm-6">
                                                    <label for="examplePassword" class="col-sm-4 col-form-label">Employer</label>
                                                    <div class="col-sm-8">
                                                        <input name="employer" placeholder="" type="text" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="position-relative row form-group col-sm-6">
                                                    <label for="examplePassword" class="col-sm-4 col-form-label">Employer
                                                    Phone</label>
                                                    <div class="col-sm-8">
                                                        <input name="employer_tel" placeholder="" type="text" class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="position-relative row form-check">
                                        <div class="col-sm-10 offset-sm-2">
                                            <button class="btn btn-success" style="float: center">COMPLETE</button>
                                        </div>
                                    </div>

                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <script type="text/javascript">
                $(function () {
                    $("#chkPassport").click(function () {
                        if ($(this).is(":checked")) {
                            $("#dvPassport").show();
                        } else {
                            $("#dvPassport").hide();
                        }
                    });
                });
            </script>