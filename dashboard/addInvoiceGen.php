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

<legend>Enter The Record of New Outdoor Patient</legend>

<p id="result"></p>


<div class="form-group">
  <label class="col-md-4 control-label" for="serialNo">Serial No</label>  
  <div class="col-md-5">
  <input id="serialNo" name="serialNo" disabled class="form-control input-md" required="" type="number">   
  </div>
</div>

<div class="form-group">
  <label class="col-md-4 control-label" for="tokenNo">Token No</label>  
  <div class="col-md-5">
  <input id="tokenNo" name="tokenNo" disabled class="form-control input-md" required="" type="number">   
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
  <label class="col-md-4 control-label" for="patientDisease">Enter Disease</label>  
  <div class="col-md-5">
  <input id="patientDisease" name="patientDisease" class="form-control input-md" required="" type="text">   
  </div>
</div>

<div class="form-group">
  <label class="col-md-4 control-label" for="catId">Select Ward/Type:</label>
  <div class="col-md-3">
	<?php 
	$sql2 = "SELECT * FROM cat WHERE catType = 'outdoor' ORDER BY catName DESC";
	$query2 = mysqli_query($connect_me, $sql2);
	echo "<select id='catId'  name='catId' onchange='balan()' class='form-control js-example-basic-single'>";
		echo "<option value=''>Choose Ward</option>";
      while($row2 = mysqli_fetch_assoc($query2)){
		  echo "<option value='".$row2["catId"]."'>".$row2["catName"]." (".$row2["catPrice"].")</option>";
	  }
    echo "</select>";
	?>
  </div>
</div>

<div class="form-group">
  <label class="col-md-4 control-label" for="doctorId">Select Doctor:</label>
  <div class="col-md-3">
	<?php 
	$sql2 = "SELECT * FROM doctor WHERE activated = '1'";
	$query2 = mysqli_query($connect_me, $sql2);
	echo "<select id='doctorId' name='doctorId' onchange='getTokenNo(this.value)' class='form-control js-example-basic-single'>";
			echo "<option value=''>Choose Doctor</option>";
      while($row2 = mysqli_fetch_assoc($query2)){
		  echo "<option value='".$row2["doctorId"]."'>".$row2["doctorName"]."</option>";
	  }
    echo "</select>";
	?>
  </div>
</div>

<div class="form-group">
  <label class="col-md-4 control-label" for="fee">Enter Fee (Dr. Charges)</label>  
  <div class="col-md-5">
  <input id="fee" name="fee" class="form-control input-md" onkeyup="balan()"  required="" type="number">   
  </div>
</div>

<div class="form-group">
  <label class="col-md-4 control-label" for="otherCharges">Enter Any Other Charges</label>  
  <div class="col-md-5">
  <input id="otherCharges" name="otherCharges" onkeyup="balan()" class="form-control input-md" type="number">   
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
  <button onclick="return invoiceGen()" class="btn btn-info btn-block" class="form-control input-sm" required="">Add Detail</button>
  </div>
</div>

</fieldset>
</form>


</section>



<script>
setInterval(invId, 1000);

function invId(){
	
	$.ajax({
		method:"POST",
		url:"insert.php?p=getInvoiceGenSerialNo",
		dataType:"JSON",
		success: function(resp){
			// alert(resp);
			var serialNo = addZero(resp.serialNo)
			$("#serialNo").val(serialNo);
		}
	});	
}	

function getTokenNo(doctorId){
	$.ajax({
		method:"POST",
		data:"doctorId="+doctorId,
		url:"insert.php?p=getInvoiceGenTokenNo",
		dataType:"JSON",
		success: function(e){
			// alert(e);
			var tokenNo = addZero(e.tokenNo)
			$("#tokenNo").val(tokenNo);
		}
	});	
}

function balan(){
	
	var catId = $("#catId").val();
	
	$.ajax({
		method:"POST",
		data:"catId="+catId,
		url:"insert.php?p=getWardFee",
		dataType:"JSON",
		success: function(re){
			// var catPri = re.catPrice;
			// alert(catPri);
			var fee = $("#fee").val();
			var otherCharges = $("#otherCharges").val();
			// alert(catPri);
			var total = Math.floor(fee) + Math.floor(otherCharges) + Math.floor(re.catPrice);
			$("#total").val(total);
		}
	});	
	

}

function invoiceGen(){
	
	var serialNo = $("#serialNo").val();
	var tokenNo = $("#tokenNo").val();
	var patientName = $("#patientName").val();
	var patientNameOf = $("#patientNameOf").val();
	var patientGender = $("#patientGender").val();
	var age = $("#patientAge").val();
	var ageValue = $("#ageValue").val();
	var patientAddress = $("#patientAddress").val();
	var patientPhone = $("#patientPhone").val();
	var patientDisease = $("#patientDisease").val();
	var catId = $("#catId").val();
	var doctorId = $("#doctorId").val();
	var fee = $("#fee").val();
	var otherCharges = $("#otherCharges").val();
	var total = $("#total").val();
	var patientAge = age + ageValue;

	if(serialNo == "" || tokenNo == "" || catId == "" || doctorId == ""){
		return false;
	}else{
	$.ajax({
		method:"POST",
		url:"insert.php?p=addInvoiceGen",
		dataType:"JSON",
		data:"serialNo="+serialNo+"&tokenNo="+tokenNo+"&patientName="+patientName+"&patientNameOf="+patientNameOf+"&patientGender="+patientGender+"&patientAge="+patientAge+"&patientAddress="+patientAddress+"&patientPhone="+patientPhone+"&patientDisease="+patientDisease+"&catId="+catId+"&doctorId="+doctorId+"&fee="+fee+"&otherCharges="+otherCharges+"&total="+total,
		success: function(response){
			// alert(response);
		// $("#result").html(response);			
			clearform();
			window.location.assign("invoiceBill.php?id="+response.invoiceGenId);
		}
	});
	}
} 
</script>
	
</div>
<?php include'footer.php';?>
</body>
</html>	