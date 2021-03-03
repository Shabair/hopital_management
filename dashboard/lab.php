<?php include'../db/db.php';?>
<?php include'../main/head.php';?>


<body>
<div id="wrapper">
<?php include 'hospSidebar.php'?>
<section>
	<a href="addLab.php" class="btn btn-info btn-md" style="float:right;">
	  <span class="glyphicon glyphicon-plus-sign"></span> Add New Test Report
	</a>
<legend class="text-center"></legend>
<button type="button" onclick="printJS('myTable', 'html')"><span class="glyphicon glyphicon-print"></span></button>
<div id="demo"></div>
<div class="table-responsive">
<div class="clearfix">
<div class="col-md-2">
<select class="form-control opt" id="searchOption" onchange="myFunction()">
  <option value="labId">Lab Id
  <option value="labTestDate">Lab Test Date
 <!-- <option value="doctorName">Doctor Name
  <option value="patientName">Patient Name
  <option value="patientPhone">Phone -->
</select>
</div>
<div class="col-md-6">
<input id="searchValue" class="search form-control input-md" onkeyup="myFunction()" type="text" name="search" placeholder="Search"></input>
</div>
</div>

<table class="table table-bordered" id="myTable">
		<thead>
			<tr>
			<center><td style='text-align:center;' colspan='10'><h3> Record of Lab Test Reports</h3></td></center>
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
				<th>Action</th>
			</tr>
		</thead>
		<tbody id="labRow">
		
		</tbody>

</table>
</div>
</section>
</div>
<script>
function myFunction(){
	var searchOption = $("#searchOption").val();
	var searchValue = $("#searchValue").val();
  
	// alert(searchOption);
	if(searchOption == 'labTestDate'){
		$("#searchValue").attr("type","date");
	}else{
		$("#searchValue").attr("type","text");
	}
	$.ajax({
		method:"POST",
		url:"insert.php?p=getLabRow",
		data:"searchOption="+searchOption+"&searchValue="+searchValue,
		dataType:"TEXT",
		success: function(response){
			// alert(response);
		$("#labRow").html(response);			
		}
	});
} 

$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip();   
});
</script>
</body>
</html>