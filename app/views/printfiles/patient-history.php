<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Print Invoice</title>
    <style>
        html, body {
            margin: 0;
            padding: 0;
            font-size: 12px;
            background-color: #fff;
        }

        #phistory {
            width: 100%;
            /*margin-top: 30px;
            margin-bottom: 30px;*/
        }

        #phistory tr td {
            font-size: 12px;
        }

        #printbox {
            width: 2480px;
            margin: 5pt;
            padding: 5px;
            text-align: justify;
        }

        .inv_info tr td {
            padding-right: 10pt;
        }

        .product_row {
            margin: 15pt;
        }

        .stamp {
            margin: 5pt;
            padding: 3pt;
            border: 3pt solid #111;
            text-align: center;
            font-size: 20pt;
            color
        }

        .text-center {
            text-align: center;
        }
        .text-left {
            text-align: left;
        }
        .bordered-cell{
            border: 1px solid black;
            border-collapse: collapse;
            padding: 5px;
        }
    </style>
</head>
<body dir="<?= LTR ?>">

<div id='printbox'>
    <table style=" border-collapse: collapse;">
        <tr>
            <td><img src="<?php echo base_url();?>res/assets/images/oakwood.jpeg" style="height: 100px;"></td>
            <td style="padding-left: 20px;"></td>
            <td>
                <h2 style="margin-top:0;font-size: 22px;color: #535354;" class="text-left"><span style="color: #043161;">Oakwood Hospital Ltd.</span><br>
                <b style="font-size: 12px;">Kikuyu / Gikambura/ Dagoretti Road off Southern Bypass<br></b>
                <b style="font-size: 12px;">P O. Box 395-10230<br></b>
                    <br><b style="font-size: 12px;">TEL: 0720 126 297<br>Email: info@oakwoodhospital.co.ke</b></h2>
            </td>
            <td colspan="3" style="color: white; padding-left: 150px;"></td>
            <td style="background-color: #055797;padding-left: 5px;"></td>
            <td style="background-color: #900309;padding-left: 5px;"></td>
            <td style="background-color: #6E6D6D;padding-left: 5px;"></td>
        </tr>
    </table>
    <hr>

    <table class="inv_info">
        <tr class="product_row">
            <td><b>NAME: </b></td>
            <td><?php echo $patientdetails['name']." ".$patientdetails['lname']; ?></td>
            <td><b>AGE: </b></td>
            <td><?php echo(date('Y-m-d') - $patientdetails['dob']); ?></td>
        </tr>
        <tr class="product_row">
            <td><b>GENDER: </b></td>
            <td><?php echo $patientdetails['gender'];?></td>
            
        </tr>
        <tr class="product_row">
            <td><b>PRINTED BY: </b></td>
            <td><?php echo $this->session->userdata('user_aob')->name;?></td>
            <td><b>DATE: </b></td>
            <td><?php echo date('Y-m-d H:i:s');?></td>
        </tr>
        <tr class="product_row">
            <td colspan="4">
               
            </td>
        </tr>
        
    </table>

    <h3>1.)Medication</h3>
<div>
    <table id="phistory" style="border-collapse: collapse;">
        <tr class="product_row" style="background-color: #D6D4D7;">
            <td class="bordered-cell" style="color: #450662;"><b>#</b></td>
            <td class="bordered-cell" style="color: #450662;"><b>MED NAME</b></td>
            <td class="bordered-cell" style="color: #450662;"><b>UNITS</b></td>
            <td class="bordered-cell" style="color: #450662;"><b>PRESC.</b></td>
            <td class="bordered-cell" style="color: #450662;"><b>PRESCRIBED BY</b></td>         
        </tr>
        <?php $i=0; foreach ($medicationdetails as $key) { $i++; ?>
         <tr class="product_row">
            <td class="bordered-cell"><?php echo $i; ?></td>
            <td class="bordered-cell"><?php echo $key['mname']; ?></td>
            <td class="bordered-cell"><?php echo $key['units']; ?></td>
            <td class="bordered-cell"><?php echo $key['prescription']; ?></td>
            <td class="bordered-cell"><?php echo $key['uname']; ?></td>
        </tr>
    <?php }?>     
    </table>
    </div>
    <br>
    <h3>2.) Nursing Cadex</h3>
    <table id="phistory" style="border-collapse: collapse;">
        <tr class="product_row" style="background-color: #D6D4D7;">
            <td class="bordered-cell" style="color: #450662;"><b>#</b></td>
            <td class="bordered-cell" style="color: #450662;"><b>DATE</b></td>
            <td class="bordered-cell" style="color: #450662;"><b>TIME</b></td>
            <td class="bordered-cell" style="color: #450662;"><b>NURSING NOTES</b></td>         
        </tr>
        <?php $i = 1; foreach ($nursing_cadex as $one) { $data = json_decode($one['operation_data'],true); ?>
         <tr class="product_row">
            <td class="bordered-cell"><?php echo $i; ?></td>
            <td class="bordered-cell"><?php echo date('d/m/Y',strtotime($data['created_at'])); ?></td>
            <td class="bordered-cell"><?php echo date('H:i',strtotime($data['created_at'])); ?></td>
            <td class="bordered-cell"><?php echo $data['nursing_notes']; ?></td>
        </tr>
    <?php $i++; } ?>    
    </table>
    <br>

    <h3>3.) Observations</h3>
    <table id="phistory" style="border-collapse: collapse;">
        <tr class="product_row" style="background-color: #D6D4D7;">
            <td class="bordered-cell" style="color: #450662;"><b>#</b></td>
            <td class="bordered-cell" style="color: #450662;"><b>DATE</b></td>
            <td class="bordered-cell" style="color: #450662;"><b>TIME</b></td> 
            <td class="bordered-cell" style="color: #450662;"><b>TEMP.</b></td>
            <td class="bordered-cell" style="color: #450662;"><b>BLOOD PRESSURE</b></td>
            <td class="bordered-cell" style="color: #450662;"><b>PULSE</b></td>
            <td class="bordered-cell" style="color: #450662;"><b>RESP RATE</b></td>         
        </tr>
        <?php $i=1; foreach ($observations as $one) { $data = json_decode($one['operation_data'],true);?> ?>
         <tr class="product_row">
            <td class="bordered-cell"><?php echo $i; ?></td>
            <td class="bordered-cell"><?php echo date('d/m/Y',strtotime($data['created_at'])); ?></td>
            <td class="bordered-cell"><?php echo date('H:i',strtotime($data['created_at'])); ?></td>
            <td class="bordered-cell"><?php echo $data['temp']; ?></td>
            <td class="bordered-cell"><?php echo $data['bp']; ?></td>
            <td class="bordered-cell"><?php echo $data['pulse']; ?></td>
            <td class="bordered-cell"><?php echo $data['resp_rate']; ?></td>
        </tr>
    <?php $i++; }?>     
    </table>
    <br>

    <h3>4.) Blood Transfusion</h3>
     <table id="phistory" style="border-collapse: collapse;">
        <tr class="product_row" style="background-color: #D6D4D7;">
            <td class="bordered-cell" style="color: #450662;"><b>#</b></td>
            <td class="bordered-cell" style="color: #450662;"><b>DATE</b></td>
            <td class="bordered-cell" style="color: #450662;"><b>TIME</b></td> 
            <td class="bordered-cell" style="color: #450662;"><b>TEMP.</b></td>
            <td class="bordered-cell" style="color: #450662;"><b>BLOOD PRESSURE</b></td>
            <td class="bordered-cell" style="color: #450662;"><b>PULSE</b></td>
            <td class="bordered-cell" style="color: #450662;"><b>RESP RATE</b></td>
            <td class="bordered-cell" style="color: #450662;"><b>REMARKS</b></td>         
        </tr>
        <?php $i=1; foreach ($transfusions as $one) { $data = json_decode($one['operation_data'],true);?> ?>
         <tr class="product_row">
            <td class="bordered-cell"><?php echo $i; ?></td>
            <td class="bordered-cell"><?php echo date('d/m/Y',strtotime($data['created_at'])); ?></td>
            <td class="bordered-cell"><?php echo date('H:i',strtotime($data['created_at'])); ?></td>
            <td class="bordered-cell"><?php echo $data['temp']; ?></td>
            <td class="bordered-cell"><?php echo $data['bp']; ?></td>
            <td class="bordered-cell"><?php echo $data['pulse']; ?></td>
            <td class="bordered-cell"><?php echo $data['resp_rate']; ?></td>
            <td class="bordered-cell"><?php echo $data['remarks']; ?></td>
        </tr>
    <?php $i++; }?>     
    </table>
    <br>

    <h3>5.) Nursing Care Plan</h3>
    <table id="phistory" style="border-collapse: collapse;">
        <tr class="product_row" style="background-color: #D6D4D7;">
            <td class="bordered-cell" style="color: #450662;"><b>#</b></td>
            <td class="bordered-cell" style="color: #450662;"><b>DATE</b></td>
            <td class="bordered-cell" style="color: #450662;"><b>ASSESSMENT</b></td> 
            <td class="bordered-cell" style="color: #450662;"><b>NURSING DIAGNOSIS</b></td>
            <td class="bordered-cell" style="color: #450662;"><b>GOAL/OUTCOME CRETERIA</b></td>
            <td class="bordered-cell" style="color: #450662;"><b>NURSING INTERVENTION</b></td>
            <td class="bordered-cell" style="color: #450662;"><b>SCIENTIFIC RATIONALE</b></td>
            <td class="bordered-cell" style="color: #450662;"><b>IMPLEMENTATION</b></td>
            <td class="bordered-cell" style="color: #450662;"><b>EVALUATION</b></td>          
        </tr>
        <?php $i=1; foreach ($nursing_care as $one) { $data = json_decode($one['operation_data'],true);?> ?>
         <tr class="product_row">
            <td class="bordered-cell"><?php echo $i; ?></td>
            <td class="bordered-cell"><?php echo date('d/m/Y',strtotime($data['created_at'])); ?></td>
            <td class="bordered-cell"><?php echo $data['assessment']; ?></td>
            <td class="bordered-cell"><?php echo $data['nursing_diagnosis']; ?></td>
            <td class="bordered-cell"><?php echo $data['outcome_criteria']; ?></td>
            <td class="bordered-cell"><?php echo $data['nursing_intervention']; ?></td>
            <td class="bordered-cell"><?php echo $data['scientific_rationale']; ?></td>
            <td class="bordered-cell"><?php echo $data['implementation']; ?></td>
            <td class="bordered-cell"><?php echo $data['evaluation']; ?></td>
        </tr>
    <?php $i++; }?>     
    </table>
    <br>

    <h3>6.) Other Charges</h3>
    <table id="phistory" style="border-collapse: collapse;">
        <tr class="product_row" style="background-color: #D6D4D7;">
            <td class="bordered-cell" style="color: #450662;"><b>#</b></td>
            <td class="bordered-cell" style="color: #450662;"><b>COST NAME</b></td>
            <td class="bordered-cell" style="color: #450662;"><b>AMOUNT</b></td>
            <td class="bordered-cell" style="color: #450662;"><b>DATE</b></td>
            <td></td>         
        </tr>
        <?php $i = 1;$total = 0; foreach ($costs as $one) {$total += $one['amount']; ?>
         <tr class="product_row">
            <td class="bordered-cell"><?php echo $i; ?></td>
            <td class="bordered-cell"><?php echo $one['cost_name']; ?></td>
            <td class="bordered-cell"><?php echo $one['amount']; ?></td>
            <td class="bordered-cell"><?php echo $one['created_at']; ?></td>
            <td></td>
        </tr>
    <?php $I++; }?> 
        <tr>
            <td class="bordered-cell" colspan="2"></td>
            <td class="bordered-cell"><?php echo $total; ?></td>
            <td class="bordered-cell"></td>
        </tr>    
    </table>
    <br>
   
    <hr>
    <table>
        
        <tr>
           <td colspan="3">
               &nbsp; 
            </td> 
        </tr>
        
        <tr>
           <td>Tests by: </td> 
           <td><?php echo $tests_by;?></td>
        </tr>
         <tr>
           <td colspan="3">
               &nbsp; 
            </td> 
        </tr>
        <tr>
           <td>Sign: </td> 
           <td>................................</td>
        </tr>
        <tr>
           <td colspan="3">
               &nbsp;
            </td> 
        </tr>
        <tr>
           <td colspan="3">
                &nbsp;
            </td> 
        </tr>
        <tr>
           <td>Stamp: </td> 
           <td></td>
        </tr>
        <tr>
           <td colspan="3">
               &nbsp;
            </td> 
        </tr>
        <tr>
           <td colspan="3">
               &nbsp;
            </td> 
        </tr>
    </table>
    
</div>
</body>
</html>
