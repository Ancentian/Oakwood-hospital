</div>

</div>
</div>
<script type="text/javascript" src="<?php echo base_url(); ?>res/assets/scripts/main.js"></script>


</body>
<!-- The Modal -->
<div class="modal fade" id="fullPayment">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title" style="text-align: center">SELL</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <form method="post" action="<?php echo base_url('pos/sell/1')?>">
                    <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">
                    <div class="form-group">
                        <label for="clName">Client name:</label>
                        <select class="form-control" id="cNameFl" name="cName" readonly style="pointer-events: none">
                            <option value=""></option>
                        <?php if ($clientArr){
                            foreach ($clientArr as $client) {
                                ?>
                            <option value="<?php echo $client['id']?>"><?php echo $client['name']." ".$client['lname']?></option>
                            <?php
                            }
                        } ?>
                            ?>
                        </select>

                        <input type="text" id="ordDetails" name="ordDetails" class="form-control" hidden required>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-4">
                            <label for="amtPaid">Amount to be paid:</label>
                            <input type="number" name="amtPaid" id="amtPaid" class="form-control" readonly required>
                        </div>
                        <div class="form-group col-sm-4">
                            <label for="clName">Total Billed:</label>
                            <input type="text" name="totAmt" id="totAmt" class="form-control" value="<?php echo $grandTot; ?>" readonly required>
                        </div>
                        <div class="form-group col-sm-4">
                            <label for="clName">Previous Due:</label>
                            <input type="text" name="prevDue" id="amtDue" class="form-control" readonly style="color: red">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-6" hidden>
                            <label for="amtPaid">Vat:</label>
                            <input type="text" name="vat" id="vat" class="form-control" readonly required>
                        </div>
                        <div class="form-group col-sm-6">
                            <label for="clName">Discount:</label>
                            <input type="text" name="discount" readonly id="discount" class="form-control" required>
                        </div>
                        <div class="form-group col-sm-6" hidden>
                            <label for="clName">Received by:</label>
                            <input type="text" name="rBy" value="<?php echo $clNm; ?>" class="form-control">
                        </div>
                        <div class="form-group col-sm-6" hidden>
                            <label for="clName">Recepient phone:</label>
                            <input type="text" name="rPhone" value="<?php echo $clPhn; ?>" class="form-control">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="clName">Payment Methods:</label>
                        <div class="row">
                            <div class="col-sm-4">
                                <label for="clName">MPESA: </label>
                                <input type="radio" id="mpesa" name="pmtType" value="mpesa" required>
                            </div>
                            <div class="col-sm-4">
                                <label for="clName">Cash:</label>
                                <input type="radio" id="cash" name="pmtType" value="cash" required>
                            </div>
                            <div class="col-sm-4">
                                <label for="clName">FAMILY BANK:</label>
                                <input type="radio" id="cheque" name="pmtType" value="Family Bank" required>
                            </div>
                            
                        </div>
                        <div class="row">
                            <div class="form-group col-sm-4">
                                <input type="text" id="mpsNumber" name="mpsNumber" class="form-control" placeholder="Mpesa number" disabled>
                            </div>
                            <div class="form-group col-sm-4">
                                <input type="text" id="tID" name="tID" class="form-control" placeholder="Transaction ID" disabled>
                            </div>
                            <div class="form-group col-sm-4">
                                <input type="text" id="chequeNo" name="chequeNo" class="form-control" placeholder="Transaction" disabled >
                            </div>
                        </div>

                    </div>



                    <div class="row">
                        <div class="col-sm-4"></div>
                        <div class="col-sm-4">
                            <input type="submit" value="CONFIRM SALE" class="btn btn-success btn-block">&nbsp;
                            <input type="submit" value="CONFIRM & PRINT" formaction="<?php echo base_url('pos/sellprint/1')?>" class="btn btn-warning btn-block">
                        </div>
                    </div>


                </form>
            </div>


        </div>
    </div>
</div>

<!-- The Modal -->
<div class="modal fade" id="creditPayment">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title" style="text-align: center">SELL</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <form method="post" action="<?php echo base_url('pos/sell/2')?>">
                    <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">
                    <div class="form-group">
                        <label for="clName">Client name:</label>
                        <select class="form-control" id="cNameCrL" name="cName" readonly style="pointer-events: none">
                            <option value=""></option>
                            <?php if ($clientArr){
                                foreach ($clientArr as $client) {
                                    ?>
                                    <option value="<?php echo $client['id']?>"><?php echo $client['name']." ".$client['lname']?></option>
                                    <?php
                                }
                            } ?>
                            ?>
                        </select>
                        <input type="text" id="ordDetailsCr" name="ordDetails" class="form-control" hidden required>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-6">
                            <label for="amtPaid">Amount Paid:</label>
                            <input type="number" name="amtPaid" id="amtPaidCr" onkeyup="computeDueUpCr()" onkeydown="computeDueDownCr()" class="form-control" value="0" required>
                        </div>
                        <div class="form-group col-sm-6">
                            <label for="clName">Total Billed:</label>
                            <input type="text" name="totAmt" id="totAmtCr" class="form-control" readonly required>
                        </div>
                        <div class="form-group col-sm-6">
                            <label for="clName">Previous Due:</label>
                            <input type="text" name="prevDue" id="prevDueCr" class="form-control" readonly style="color: red">
                        </div>
                        <div class="form-group col-sm-6">
                            <label for="clName">Total Due :</label>
                            <input type="text" name="amtDue" id="amtDueCr" class="form-control" readonly style="color: red">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-6" hidden>
                            <label for="amtPaid">Vat:</label>
                            <input type="text" name="vat" id="vatCr" class="form-control" readonly required>
                        </div>
                        <div class="form-group col-sm-6">
                            <label for="clName">Discount:</label>
                            <input type="text" name="discount" readonly id="discountCr" class="form-control" required>
                        </div>
                        <div class="form-group col-sm-6" hidden>
                            <label for="clName">Received by:</label>
                            <input type="text" name="rBy" value="<?php echo $clNm; ?>" class="form-control">
                        </div>
                        <div class="form-group col-sm-6" hidden>
                            <label for="clName">Recepient phone:</label>
                            <input type="text" name="rPhone" value="<?php echo $clPhn; ?>" class="form-control">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="clName">Payment Methods:</label>
                        <div class="row">
                            <div class="col-sm-3">
                                <label for="clName">NONE: </label>
                                <input type="radio" id="noneCr" name="pmtType" value="none" required>
                            </div>
                            <div class="col-sm-3">
                                <label for="clName">MPESA: </label>
                                <input type="radio" id="mpesaCr" name="pmtType" value="mpesa" required>
                            </div>
                            <div class="col-sm-3">
                                <label for="clName">Cash:</label>
                                <input type="radio" id="cashCr" name="pmtType" value="cash" required>
                            </div>
                            <div class="col-sm-3">
                                <label for="clName">FAMILY BANK:</label>
                                <input type="radio" id="chequeCr" name="pmtType" value="Family Bank" required>
                            </div>
                           
                        </div>
                        <div class="row">
                            <div class="form-group col-sm-4">
                                <input type="text" id="mpsNumberCr" name="mpsNumber" class="form-control" placeholder="Mpesa number" disabled>
                            </div>
                            <div class="form-group col-sm-4">
                                <input type="text" id="tIDCr" name="tID" class="form-control" placeholder="Transaction ID" disabled>
                            </div>
                            <div class="form-group col-sm-4">
                                <input type="text" id="chequeNoCr" name="chequeNo" class="form-control" placeholder="Transaction" disabled >
                            </div>
                        </div>

                    </div>



                    <div class="row">
                        <div class="col-sm-4"></div>
                        <div class="col-sm-4">
                            <input type="submit" value="CONFIRM SALE" class="btn btn-success btn-block">
                            <input type="submit" value="CONFIRM & PRINT" formaction="<?php echo base_url('pos/sellprint/2')?>" class="btn btn-warning btn-block">
                        </div>
                    </div>


                </form>
            </div>


        </div>
    </div>
</div>
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>


var allItems = [];

$( document ).ready(function() {
    $('#mainbody').fadeIn();
    $(document).on("wheel", "input[type=number]", function (e) {
        $(this).blur();
    });
    $('#btnCredit').hide();
});

$('#cName').on('change', function() {
    if($(this).val() == "")
    {
        $('#btnCredit').hide();
        $('#btnNow').hide();
    }
    var is_walkin = $(this).find(':selected').data('string')
    if(is_walkin == 1){
        $('#btnCredit').hide();
        $('#btnNow').show();
    }else if(is_walkin == 0){
        $('#btnCredit').show();
        $('#btnNow').show();
    }
});

$("#searchbox").on("keyup", function() {
  var input = $(this).val().toUpperCase();

  $(".single-prod").each(function() {
    if ($(this).data("string").toUpperCase().indexOf(input) < 0) {
      $(this).hide();
    } else {
      $(this).show();
    }
  })
});

    var client = $("#cName").val();
    var origDue;
    function readTable(id)
    {
       var client = $("#cName").val();

        $('#cNameFl').val( client );
        $('#cNameCrL').val( client );
        
        
        console.log(client);
        
        $("#ordDetails").val(JSON.stringify(allItems));
        $("#totAmt").val($("#grandTotal").text());
        $("#vatCr").val("0");
        $("#discountCr").val($("#granddiscount").val());

        $("#ordDetailsCr").val(JSON.stringify(allItems));
        $("#totAmtCr").val($("#grandTotal").text());
        $("#vat").val("0");
        $("#discount").val($("#granddiscount").val());
        clientDue(client,id);

    }
    $('#mpesa').click(function()
    {
        console.log("mpesa");
        $('#mpsNumber').prop('disabled', false);
        // $('#mpsNumber').prop('required', true);
        // $('#tID').prop('required', true);
        $('#chequeNo').prop('required', false);
        $('#tID').prop('disabled', false);
        $('#chequeNo').prop('disabled', true);
    });

    $('#mpesaCr').click(function()
    {
        console.log("mpesa");
        $('#mpsNumberCr').prop('disabled', false);
        // $('#mpsNumberCr').prop('required', true);
        // $('#tIDCr').prop('required', true);
        $('#chequeNoCr').prop('required', false);
        $('#tIDCr').prop('disabled', false);
        $('#chequeNoCr').prop('disabled', true);
    });

    $('#cheque').click(function()
    {
        $('#mpsNumber').prop('disabled', true);
        $('#tID').prop('disabled', true);
        $('#chequeNo').prop('disabled', false);

        $('#mpsNumber').prop('required', false);
        $('#tID').prop('required', false);
        // $('#chequeNo').prop('required', true);
    });
    $('#eqty').click(function()
    {
        $('#mpsNumber').prop('disabled', true);
        $('#tID').prop('disabled', true);
        $('#chequeNo').prop('disabled', false);

        $('#mpsNumber').prop('required', false);
        $('#tID').prop('required', false);
        // $('#chequeNo').prop('required', true);
    });

    $('#chequeCr').click(function()
    {
        $('#mpsNumberCr').prop('disabled', true);
        $('#tIDCr').prop('disabled', true);
        $('#chequeNoCr').prop('disabled', false);

        $('#mpsNumberCr').prop('required', false);
        $('#tIDCr').prop('required', false);
        // $('#chequeNoCr').prop('required', true);
    });
    
    $('#eqtyCr').click(function()
    {
        $('#mpsNumberCr').prop('disabled', true);
        $('#tIDCr').prop('disabled', true);
        $('#chequeNoCr').prop('disabled', false);

        $('#mpsNumberCr').prop('required', false);
        $('#tIDCr').prop('required', false);
        // $('#chequeNoCr').prop('required', true);
    });

    $('#cash').click(function()
    {
        $('#mpsNumber').prop('disabled', true);
        $('#tID').prop('disabled', true);
        $('#chequeNo').prop('disabled', true);

        $('#mpsNumber').prop('required', false);
        $('#tID').prop('required', false);
        $('#chequeNo').prop('required', false);
    });
    
    $('#cashCr').click(function()
    {
        $('#mpsNumberCr').prop('disabled', true);
        $('#tIDCr').prop('disabled', true);
        $('#chequeNoCr').prop('disabled', true);

        $('#mpsNumberCr').prop('required', false);
        $('#tIDCr').prop('required', false);
        $('#chequeNoCr').prop('required', false);
    });
    
    $('#noneCr').click(function()
    {
        $('#mpsNumberCr').prop('disabled', true);
        $('#tIDCr').prop('disabled', true);
        $('#chequeNoCr').prop('disabled', true);

        $('#mpsNumberCr').prop('required', false);
        $('#tIDCr').prop('required', false);
        $('#chequeNoCr').prop('required', false);
    });

    

    function  computeDueUpCr() {
        var originalDue = getDue($('#cName').val());
        var amtPaid = $('#amtPaidCr').val();
        var remPay = amtPaid - $("#totAmtCr").val()+parseFloat($("#discountCr").val());

        var newAmtDue = originalDue - remPay;

        $('#amtDueCr').val(newAmtDue);
        
    }

    

    function  computeDueDownCr() {
        var originalDue = getDue($('#cName').val());
        var amtPaid = $('#amtPaidCr').val();
        var remPay = amtPaid - $("#totAmtCr").val()+parseFloat($("#discountCr").val());

        var newAmtDue = originalDue - remPay;

        $('#amtDueCr').val(newAmtDue);

    }
    function clientDue(id,type)
    {

        if(type == '2'){
            clientDueCr(id);
        }else{
            $("#cName").val(id);
            $("#cNameCr").val(id);
            var allDues = '<?php echo $dueArr; ?>';
            var dueArr = JSON.parse(allDues);
    
            for (var i =0; i<dueArr.length; i++){
                var oneDue = dueArr[i];
                if (oneDue['patient_id'] == id){
                    origDue = oneDue['due']
                    $('#amtDue').val(oneDue['due']);
                    break;
                } else {
                    $('#amtDue').val(0);
                }
            }
            var tot = parseFloat($("#totAmt").val()) + parseFloat($("#amtDue").val())-parseFloat($("#discount").val());
            $("#amtPaid").val(tot);
            
            $('#fullPayment').modal('show');
        }
        
        
    }
    
    function getDue(user){
        var allDues = '<?php echo $dueArr; ?>';
        var dueArr = JSON.parse(allDues);

        for (var i =0; i<dueArr.length; i++){
            var oneDue = dueArr[i];
            if (oneDue['patient_id'] == user){
                var thisDue = oneDue['due'];
                break;
            } else {
                var thisDue = 0;
            }
        }
        return thisDue;
    }

    function clientDueCr(id)
    {
        var allDues = '<?php echo $dueArr; ?>';
        var dueArr = JSON.parse(allDues);

        for (var i =0; i<dueArr.length; i++){
            var oneDue = dueArr[i];
            if (oneDue['patient_id'] == id){
                origDue = oneDue['due']
                $('#prevDueCr').val(oneDue['due']);
                var tot = parseFloat($("#totAmtCr").val()) + parseFloat($("#prevDueCr").val());
                $('#amtDueCr').val(tot);
                break;
            } else {
                $('#amtDueCr').val($("#totAmtCr").val());
                $('#prevDueCr').val(0);
            }
        }
        
        $('#creditPayment').modal('show');
        
        
    }
    
     $('.custom-select').select2();
     
     function addToCart(id){
        var clicked = "#"+id;
        $(clicked).hide();
        //  console.log();
        
        var prodid = $(clicked).data("value");
         
          var prod = '<?php echo json_encode($prodArr,true)?>';
         var prodArr = JSON.parse(prod);
         
        var result = $.grep(prodArr, function(e){ return e.id == prodid; });
        
        var thisprod = result[0];
        totdisc = Math.round(thisprod['cost']*thisprod['disc_perc'] / 100);
        tot = thisprod['cost']-totdisc;
        
        var oneItem = {
                     'prodId': thisprod['id'],
                     "prodName": thisprod['name'],
                     "prodQty" : 1,
                     "prodCost": thisprod['cost'],
                     "prodTax" : 0,
                     "prodDisc" : thisprod['disc_perc'],
                     "prodTot" : thisprod['cost'],
                     "prodTotDisc" : totdisc,
                     "avQty" : thisprod['qty']
                 };
        // console.log(oneItem);
        allItems.push(oneItem);
        
        var html = "<div class='row' id='onerow' style='margin-top: 5px;'>";

            html += "<div class='col-sm-3'><input style='width: 100%' type='hidden' name='prodid[]' id='prodid_"+thisprod['id']+"' class='form-control' required value='"+thisprod['id']+"' readonly><input style='width: 100%' type='text' name='prodname[]' id='prodname_"+thisprod['id']+"' class='form-control' required value='"+thisprod['name']+"' readonly></div>";

            html += "<div class='col-sm-2'><input type='number' name='prodqty[]' id='prodqty_"+thisprod['id']+"' data-value='"+thisprod['id']+"' onkeyup='computetotal(this.id)'  class='form-control' required value='1'></div>";

            html += "<div class='col-sm-2'><input type='text' name='prodprice[]' class='form-control' required id='prodprice_"+thisprod['id']+"' value='"+thisprod['cost']+"' readonly></div>";

            html += "<div class='col-sm-2'><input type='text' name='prodtot[]' id='prodtot_"+thisprod['id']+"'  class='form-control totalprice' required value='"+thisprod['cost']+"' readonly></div>";

            html += "<div class='col-sm-2'><input type='text' name='percdisc[]' id='percdisc_"+thisprod['id']+"'  class='form-control' required value='"+thisprod['disc_perc']+"' onkeyup='computetotaldisc(this.id)'><input type='hidden' name='proddisc[]' id='proddisc_"+thisprod['id']+"'  class='form-control discprice' required value='"+totdisc+"' readonly></div>";

            html += "<div class='col-sm-1'><a class='btn btn-danger' id='removeRow'><span class='fa fa-trash'></span></a></div></div>";
        
        $("#prodrow").append(html);
        
        computegrandtot();
        computediscount();
     }
     
     $(document).on('click', '#removeRow', function () {
            $(this).closest('#onerow').remove();
            computegrandtot();
            computediscount();
    });
    
    function computetotaldisc(thisid){
       
       var res = thisid.split("_");
       var id = res[1];
       var percinput = "#percdisc_"+id;
       var qtyinput = "#prodqty_"+id;
       var totinput = "#prodtot_"+id;
       var discinput = "#proddisc_"+id;
       var priceinput = "#prodprice_"+id;
       
      var prodquantity = $(qtyinput).val();
      if(prodquantity == ""){
          prodquantity = 0;
      }
      
      var proddisc = $(percinput).val();
      if(proddisc == ""){
          proddisc = 0;
      }

      discperc = 0;
      disc = 0;
      
      for(i =0; i<allItems.length; i++){
           var thisitem = allItems[i];
           if(thisitem['prodId'] == id){
                tot = prodquantity*thisitem['prodCost'];
                disc = Math.round(tot*proddisc/100)
                $(discinput).val(disc);
                
               var newItem = {
                     'prodId': thisitem['prodId'],
                     "prodName": thisitem['prodName'],
                     "prodQty" : prodquantity,
                     "prodCost": thisitem['prodCost'],
                     "prodTax" : 0,
                     "prodDisc" : proddisc,
                     "prodTot" : tot,
                     "prodDiscTot" : disc,
                     "avQty" : thisitem['avQty']
                 };
              allItems.splice(i,1); 
              allItems.push(newItem);
           }
       }
      
      var prodprice = $(priceinput).val();
      var totprice = prodprice*prodquantity;
      // var totdisc = prodprice * prodquantity / 
      $(totinput).val(totprice);
      
        computegrandtot();
        computediscount();
   }
    
   function computetotal(thisid){
       
       var res = thisid.split("_");
       var id = res[1];
       var qtyinput = "#prodqty_"+id;
       var totinput = "#prodtot_"+id;
       var discinput = "#proddisc_"+id;
       var priceinput = "#prodprice_"+id;
       
      var prodquantity = $(qtyinput).val();
      if(prodquantity == ""){
          prodquantity = 0;
      }

      discperc = 0;
      disc = 0;
      
      for(i =0; i<allItems.length; i++){
          var extra = 0;
           var thisitem = allItems[i];
           if(thisitem['prodId'] == id){
               if(parseInt(prodquantity) > parseInt(thisitem['avQty'])){
                   prodquantity = thisitem['avQty'];
                   extra = 1;
               }
                tot = prodquantity*thisitem['prodCost'];
                disc = Math.round(tot*thisitem['prodDisc']/100);
                $(discinput).val(disc);
                
               var newItem = {
                     'prodId': thisitem['prodId'],
                     "prodName": thisitem['prodName'],
                     "prodQty" : prodquantity,
                     "prodCost": thisitem['prodCost'],
                     "prodTax" : 0,
                     "prodDisc" : thisitem['prodDisc'],
                     "prodTot" : tot,
                     "prodDiscTot" : disc,
                     "avQty" : thisitem['avQty']
                 };
              allItems.splice(i,1); 
              allItems.push(newItem);
              if(extra == 1){
                  $(qtyinput).val(prodquantity);
                   var alertmsg = "You can't sell more than the remaining in stock!";
                   window.alert(alertmsg);
                   extra = 0;
              }
           }
       }
      
      var prodprice = $(priceinput).val();
      var totprice = prodprice*prodquantity;
      // var totdisc = prodprice * prodquantity / 
      $(totinput).val(totprice);
      
        computegrandtot();
        computediscount();
   }
   
   function computediscount(){
       grandisc = 0
       $('.discprice').each(function(){
            grandisc += parseFloat(this.value);
        });
       if(grandisc == ""){
           grandisc = 0;
       }
       var grandtot = $("#grandTotal").text();
       var tot = grandtot-grandisc;
    //   console.log(tot);
       $("#tot").text(tot);
       $("#granddiscount").val(grandisc);
   }
   
   function computegrandtot(){
        var grandtot = 0;
        $('.totalprice').each(function(){
            grandtot += parseFloat(this.value);
        });
        
        $("#grandTotal").text(grandtot);
   }
  
    
</script>
</html>
