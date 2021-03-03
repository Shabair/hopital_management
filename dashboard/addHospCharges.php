<?php include'../db/db.php';?>
<?php include'../main/head.php';?>
<style>
.form-horizontal .form-group {
    margin-right: 0px; 
    margin-left: 0px; 
}
</style>
<body>
<div id="wrapper">
<?php include 'hospSidebar.php'?>
<section>
<form id="myForm" class="form-horizontal" method="post">
<fieldset>

<legend>Enter The Record of New Accidental Patient</legend>

<p id="result"></p>

<div class="form-group">
  <label class="col-md-4 control-label" for="hospChargesId">HC Token No</label>  
  <div class="col-md-5">
  <input id="hospChargesId" name="hospChargesId" disabled class="form-control input-md" required="" type="number">   
  </div>
</div>

<div class="form-group">
  <label class="col-md-4 control-label" for="patientName">Enter Name</label>  
  <div class="col-md-5">
  <input id="patientName" name="patientName" class="form-control input-md" required="" autofocus type="text">   
  </div>
</div>

<div class="form-group">
  <label class="col-md-4 control-label" for="patientNameOf">Enter S/D/W of Name</label>  
  <div class="col-md-5">
  <input id="patientNameOf" name="patientNameOf" class="form-control input-md" required="" type="text">   
  </div>
</div>

<div class="form-group">
  <label class="col-md-4 control-label" for="patientGender">Select Gender</label>  
  <div class="col-md-5">
  <select id="patientGender" name="patientGender" class="form-control" required="">   
	<option value="male">Male</option>
	<option value="female">Female</option>
	<option value="unspecified">unspecified</option>
</select>
  </div>
</div>

<div class="form-group">
  <label class="col-md-4 control-label" for="patientAge">Enter Age</label>  
  <div class="col-md-5">
  <div class="form-inline">
	  <div class="form-group">
		<input id="patientAge" name="patientAge" class="form-control input-md" required="" type="number">   
	  </div>
	  <div class="form-group">
		<select id="ageValue" name="ageValue" onchange="testest()" class="form-control input-md" required="" type="number">   
			<option value="Y">Years</option>
			<option value="M">Months</option>
			<option value="D">Days</option>
		</select>
	  </div>
	</div>
  </div>
</div>

<div class="form-group">
  <label class="col-md-4 control-label" for="patientAddress">Enter Address</label>  
  <div class="col-md-5">
  <textarea id="patientAddress" name="patientAddress" class="form-control input-md" required="" type="text">   </textarea>
  </div>
</div>

<div class="form-group">
  <label class="col-md-4 control-label" for="patientPhone">Enter Phone (If Any)</label>  
  <div class="col-md-5">
  <input id="patientPhone" name="patientPhone" class="form-control input-md" required=""  type="number">   
  </div>
</div>

<div class="form-group">
  <label class="col-md-4 control-label" for="stitchingCharges">Enter Stitching Charges</label>  
  <div class="col-md-5">
  <input id="stitchingCharges" name="stitchingCharges" onkeyup="balan()" class="form-control input-md" type="number">   
  </div>
</div>

<div class="form-group">
  <label class="col-md-4 control-label" for="dressingCharges">Enter Dressing Charges</label>  
  <div class="col-md-5">
  <input id="dressingCharges" name="dressingCharges" class="form-control input-md" onkeyup="balan()"  required="" type="number">   
  </div>
</div>


<div class="form-group">
  <label class="col-md-4 control-label" for="bedCharges">Enter Bed Charges</label>  
  <div class="col-md-5">
  <input id="bedCharges" name="bedCharges" onkeyup="balan()" class="form-control input-md" type="number">   
  </div>
</div>


<div class="form-group">
  <label class="col-md-4 control-label" for="total">Total</label>  
  <div class="col-md-5">
  <input id="total" name="total" readonly class="form-control input-md" required="" type="number">   
  </div>
</div>

<div class="form-group">
    <label class="col-md-4 control-label"></label>
  <div class="col-sm-2">
  <button onclick="return hospCharges()" class="btn btn-info btn-block" class="form-control input-sm" required="">Add Detail</button>
  </div>
</div>

</fieldset>
</form>


</section>



<script>
setInterval(invHcId, 1000);

function invHcId(){
	
	$.ajax({
		method:"POST",
		url:"insert.php?p=gethospChargesId",
		dataType:"JSON",
		success: function(resp){
			// alert(resp);
			var hospChargesId = addZero(resp.hospChargesId)
			$("#hospChargesId").val(hospChargesId);
		}
	});	
}	

function balan(){
	
	var stitchingCharges = $("#stitchingCharges").val();
	var dressingCharges = $("#dressingCharges").val();
	var bedCharges = $("#bedCharges").val();
	var total = Math.floor(stitchingCharges) + Math.floor(dressingCharges) + Math.floor(bedCharges);
	$("#total").val(total);
	

}

function hospCharges(){
	
	var patientName = $("#patientName").val();
	var patientNameOf = $("#patientNameOf").val();
	var patientGender = $("#patientGender").val();
	var age = $("#patientAge").val();
	var ageValue = $("#ageValue").val();
	var patientAddress = $("#patientAddress").val();
	var patientPhone = $("#patientPhone").val();
	var stitchingCharges = $("#stitchingCharges").val();
	var dressingCharges = $("#dressingCharges").val();
	var bedCharges = $("#bedCharges").val();
	var total = $("#total").val();
	var patientAge = age + ageValue;

	if(total == ""){
		return false;
	}else{
	$.ajax({
		method:"POST",
		url:"insert.php?p=addHospCharges",
		dataType:"JSON",
		data:"patientName="+patientName+"&patientNameOf="+patientNameOf+"&patientGender="+patientGender+"&patientAge="+patientAge+"&patientAddress="+patientAddress+"&patientPhone="+patientPhone+"&stitchingCharges="+stitchingCharges+"&dressingCharges="+dressingCharges+"&bedCharges="+bedCharges+"&total="+total,
		success: function(respons){
			// alert(response);
		// $("#result").html(response);			
			clearform();
			window.location.assign("hospChargesInvoice.php?id="+respons.hospChargesId);
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
<?php include'footer.php';?>
</body>
</html>	