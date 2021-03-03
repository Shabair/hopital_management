<?php include'../db/db.php';?>
<?php include'../main/head.php';?>


<body>
<div id="wrapper">
<?php include 'hospSidebar.php'?>
<section>
	<a href="addHospCharges.php" class="btn btn-info btn-md" style="float:right;">
	  <span class="glyphicon glyphicon-plus-sign"></span> Add New HC Invoice
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
			  <option value="1">HC Token ID
			  <option value="3">Patient Name
			  <option value="6">Phone
			  <option value="2">Date
			</select>
		</div>
		<div class="col-md-2">
			<input  class="form-control input-md" onkeyup="myFunction()" id="search_input" type="text" name="search" placeholder="Search"></input>
		</div>
		<div class="col-md-4 reDate">
			<input  class="form-control input-md" onchange="getCustomHC()" id="frmDate" type="date" ></input>
		</div>
		<div class="col-md-4 reDate">
			<input  class="form-control input-md" onchange="getCustomHC()" id="toDate" type="date"></input>
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
			<center><td style='text-align:center;' colspan='9'><h3> Record of Patients <span id="frDa"> </span> to <span id="toDa"></span></h3></td></center>
			</tr>
			<tr class="default">
				<th>Sr#</th>
				<th>HC Invoice ID</th>
				<th>Date</th>
				<th>Patient Name</th>
				<th>Patient Age</th>
				<th>Patient Address</th>
				<th>Patient Phone</th>
				<th>Total</th>
			</tr>
		</thead>
		<tbody id='HCInvoiceRowData'>

		</tbody>

</table>
</div>
</section>
</div>
<script>

function getCustomHC(){
	
	var frmDate = $("#frmDate").val();
	var toDate = $("#toDate").val();
	$("#frDa").html(frmDate);
	$("#toDa").html(toDate);
	// alert(rv);
	// alert(doctorId);
	// alert(frmDate);
	// alert(toDate);
	$.ajax({
		method:"POST",
		url:"insert.php?p=getHCInvoiceReport",
		dataType:"TEXT",
		data:"frmDate="+frmDate+"&toDate="+toDate,
		success: function(response){
			// alert(response);
			$("#HCInvoiceRowData").html(response);			
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