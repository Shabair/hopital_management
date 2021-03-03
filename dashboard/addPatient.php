<?php include'../db/db.php';?>
<?php include'../main/head.php';?>

<body>
<div id="wrapper">
<?php include 'hospSidebar.php'?>
<section>

<form id="myForm" class="form-horizontal" method="post">
<fieldset>

<legend>Enter The Record of New Indoor Patient</legend>

<p id="result"></p>

<div class="form-group">
  <label class="col-md-4 control-label" for="patientId">Token ID</label>  
  <div class="col-md-5">
  <input id="patientId" name="patientId" class="form-control input-md" required="" disabled type="number">   
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
  <label class="col-md-4 control-label" for="patientGender">Select Gender</label>  
  <div class="col-md-5">
  <select id="patientGender" name="patientGender" class="form-control" required="">   
	<option value="male">Male</option>
	<option value="female">Female</option>
</select>
  </div>
</div>

<div class="form-group">
  <label class="col-md-4 control-label" for="patientAddress">Enter Address</label>  
  <div class="col-md-5">
  <textarea id="patientAddress" name="patientAddress" class="form-control input-md" required="" type="text"></textarea>   
  </div>
</div>


<div class="form-group">
  <label class="col-md-4 control-label" for="patientPhone">Enter Phone</label>  
  <div class="col-md-5">
  <input id="patientPhone" name="patientPhone" class="form-control input-md" placeholder="Leave blank if don't have any"  type="number">   
  </div>
</div>

<div class="form-group">
  <label class="col-md-4 control-label" for="catId">Select Ward/Type:</label>
  <div class="col-md-3">
	<?php 
	$sql2 = "SELECT * FROM cat WHERE catType = 'indoor'";
	$query2 = mysqli_query($connect_me, $sql2);
	echo "<select id='catId'  name='catId' class='form-control js-example-basic-single'>";
		echo "<option value=''>Choose Ward</option>";
      while($row2 = mysqli_fetch_assoc($query2)){
		  echo "<option value='".$row2["catId"]."'>".$row2["catName"]."</option>";
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
	echo "<select id='doctorId' name='doctorId' class='form-control js-example-basic-single'>";
			echo "<option value=''>Choose Doctor</option>";
      while($row2 = mysqli_fetch_assoc($query2)){
		  echo "<option value='".$row2["doctorId"]."'>".$row2["doctorName"]."</option>";
	  }
    echo "</select>";
	?>
  </div>
</div>


<div class="form-group">
  <label class="col-md-4 control-label" for="admDate">Admission Date</label>  
  <div class="col-md-5">
  <input id="admDate" name="admDate" class="form-control input-md" required="" value="<?php echo date("Y-m-d"); ?>" type="date">   
  </div>
</div>

<div class="form-group">
  <label class="col-md-4 control-label" for="advance"> Advance Charges</label>  
  <div class="col-md-5">
  <input id="advance" name="advance" class="form-control input-md" required="" type="number">   
  </div>
</div>

<div class="form-group">
  <label class="col-md-4 control-label" for="admissionFee"> Admission Charges</label>  
  <div class="col-md-5">
  <input id="admissionFee" name="admissionFee" class="form-control input-md" required="" type="number">   
  </div>
</div>


<div class="form-group">
    <label class="col-md-4 control-label"></label>
  <div class="col-sm-2">
		  <button onclick="return patient()" class="btn btn-info btn-block" type="button" required="">Generate Token</button>

  </div>
</div>

</fieldset>
</form>


</section>



<script>

setInterval(patId, 1000);

function patId(){
	
$.ajax({
		method:"POST",
		url:"insert.php?p=getPatientId",
		dataType:"JSON",
		success: function(resp){
			var pId = addZero(resp.patientId)
			$("#patientId").val(pId);
		}
	});
}	

function patient(){
	
	var patientName = $("#patientName").val();
	var patientNameOf = $("#patientNameOf").val();
	var age = $("#patientAge").val();
	var ageValue = $("#ageValue").val();
	var patientGender = $("#patientGender").val();
	var patientAddress = $("#patientAddress").val();
	var patientPhone = $("#patientPhone").val();
	var doctorId = $("#doctorId").val();
	var catId = $("#catId").val();
	var admDate = $("#admDate").val();
	var advance = $("#advance").val();
	var admissionFee = $("#admissionFee").val();
	var patientAge = age + ageValue;
	// alert(catId);
	if(patientName == "" || catId == "" || advance == ""){
		return false;
	}else{
		$.ajax({
		method:"POST",
		url:"insert.php?p=addIndoorPatient",
		dataType:"JSON",
		data:"patientName="+patientName+"&patientNameOf="+patientNameOf+"&patientAge="+patientAge+"&patientGender="+patientGender+"&patientAddress="+patientAddress+"&patientPhone="+patientPhone+"&doctorId="+doctorId+"&catId="+catId+"&admDate="+admDate+"&advance="+advance+"&admissionFee="+admissionFee,
		success: function(response){
			// alert(response);
			// $("#result").html(response);			
			clearform();
			window.location.assign("patientinfo.php?id="+response.patientId);
		}
	});
	}
} 

</script>
	
</div>
<?php include'footer.php';?>
</body>
</html>	