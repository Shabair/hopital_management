<?php include'../db/db.php';?>
<?php include'../main/head.php';?>


<body>
<div id="wrapper">
<?php include 'hospSidebar.php'?>

<section>
<form class="form-inline">
<center>
	<div class="form-group">
		  <label class="col-md-4 control-label" for="frmDate">Select From Date</label>  
		<div class="col-md-5">
		  <input id="frmDate" class="form-control input-md" type="date">   
		</div>
	</div>
	<div class="form-group">
		  <label class="col-md-4 control-label" for="toDate">Select To Date</label>  
		<div class="col-md-5">
		  <input id="toDate" onchange="getReport1()" class="form-control input-md"  type="date">   
		</div>
	</div>
</center>
</form>
<legend class="text-center"></legend>
<button type="button" onclick="printJS('myTable', 'html')"><span class="glyphicon glyphicon-print"></span></button>
<div id="demo"></div>
<div class="table-responsive">
<div class="clearfix">
<div class="col-md-2">
<select class="form-control" id="searchvalue" onchange="myFunction()">
  <option value="1">Invoice Id
  <option value="2">Name
  <option value="9">Date
  <option value="3">Type
</select>
</div>
<div class="col-md-6">
<input  class="search form-control input-md" onkeyup="myFunction()" id="search_input" type="text" name="search" placeholder="Search"></input>
</div>
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
<table class="table table-bordered" id="myTable">
		<thead>
			<tr>
			<center><td style='text-align:center;' colspan='9'><h3> Record of Unpaid Indoor Invoices</h3></td></center>
			</tr>
			<tr class="default">
				<th>Sr.</th>
				<th>Invoice ID</th>
				<th>Name</th>
				<th>Address</th>
				<th>Total</th>
				<th>Balance</th>
				<th>Date</th>
				<th>Status</th>
				<th>Action</th>
			</tr>
		</thead>
<?php 
		echo "<tbody id='rowData'>";
			
			
		echo "</tbody>";
?>
</table>
</div>
</section>
</div>


<!-- Modal -->
<div id="inv" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Update the Invoice for Patient</h4>
      </div>
	  
      <div class="modal-body">  
	 <?php include'indoorInvoiceData.php';?>
 

</body>
</html>