<?php //echo $total;die;?>
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
            <td><?php echo $ticketdetails['pname']; ?> <?php echo $ticketdetails['mname']; ?> <?php echo $ticketdetails['lname']; ?></td>
        </tr>
        <tr>
            <td>Patient No:</td>
            <td><?php echo str_pad( $ticketdetails['pid'], 4, "0", STR_PAD_LEFT ); ?></td>
        </tr>
        <tr>
            <td>Receipt no:</td>
            <td>#<?php echo str_pad( $receipt['id'], 4, "0", STR_PAD_LEFT ); ?></td>
        </tr>
        <tr>
            <td>Receipt Date: </td>
            <td><?php echo date('d/m/Y H:s', strtotime($receipt['created_at']))?><br></td>
        </tr>
    </table>
    <hr>
    <table id="products" >
        <tr class="product_row">
            <td colspan="2"><b> Mode</b></td>
            <td><b>Amount&nbsp;</b></td>
        </tr>
        <tr>
            <td colspan="3">
                <hr>
            </td>
        </tr>
        <?php
        $this->pheight = 0;

        $this->pheight = $this->pheight + 8;
        $mode = json_decode($receipt['mode']);
        $amt = json_decode($receipt['amnt']);
        
        $i=0;
        foreach($mode as $one){
            $onemode = $one;
            $oneamt = $amt[$i];
            
             echo '<tr>
                <td colspan="2"><b>' . $onemode . '</b></td>
                 <td><b> Ksh ' . $oneamt. '</b></td>
                </tr>';
        ?>
        <?php if($onemode == "mpesa"){
             echo '<tr>
            <td colspan="2"><small>Phone No:</small></td>
             <td><small>' . $receipt['phone_no']. '</small></td>
            
        </tr>';
         echo '<tr>
            <td colspan="2"><small>Transaction:</small></td>
             <td><small>' . $receipt['transaction_id']. '</small></td>
            
        </tr><tr><td colspan="3">&nbsp;</td></tr>';
        ?>
            
        <?php } ?>
         <?php if($onemode == "insurance"){
             echo '<tr>
            <td colspan="2"><small>Company:</small></td>
             <td><small>' . $receipt['insurance_company']. '</small></td>
            
        </tr>';
         echo '<tr>
            <td colspan="2"><small>Card no:</small></td>
             <td><small>' . $receipt['card_no']. '</small></td>
            
        </tr>';
         echo '<tr>
            <td colspan="2"><small>Code:</small></td>
             <td><small>' . $receipt['confirmation_code']. '</small></td>
            
        </tr><tr><td colspan="3">&nbsp;</td></tr>';
        ?>
            
        <?php }
        
        $i++;
            }
        ?>
    </table>
    <hr>
   
    <table class="inv_info">
        <tr>
            <td><b>Total</b></td>
            <td><b>Ksh. <?php echo number_format($receipt['amount']) ?></b></td>
        </tr>
        <!-- <tr>
            <td><b>Discount</b></td>
            <td><b>Ksh. <?php //echo $discount; ?></b></td>
        </tr> -->
        <tr>
            <td><b>Total Due</b></td>
            <td><b>Ksh. <?php  echo number_format((float)abs($totpaid -$total), 2,'.','');?></b><?php if(($totpaid -$total)>0){echo "(overpaid) ";} ?></td>
        </tr>

    </table>
    <hr>
    <table>

        <tr>
            <td colspan="3">
                &nbsp;
            </td>
        </tr>

        <tr>
            <td>Received by: </td>
            <td><?php echo $this->session->userdata('user_aob')->name;?></td>
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
    <hr>
    <div class="text-center">** Powered by: Fortsort 0724654191 **</div>


</div>
</body>
</html>
