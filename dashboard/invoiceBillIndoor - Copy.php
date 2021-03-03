<?php include'../db/db.php';?>
<?php include'../main/head.php';?>
<style type="text/css" media="print">
    @page { 
        size: portrait;
    }
    body { 
        writing-mode: tb-rl;
    }
</style>
<body>
<div id="wrapper">
<?php include 'hospSidebar.php'?>

<section>
<form class="form-inline" method="post" enctype="multipart/form-data">
<fieldset>
<!-- <button type="button" onclick="printJS('myTable', 'html')"><span class="glyphicon glyphicon-print"></span></button> -->
 <button onclick="printData()" class="glyphicon glyphicon-print"></button> 
<?php 
if(!empty($_GET['invid'])){
	
$invoice = $_GET['invid'];
$sql = "SELECT * FROM invoice WHERE invoiceId = '$invoice'";	
}
if(!empty($_GET['id'])){
	
$patient = $_GET['id'];

$sql = "SELECT * FROM invoice WHERE patientId = '$patient'";	
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
	$admDate = date('d-M-Y', strtotime($row4['admDate']));
	if($row4['dischargeDate'] == null){
	$disDate = "Not Discharge";
	}else{
	$disDate = date('d-M-Y', strtotime($row4['dischargeDate']));
	}
	
}
$today = date("Y-m-d");
?>
<div class="table-responsive">
<table width="80%" id="myTable" align="center" border="1" style="border-collapse:collapse;">
<?php

echo '
<tr><td colspan="4"><p style="text-align: right;">Invoice ID: <strong>'.$row['invoiceId'].'</p></strong></td></tr>
<tr>
<td align="center" colspan="1"><img src="../images/invoiceLogo.png" class="img-responsive" width="100px" /></td>
<td colspan="3">
<center>
<h2>Zohra Memorial Hospital </h2><h4>Admission <strong>/</strong> Discharge Slip</h4>
<h5>(UNDER THE MANAGEMENT OF JAFFAR HILBRO TRUST SIALKOT)</h5>
</center>
</td>
</tr>
	<tr class="upp"><td colspan="2"><p>Name: <strong>'.$patientName.'</strong></p></td>
	<td colspan="2"><p>S/D/W: <strong>'.$patientNameOf.'</strong></p></td></tr>
	<tr class="upp"><td colspan="2"><p>Age: <strong>'.$patientAge.'</strong></p></td>
	<td colspan="2"><p>Date of Admission: <strong>'.$admDate.'</strong></p></td></tr>
	<tr class="upp"><td colspan="2"><p>Date of Discharge(If): <strong>'.$disDate.'</strong></p></td>
	<td colspan="2"><p>Disease: <strong>'.$patientDisease.'</strong></p></td></tr>
	<tr>
	<tr style="padding:10px;"><td colspan="2" align="center" ><p><strong>Details of Hospital Charges</strong></p></td>
	<td align="center" ><p><strong>Category</strong></p></td>
	<td align="center" ><p><strong>Amount</strong></p></td>
	<tr>
	<td rowspan="14" colspan="2" align="center">
	<p>
	BTL: Rs. '.$row['BTL'].'<br><hr>
	HCV: Rs. '.$row['HCV'].'<br><hr>
	AC: Rs. '.$row['AC'].'<br><hr>
	Fridge: Rs. '.$row['Fridge'].'<br><hr>
	O<sup>2</sup>: Rs. '.$row['O2'].'<br><hr>
	ExtraDays: Rs. '.$row['ExtraDays'].'<br><hr>
	RoomRent: Rs. '.$row['RoomRent'].'<hr>
	</p>
	</td>
	</tr>
	<tr>
	<td align="center" style="padding:0;margin:0;"><p>Child Spec: </p></td><td  align="center"><p>Rs. '.$row['childSpec'].'</p><br></td>
	</tr>
	<tr>
	<td align="center" ><p>Surgeon Fee: </p></td><td align="center"><p>Rs. '.$row['surgeonFee'].'</p><br></td>
	</tr>
	<tr>
	<td align="center"><p>Anesthesia Fee: </p></td><td align="center"><p>Rs. '.$row['anesthesiaFee'].'</p><br></td>
	</tr>
	<tr>
	<td align="center"><p>OTA Fee: </p></td><td align="center"><p>Rs. '.$row['OTAFee'].'</p><br></td>
	</tr>
	<tr>
	<td align="center"><p>Staff Nurse Charges: </p></td><td align="center"><p>Rs. '.$row['staffNurseCharges'].'</p><br></td>
	</tr>
	<tr>
	<td align="center"><p> Hospital Charges (Total):</p></td><td align="center"><p>Rs. '.$row['hospitalCharges'].'</p><br></td>
	</tr>
	<tr>
	<td align="center"><p>Admission Fee: </p></td><td align="center"><p>Rs. '.$row['admissionFee'].'</p><br></td>
	</tr>
	<tr>
	<td><p style="float:right;font-weight:bold;">Total  Bill: </p></td><td><p style="font-weight:bold;float:left;">Rs. '.$row['total'].'</p><br></td>
	</tr>
	<tr>
	<td align="center"><p>Advance: </p></td><td align="center"><p>Rs. '.$row['advance'].'</p><br></td>
	</tr>
	<tr>
	<td align="center"><p>Discount: </p></td><td align="center"><p>Rs. '.$row['discount'].'</p><br></td>
	</tr>
	<tr>
	<td align="center"><p>Return Amount: </p></td><td align="center"><p>Rs. '.$row['returnCash'].'</p><br></td>
	</tr>	
	<td align="center"><p>Received Remaining: </p></td><td align="center"><p>Rs. '.$row['received'].'</p><br></td>
	</tr>
	</tr>
	<td align="center"><p style="font-weight:bold;">Amount Payable: </p></td><td align="center"><p style="font-weight:bold;">Rs. '.$row['balance'].'</p><br></td>
	</tr>
	<tr class="up"><td colspan="4"><p>with Advance of Rs <strong>'.$row['advance'].'</strong>. Received the Sum of <strong>Rs '.$row['received'].'</strong> Dated: <strong>'.date('d-M-Y', strtotime($row['date'])).'</strong></p></td></tr>

';

?>
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
   newWin.print();
   newWin.close();

   }
</script>
</body>
</html>	