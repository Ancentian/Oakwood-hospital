<div class="app-main__outer">
    <div class="app-main__inner">

        <div class="row">
            <div class="col-md-1"></div>
            <div class="col-md-10" style="padding-top: 20px;">
                <div class="main-card mb-3 card">
                    <div class="card-body"><h5 class="card-title">ADD TRIAGE</h5>
                        <hr>
                        <?php if($totaldue > 0){ ?>
                            <div class="alert alert-warning"> This patient's total due balance: <b>Ksh <?php echo $totaldue;?></b></div>
                        <?php } else if($totaldue == '0'){ ?>
                            <div class="alert alert-success"> This patient's total due balance: <b>Ksh <?php echo $totaldue;?></b></div>
                        <?php } ?>
                        <div class="alert alert-info">
                            <table width="100%">
                                <tr>
                                    <th>Name:</th>
                                    <td><?php echo $ticket_details['pname']." ".$ticket_details['mname']." ".$ticket_details['lname'];?></td>
                                    <td></td>
                                    <th>Patient No:</th>
                                    <td><?php echo str_pad( $ticket_details['pid'], 4, "0", STR_PAD_LEFT ); ?></td>
                                </tr>
                            </table>
                        </div>
                        <?php if ($is_direct == '0') {
                           ?>
                        <form class="" method="post" action="<?php echo base_url(); ?>queue/save_labtest" enctype="multipart/form-data">
                            <div class="row">
                                <div class="alert alert-warning col-sm-12" style="text-align: center;">Add lab results and
                                    attach a file(optional)
                                </div>
                                <?php foreach ($test_details as $key) { ?>
                                    <input type="hidden" name="tests[]" value="<?php echo $key['id'];?>">
                                    <div class="position-relative row form-group col-sm-12" style="border-bottom: 1px solid grey;margin-left: 5px;padding-bottom: 5px;"><label for="exampleEmail"  class="col-sm-3 col-form-label"><b><?php echo $key['name'] ?>: </b></label>
                                        <div class="col-sm-9">
                                            <textarea <?php if(in_array($key['id'], ['20','26','27','28','11','13','22'])){?> hidden <?php }?> name="comments[]" class="form-control" rows="5" placeholder="<?php echo $key['name'] ?> results"></textarea>
                                            <?php if($key['id'] == "28"){?>
                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <textarea name="stool_microscopy" class="form-control" placeholder="Stool Microscopy"></textarea>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <textarea name="stool_macroscopy" class="form-control" placeholder="Stool Macroscopy"></textarea>
                                                    </div>
                                                    
                                                </div>
                                            <?php } ?>

                                             <?php if($key['id'] == "26"){?>
                                                <div class="row">
                                                    <div class="col-sm-4">
                                                        <input type="text" name="creatinine" class="form-control" placeholder="Creatinine">
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <input type="text" name="urea" class="form-control" placeholder="Urea">
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <input type="text" name="sodium" class="form-control" placeholder="Sodium">
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <input type="text" name="potassium" class="form-control" placeholder="Potassium">
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <input type="text" name="chloride" class="form-control" placeholder="Chloride">
                                                    </div>
                                                </div>
                                            <?php } ?> 

                                            <?php if($key['id'] == "11"){?>
                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <textarea class="form-control" name="urine_macroscopy" placeholder="Urine Macroscopy"></textarea>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <textarea class="form-control" name="urine_microscopy" placeholder="Urine Microscopy"></textarea>
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <input type="text" name="leuc" class="form-control" placeholder="Leuc">
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <input type="text" name="nitrites" class="form-control" placeholder="Nitrites">
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <input type="text" name="urobilinogen" class="form-control" placeholder="Urobilinogen">
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <input type="text" name="protein" class="form-control" placeholder="Protein">
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <input type="text" name="ph" class="form-control" placeholder="PH">
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <input type="text" name="blood" class="form-control" placeholder="Blood">
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <input type="text" name="sg" class="form-control" placeholder="Sg">
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <input type="text" name="ketons" class="form-control" placeholder="Ketons">
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <input type="text" name="bil" class="form-control" placeholder="Bil">
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <input type="text" name="glucose" class="form-control" placeholder="Glucose">
                                                    </div>

                                                </div>

                                            <?php } ?> 

                                            <?php if($key['id'] == "22"){?>
                                                <div class="row">
                                                    
                                                    <div class="col-sm-3 mb-2">
                                                        <input type="text" name="blood_grp" class="form-control" placeholder="Blood Group">
                                                    </div>
                                                    <div class="col-sm-3 mb-2">
                                                        <input type="text" name="rhesus" class="form-control" placeholder="Rhesus">
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <input type="text" name="hb" class="form-control" placeholder="HB">
                                                    </div>
                                                    <div class="col-sm-3 mb-2">
                                                        <input type="text" name="vdrl" class="form-control" placeholder="VDRL">
                                                    </div>
                                                    <div class="col-sm-3 mb-2">
                                                        <input type="text" name="hbsag" class="form-control" placeholder="HBSAG">
                                                    </div>
                                                    <div class="col-sm-3 mb-2">
                                                        <input type="text" name="hiv_aids" class="form-control" placeholder="HIV/AIDS">
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-sm-6 mb-2">
                                                        <textarea class="form-control" name="urine_macroscopy" placeholder="Urine Macroscopy"></textarea>
                                                    </div>
                                                    <div class="col-sm-6 mb-2">
                                                        <textarea class="form-control" name="urine_microscopy" placeholder="Urine Microscopy"></textarea>
                                                    </div>
                                                </div>

                                            <?php } ?> 

                                            <?php if($key['id'] == "27"){?>
                                                <div class="row">
                                                    
                                                    <div class="col-sm-3">
                                                        <input type="text" name="wbc" class="form-control" placeholder="wbc">
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <input type="text" name="lymph" class="form-control" placeholder="lymph">
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <input type="text" name="neut" class="form-control" placeholder="neut">
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <input type="text" name="mid" class="form-control" placeholder="mid">
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <input type="text" name="neut_pc" class="form-control" placeholder="neut %">
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <input type="text" name="lymph_pc" class="form-control" placeholder="lymph %">
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <input type="text" name="mid_pc" class="form-control" placeholder="mid %">
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <input type="text" name="hb" class="form-control" placeholder="hb">
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <input type="text" name="rbc" class="form-control" placeholder="rbc">
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <input type="text" name="hct" class="form-control" placeholder="hct">
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <input type="text" name="mcv" class="form-control" placeholder="mcv">
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <input type="text" name="mch" class="form-control" placeholder="mch">
                                                    </div>                                                                                  <div class="col-sm-3">
                                                        <input type="text" name="mchc" class="form-control" placeholder="mchc">
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <input type="text" name="rdw_cv" class="form-control" placeholder="rdw_cv">
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <input type="text" name="rdw_sd" class="form-control" placeholder="rdw_sd">
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <input type="text" name="plt" class="form-control" placeholder="plt">
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <input type="text" name="mpv" class="form-control" placeholder="mpv">
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <input type="text" name="pct" class="form-control" placeholder="pct">
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <input type="text" name="pdw_pc" class="form-control" placeholder="pdw %">
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <input type="text" name="plcr_pc" class="form-control" placeholder="plcr %">
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <input type="text" name="mcv" class="form-control" placeholder="mcv">
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <input type="text" name="mch" class="form-control" placeholder="mch">
                                                    </div>


                                                </div>

                                            <?php } ?> 

                                            <?php if($key['id'] == "13"){?>
                                                <div class="row">
                                                    <div class="col-sm-3">
                                                        <input type="text" name="albumin" class="form-control" placeholder="Albumin">
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <input type="text" name="alkp" class="form-control" placeholder="ALKP">
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <input type="text" name="bil_direct" class="form-control" placeholder="BIL DIRECT">
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <input type="text" name="bil_total" class="form-control" placeholder="BIL TOTAL">
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <input type="text" name="got" class="form-control" placeholder="GOT">
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <input type="text" name="gpt" class="form-control" placeholder="GPT">
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <input type="text" name="protein" class="form-control" placeholder="Protein">
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <input type="text" name="ggt" class="form-control" placeholder="gGT">
                                                    </div>
                                                </div>

                                            <?php } ?>

                                            <?php if($key['id'] == "20"){?>
                                                <div class="row">
                                                    <div class="col-sm-3">
                                                        <input type="text" name="tf3" class="form-control" placeholder="TF3">
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <input type="text" name="ft4" class="form-control" placeholder="FT4">
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <input type="text" name="t3" class="form-control" placeholder="T3">
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <input type="text" name="tsh" class="form-control" placeholder="TSH">
                                                    </div>
                                                </div>

                                            <?php } ?>    
                                        </div>
                                    </div>
                                <?php } ?>

                                <div class="position-relative row form-group col-sm-12"><label for="exampleEmail" class="col-sm-4 col-form-label">Attach
                                        file(optional)</label>
                                    <div class="col-sm-8">
                                        <input class="form-control" data-height="40" type='file' name='file' id="file"
                                               size='2000'
                                               style=" border: 1px !important;outline: 1 !important; opacity: 1 !important;"/>
                                    </div>
                                </div>

                                <input type="hidden" name="tick_id" value="<?php echo $tick_id; ?>" required>
                                <input type="hidden" name="lab_id" value="<?php echo $lab_id; ?>" required>
                                <input type="hidden" name="mvt_id" value="<?php echo $mvt_id; ?>" required>
                                <div class="position-relative row form-check">
                                    <div class="col-sm-10 offset-sm-2">
                                        <button class="btn btn-success">COMPLETE</button>

                                    </div>
                                </div>

                            </div>


                        </form>
                    <?php }else{
                            if (sizeof($test_details) > 0) {?>

                                <form class="" method="post" action="<?php echo base_url(); ?>queue/save_labtest"
                              enctype="multipart/form-data">
                            <div class="row">
                                <div class="alert alert-warning col-sm-12" style="text-align: center;">Add lab results and
                                    attach a file(optional)
                                </div>
                                <?php foreach ($test_details as $key) { ?>
                                    <input type="hidden" name="tests[]" value="<?php echo $key['id'];?>">
                                    <div class="position-relative row form-group col-sm-12" style="border-bottom: 1px solid grey;margin-left: 5px;padding-bottom: 5px;"><label for="exampleEmail"  class="col-sm-3 col-form-label"><b><?php echo $key['name'] ?>: </b></label>
                                        <div class="col-sm-9">
                                            <textarea <?php if(in_array($key['id'], ['20','26','27','28','11','13'])){?> hidden <?php }?> name="comments[]" class="form-control" rows="5" placeholder="<?php echo $key['name'] ?> results"></textarea>
                                            <?php if($key['id'] == "28"){?>
                                                <div class="row">
                                                    <div class="col-sm-4">
                                                        <input type="text" name="bloody" class="form-control" placeholder="Bloody">
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <input type="text" name="hard" class="form-control" placeholder="Hard">
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <input type="text" name="non_mucoid" class="form-control" placeholder="Non-mucoid">
                                                    </div>
                                                </div>
                                            <?php } ?>

                                             <?php if($key['id'] == "26"){?>
                                                <div class="row">
                                                    <div class="col-sm-4">
                                                        <input type="text" name="creatinine" class="form-control" placeholder="Creatinine">
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <input type="text" name="urea" class="form-control" placeholder="Urea">
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <input type="text" name="sodium" class="form-control" placeholder="Sodium">
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <input type="text" name="potassium" class="form-control" placeholder="Potassium">
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <input type="text" name="chloride" class="form-control" placeholder="Chloride">
                                                    </div>
                                                </div>
                                            <?php } ?> 

                                            <?php if($key['id'] == "11"){?>
                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <textarea class="form-control" name="urine_macroscopy" placeholder="Urine Macroscopy"></textarea>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <textarea class="form-control" name="urine_microscopy" placeholder="Urine Microscopy"></textarea>
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <input type="text" name="leuc" class="form-control" placeholder="Leuc">
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <input type="text" name="nitrites" class="form-control" placeholder="Nitrites">
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <input type="text" name="urobilinogen" class="form-control" placeholder="Urobilinogen">
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <input type="text" name="protein" class="form-control" placeholder="Protein">
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <input type="text" name="ph" class="form-control" placeholder="PH">
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <input type="text" name="blood" class="form-control" placeholder="Blood">
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <input type="text" name="sg" class="form-control" placeholder="Sg">
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <input type="text" name="ketons" class="form-control" placeholder="Ketons">
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <input type="text" name="bil" class="form-control" placeholder="Bil">
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <input type="text" name="glucose" class="form-control" placeholder="Glucose">
                                                    </div>

                                                </div>

                                            <?php } ?> 

                                            <?php if($key['id'] == "27"){?>
                                                <div class="row">
                                                    
                                                    <div class="col-sm-3">
                                                        <input type="text" name="wbc" class="form-control" placeholder="wbc">
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <input type="text" name="lymph" class="form-control" placeholder="lymph">
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <input type="text" name="neut" class="form-control" placeholder="neut">
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <input type="text" name="mid" class="form-control" placeholder="mid">
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <input type="text" name="neut_pc" class="form-control" placeholder="neut %">
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <input type="text" name="lymph_pc" class="form-control" placeholder="lymph %">
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <input type="text" name="mid_pc" class="form-control" placeholder="mid %">
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <input type="text" name="hb" class="form-control" placeholder="hb">
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <input type="text" name="rbc" class="form-control" placeholder="rbc">
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <input type="text" name="hct" class="form-control" placeholder="hct">
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <input type="text" name="mcv" class="form-control" placeholder="mcv">
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <input type="text" name="mch" class="form-control" placeholder="mch">
                                                    </div>                                                                                  <div class="col-sm-3">
                                                        <input type="text" name="mchc" class="form-control" placeholder="mchc">
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <input type="text" name="rdw_cv" class="form-control" placeholder="rdw_cv">
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <input type="text" name="rdw_sd" class="form-control" placeholder="rdw_sd">
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <input type="text" name="plt" class="form-control" placeholder="plt">
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <input type="text" name="mpv" class="form-control" placeholder="mpv">
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <input type="text" name="pct" class="form-control" placeholder="pct">
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <input type="text" name="pdw_pc" class="form-control" placeholder="pdw %">
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <input type="text" name="plcr_pc" class="form-control" placeholder="plcr %">
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <input type="text" name="mcv" class="form-control" placeholder="mcv">
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <input type="text" name="mch" class="form-control" placeholder="mch">
                                                    </div>


                                                </div>

                                            <?php } ?> 

                                            <?php if($key['id'] == "13"){?>
                                                <div class="row">
                                                    <div class="col-sm-3">
                                                        <input type="text" name="albumin" class="form-control" placeholder="Albumin">
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <input type="text" name="alkp" class="form-control" placeholder="ALKP">
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <input type="text" name="bil_direct" class="form-control" placeholder="BIL DIRECT">
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <input type="text" name="bil_total" class="form-control" placeholder="BIL TOTAL">
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <input type="text" name="got" class="form-control" placeholder="GOT">
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <input type="text" name="gpt" class="form-control" placeholder="GPT">
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <input type="text" name="protein" class="form-control" placeholder="Protein">
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <input type="text" name="ggt" class="form-control" placeholder="gGT">
                                                    </div>
                                                </div>

                                            <?php } ?>

                                            <?php if($key['id'] == "20"){?>
                                                <div class="row">
                                                    <div class="col-sm-3">
                                                        <input type="text" name="tf3" class="form-control" placeholder="TF3">
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <input type="text" name="ft4" class="form-control" placeholder="FT4">
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <input type="text" name="t3" class="form-control" placeholder="T3">
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <input type="text" name="tsh" class="form-control" placeholder="TSH">
                                                    </div>
                                                </div>

                                            <?php } ?>    
                                        </div>
                                    </div>
                                <?php } ?>

                                <div class="position-relative row form-group col-sm-12"><label for="exampleEmail" class="col-sm-4 col-form-label">Attach
                                        file(optional)</label>
                                    <div class="col-sm-8">
                                        <input class="form-control" data-height="40" type='file' name='file' id="file"
                                               size='2000'
                                               style=" border: 1px !important;outline: 1 !important; opacity: 1 !important;"/>
                                    </div>
                                </div>

                                <input type="hidden" name="tick_id" value="<?php echo $tick_id; ?>" required>
                                <input type="hidden" name="lab_id" value="<?php echo $lab_id; ?>" required>
                                <input type="hidden" name="mvt_id" value="<?php echo $mvt_id; ?>" required>
                                <div class="position-relative row form-check">
                                    <div class="col-sm-10 offset-sm-2">
                                        <button class="btn btn-success">COMPLETE</button>

                                    </div>
                                </div>

                            </div>


                        </form>
                <?php }else{?>
                    <form class="" method="post" action="<?php echo base_url(); ?>queue/add_direct_labtest">
                    <div class="position-relative row form-group col-sm-12" id="labtests">
                                    <div class="col-sm-12 alert alert-warning"><p>Add labtests to be carried on this patient.</p></div>

                                    <label for="exampleEmail" class="col-sm-3 col-form-label">Lab Tests:</label>
                                    <div class="col-sm-8">
                                        <select class="select form-control" style="width: 100%;" name="labtests[]" multiple required>
                                                    <?php foreach ($labtests as $act) {
                                                            ?>
                                                            <option value="<?php echo $act['id']; ?>"><?php echo $act['name']; ?> (Cost: Ksh.<?php echo $act['cost']; ?> )</option>
                                                        <?php 
                                                    } ?>
                                        </select>
                                    </div>
                                </div>
                                <input type="hidden" name="ticket_id" value="<?php echo $tick_id; ?>" required>
                                <input type="hidden" name="mvt_id" value="<?php echo $mvt_id; ?>" required>
                                <div class="position-relative row form-check">
                                    <div class="col-sm-10 offset-sm-2">
                                        <button class="btn btn-success">ADD TESTS</button>

                                    </div>
                                </div>
                            </form>

                  <?php }} ?>
                    </div>
                </div>
            </div>
        </div>
    </div>