<?php include'../db/db.php';?>
<?php include'../main/head.php';?>

<body>
<div id="wrapper">
<?php include 'hospSidebar.php'?>
<section>
	<a href="addLab.php" class="btn btn-info btn-md" style="float:right;">
	  <span class="glyphicon glyphicon-plus-sign"></span> Add New Lab 
	</a>
	 <button onclick="printData()" class="glyphicon glyphicon-print"></button> 

<!--<button type="button" onclick="printJS('myTable', 'html')"><span class="glyphicon glyphicon-print"></span></button> -->
<legend class="text-center"></legend>
<div id="demo"></div>
<div class="table-responsive">
	<div class="clearfix">
			<div class="col-md-2">
				<select class="form-control" id="searchvalue" onchange="myFunction()">
				  <option disabled selected value="">Search
				  <option value="1">Serial No
				  <option value="3">Doctor Name
				  <option value="4">Patient Name
				  <option value="7">Phone
				  <option value="2">Date
				</select>
			</div>

			<div class="col-md-2">
				<input  class="form-control input-md" onkeyup="myFunction()" id="search_input" type="text" name="search" placeholder="Search"></input>
			</div>
		
		
			<div class="col-md-2">
				<select class="form-control" id="columnData" onchange="reportValue(this.value)">
				  <option disabled selected value="">Reports
				  <option value="overAll">OverAll
				  <option value="patientId">Patient
				  <option value="doctorId">Doctor
				  <option value="catId">Test
				</select>
			</div>	
	
		  <div class="col-md-2" id="tests" >
			<?php 
			$sql2 = "SELECT * FROM cat WHERE catType = 'labTest'";
			$query2 = mysqli_query($connect_me, $sql2);
			echo "<select id='catId' name='catId' style='width:100%;' onchange='getCustomLab()' class='form-control js-example-basic-single'>";
					echo "<option value=''>Choose Tests</option>";
			  while($row2 = mysqli_fetch_assoc($query2)){
				  echo "<option value='".$row2["catId"]."'>".$row2["catName"]." (".$row2["catPrice"].")</option>";
			  }
			echo "</select>";
			?>
		  </div>
		  <div class="col-md-2" id="doctor">
			<?php 
			$sql2 = "SELECT * FROM doctor WHERE activated = '1'";
			$query2 = mysqli_query($connect_me, $sql2);
			echo "<select id='doctorId' name='doctorId' style='width:100%;' onchange='getCustomLab()'  class='form-control js-example-basic-single'>";
					echo "<option value=''>Choose Doctor</option>";
			  while($row2 = mysqli_fetch_assoc($query2)){
				  echo "<option value='".$row2["doctorId"]."'>".$row2["doctorName"]."</option>";
			  }
			echo "</select>";
			?>
		  </div>
		<div class="col-md-3 reDate">
			<input  class="form-control input-md" onchange="getCustomLab()" id="frmDate" type="date" ></input>
		</div>
		<div class="col-md-3 reDate">
			<input  class="form-control input-md" onchange="getCustomLab()" id="toDate" type="date"></input>
		</div>		
<script>
function myFunction() {

  var input, filter, table, tr, td, i;
  input = document.getElementById("search_input");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable");
  tr = table.getElementsByTagName("tr");

  var x = document.getElementById("searchvalue").value;
  
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[x];
    if (td) {
      if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }
  }
}
</script>
<table width="100%" id="myTable" border="1" cellpadding="5" style="border-collapse:collapse;padding-bottom:100px;">
		<thead>
			<tr>
			<center><td style='text-align:center;' colspan='9'><h3> Record of Lab Test Reports - <span id="labTestCatName"></span> - From <span id="frm"></span> to <span id="to"></span></h3></td></center>
			</tr>
			<tr class="default">
				<th>Sr#</th>
				<th>Lab Id</th>
				<th>Lab Test Date</th>
				<th>Prescribed By</th>
				<th>Patient Name</th>
				<th>Patient Age</th>
				<th>Patient Address</th>
				<th>Patient Phone</th>
				<th>Total</th>
			</tr>
		</thead>
		<tbody id="reportLabData">
		
		</tbody>

</table>
</div>
</section>
</div>
<script>
// $("#patient").hide();
$("#tests").hide();
$("#doctor").hide();

function reportValue(rv){
	if(rv == "patientId"){
		$("#tests").hide();	
		$("#doctor").hide();	
	}else if(rv == "doctorId"){
		$(".reDate").removeClass("col-md-3");
		$(".reDate").addClass("col-md-2");
		$("#doctor").fadeIn();	
		$("#patient").hide();	
		$("#tests").hide();	
	}else if(rv == 'catId'){
		$(".reDate").removeClass("col-md-3");
		$(".reDate").addClass("col-md-2");
		$("#tests").fadeIn();	
		$("#patient").hide();	
		$("#doctor").hide();	
	}else{
		$(".reDate").removeClass("col-md-2");
		$(".reDate").addClass("col-md-3");		
		$("#patient").hide();	
		$("#tests").hide();	
		$("#doctor").hide();	
	}
	getCustomLab();
}

function getCustomLab(){
	
	var rv = $("#columnData").val();
	var patientId = $("#patientId").val();
	var doctorId = $("#doctorId").val();
	var catId = $("#catId").val();
	if(rv == "patientId"){
		catId = "";
		dataId = patientId;
		patientName(dataId);
	}
	if(rv == "doctorId"){
		catId = "";
		dataId = doctorId;
		doctorName(dataId)
	}
	if(rv == "catId"){
		dataId = "";
		catName(catId);
	}
	if(rv == "overAll"){
		catId = "";
		dataId = rv;
	}
	// alert(rv);
	var frmDate = $("#frmDate").val();
	var toDate = $("#toDate").val();
	$("#frm").html(frmDate);
	$("#to").html(toDate);
	
	// alert(doctorId);
	// alert(frmDate);
	// alert(toDate);
	$.ajax({
		method:"POST",
		url:"insert.php?p=getInvoiceLabReport",
		dataType:"TEXT",
		data:"column="+rv+"&frmDate="+frmDate+"&toDate="+toDate+"&catId="+catId+"&dataId="+dataId,
		success: function(response){
			// alert(response);
			$("#reportLabData").html(response);
			// if(rv == 'patientId'){
			// catName(dataId, frmDate, toDate);
			// }
			// clearform();
			// window.location.assign("patientinfo.php?id="+response.patientId);
		}
	});

}

function catName(abc){
	$.ajax({
		method:"POST",
		url:"insert.php?p=getCatName",
		dataType:"JSON",
		data:"catId="+abc,
		success: function(respo){
			// alert(respo);
			$("#labTestCatName").html(respo.catName);			
			// clearform();
			// window.location.assign("patientinfo.php?id="+response.patientId);
		}
	});	
}

function doctorName(dId){
	$.ajax({
		method:"POST",
		url:"insert.php?p=getDoctorName",
		dataType:"JSON",
		data:"doctorId="+dId,
		success: function(respo){
			// alert(respo);
			$("#labTestCatName").html(respo.doctorName);			
			// clearform();
			// window.location.assign("patientinfo.php?id="+response.patientId);
		}
	});	
}


function patientName(pId){
	$.ajax({
		method:"POST",
		url:"insert.php?p=getPatientName",
		dataType:"JSON",
		data:"patientId="+pId,
		success: function(respo){
			// alert(respo);
			$("#labTestCatName").html(respo.patientName);			
			// clearform();
			// window.location.assign("patientinfo.php?id="+response.patientId);
		}
	});	
}

$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip();   
});
</script>
<?php include 'footer.php';?>
</body>
</html>	