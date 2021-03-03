<?php include'../db/db.php';?>
<?php include'../main/head.php';?>


<body>
<div id="wrapper">

<?php include 'hospSidebar.php'?>
<section>
	<a href="addPatient.php" class="btn btn-info btn-md" style="float:right;">
	  <span class="glyphicon glyphicon-plus-sign"></span> Add New Patient
	</a>
<legend class="text-center"></legend>
<button type="button" onclick="printData()"><span class="glyphicon glyphicon-print"></span></button>
<div id="demo"></div>
<div class="table-responsive">
<div class="clearfix">
<div class="col-md-2">
<select class="form-control" id="searchvalue">
  <option value="patientId">Token ID
  <option value="patientName">Name
  <option value="patientPhone">Mob
  <option value="admDate">Admission Date
  <option value="dischargeDate">Discharge Date
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
<table http-equiv="refresh" content="1" class="table table-bordered" id="myTable">
		<thead>
			<tr>
			<center><td style='text-align:center;' colspan='12'><h3> Record of Indoor Patient</h3></td></center>
			</tr>
			<tr class="default">
				<th>Sr.</th>
				<th>Token ID</th>
				<th>Name</th>
				<th>S/D/W Of</th>
				<th>Age</th>
				<th>Gender</th>
				<th>Address</th>
				<th>Phone</th>
				<th>Doctor</th>
				<th>Adm Date</th>
				<th>Discharge Date</th>
				<th>Action</th>
			</tr>
		</thead>
		<tbody id="fetchInvoicePatientData">
		
		</tbody>

</table>
</div>
</section>

<!-- Modal -->
<div id="editModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Update the Record of Indoor Patient</h4>
      </div>
      <div class="modal-body">
	  

		<form id="myForm" class="form-horizontal" method="post">
		<fieldset>
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
		  <label class="col-md-4 control-label" for="patientAge">Enter Age (in Years)</label>  
		  <div class="col-md-5">
		  <input id="patientAge" name="patientAge" class="form-control input-md" required="" type="number" max="999">   
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
		  <label class="col-md-4 control-label" for="doctorId">Select Doctor:</label>
		  <div class="col-md-3">
			<?php 
			$sql2 = "SELECT * FROM doctor WHERE activated = '1'";
			$query2 = mysqli_query($connect_me, $sql2);
			echo "<select id='doctorId' name='doctorId' class='form-control'>";
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
		  <input id="admDate" name="admDate" class="form-control input-md" required="" type="date">   
		  </div>
		</div>


		<div class="form-group">
			<label class="col-md-4 control-label"></label>
		  <div class="col-sm-2">
				  <button onclick="return patient()" class="btn btn-info btn-block" type="button" required="">Update</button>

		  </div>
		</div>

		</fieldset>
		</form>

	   
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
<script>

function myFunction(){
var sColumn = $("#searchvalue").val();	
var sData = $("#search_input").val();
if(sColumn == 'admDate' || sColumn == 'dischargeDate' ){
		$("#search_input").attr("type","date");
	}else{
		$("#search_input").attr("type","text");
	}
	$.ajax({
		method:"POST",
		url:"insert.php?p=getInvoicePatientData",
		dataType:"TEXT",
		data:"sColumn="+sColumn+"&sData="+sData,
		success: function(response){
			// alert(response);
		$("#fetchInvoicePatientData").html(response);			
			// clearform();
			// window.location.assign("invoiceBill.php?id="+response.invoiceGenId);
		}
	});
}

function prompt(id) {
    if(confirm("Do you want to Delete!")){
	// alert(val);

	$.ajax({
		method: "post",
		dataType: "text",
		url: 'ajax.php?p=delPaId',
		data: 'delPaId='+id,
		success: function(data){
			document.getElementById("demo").innerHTML = data;
			setTimeout(location.reload.bind(location), 1000);
			// $('$demo').html(data)
		}
		
		});
	return true;	
    }
	else {
	return false;
    }
}

$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip();   
});

$(document).ready(function() {
	$(document).on('click','.editData',function() {
		var patientId = $(this).attr("id");	
		// alert(patientId);
		$.ajax({
				method:"POST",
				url:"modalData.php?p=updateIndoorPatient",
				data:"patientId="+patientId,
				dataType:"JSON",
				success: function(re){
					// alert(re);
					$("#patientName").val(re.patientName);
					$("#patientNameOf").val(re.patientNameOf);
					$("#patientAge").val(re.patientAge);
					$("#patientGender").val(re.patientGender);
					$("#patientAddress").val(re.patientAddress);
					$("#patientPhone").val(re.patientPhone);
					$("#doctorId").val(re.drName);
					$("#admDate").val(re.admDate);
					$("#patientId").val("0000"+re.patientId);
					$("#editModal").modal("show");
				}
		});
	});
});

function patient(){
	
	var patientId = $("#patientId").val();
	var patientName = $("#patientName").val();
	var patientNameOf = $("#patientNameOf").val();
	var patientAge = $("#patientAge").val();
	var patientGender = $("#patientGender").val();
	var patientAddress = $("#patientAddress").val();
	var patientPhone = $("#patientPhone").val();
	var drName = $("#doctorId").val();
	var admDate = $("#admDate").val();
	// alert(drName);
	if(patientName == "" || patientAddress == "" || drName == "" || patientAge == "" || patientGender == "" || admDate == ""){
		return false;
	}else{
		$.ajax({
		method:"POST",
		url:"insert.php?p=editIndoorPatient",
		dataType:"text",
		data:"patientName="+patientName+"&patientNameOf="+patientNameOf+"&patientAge="+patientAge+"&patientGender="+patientGender+"&patientAddress="+patientAddress+"&patientPhone="+patientPhone+"&drName="+drName+"&admDate="+admDate+"&patientId="+patientId,
		success: function(response){
			// alert(response);
			alert("Successfuly Updated");
			$("#result").innerHTML = response;
			window.location.assign("indoorPatient.php");
		}
	});
	}
} 


</script>
</div>

</body>
</html>