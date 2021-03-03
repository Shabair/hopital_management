<?php include'../db/db.php';?>
<?php include'../main/head.php';?>


<body>
<div id="wrapper">
<?php include 'hospSidebar.php'?>
<section>
	 <button onclick="printData()" class="glyphicon glyphicon-print"></button> 

<!--<button type="button" onclick="printJS('myTable', 'html')"><span class="glyphicon glyphicon-print"></span></button> -->
<legend class="text-center"></legend>
<div id="demo"></div>
<div class="table-responsive">
	<div class="clearfix">
		<div class="col-md-2">
			<select class="form-control" id="searchvalue" onchange="myFunction()">
			  <option disabled selected value="">Search
			  <option value="1">Invoice ID
			  <option value="2">Token No
			  <option value="3">Patient Name
			  <option value="8">Date
			</select>
		</div>
		<div class="col-md-2">
			<input  class="form-control input-md" onkeyup="myFunction()" id="search_input" type="text" name="search" placeholder="Search"></input>
		</div>
		<div class="col-md-2">
			<select class="form-control" id="iColumnData" onchange="getCustomInvoice()">
			  <option disabled selected value="">Reports
			  <option value="paid">Paid
			  <option value="unpaid">Unpaid
			</select>
		</div>	
		<div class="col-md-3 reDate">
			<input  class="form-control input-md" onchange="getCustomInvoice()" id="frmDate" type="date" ></input>
		</div>
		<div class="col-md-3 reDate">
			<input  class="form-control input-md" onchange="getCustomInvoice()" id="toDate" type="date"></input>
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
			<center><td style='text-align:center;' colspan='10'><h3> Record of Indoor Invoices - <span id="repo"></span> - <span id="frDa"></span> - <span id="toDa"></span></h3></td></center>
			</tr>
			<tr class="default">
				<th>Sr.</th>
				<th>Invoice ID</th>
				<th>Token No</th>
				<th>Name</th>
				<th>Address</th>
				<th>Received</th>
				<th>Status</th>
				<th>Balance</th>
				<th>Date</th>
				<th>Total</th>
			</tr>
		</thead>
		<tbody id='invoiceRowData'>

		</tbody>
</table>
</div>
</section>
</div>
<script>

function getCustomInvoice(){
	
	var iColumnData = $("#iColumnData").val();
	var frmDate = $("#frmDate").val();
	var toDate = $("#toDate").val();
	$("#repo").html(iColumnData);
	$("#frDa").html(frmDate);
	$("#toDa").html(toDate);
	// alert(rv);
	// alert(doctorId);
	// alert(frmDate);
	// alert(toDate);
	$.ajax({
		method:"POST",
		url:"insert.php?p=getInvoiceReport",
		dataType:"TEXT",
		data:"iColumnData="+iColumnData+"&frmDate="+frmDate+"&toDate="+toDate,
		success: function(response){
			// alert(response);
			$("#invoiceRowData").html(response);			
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