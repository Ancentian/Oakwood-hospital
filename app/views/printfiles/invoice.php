<?php //echo $totpaid;die;?>
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

        #products {
            width: 100%;
        }

        #products tr td {
            font-size: 12px;
        }

        #printbox {
            width: 280px;
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
    </style>
</head>
<body  dir="<?= LTR ?>">

<div id='printbox'>
    <h2 style="margin-top:0" class="text-center">Oakwood Hospital Ltd.<br>
    <b style="font-size: 10px;">Kikuyu / Gikambura/ Dagoretti Road off Southern Bypass</b><br>
    <b style="font-size: 10px;">P O. Box 395-10230</b>
        <br><b style="font-size: 10px;">TEL: 0720 126 297<br>Email: info@oakwoodhospital.co.ke</b></h2>


    <table class="inv_info">
        <tr>
            <td>Patient:</td>
            <td><?php echo ucwords($ticketdetails['pname']); ?> <?php echo ucwords($ticketdetails['mname']); ?> <?php echo ucwords($ticketdetails['lname']); ?></td>
        </tr>
        <tr>
            <td>Patient No:</td>
            <td><?php echo str_pad( $ticketdetails['pid'], 4, "0", STR_PAD_LEFT ); ?></td>
        </tr>
        <tr>
            <td>Invoice no:</td>
            <td>#<?php echo str_pad( $invoice['id'], 4, "0", STR_PAD_LEFT ); ?></td>
        </tr>

        <tr>
            <td>Invoice Date: </td>
            <td><?php echo date('d/m/Y H:s', strtotime($invoice['created_at']))?><br></td>
        </tr>
    </table>
    <hr>
    <table id="products" >
        <tr class="product_row">
            <td colspan="2"><b> Service</b></td>
            <td><b>Cost&nbsp;</b></td>
        </tr>
        <tr>
            <td colspan="3">
                <hr>
            </td>
        </tr>
        <?php
        $this->pheight = 0;

        $this->pheight = $this->pheight + 8;
        if($totcons > 0)
        echo '<tr>
            <td colspan="2">Consultation</td>
             <td> Ksh ' . number_format($totcons). '</td>
            
        </tr>';
        if($totrsb > 0)
        echo '<tr>
            <td colspan="2">RSB</td>
             <td> Ksh ' . $totrsb. '</td>
            
        </tr>';
        if($totmed > 0)
        echo '<tr>
            <td colspan="2">Medication</td>
             <td> Ksh ' . number_format($totmed). '</td>
            
        </tr>';
        if($totlab > 0)
        echo '<tr>
            <td colspan="2">Labtests</td>
             <td> Ksh ' . number_format($totlab). '</td>
            
        </tr>';
        if($totwaiver > 0)
        echo '<tr>
            <td colspan="2">Waiver Amount</td>
             <td> Ksh ' . number_format($totwaiver). '</td>
            
        </tr>';
        if($totrad > 0)
        echo '<tr>
            <td colspan="2">Radiology screening</td>
             <td> Ksh ' . number_format($totrad). '</td>           
        </tr>';
        if($totmisc > 0){
        foreach($miscdetails as $one){
            echo '<tr>
            <td colspan="2">'.$one['cost_name'].'</td>
             <td> Ksh ' . number_format($one['amount']). '</td></tr>';
         }}
             echo '<tr><td colspan="3">&nbsp;</td></tr>';
        ?>

    </table>
    <hr>
    <table class="inv_info">
        <tr>
            <td><b>Total</b></td>
            <td><b>Ksh. <?php echo number_format($total); ?></b></td>
        </tr>


    </table>

    <hr>
    <div class="text-center">  ** Powered by: Fortsort 0724654191 **</div>


</div>
</body>
</html>
