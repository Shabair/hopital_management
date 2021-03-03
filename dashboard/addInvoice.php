<?php include'../db/db.php';?>
<?php include'../main/head.php';?>

<body>
<div id="wrapper">
<?php include 'hospSidebar.php'?>
<section>

<form id="myForm" class="form-horizontal" method="post">
<fieldset>

<legend>Enter The Record of New Invoice for Indoor Patient</legend>

<p id="result"></p>

<div class="form-group">
  <label class="col-md-4 control-label" for="invoiceId">Invoice ID</label>  
  <div class="col-md-5">
  <input id="invoiceId" name="invoiceId" class="form-control input-md" min="0" disabled type="number">   
  </div>
</div>

<div class="form-group">
  <label class="col-md-4 control-label" for="patient_id">Select Patient</label>  
  <div class="col-md-5">
  <select id="patientId" name="patientId" class='form-control js-example-basic-single' required="">   
	<option value='' readonly >Choose Patient</option>
    <?php 
	$sql = "SELECT * FROM patient WHERE dischargeDate IS NULL OR dischargeDate = '' ORDER BY patientId DESC";
	$query = mysqli_query($connect_me, $sql);
	while($row = mysqli_fetch_assoc($query)){
		$sql1 = "SELECT * FROM invoice WHERE patientId = '".$row['patientId']."' LIMIT 1";
		$query1 = mysqli_query($connect_me, $sql1);
		$row1 = mysqli_fetch_assoc($query1);
		if(($row1['status']) == 'paid'){	
		}else{
			echo "<option value='".$row['patientId']."'>0000".$row['patientId']." - ".$row['patientName']." - ".$row['patientPhone']."</option>";
		}
	} ?>
</select>
  </div>
</div>

<script type="text/javascript">
$(".js-example-basic-single").select2({
	placeholder: "Select please",
  allowClear: true
});
</script>

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
  <input id="received" name="received" onkeyup="balan()" value="0" class="form-control input-md" min="0" type="number">   
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
  <button name="iSubmit" onclick="return invNew()" class="btn btn-info btn-block" type="button" class="form-control input-sm">Add Detail</button>
  </div>
</div>

</fieldset>
</form>


</section>



<script>

setInterval(iId, 1000);

function iId(){
	
$.ajax({
		method:"POST",
		url:"insert.php?p=getInvoiceId",
		dataType:"JSON",
		success: function(resp){
			// alert(resp);
			$("#invoiceId").val(resp.invoiceId);
		}
	});
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

function invNew(){

		var invoiceId = $("#invoiceId").val();
		var patientId = $("#patientId").val();
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
		if(patientId == ""){
			return false;
		}else{
		
			if(balance == "0"){
			var status = "paid";
			}else{
			var status = "unpaid";
			}
		
		$.ajax({
		method:"POST",
		url:"insert.php?p=inv",
		dataType:"text",
		data:"patientId="+patientId+"&childSpec="+childSpec+"&surgeonFee="+surgeonFee+"&anesthesiaFee="+anesthesiaFee+"&OTAFee="+OTAFee+"&hospitalCharges="+hospitalCharges+"&admissionFee="+admissionFee+"&advanceCharges="+advanceCharges+"&received="+received+"&balance="+balance+"&total="+total+"&status="+status,
		success: function(response){
			// alert(response);
		$("#result").html(response);
			clearform();
			// window.location.assign("invoiceBillIndoor.php?invid="+invoiceId);
		window.location.assign("patientInfo.php?id="+patientId);
		}
		});
	} 
}

function clearform(){
	$("#myForm :input").each(function (){
		$(this).val("");
	});
}

</script>
	
</div>
</body>
</html>	