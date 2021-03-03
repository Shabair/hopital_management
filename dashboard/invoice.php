<?php include'../db/db.php';?>
<?php include'../main/head.php';?>


<body>
<div id="wrapper">
<?php include 'hospSidebar.php'?>

<section>
	<!-- <a href="addInvoice.php" class="btn btn-info btn-md" style="float:right;">
	  <span class="glyphicon glyphicon-plus-sign"></span> Add New Invoice
	</a> -->
<legend class="text-center"></legend>
<button type="button" onclick="printJS('myTable', 'html')"><span class="glyphicon glyphicon-print"></span></button>
<div id="demo"></div>
<div class="table-responsive">
<div class="clearfix">
<div class="col-md-2">
<select class="form-control" id="searchvalue" onchange="myFunction()">
  <option value="invoiceId">Invoice Id
  <option value="patientId">Token No
  <option value="date">Date
</select>
</div>
<div class="col-md-6">
<input  class="search form-control input-md" onkeyup="myFunction()" id="search_input" type="text" name="search" placeholder="Search"></input>
</div>
</div>

<table class="table table-bordered" id="myTable">
		<thead>
			<tr>
			<center><td style='text-align:center;' colspan='10'><h3> Record of Indoor Invoices</h3></td></center>
			</tr>
			<tr class="default">
				<th>Sr.</th>
				<th>Invoice ID</th>
				<th>Token No</th>
				<th>Name</th>
				<th>Address</th>
				<th>Total</th>
				<th>Balance</th>
				<th>Date</th>
				<th>Status</th>
				<th>Action</th>
			</tr>
		</thead>
		<tbody id="fetchInvoiceRowData">
		</tbody>

</table>
</div>
</section>
</div>


<!-- Modal -->
<div id="inv" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Update the Invoice for Patient</h4>
      </div>
      <div class="modal-body">  

		<form id="myForm" class="form-horizontal" method="post">
		<fieldset>

		<p id="result"></p>
		
		<div class="form-group">
		  <label class="col-md-4 control-label" for="invoiceId">Invoice Id</label>  
		  <div class="col-md-5">
		  <input id="invoiceId" name="invoiceId" disabled class="form-control input-md" min="0" type="number">   
		  </div>
		</div>

		
		<div class="form-group">
		  <label class="col-md-4 control-label" for="patientId">Patient Name</label>  
		  <div class="col-md-5">
			<input id="patientId"  type="hidden">   
			<input id="patientName" name="patientName" disabled class="form-control input-md" type="text">   
		  </div>
		</div>
				
		<div class="form-group">
		  <label class="col-md-4 control-label" for="patientDisease">Patiet Disease</label>  
		  <div class="col-md-5">
			<input id="patientDisease" name="patientDisease" placeholder="Not Yet Entered" class="form-control input-md" type="text">   
		  </div>
		</div>
		
		<div class="form-group">
		  <label class="col-md-4 control-label" for="childSpec">Child Spec</label>  
		  <div class="col-md-5">
		  <input id="childSpec" name="childSpec" class="form-control input-md" min="0" value="0" onkeyup="mine()" type="number">   
		  </div>
		</div>

		<div class="form-group">
		  <label class="col-md-4 control-label" for="surgeonFee">Surgeon Fee</label>  
		  <div class="col-md-5">
		  <input id="surgeonFee" name="surgeonFee" class="form-control input-md" min="0" value="0" onkeyup="mine()" required="" type="number">   
		  </div>
		</div>

		<div class="form-group">
		  <label class="col-md-4 control-label" for="anesthesiaFee">Anesthesia Fee</label>  
		  <div class="col-md-5">
		  <input id="anesthesiaFee" name="anesthesiaFee" class="form-control input-md" min="0" value="0" onkeyup="mine()" type="number">   
		  </div>
		</div>

		<div class="form-group">
		  <label class="col-md-4 control-label" for="OTAFee">OTA Fee</label>  
		  <div class="col-md-5">
		  <input id="OTAFee" name="OTAFee" class="form-control input-md" min="0" value="0" onkeyup="mine()" type="number">   
		  </div>
		</div>

		<div class="form-group">
		  <label class="col-md-4 control-label" for="staffNurseCharges">Staff Nurse Charges</label>  
		  <div class="col-md-5">
		  <input id="staffNurseCharges" name="staffNurseCharges" class="form-control input-md" min="0" value="0" onkeyup="mine()" type="number">   
		  </div>
		</div>
		
		
		<div class="form-group">
		  <label class="col-md-4 control-label" for="BTL">BTL (Hospital Charges)</label>  
		  <div class="col-md-5">
		  <input id="BTL" name="BTL" class="form-control input-md" min="0" value="0" onkeyup="hospmine()" type="number">   
		  </div>
		</div>
				
		<div class="form-group">
		  <label class="col-md-4 control-label" for="HCV">HCV (Hospital Charges)</label>  
		  <div class="col-md-5">
		  <input id="HCV" name="HCV" class="form-control input-md" min="0" value="0" onkeyup="hospmine()" type="number">   
		  </div>
		</div>
						
		<div class="form-group">
		  <label class="col-md-4 control-label" for="AC">AC (Hospital Charges)</label>  
		  <div class="col-md-5">
		  <input id="AC" name="AC" class="form-control input-md" min="0" value="0" onkeyup="hospmine()" type="number">   
		  </div>
		</div>
				
		<div class="form-group">
		  <label class="col-md-4 control-label" for="Fridge">Fridge (Hospital Charges)</label>  
		  <div class="col-md-5">
		  <input id="Fridge" name="Fridge" class="form-control input-md" min="0" value="0" onkeyup="hospmine()" type="number">   
		  </div>
		</div>
				
		<div class="form-group">
		  <label class="col-md-4 control-label" for="O2">O2 (Hospital Charges)</label>  
		  <div class="col-md-5">
		  <input id="O2" name="O2" class="form-control input-md" min="0" value="0" onkeyup="hospmine()" type="number">   
		  </div>
		</div>
						
		<div class="form-group">
		  <label class="col-md-4 control-label" for="ExtraDays">Extra Days (Hospital Charges)</label>  
		  <div class="col-md-5">
		  <input id="ExtraDays" name="ExtraDays" class="form-control input-md" min="0" value="0" onkeyup="hospmine()" type="number">   
		  </div>
		</div>
								
		<div class="form-group">
		  <label class="col-md-4 control-label" for="RoomRent">Room Rent (Hospital Charges)</label>  
		  <div class="col-md-5">
		  <input id="RoomRent" name="RoomRent" class="form-control input-md" min="0" value="0" onkeyup="hospmine()" type="number">   
		  </div>
		</div>

		
		<div class="form-group">
		  <label class="col-md-4 control-label" for="hospitalCharges">Hospital Charges(Total)</label>  
		  <div class="col-md-5">
		  <input id="hospitalCharges" name="hospitalCharges" disabled class="form-control input-md" min="0" value="0" onkeyup="mine()" type="number">   
		  </div>
		</div>
		
		<div class="form-group">
		  <label class="col-md-4 control-label" for="admissionFee">Admission Fee</label>  
		  <div class="col-md-5">
		  <input id="admissionFee" name="admissionFee" class="form-control input-md" min="0" value="0" onkeyup="mine()" type="number">   
		  </div>
		</div>

		<div class="form-group">
		  <label class="col-md-4 control-label" for="advance">Advance</label>  
		  <div class="col-md-5">
		  <input id="advance" name="advance" readonly class="form-control input-md" min="0" value="0" type="number">   
		  </div>
		</div>
		
		<div class="form-group">
		  <label class="col-md-4 control-label" for="total">Total Amount</label>  
		  <div class="col-md-5">
		  <input id="total" name="total" class="form-control input-md" min="0" disabled type="number">   
		  </div>
		</div>

		<div class="form-group">
		  <label class="col-md-4 control-label" for="discount">Discount</label>  
		  <div class="col-md-5">
		  <input id="discount" name="discount" onkeyup="balan()" class="form-control input-md" min="0" value="0" type="number">   
		  </div>
		</div>

		<div class="form-group">
		  <label class="col-md-4 control-label" for="returnCash">Return Amount</label>  
		  <div class="col-md-5">
		  <input id="returnCash" name="returnCash" onkeyup="balan()" class="form-control input-md" min="0" value="0" type="number">   
		  </div>
		</div>

		<div class="form-group">
		  <label class="col-md-4 control-label" for="received">Received Amount</label>  
		  <div class="col-md-5">
		  <input id="received" name="received" onkeyup="balan()" class="form-control input-md" min="0" type="number">   
		  </div>
		</div>

		<div class="form-group">
		  <label class="col-md-4 control-label" for="balance">Amount Balance</label>  
		  <div class="col-md-5">
		  <input id="balance" name="balance" class="form-control input-md" min="0" disabled type="number">   
		  </div>
		</div>

		<div class="form-group">
			<label class="col-md-4 control-label"></label>
		  <div class="col-sm-2">
		  <button name="iSubmit" onclick="return invNew()" class="btn btn-info btn-block" type="button" class="form-control input-sm">Update</button>
		  </div>
		</div>

		</fieldset>
		</form>


      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>

<script>
function hospmine(){
	var tot = Math.floor($("#BTL").val()) +  Math.floor($("#HCV").val()) + Math.floor($("#AC").val()) + Math.floor($("#Fridge").val()) + Math.floor($("#O2").val()) +  Math.floor($("#ExtraDays").val()) +  Math.floor($("#RoomRent").val());
		
	$("#hospitalCharges").val(tot);
	mine();
}
function myFunction(){
var sColumn = $("#searchvalue").val();	
var sData = $("#search_input").val();
if(sColumn == 'date'){
		$("#search_input").attr("type","date");
	}else{
		$("#search_input").attr("type","text");
	}
	$.ajax({
		method:"POST",
		url:"insert.php?p=getInvoiceRowData",
		dataType:"TEXT",
		data:"sColumn="+sColumn+"&sData="+sData,
		success: function(response){
			// alert(response);
		$("#fetchInvoiceRowData").html(response);			
			// clearform();
			// window.location.assign("invoiceBill.php?id="+response.invoiceGenId);
		}
	});
}
// $(".checkboxClass").click(function(){
        // var selectedCountry = new Array();
        // var n = $(".checkboxClass:checked").length;
        // if (n > 0){
            // $(".checkboxClass:checked").each(function(){
                // selectedCountry.push($(this).attr("id"));
            // });
			// $("#hospChargesId").val(selectedCountry);
        // }		
    // });
	
// var $cbs = $(':checkbox');
// $cbs.change(function(){
// var total = 0; 
// $cbs.each(function(){
    // if ($(this).is(":checked"))
        // total += parseFloat($(this).val());
// });
// $("#hospitalCharges").val(total);
// mine();
// });
		
function prompt(id) {
    if(confirm("Do you want to Delete!")){
	// alert(val);

	$.ajax({
		method: "post",
		dataType: "text",
		url: "ajax.php?p=delInId",
		data:"id="+id,
		success: function(resp){
			document.getElementById("demo").innerHTML = resp;
			setTimeout(location.reload.bind(location), 1000);
			// $('$demo').html(data)
		}
		
		});
	return true;	
    }
	else {
	return false;
    }
}
$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip();   
});

$(document).ready(function() {
	$(document).on('click','.inv',function() {
		var invoiceId = $(this).attr("id");
		// alert(invoiceId)
		$.ajax({
				method:"POST",
				url:"modalData.php?invoiceId="+invoiceId,
				dataType:"JSON",
				success: function(re){
					// alert(re);					
					$("#patientId").val(re.patientId);
					$("#invoiceId").val(re.invoiceId);					
					$("#patientDisease").val(re.patientDisease);					
					$("#childSpec").val(re.childSpec);
					$("#surgeonFee").val(re.surgeonFee);
					$("#anesthesiaFee").val(re.anesthesiaFee);
					$("#OTAFee").val(re.OTAFee);
					$("#staffNurseCharges").val(re.staffNurseCharges);
					$("#BTL").val(re.BTL);
					$("#HCV").val(re.HCV);
					$("#AC").val(re.AC);
					$("#Fridge").val(re.Fridge);
					$("#O2").val(re.O2);
					$("#ExtraDays").val(re.ExtraDays);
					$("#RoomRent").val(re.RoomRent);
					$("#hospitalCharges").val(re.hospitalCharges);
					$("#admissionFee").val(re.admissionFee);
					$("#advance").val(re.advance);
					$("#received").val(re.received);
					$("#balance").val(re.balance);
					$("#total").val(re.total);
					$("#discount").val(re.discount);
					$("#returnCash").val(re.returnCash);
					$('#inv').modal('show');
				}
		});
	});
});



function invNew(){
	
		var invoiceId = $("#invoiceId").val();
		var patientId = $("#patientId").val();
		var patientDisease = $("#patientDisease").val();
		var childSpec = $("#childSpec").val();
		var surgeonFee = $("#surgeonFee").val();
		var anesthesiaFee = $("#anesthesiaFee").val();
		var OTAFee = $("#OTAFee").val();
		var staffNurseCharges = $("#staffNurseCharges").val();
		var BTL = $("#BTL").val();
		var HCV = $("#HCV").val();
		var AC = $("#AC").val();
		var Fridge = $("#Fridge").val();
		var O2 = $("#O2").val();
		var ExtraDays = $("#ExtraDays").val();
		var RoomRent =$("#RoomRent").val();
		var hospitalCharges = $("#hospitalCharges").val();
		var admissionFee = $("#admissionFee").val();
		var advance = $("#advance").val();
		var received = $("#received").val();
		var balance = $("#balance").val();
		var returnCash = $("#returnCash").val();
		var total = $("#total").val();
		var discount = $("#discount").val();
		// alert(patientId);
		// alert(received);
		if(patientId == "" && received == ""){
			return false;
		}else{
			rem = balan();
			if(rem == "0"){
				var status = "paid";
			}else{
				var status = "unpaid";
			}
		
		$.ajax({
		method:"POST",
		url:"insert.php?p=invEdit",
		dataType:"text",
		data:"patientId="+patientId+"&childSpec="+childSpec+"&patientDisease="+patientDisease+"&surgeonFee="+surgeonFee+"&anesthesiaFee="+anesthesiaFee+"&OTAFee="+OTAFee+"&hospitalCharges="+hospitalCharges+"&invoiceId="+invoiceId+"&admissionFee="+admissionFee+"&staffNurseCharges="+staffNurseCharges+"&advance="+advance+"&received="+received+"&balance="+balance+"&total="+total+"&discount="+discount+"&returnCash="+returnCash+"&BTL="+BTL+"&HCV="+HCV+"&AC="+AC+"&Fridge="+Fridge+"&O2="+O2+"&ExtraDays="+ExtraDays+"&RoomRent="+RoomRent+"&status="+status,
		success: function(response){
			// alert(response);
			alert("Successfuly Updated");
			// $("#demo").innerHTML = response;
			setTimeout(location.reload.bind(location), 1000);
		}
		});
	} 
}
function mine(){
	
	  // var medicine = document.getElementById("medicine").value;
	  // var doctor = document.getElementById("doctor").value;
	  // var room = document.getElementById("room").value;

		var childSpec = $("#childSpec").val();
		var surgeonFee = $("#surgeonFee").val();
		var anesthesiaFee = $("#anesthesiaFee").val();
		var OTAFee = $("#OTAFee").val();
		var hospitalCharges = $("#hospitalCharges").val();
		var staffNurseCharges = $("#staffNurseCharges").val();
		var admissionFee = $("#admissionFee").val();
		
		var tot = Math.floor(childSpec) +  Math.floor(surgeonFee) + Math.floor(anesthesiaFee) + Math.floor(OTAFee) + Math.floor(staffNurseCharges) +  Math.floor(hospitalCharges) +  Math.floor(admissionFee);
		
		// alert(tot);
		$("#total").val(tot);
		balan();
}

function balan(){
	
	var received = $("#received").val();
	var discount = $("#discount").val();
	var returnCash = $("#returnCash").val();
	var total = $("#total").val();
	var advance = $("#advance").val();
	
	var rem = Math.floor(total) - (Math.floor(received) + Math.floor(advance) + Math.floor(discount));

	if(rem < 0){
		rem  = rem + Math.floor(returnCash) ;
	}
	$("#balance").val(rem);
	
	return rem;
}


setInterval(patName, 1000);

function patName(){
	var patientId = $("#patientId").val();
	
$.ajax({
		method:"POST",
		url:"insert.php?p=getPatientName",
		data:"patientId="+patientId,
		dataType:"JSON",
		success: function(resp){
			// alert(resp);
			$("#patientName").val(resp.patientName);
		}
	});
}	

</script>

<?php include'footer.php';?>
</body>
</html>