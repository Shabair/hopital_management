
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
			<input id="patientDisease" name="patientDisease" class="form-control input-md" type="text">   
		  </div>
		</div>
			
		<div class="form-group">
		  <label class="col-md-4 control-label" for="childSpec">Child Spec</label>  
		  <div class="col-md-5">
		  <input id="childSpec" name="childSpec" class="form-control input-md" min="0" value="0" onkeyup="balan()" type="number">   
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
		  <label class="col-md-4 control-label" for="hospitalCharges">Hospital Charges</label>  
		  <div class="col-md-5">
		  <input id="hospitalCharges" name="hospitalCharges" class="form-control input-md" min="0" value="0" onkeyup="mine()" type="number">   
		  </div>
		</div>

		<div class="form-group">
		  <label class="col-md-4 control-label" for="admissionFee">Admission Fee</label>  
		  <div class="col-md-5">
		  <input id="admissionFee" name="admissionFee" class="form-control input-md" min="0" value="0" onkeyup="mine()" type="number">   
		  </div>
		</div>
		<div class="form-group">
		  <label class="col-md-4 control-label" for="OTAFee">Total Amount</label>  
		  <div class="col-md-5">
		  <input id="total" name="total" class="form-control input-md" min="0" disabled type="number">   
		  </div>
		</div>

		<div class="form-group">
		  <label class="col-md-4 control-label" for="advanceCharges">Advance Charges</label>  
		  <div class="col-md-5">
		  <input id="advanceCharges" name="advanceCharges" class="form-control input-md" min="0" value="0" onkeyup="mine()" type="number">   
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
$(".js-example-basic-single").select2({
	placeholder: "Select please",
  allowClear: true
});

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
					$("#childSpec").val(re.childSpec);
					$("#surgeonFee").val(re.surgeonFee);
					$("#anesthesiaFee").val(re.anesthesiaFee);
					$("#OTAFee").val(re.OTAFee);
					$("#hospitalCharges").val(re.hospitalCharges);
					$("#admissionFee").val(re.admissionFee);
					$("#advanceCharges").val(re.advanceCharges);
					$("#received").val(re.received);
					$("#balance").val(re.balance);
					$("#total").val(re.total);
					$("#invoiceId").val(re.invoiceId);					
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
		var hospitalCharges = $("#hospitalCharges").val();
		var admissionFee = $("#admissionFee").val();
		var advanceCharges = $("#advanceCharges").val();
		var received = $("#received").val();
		var balance = $("#balance").val();
		var total = $("#total").val();
		// alert(balance);
		if(patientId == "" && received == ""){
			return false;
		}else{
		
			if(balance == "0"){
			var status = "paid";
			}else{
			var status = "unpaid";
			}
		
		$.ajax({
		method:"POST",
		url:"insert.php?p=invEdit",
		dataType:"text",
		data:"patientId="+patientId+"&childSpec="+childSpec+"&patientDisease="+patientDisease+"&surgeonFee="+surgeonFee+"&anesthesiaFee="+anesthesiaFee+"&OTAFee="+OTAFee+"&hospitalCharges="+hospitalCharges+"&invoiceId="+invoiceId+"&admissionFee="+admissionFee+"&advanceCharges="+advanceCharges+"&received="+received+"&balance="+balance+"&total="+total+"&status="+status,
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
		var admissionFee = $("#admissionFee").val();
		
		var tot = Math.floor(childSpec) + Math.floor(surgeonFee) + Math.floor(anesthesiaFee) + Math.floor(OTAFee) + Math.floor(hospitalCharges)  + Math.floor(admissionFee);
		
		// alert(tot);
		$("#total").val(tot);
		
}

function balan(){
	var received = $("#received").val();
	var total = $("#total").val();
	var advanceCharges = $("#advanceCharges").val();
	
	var rem = Math.floor(total) - Math.floor(received) - Math.floor(advanceCharges);
	
	$("#balance").val(rem);
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

function getReport1(){
	var frmDate = $("#frmDate").val();
	var toDate = $("#toDate").val();
	
	$.ajax({
		method:"POST",
		url:"ajax.php?p=unpaidReport",
		dataType:"TEXT",
		data:"frmDate="+frmDate+"&toDate="+toDate,
		success: function(res){
			$("#rowData").html(res);
		}
	});
}

function getReport(){
	var frmDate = $("#frmDate").val();
	var toDate = $("#toDate").val();
	
	$.ajax({
		method:"POST",
		url:"ajax.php?p=paidReport",
		dataType:"TEXT",
		data:"frmDate="+frmDate+"&toDate="+toDate,
		success: function(res){
			$("#rowData").html(res);
		}
	});
}

</script>
