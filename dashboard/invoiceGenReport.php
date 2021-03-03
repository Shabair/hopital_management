<?php include'../db/db.php';?>
<?php include'../main/head.php';?>


<body>
<div id="wrapper">
<?php include 'hospSidebar.php'?>
<section>
	<a href="addInvoiceGen.php" class="btn btn-info btn-md" style="float:right;">
	  <span class="glyphicon glyphicon-plus-sign"></span> Add New Invoice
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
			  <option value="4">Doctor Name
			  <option value="5">Patient Name
			  <option value="8">Phone
			  <option value="2">Date
			</select>
		</div>
		<div class="col-md-2">
			<input  class="form-control input-md" onkeyup="myFunction()" id="search_input" type="text" name="search" placeholder="Search"></input>
		</div>
		<div class="col-md-2">
			<select class="form-control" id="columnData" onchange="reportValue(this.value)">
			  <option disabled selected value="">Reports
			  <option value="doctorId">Doctor
			  <option value="date">OverAll
			</select>
		</div>	
		<div  id="doctorReport">
			<div class="col-md-2">
				<?php 
					$sql2 = "SELECT * FROM doctor WHERE activated = '1'";
					$query2 = mysqli_query($connect_me, $sql2);
					echo "<select id='doctorId' name='doctorId' onchange='getCustomInvoiceGen()' class='form-control'>";
							echo "<option value=''>Choose Doctor</option>";
					  while($row2 = mysqli_fetch_assoc($query2)){
						  echo "<option value='".$row2["doctorId"]."'>".$row2["doctorName"]."</option>";
					  }
					echo "</select>";
				?>
			</div>
		</div>
		<div class="col-md-3 reDate">
			<input  class="form-control input-md" onchange="getCustomInvoiceGen()" id="frmDate" type="date" ></input>
		</div>
		<div class="col-md-3 reDate">
			<input  class="form-control input-md" onchange="getCustomInvoiceGen()" id="toDate" type="date"></input>
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
			<center><td style='text-align:center;' colspan='12'><h3> Record of Outdoor Patient</h3></td></center>
			</tr>
			<tr class="default">
				<th>Sr#</th>
				<th>Serial No</th>
				<th>Date</th>
				<th>Token No</th>
				<th>Doctor Name</th>
				<th>Patient Name</th>
				<th>Patient Age</th>
				<th>Patient Address</th>
				<th>Patient Phone</th>
				<th>H. Charges</th>
				<th>Doctor Fee</th>
				<th>Total</th>
			</tr>
		</thead>
		<tbody id='invoiceGenRowData'>

		</tbody>

</table>
</div>
</section>
</div>
<script>
$("#doctorReport").hide();

function reportValue(rv){
	if(rv == "doctorId"){
		$(".reDate").removeClass("col-md-3");
		$(".reDate").addClass("col-md-2");
		$("#doctorReport").fadeIn();	
	}else{
		$(".reDate").removeClass("col-md-2");
		$(".reDate").addClass("col-md-3");
		$("#doctorReport").fadeOut();		
	}
	getCustomInvoiceGen();
}

function getCustomInvoiceGen(){
	
	var rv = $("#columnData").val();
	var doctorId = $("#doctorId").val();
	if(doctorId == null){
		doctorId = "";
	}
	if(rv == 'date'){
		doctorId = "";
	}
	var frmDate = $("#frmDate").val();
	var toDate = $("#toDate").val();
	// alert(rv);
	// alert(doctorId);
	// alert(frmDate);
	// alert(toDate);
	$.ajax({
		method:"POST",
		url:"insert.php?p=getInvoiceGenReport",
		dataType:"TEXT",
		data:"column="+rv+"&frmDate="+frmDate+"&toDate="+toDate+"&doctorId="+doctorId,
		success: function(response){
			// alert(response);
			$("#invoiceGenRowData").html(response);			
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