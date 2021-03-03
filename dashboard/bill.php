<?php include'../db/db.php';?>
<?php include'../main/head.php';?>
<style>
table{
	border:1px solid black;
	border-collapse: collapse;
}
.upp{
	border:1px solid black;

}
td{
	padding:5px;
}
</style>
<body>
<div id="wrapper">
<?php include 'hospSidebar.php'?>

<section>
<form class="form-inline">
<fieldset>
<button type="button" onclick="printJS('myTable', 'html')"><span class="glyphicon glyphicon-print"></span></button>
 <button onclick="printData()" class="glyphicon glyphicon-print"></button> 
<?php 
$today = date("Y-m-d");
if(!empty($_GET['invid'])){
	
$invoiceId = $_GET['invid'];
$sql = "SELECT * FROM invoice WHERE invoiceId = '$invoiceId'";	
}
if(!empty($_GET['id'])){
	
$patientId = $_GET['id'];

$sql = "SELECT * FROM invoice WHERE patientId = '$patientId'";	
}
$query = mysqli_query($connect_me, $sql);
if(mysqli_num_rows($query) > 0){
	
while($row=mysqli_fetch_assoc($query)){

$sql4 = "SELECT * FROM patient WHERE patientId = '".$row['patientId']."'";
$query4 = mysqli_query($connect_me, $sql4);
while($row4 = mysqli_fetch_assoc($query4)){
	$patientName = $row4['patientName'];
	$patientNameOf = $row4['patientNameOf'];
	$patientAge = $row4['patientAge'];
	$patientGender = $row4['patientGender'];
	$patientDisease = $row4['patientDisease'];
	$admDate = date('d-m-Y', strtotime($row4['admDate']));
	if($row4['dischargeDate'] == null){
	$disDate = "Not Discharge";
	}else{
	$disDate = date('d-m-Y', strtotime($row4['dischargeDate']));
	}
	
}

?>
<div class="table-responsive">
<table id="myTable" border="1" cellpadding="5" width="100%" height="100vh" style="border-collapse:collapse;">
<?php

echo '
<tr><td colspan="2"><p class="text-right">Invoice ID: <strong>'.$row['invoiceId'].'</p></strong></td></tr>
<tr><td colspan="2"><center><h2>Zohra Memorial Hospital <br> Patient Discharge Slip</h2></center></td></tr>
	<tr class="upp"><td><p>Name: <strong>'.$patientName.'</strong></p></td>
	<td><p>S/D/W: <strong>'.$patientNameOf.'</strong></p></td></tr>
	<tr class="upp"><td><p>Age: <strong>'.$patientAge.'</strong></p></td>
	<td><p>Date of Admission: <strong>'.$admDate.'</strong></p></td></tr>
	<tr class="upp"><td><p>Date of Discharge(If): <strong>'.$disDate.'</strong></p></td>
	<td><p>Disease: <strong>'.$patientDisease.'</strong></p></td></tr>
	<tr>
	<td><h4 style="float:right;">Child Spec: </h4></td><td><h4  >'.$row['childSpec'].'</h4><br></td>
	</tr>
	<tr>
	<td><h4 style="float:right;">Surgeon Fee: </h4></td><td><h4  >'.$row['surgeonFee'].'</h4><br></td>
	</tr>
	<tr>
	<td><h4 style="float:right;">Anesthesia Fee: </h4></td><td><h4  >'.$row['anesthesiaFee'].'</h4><br></td>
	</tr>
	<tr>
	<td><h4 style="float:right;">OTA Fee: </h4></td><td><h4  >'.$row['OTAFee'].'</h4><br></td>
	</tr>
	<tr>
	<td><h4 style="float:right;">Hospital Charges: </h4></td><td><h4  >'.$row['hospitalCharges'].'</h4><br></td>
	</tr>
	<tr>
	<td><h4 style="float:right;">Admission Fee: </h4></td><td><h4  >'.$row['admissionFee'].'</h4><br></td>
	</tr>
	<tr>
	<td><h4 style="float:right;font-weight:bold;">Total  Bill: </h4></td><td><h4 style="font-weight:bold;">'.$row['total'].'</h4><br></td>
	</tr>
	<td><h4 style="float:right;float:right;">Received/Advance: </h4></td><td><h4  >'.$row['received'].'</h4><br></td>
	</tr>
	</tr>
	<td><h4 style="float:right;font-weight:bold;">Amount Payable: </h4></td><td><h4 style="float:left;font-weight:bold;">'.$row['balance'].'</h4><br></td>
	</tr>
	<tr class="up"><td colspan="2"><h4>Received the Sum of <strong>'.$row['total'].'</strong> Dated: <strong>'.date('d-m-Y', strtotime($today)).'</strong></h4></td></tr>

';

?>
</table>
</div>
</div>
</fieldset>
</form>

<?php }}
else{
echo "<br><tr><td><div class='form-group'>";
	echo "<label class='control-label'>Status:</label>";
		echo "<div class='col-sm-10'>";
			echo "<p class='form-control-static'>Nothing is Pending</p>";		
	echo "</div>";
echo "</div></td></tr>";
}
?>
</section>
	
</div>
<script>	 
function printData()
{
   var divToPrint=document.getElementById("myTable");
   newWin= window.open("");
   newWin.document.write(divToPrint.outerHTML);
   window.location.assign("invoice.php");
   newWin.print();
   newWin.window.open("invoice.php");
   // window.location.assign("patient_bill.php?invid="+invoiceId);
   
}
</script>
</body>
</html>	