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

<legend>Enter The Record of New Test Report</legend>

<p id="result"></p>


<div class="form-group">
  <label class="col-md-4 control-label" for="labId">Lab Test Id</label>  
  <div class="col-md-5">
  <input id="labId" name="labId" disabled class="form-control input-md" required="" type="number">   
  </div>
</div>


	<div class="form-group">
	  <label class="col-md-4 control-label" for="doctorId">Prescribed By:</label>
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
  <label class="col-md-4 control-label" for="patientType">Patient Type</label>  
  <div class="col-md-3">
  <select id="patientStatus" name="patientStatus" onchange="pattype(this.value)" class="form-control" required> 
  <option value="other">Other</option>
  <option value="indoor">Indoor</option>
  <option value="outdoor">Outdoor</option>
	</select>  
  </div>
</div>
<div id="otherType" >
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
</div>
<div id="patient" >
	<div class="form-group">
	  <label class="col-md-4 control-label" for="patientId">Select Patient:</label>
	  <div class="col-md-4">
			<div id="patType">
			
			</div>
	  </div>
	</div>
</div>

<div class="form-group">
  <label class="col-md-4 control-label" for="doctorId">Select Tests:</label>
  <div class="col-md-3">
	<?php 
	$sql2 = "SELECT * FROM cat WHERE catType = 'labTest'";
	$query2 = mysqli_query($connect_me, $sql2);
	echo "<select id='catId' name='catId' onchange='mulLabTest()' class='form-control js-example-basic-multiple' multiple='multiple'>";
			echo "<option value=''>Choose Tests</option>";
	  while($row2 = mysqli_fetch_assoc($query2)){
		  echo "<option value='".$row2["catId"]."'>".$row2["catName"]." (".$row2["catPrice"].")</option>";
	  }
	echo "</select>";
	?>
  </div>
</div>

<div class="form-group">
  <label class="col-md-4 control-label" for="total">Total</label>  
  <div class="col-md-5">
  <input id="total" name="total" class="form-control input-md" required=""  type="number">   
  </div>
</div>

<div class="form-group">
    <label class="col-md-4 control-label"></label>
  <div class="col-sm-2">
  <button onclick="return addLab()" class="btn btn-info btn-block" class="form-control input-sm" required="">Add Detail</button>
  </div>
</div>

</fieldset>
</form>


</section>



<script>
function mulLabTest(){
	var catId = $("#catId").val();
	$.ajax({
		method:"POST",
		url:"insert.php?p=getLabTestPrice",
		data:"catId="+catId,
		dataType:"JSON",
		success: function(resp){
			// alert(resp);
			// var labId = addZero(resp.labId)
			$("#total").val(resp.total);
		}
	});	
	// alert(catId);
}
function orderHide(patientStatus){
	if(patientStatus == "other"){
		$("#patient").fadeOut(1000, "linear");
		// $("#patient").hide();
		$("#otherType").fadeIn(1000, "linear" );
		// $("#otherType").show();
	}else{
		$("#otherType").fadeOut(1000, "linear");
		// $("#otherType").hide();
		$("#patient").fadeIn(1000, "linear");
		// $("#patient").show();
		
		$.ajax({
			method:"POST",
			url:"page.php?p=getPatTypeDetail",
			data:"patType="+patientStatus,
			dataType:"TEXT",
			success: function(r){
				// alert(resp);
				$("#patType").html(r);
			}
		});	
	}	
}
var patientStatus = $("#patientStatus").val();
orderHide(patientStatus);

setInterval(invId, 1000);

function invId(){
	
	$.ajax({
		method:"POST",
		url:"insert.php?p=getLabId",
		dataType:"JSON",
		success: function(resp){
			// alert(resp);
			var labId = addZero(resp.labId)
			$("#labId").val(labId);
		}
	});	
}	
function pattype(pType){
	// alert(pType);
	var patientStatus = $("#patientStatus").val();
	orderHide(patientStatus);

}

function addLab(){
	
	var doctorId = $("#doctorId").val();
	var patientType = $("#patientType").val();
	var patientName = $("#patientName").val();
	var patientNameOf = $("#patientNameOf").val();
	var patientGender = $("#patientGender").val();
	var age= $("#patientAge").val();
	var ageValue = $("#ageValue").val();
	var patientAddress = $("#patientAddress").val();
	var patientStatus = $("#patientStatus").val();
	var patientPhone = $("#patientPhone").val();
	var catId = $("#catId").val();
	var patientId = $("#patientId").val();
	var total = $("#total").val();
	var patientAge = age + ageValue;
	if(catId == "" || total == ""){
		return false;
	}else{
	// alert(patientAddress);
	// alert(patientAge);
	// alert(patientGender); 
	// alert(patientId);
	// alert(patientName);
	// alert(patientNameOf);
	// alert(patientPhone);
	// alert(doctorId);
	// alert(catId);
	$.ajax({
		method:"POST",
		url:"insert.php?p=addLab",
		dataType:"JSON",
		data:"patientName="+patientName+"&patientNameOf="+patientNameOf+"&patientGender="+patientGender+"&patientAge="+patientAge+"&patientAddress="+patientAddress+"&patientPhone="+patientPhone+"&patientStatus="+patientStatus+"&catId="+catId+"&doctorId="+doctorId+"&patientId="+patientId+"&total="+total,
		success: function(response){
			// alert(response);
		$("#result").html(response);			
			clearform();
			window.location.assign("labTestReport.php?id="+response.labId);
		}
	});
	}
} 
</script>
	
</div>
<?php include'footer.php';?>
</body>
</html>	