<div class="app-main__outer">
    <div class="app-main__inner">

        <div class="row">
            <div class="col-md-1"></div>
            <div class="col-md-10" style="padding-top: 20px;">
                <?php if($totaldue > 0){ ?>
                            <div class="alert alert-warning"> This patient's total due balance: <b>Ksh <?php echo $totaldue;?></b></div>
                        <?php } else if($totaldue == '0'){ ?>
                            <div class="alert alert-success"> This patient's total due balance: <b>Ksh <?php echo $totaldue;?></b></div>
                        <?php } ?>
                <div class="main-card mb-3 card">
                    <div class="card-body"><h5 class="card-title">1) PATIENT DETAILS</h5>
                        <hr>

                        <div class="row">
                            <div class="position-relative row form-group col-sm-6"><label for="exampleEmail"class="col-sm-4 col-form-label"><b>Patient
                                        No: </b></label>
                                <div class="col-sm-8"><label for="exampleEmail"                                                             class="col-sm-8 col-form-label"><?php echo $patientdetails['id']; ?></label>
                                </div>
                            </div>
                            <div class="position-relative row form-group col-sm-6"><label for="exampleEmail"                                                                          class="col-sm-4 col-form-label"><b>Name: </b></label>
                                <div class="col-sm-8"><label for="exampleEmail"                                                             class="col-sm-8 col-form-label"><?php echo $patientdetails['name']." ".$patientdetails['lname']; ?></label>
                                </div>
                            </div>
                            <div class="position-relative row form-group col-sm-6"><label for="exampleEmail"                                                                          class="col-sm-4 col-form-label"><b>Blood
                                        Group: </b></label>
                                <div class="col-sm-8"><label for="exampleEmail"                                                             class="col-sm-8 col-form-label"><?php echo $patientdetails['blood_group']; ?></label>
                                </div>
                            </div>
                            <div class="position-relative row form-group col-sm-6"><label for="exampleEmail"                                                                          class="col-sm-4 col-form-label"><b>Age: </b></label>
                                <div class="col-sm-8"><label for="exampleEmail"                                                             class="col-sm-8 col-form-label"><?php echo(date('Y-m-d') - $patientdetails['dob']); ?></label>
                                </div>
                            </div>
                            <div class="position-relative row form-group col-sm-6"><label for="exampleEmail"                                                                          class="col-sm-4 col-form-label"><b>Phone
                                        No: </b></label>
                                <div class="col-sm-8"><label for="exampleEmail"                                                             class="col-sm-8 col-form-label"><?php echo $patientdetails['phone']; ?></label>
                                </div>
                            </div>
                            <div class="position-relative row form-group col-sm-6"><label for="exampleEmail"                                                                          class="col-sm-4 col-form-label"><b>NoK
                                        Phone: </b></label>
                                <div class="col-sm-8"><label for="exampleEmail"                                                             class="col-sm-8 col-form-label"><?php echo $patientdetails['nok_phone']; ?></label>
                                </div>
                            </div>
                        </div>

                    </div>
                   
                        <?php if (sizeof($triagedetails) > 0) { ?>
                    <div class="card-body"><h5 class="card-title">TRIAGE DETAILS</h5>
                        <hr>

                            <div class="row">
                                <div class="position-relative row form-group col-sm-6"><label for="exampleEmail"                                                                              class="col-sm-4 col-form-label">Weight(Kgs)</label>
                                    <div class="col-sm-8"><input name="weight" placeholder="" type="text"
                                                                 class="form-control"
                                                                 value="<?php echo $triagedetails['weight']; ?> kgs"
                                                                 disabled></div>
                                </div>
                                <div class="position-relative row form-group col-sm-6"><label for="exampleEmail"                                                                              class="col-sm-4 col-form-label">Height(cm)</label>
                                    <div class="col-sm-8"><input name="height" placeholder="" type="text"
                                                                 class="form-control"
                                                                 value="<?php echo $triagedetails['height']; ?> cm"
                                                                 disabled></div>
                                </div>
                                <div class="position-relative row form-group col-sm-6"><label for="exampleEmail"                                                                              class="col-sm-4 col-form-label">Temperature</label>
                                    <div class="col-sm-8"><input name="temperature" placeholder="" type="text" class="form-control" value="<?php echo $triagedetails['temperature']; ?>" style="<?php if($triagedetails['temperature'] > '37' || $triagedetails['temperature'] < '36'){?> color: red;border: 1px solid red; <?php } ?>"
                                                                 disabled></div>
                                </div>
                                <div class="position-relative row form-group col-sm-6"><label for="exampleEmail" class="col-sm-4 col-form-label">Blood
                                        Pressure</label>
                                        <?php if($triagedetails['blood_pressure']){
                                          $bp = explode('/', $triagedetails['blood_pressure']);
                                          $hbp = $bp[0];
                                          $lbp = $bp[1];
                                        } ?>
                                    <div class="col-sm-8"><input name="blood_pressure" placeholder="" type="text" style="<?php if($hbp > '120' || $lbp < '80'){?> color: red;border: 1px solid red; <?php } ?>"
                                                                 class="form-control"
                                                                 value="<?php echo $triagedetails['blood_pressure']; ?>"
                                                                 disabled></div>
                                </div>
                                <div class="position-relative row form-group col-sm-6"><label for="exampleEmail"                                                                                              class="col-sm-4 col-form-label">SPO2</label>
                                    <div class="col-sm-8"><input name="spo2" placeholder="" type="text"
                                                                 class="form-control"
                                                                 value="<?php echo $triagedetails['spo2']; ?>" style="<?php if($triagedetails['spo2'] < '90'){?> color: red;border: 1px solid red; <?php } ?>" disabled>
                                    </div>
                                </div>
                                <div class="position-relative row form-group col-sm-6"><label for="exampleEmail" class="col-sm-4 col-form-label">Pulse Rate</label>
                                    <div class="col-sm-8"><input name="resp_rate" placeholder="" type="text" class="form-control" value="<?php echo $triagedetails['resp_rate']; ?>" style="<?php if($triagedetails['resp_rate'] > '25' || $triagedetails['resp_rate'] < '12'){?> color: red;border: 1px solid red; <?php } ?>" disabled>
                                        <hr>
                                    </div>


                                </div>
                            </div>
                        </div>
                        <?php } ?>
                    
                            <?php if (sizeof($diagnosisdetails) > 0) { ?>
                            <div class="card-body"><h5 class="card-title">DIAGNOSIS DETAILS</h5>
                            <hr>
                                <div class="row">
                                   
                                    <div class="position-relative row form-group col-sm-6"><label for="exampleEmail"                                                                                                  class="col-sm-4 col-form-label">Diagnosed
                                            By:</label>
                                        <div class="col-sm-8"><input name="height" placeholder="" type="text"
                                                                     class="form-control"
                                                                     value="<?php echo $diagnosisdetails['uname']; ?>"
                                                                     disabled></div>
                                    </div>
                                    <div class="position-relative row form-group col-sm-12">
                                    <div class="col-sm-2">Clinical History</div>
                                    <div class="col-sm-10"><textarea name="clinical_history" class="form-control" rows="3" disabled><?php echo $diagnosisdetails['clinical_history']; ?></textarea>
                                    </div>

                                </div>

                                <div class="position-relative row form-group col-sm-12">
                                    <div class="col-sm-2">Physical Findings</div>
                                    <div class="col-sm-10"><textarea name="physical_findings" class="form-control" rows="3" disabled><?php echo $diagnosisdetails['physical_findings']; ?></textarea>
                                    </div>

                                </div>

                                <div class="position-relative row form-group col-sm-12">
                                    <div class="col-sm-2">Impressions & Diagnosis</div>
                                    <div class="col-sm-10"><textarea name="diagnosis" class="form-control" rows="3" disabled><?php echo $diagnosisdetails['diagnosis']; ?></textarea>
                                    </div>

                                </div>
                                </div>
                                </div>
                            <?php } ?>

                        <?php
                        if (sizeof($radiologydetails) > 0) {
                            ?>
                    <div class="card-body"><h5 class="card-title">RADIOLOGY DETAILS</h5>
                        <hr>

                            <div class="row alert alert-info">
                                <div class="position-relative row form-group col-sm-6"><label for="exampleEmail"                                                                                              class="col-sm-5 col-form-label"><b>Status:</b></label>
                                    <label for="exampleEmail"                                           class="col-sm-7 col-form-label"><?php if ($radiologydetails[0]['labstatus'] == "seen") { ?>
                                            <span class="badge badge-success">seen</span>
                                        <?php } else { ?><span class="badge badge-danger">pending</span> <?php } ?>
                                    </label>
                                </div>

                                <div class="position-relative row form-group col-sm-6"><label for="exampleEmail"                                                                                              class="col-sm-5 col-form-label"><b>Results
                                            By:</b></label>
                                    <label for="exampleEmail"                                           class="col-sm-7 col-form-label"><?php if ($radiologydetails[0]['labstatus'] == "seen") {
                                            echo $radiologydetails[0]['tests_by']; ?>

                                        <?php } else { ?><span class="badge badge-danger">In Queue</span> <?php } ?>
                                    </label>
                                </div>

                                <div class="position-relative row form-group col-sm-6"><label for="exampleEmail"                                                                                              class="col-sm-5 col-form-label"><b>Requested
                                            By:</b></label>
                                    <label for="exampleEmail"                                           class="col-sm-7 col-form-label"><?php echo $radiologydetails[0]['requested_by']; ?></label>
                                </div>


                            </div>
                            <div class="row">
                                <div class="position-relative row form-group col-sm-12"><label for="exampleEmail"                                                                                               class="col-sm-3 col-form-label"><b>Test</b></label>
                                    <label for="exampleEmail"class="col-sm-9 col-form-label"><b>Results</b></label>
                                </div>

                            </div>

                            <?php
                            foreach ($radiologydetails as $key) {
                                ?>
                                <div class="row">
                                    <div class="position-relative row form-group col-sm-12"><label for="exampleEmail"                                                                                                   class="col-sm-3 col-form-label"><?php echo $key['test_name']; ?></label>
                                        <textarea class="col-sm-7 form-control" rows="4"
                                                  disabled><?php echo $key['test_result']; ?></textarea>
                                        <?php if ($key['attachment']) { ?>
                                            <a href="<?php echo base_url(); ?>queue/radattachment/<?php echo $key['attachment']; ?>"
                                               target="popup"
                                               onclick="window.open('<?php echo base_url(); ?>queue/radattachment/<?php echo $key['attachment']; ?>','popup','width=600,height=600'); return false;"
                                               class="btn btn-success" role="button"
                                               style="max-height: 40px;margin: 5px;">View Attachment</a>
                                        <?php } ?>
                                    </div>
                                </div>
                                </div>

                            <?php }
                        } ?>
                           
                        <?php if (sizeof($admissiondetails) != 0) { ?>
                            <div class="card-body">
                            <div class="row">
                                <div class="position-relative row form-group col-sm-6"><label for="exampleEmail"                                                                                              class="col-sm-4 col-form-label">Ward</label>
                                    <div class="col-sm-8"><input name="weight" placeholder="" type="text"
                                                                 class="form-control"
                                                                 value="<?php echo $admissiondetails['name']; ?>"
                                                                 disabled></div>
                                </div>
                                <div class="position-relative row form-group col-sm-6"><label for="exampleEmail"                                                                                              class="col-sm-4 col-form-label">Cost</label>
                                    <div class="col-sm-8"><input name="height" placeholder="" type="text"
                                                                 class="form-control"
                                                                 value="Ksh <?php echo $admissiondetails['cost']; ?>"
                                                                 disabled></div>
                                </div>
                                <div class="position-relative row form-group col-sm-6"><label for="exampleEmail"                                                                                              class="col-sm-4 col-form-label">Admission
                                        Date</label>
                                    <div class="col-sm-8"><input name="temperature" placeholder="" type="text"
                                                                 class="form-control"
                                                                 value="<?php echo date('Y-m-d H:i', strtotime($admissiondetails['admission_time'])); ?>"
                                                                 disabled></div>
                                </div>
                                <div class="position-relative row form-group col-sm-6"><label for="exampleEmail"                                                                                              class="col-sm-4 col-form-label">Status</label>
                                    <label for="exampleEmail"                                           class="col-sm-8 col-form-label"><?php if ($admissiondetails['status'] == "admitted") { ?>
                                            <span class="badge badge-success">admitted</span>
                                        <?php } else { ?><span class="badge badge-danger">discharged</span> <?php } ?>
                                    </label>
                                </div>

                            </div>
                        </div>
                        <?php } ?>
                    
                        <?php if (sizeof($medicationdetails) > 0) { ?>
                            <div class="card-body"><h5 class="card-title">PRESCRIPTION DETAILS</h5>
                        <hr>
                            <div class="row">
                                <div class="position-relative row form-group col-sm-12"><label for="exampleEmail"                                                                                               class="col-sm-3 col-form-label"><b>Medicine</b></label>
                                    <label for="exampleEmail"class="col-sm-3 col-form-label"><b>Units</b></label>
                                    <label for="exampleEmail"class="col-sm-3 col-form-label"><b>Precription</b></label>
                                    <label for="exampleEmail"class="col-sm-3 col-form-label"><b>Precribed
                                            By</b></label>
                                </div>

                            </div>

                            <?php
                            foreach ($medicationdetails as $key) {
                                ?>
                                <div class="row">
                                    <div class="position-relative row form-group col-sm-12"><label for="exampleEmail"                                                                                                   class="col-sm-3 col-form-label"><?php echo $key['mname']; ?></label>
                                        <label for="exampleEmail"                                               class="col-sm-3 col-form-label"><?php echo $key['units']; ?></label>
                                        <label for="exampleEmail"                                               class="col-sm-3 col-form-label"><?php echo $key['prescription']; ?></label>
                                        <label for="exampleEmail"                                               class="col-sm-3 col-form-label"><?php echo $key['uname']; ?></label>
                                    </div>
                                </div>
                            
                            <?php }
                        } ?>
                           
                            <?php if (sizeof($anc_details) > 0) { ?>
                            <div class="card-body"><h5 class="card-title">FIRST TIME ANC DETAILS</h5>
                            <hr>
                                <div class="row" style="padding-left: 10px;">
                                    <form action="<?php echo base_url();?>queue/save_firsttime_anc" method="post">
                            <div class="row">
                                <div class="position-relative row form-group col-sm-6" id="appointment"><label for="exampleEmail" class="col-sm-4 col-form-label">General</label>
                                    <div class="col-sm-8">
                                        <input type="text" value="<?php echo $anc_details['general'];?>" disabled class="form-control" placeholder="">
                                    </div>
                                </div>

                                <div class="position-relative row form-group col-sm-6" id="appointment"><label for="exampleEmail" class="col-sm-4 col-form-label">BP</label>
                                    <div class="col-sm-8">
                                        <input type="text" value="<?php echo $anc_details['bp'];?>" disabled class="form-control" placeholder="">
                                    </div>
                                </div>
                                <div class="position-relative row form-group col-sm-6" id="appointment"><label for="exampleEmail" class="col-sm-4 col-form-label">Height</label>
                                    <div class="col-sm-8">
                                        <input type="text" value="<?php echo $anc_details['height'];?>" disabled class="form-control" placeholder="">
                                    </div>
                                </div>
                                
                                <div class="position-relative row form-group col-sm-6" id="appointment"><label for="exampleEmail" class="col-sm-4 col-form-label">CVS</label>
                                    <div class="col-sm-8">
                                        <input type="text" value="<?php echo $anc_details['cvs'];?>" disabled class="form-control" placeholder="">
                                    </div>
                                </div>
                                <div class="position-relative row form-group col-sm-6" id="appointment"><label for="exampleEmail" class="col-sm-4 col-form-label">Resp</label>
                                    <div class="col-sm-8">
                                        <input type="text" value="<?php echo $anc_details['resp'];?>" disabled class="form-control" placeholder="">
                                    </div>
                                </div>
                                <div class="position-relative row form-group col-sm-6" id="appointment"><label for="exampleEmail" class="col-sm-4 col-form-label">Breasts</label>
                                    <div class="col-sm-8">
                                        <input type="text" value="<?php echo $anc_details['breasts'];?>" disabled class="form-control" placeholder="">
                                    </div>
                                </div>
                                <div class="position-relative row form-group col-sm-6" id="appointment"><label for="exampleEmail" class="col-sm-4 col-form-label">Abdomen</label>
                                    <div class="col-sm-8">
                                        <input type="text" value="<?php echo $anc_details['abdomen'];?>" disabled class="form-control" placeholder="">
                                    </div>
                                </div>
                                <div class="position-relative row form-group col-sm-6" id="appointment"><label for="exampleEmail" class="col-sm-4 col-form-label">Vaginal Examination</label>
                                    <div class="col-sm-8">
                                        <input type="text" value="<?php echo $anc_details['vaginal_examination'];?>" disabled class="form-control" placeholder="">
                                    </div>
                                </div>
                                <div class="position-relative row form-group col-sm-6" id="appointment"><label for="exampleEmail" class="col-sm-4 col-form-label">Discharge</label>
                                    <div class="col-sm-8">
                                        <input type="text" value="<?php echo $anc_details['discharge'];?>" disabled class="form-control" placeholder="">
                                    </div>
                                </div>
                                <div class="position-relative row form-group col-sm-6" id="appointment"><label for="exampleEmail" class="col-sm-4 col-form-label">HB</label>
                                    <div class="col-sm-8">
                                        <input type="text" value="<?php echo $anc_details['hb'];?>" disabled class="form-control" placeholder="">
                                    </div>
                                </div>
                                <div class="position-relative row form-group col-sm-6" id="appointment"><label for="exampleEmail" class="col-sm-4 col-form-label">Blood Group</label>
                                    <div class="col-sm-8">
                                        <input type="text" value="<?php echo $anc_details['blood_grp'];?>" disabled class="form-control" placeholder="">
                                    </div>
                                </div>

                                <div class="position-relative row form-group col-sm-6" id="appointment"><label for="exampleEmail" class="col-sm-4 col-form-label">Rhesus</label>
                                    <div class="col-sm-8">
                                        <input type="text" value="<?php echo $anc_details['rhesus'];?>" disabled class="form-control" placeholder="">
                                    </div>
                                </div>
                                <div class="position-relative row form-group col-sm-6" id="appointment"><label for="exampleEmail" class="col-sm-4 col-form-label">Urinalysis</label>
                                    <div class="col-sm-8">
                                        <input type="text" value="<?php echo $anc_details['urinalysis'];?>" disabled class="form-control" placeholder="">
                                    </div>
                                </div>
                                <div class="position-relative row form-group col-sm-6" id="appointment"><label for="exampleEmail" class="col-sm-4 col-form-label">TB Screening</label>
                                    <div class="col-sm-8">
                                        <input type="text" value="<?php echo $anc_details['tb_screening'];?>" disabled class="form-control" placeholder="">
                                    </div>
                                </div>
                                <div class="position-relative row form-group col-sm-6" id="appointment"><label for="exampleEmail" class="col-sm-4 col-form-label">IPT Date</label>
                                    <div class="col-sm-8">
                                        <input type="date" value="<?php echo $anc_details['ipt_date'];?>" disabled class="form-control" placeholder="">
                                    </div>
                                </div>
                                <div class="position-relative row form-group col-sm-6" id="appointment"><label for="exampleEmail" class="col-sm-4 col-form-label">Dual Testing Date</label>
                                    <div class="col-sm-8">
                                        <input type="date" value="<?php echo $anc_details['dualtesting_date'];?>" disabled class="form-control" placeholder="">
                                    </div>
                                </div>
                                <div class="position-relative row form-group col-sm-6" id="appointment"><label for="exampleEmail" class="col-sm-4 col-form-label">HIV Counselling</label>
                                    <div class="col-sm-8">
                                        <input type="text" value="<?php echo $anc_details['hiv_counselling'];?>" disabled class="form-control" placeholder="">
                                    </div>
                                </div>
                                <div class="position-relative row form-group col-sm-6" id="appointment"><label for="exampleEmail" class="col-sm-4 col-form-label">Partner HIV Status</label>
                                    <div class="col-sm-8">
                                        <input type="text" value="<?php echo $anc_details['partner_hiv'];?>" disabled class="form-control" placeholder="">
                                    </div>
                                </div>
                                <div class="position-relative row form-group col-sm-6" id="appointment"><label for="exampleEmail" class="col-sm-4 col-form-label">Infant Feeding</label>
                                    <div class="col-sm-8">
                                        <input type="text" value="<?php echo $anc_details['infant_feeding'];?>" disabled class="form-control" placeholder="">
                                    </div>
                                </div>
                               
                            </div>
                          
                        </form>
                                </div>
                            </div>
                            <?php } ?>

                            <?php if(sizeof($subsequent_anc) > 0){?>
                        <div class="card-body" style="overflow-x: auto;"><h5 class="card-title">SUBSEQUENT ANC DETAILS</h5>
                            <hr>
                            <table class="mb-0 table table-striped">
                                <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Urine</th>
                                    <th>Weight</th>
                                    <th>BP</th>
                                    <th>HB</th>
                                    <th>Pallor</th>
                                    <th>Maturity</th>
                                    <th>Fundal Height</th>
                                    <th>Presentation</th>
                                    <th>Lie</th>
                                    <th>Foetal Heart</th>
                                    <th>Foetal Movement</th>
                                </tr>
                                </thead>
                                <tbody>

                                <?php foreach ($subsequent_anc as $one) {?>
                                    <tr>
                                        <td><?php echo $one['created_at'];?></td>
                                        <td><?php echo $one['urine'];?></td>
                                        <td><?php echo $one['weight'];?></td>
                                        <td><?php echo $one['bp'];?></td>
                                        <td><?php echo $one['hb'];?></td>
                                        <td><?php echo $one['pallor'];?></td>
                                        <td><?php echo $one['maturity'];?></td>
                                        <td><?php echo $one['fundal_height'];?></td>
                                        <td><?php echo $one['presentation'];?></td>
                                        <td><?php echo $one['lie'];?></td>
                                        <td><?php echo $one['foetal_heart'];?></td>
                                        <td><?php echo $one['foetal_mvt'];?></td>
                                    </tr>
                                <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    <?php } ?>

                        <?php if (sizeof($appointmentdetails) > 0) { ?>
                                <div class="card-body"><h5 class="card-title">APPOINTMENT DETAILS</h5>
                            <hr>
                                <div class="row">
                                    <div class="position-relative row form-group col-sm-12"><label for="exampleEmail"                                                                                                   class="col-sm-2 col-form-label"><b>Date</b></label>
                                        <label for="exampleEmail"class="col-sm-2 col-form-label"><b>Status</b></label>
                                        <label for="exampleEmail"                                               class="col-sm-5 col-form-label"><b>Comments</b></label>
                                        <label for="exampleEmail"class="col-sm-3 col-form-label"><b>Appointed
                                                By</b></label>
                                    </div>

                                </div>
                                <?php foreach ($appointmentdetails as $key) { ?>

                                    <div class="row">
                                        <div class="position-relative row form-group col-sm-12"><label
                                                    for="exampleEmail"                                                    class="col-sm-2 col-form-label"><?php echo date('d/m/Y', strtotime($key['appointment_date'])); ?></label>
                                            <label for="exampleEmail"                                                   class="col-sm-2 col-form-label"><?php if ($key['status'] == "seen") { ?>
                                                    <span class="badge badge-success">seen</span>
                                                <?php } else { ?><span
                                                        class="badge badge-danger">pending</span> <?php } ?></label>
                                            <label for="exampleEmail"                                                   class="col-sm-5 col-form-label"><?php echo $key['comments']; ?></label>
                                            <label for="exampleEmail"                                                   class="col-sm-3 col-form-label"><?php echo $key['uname']; ?></label>
                                        </div>
                                    </div>
                                     </div>
                                <?php }
                            } ?>
                        
                        <?php
                        if (sizeof($labdetails) > 0) {
                            ?>
                            <div class="card-body"><h5 class="card-title">LABTESTS DETAILS</h5>
                        <hr>
                            <div class="row alert alert-info">
                                <div class="position-relative row form-group col-sm-6"><label for="exampleEmail"                                                                                              class="col-sm-5 col-form-label"><b>Status:</b></label>
                                    <label for="exampleEmail"                                           class="col-sm-7 col-form-label"><?php if ($labdetails[0]['labstatus'] == "seen") { ?>
                                            <span class="badge badge-success">seen</span>
                                        <?php } else { ?><span class="badge badge-danger">pending</span> <?php } ?>
                                    </label>
                                </div>

                                <div class="position-relative row form-group col-sm-6"><label for="exampleEmail"                                                                                              class="col-sm-5 col-form-label"><b>Results
                                            By:</b></label>
                                    <label for="exampleEmail"                                           class="col-sm-7 col-form-label"><?php if ($labdetails[0]['labstatus'] == "seen") {
                                            echo $labdetails[0]['tests_by']; ?>

                                        <?php } else { ?><span class="badge badge-danger">In Queue</span> <?php } ?>
                                    </label>
                                </div>

                                <div class="position-relative row form-group col-sm-6"><label for="exampleEmail"                                                                                              class="col-sm-5 col-form-label"><b>Requested
                                            By:</b></label>
                                    <label for="exampleEmail"                                           class="col-sm-7 col-form-label"><?php echo $labdetails[0]['requested_by']; ?></label>
                                </div>


                            </div>
                            <div class="row">
                                <div class="position-relative row form-group col-sm-12"><label for="exampleEmail"                                                                                               class="col-sm-3 col-form-label"><b>Test</b></label>
                                    <label for="exampleEmail"class="col-sm-7 col-form-label"><b>Results</b></label>
                                    <label for="exampleEmail"class="col-sm-2 col-form-label"><b>Attachment</b></label>
                                </div>

                            </div>

                            <?php
                            foreach ($labdetails as $key) {
                                ?>
                                <div class="row">
                                    <div class="position-relative row form-group col-sm-12"><label for="exampleEmail"                                                                                                   class="col-sm-3 col-form-label"><?php echo $key['test_name']; ?></label>
                                        <textarea class="col-sm-7 form-control" <?php if(in_array($key['test_id'], ['20','26','27','28','11','13','22'])){?> hidden <?php }?> rows="4"
                                                  disabled><?php echo $key['test_result']; ?></textarea>
                                        <?php if(in_array($key['test_id'], ['20','26','27','28','11','13','22'])){?>
                                        
                                            <a href="<?php echo base_url(); ?>queue/print_labtest/<?php echo $key['test_id']; ?>/<?php echo $labdetails[0]['requested_by']; ?>/<?php echo $labdetails[0]['tests_by']; ?>/<?php echo $ticket_id;?>"
                                               target="popup"
                                               onclick="window.open('<?php echo base_url(); ?>queue/print_labtest/<?php echo $key['test_id']; ?>/<?php echo $labdetails[0]['requested_by']; ?>/<?php echo $labdetails[0]['tests_by']; ?>/<?php echo $ticket_id;?>','popup','width=1200,height=700'); return false;"
                                               class="btn btn-warning" role="button"
                                               style="max-height: 40px;margin: 5px;">Generate & View</a>

                                        <?php }?>          
                                        <?php if ($key['attachment']) { ?>
                                            <a href="<?php echo base_url(); ?>queue/labattachment/<?php echo $key['attachment']; ?>"
                                               target="popup"
                                               onclick="window.open('<?php echo base_url(); ?>queue/labattachment/<?php echo $key['attachment']; ?>','popup','width=600,height=600'); return false;"
                                               class="btn btn-success" role="button"
                                               style="max-height: 40px;margin: 5px;">View Attachment</a>
                                        <?php } ?>
                                    </div>
                                </div>
                                </div>
                            <?php }
                        } ?>

                        <?php if (sizeof($dressing) > 0) { ?>
                        <div class="card-body"><h5 class="card-title">DRESSING DETAILS</h5>
                        <hr>

                        <table class="mb-0 table table-striped">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Amount</th>
                                    <th>Created At</th>
                                </tr>
                                </thead>
                                <tbody>

                                <?php $i=0; $amount=0; foreach ($dressing as $one) { $i++; $amount += $one['amount']; ?>
                                    <tr>
                                        <td><?php echo $i;?></td>
                                        <td><?php echo $one['cost_name'];?></td>
                                        <td><?php echo $one['amount'];?></td>
                                        <td><?php echo $one['created_at'];?></td>
                                    </tr>
                                <?php } ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="1"></td>
                                        <td><em><i>Total</i></em></td>
                                        <td><?php echo $amount; ?></td>
                                    </tr>
                                </tfoot>
                            </table>

                    </div>
                <?php }?>
                           
                    
                </div>
            </div>
        </div>