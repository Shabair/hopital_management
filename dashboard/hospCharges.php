<?php include'../db/db.php';?>
<?php include'../main/head.php';?>


<body>
<div id="wrapper">
<?php include 'hospSidebar.php'?>
<section>
	<a href="addHospCharges.php" class="btn btn-info btn-md" style="float:right;">
	  <span class="glyphicon glyphicon-plus-sign"></span> Add New HC Invoice
	</a>
<legend class="text-center"></legend>
<button type="button" onclick="printJS('myTable', 'html')"><span class="glyphicon glyphicon-print"></span></button>
<div id="demo"></div>
<div class="table-responsive">
<div class="clearfix">
<div class="col-md-2">
<select class="form-control" id="searchvalue" onchange="myFunction()">
  <option value="hospChargesId">HC Token ID
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
			<center><td style='text-align:center;' colspan='11'><h3> Record of Patients</h3></td></center>
			</tr>
			<tr class="default">
				<th>Sr#</th>
				<th>HC Token No</th>
				<th>Date</th>
				<th>Patient Name</th>
				<th>Patient Age</th>
				<th>Patient Address</th>
				<th>Patient Phone</th>
				<th>Total</th>
				<th>Action</th>
			</tr>
		</thead>
		<tbody id="getRowHospCharges">
		
		</tbody>
</table>
</div>
</section>
</div>
<script>

function myFunction(){
var sColumn = $("#searchvalue").val();	
var sData = $("#search_input").val();
// alert(sColumn);
// alert(sData);
if(sColumn == 'date'){
		$("#search_input").attr("type","date");
	}else{
		$("#search_input").attr("type","text");
	}
	$.ajax({
		method:"POST",
		url:"insert.php?p=getRowHospCharges",
		dataType:"TEXT",
		data:"sColumn="+sColumn+"&sData="+sData,
		success: function(response){
			// alert(response);
		$("#getRowHospCharges").html(response);			
			// clearform();
			// window.location.assign("invoiceBill.php?id="+response.invoiceGenId);
		}
	});
}
$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip();   
});
</script>
</body>
</html>