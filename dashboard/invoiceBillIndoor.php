<?php include'../db/db.php';?>
<?php include'../main/head.php';?>
<style type="text/css" media="print">
    @page { 
        size: portrait;
    }
    body { 
        writing-mode: tb-rl;
    }	
    .inner-table{
		width: 100%;
    	text-align: center;
	}
	.inner-table tr{
		border-bottom: 1px solid;
	    font-family: verdana;
	    font-size: 16px;
	    height: 45px;
	}
</style>
<style type="text/css">
	.inner-table{
		width: 100%;
    	text-align: center;
	}
	.inner-table-tr{
		border-bottom: 1px solid;font-family: verdana;font-size: 16px;height: 45px;
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
	if($row4['dischargeDate'] != null && $row['status']=='paid'){
		$disDate = date('d-M-Y', strtotime($row4['dischargeDate']));
	}else{
		$disDate = "Not Discharge";
	}
	
}
$today = date("Y-m-d");
?>
<div class="table-responsive">
<table width="80%" id="myTable" align="center" border="1" style="border-collapse:collapse;">
<?php

echo '

<tr>
	<td colspan="4"><p style="text-align: right;">Invoice ID: <strong>'.$row['invoiceId'].'</p></strong></td>
</tr>
<tr>
	<td align="center" colspan="1">
		<img src="../images/invoiceLogo.png" class="img-responsive" width="100px" />
	</td>
	<td colspan="3">
		<center>
			<h2>Zohra Memorial Hospital </h2><h4>Admission <strong>/</strong> Discharge Slip</h4>
			<h5>(UNDER THE MANAGEMENT OF JAFFAR HILBRO TRUST SIALKOT)</h5>
		</center>
	</td>
</tr>
<tr class="upp">
	<td colspan="2"><p>Name: <strong>'.$patientName.'</strong></p></td>
	<td colspan="2"><p>S/D/W: <strong>'.$patientNameOf.'</strong></p></td>
</tr>
<tr class="upp">
	<td colspan="2"><p>Age: <strong>'.$patientAge.'</strong></p></td>
	<td colspan="2"><p>Date of Admission: <strong>'.$admDate.'</strong></p></td>
</tr>
<tr class="upp">
	<td colspan="2"><p>Date of Discharge(If): <strong>'.$disDate.'</strong></p></td>
	<td colspan="2"><p>Disease: <strong>'.$patientDisease.'</strong></p></td>
</tr>
<tr style="padding:10px;">
	<td colspan="2" align="center" ><p><strong>Details of Hospital Charges</strong></p></td>
	<td align="center" ><p><strong>Category</strong></p></td>
	<td align="center" ><p><strong>Amount</strong></p></td>
</tr>
<tr>
	<td rowspan="13" colspan="2" align="center" style="vertical-align: unset;">
		<table style="width: 100%;text-align: center;">
			<tr >
				<td style="height:72px;"></td>
			</tr>
			<tr >
				<td style="height:42px;"></td>
			</tr>
			<tr style="font-family: verdana;font-size: 16px;">
				<td style="border-bottom: 1px solid #000;border-top: 1px solid #000;height: 44px;">BTL: Rs. '.$row['BTL'].'</td>
			</tr>
			<tr style="border-bottom: 1px solid #000;font-family: verdana;font-size: 16px;height: 42px;">
				<td style="border-bottom: 1px solid #000;height: 53px;">HCV: Rs. '.$row['HCV'].'</td>
			</tr>
			<tr>
				<td style="border-bottom: 1px solid #000;height: 42px;">AC: Rs. '.$row['AC'].'</td>
			</tr>
			<tr>
				<td style="border-bottom: 1px solid #000;height: 42px;">Fridge: Rs. '.$row['Fridge'].'</td>
			</tr>
			<tr>
				<td style="border-bottom: 1px solid #000;height: 42px;">O<sup>2</sup>: Rs. '.$row['O2'].'</td>
			</tr>
			<tr>
				<td style="border-bottom: 1px solid #000;height: 42px;">ExtraDays: Rs. '.$row['ExtraDays'].'</td>
			</tr>
			<tr>
				<td style="border-bottom: 1px solid #000;height: 42px;">RoomRent: Rs. '.$row['RoomRent'].'</td>
			</tr>
		</table>
	</td>
	<td align="center" style="padding: 15px 0 15px 0;"><p>Child Spec: </p></td>
	<td  align="center" style="padding: 15px 0 15px 0;"><p>Rs. '.$row['childSpec'].'</p></td>
</tr>
<tr>
	<td align="center" style="padding: 15px 0 15px 0;"><p>Surgeon Fee: </p></td>
	<td align="center" style="padding: 15px 0 15px 0;"><p>Rs. '.$row['surgeonFee'].'</p></td>
</tr>

<tr>
	<td align="center" style="padding: 15px 0 15px 0;"><p>Anesthesia Fee: </p></td>
	<td align="center" style="padding: 15px 0 15px 0;"><p>Rs. '.$row['anesthesiaFee'].'</p></td>
</tr>
<tr>
	<td align="center" style="padding: 15px 0 15px 0;"><p>OTA Fee: </p></td>
	<td align="center" style="padding: 15px 0 15px 0;"><p>Rs. '.$row['OTAFee'].'</p></td>
</tr>
<tr>
	<td align="center" style="padding: 15px 0 15px 0;"><p>Staff Nurse Charges: </p></td>
	<td align="center" style="padding: 15px 0 15px 0;"><p>Rs. '.$row['staffNurseCharges'].'</p></td>
</tr>
<tr>
	<td align="center" style="padding: 15px 0 15px 0;"><p> Hospital Charges (Total):</p></td>
	<td align="center" style="padding: 15px 0 15px 0;"><p>Rs. '.$row['hospitalCharges'].'</p></td>
</tr>
<tr>
	<td align="center" style="padding: 15px 0 15px 0;"><p>Admission Fee: </p></td>
	<td align="center" style="padding: 15px 0 15px 0;"><p>Rs. '.$row['admissionFee'].'</p></td>
</tr>
<tr>
	<td ><p style="float:right;font-weight:bold;">Total  Bill: </p></td>
	<td ><p style="font-weight:bold;float:left;">Rs. '.$row['total'].'</p></td>
</tr>
<tr>
	<td align="center" style="padding: 15px 0 15px 0;"><p>Advance: </p></td>
	<td align="center" style="padding: 15px 0 15px 0;"><p>Rs. '.$row['advance'].'</p></td>
</tr>
<tr>
	<td align="center" style="padding: 15px 0 15px 0;"><p>Discount: </p></td>
	<td align="center" style="padding: 15px 0 15px 0;"><p>Rs. '.$row['discount'].'</p></td>
</tr>
<tr>
	<td align="center" style="padding: 15px 0 15px 0;"><p>Return Amount: </p></td>
	<td align="center" style="padding: 15px 0 15px 0;"><p>Rs. '.$row['returnCash'].'</p></td>
</tr>
<tr>
	<td align="center" style="padding: 15px 0 15px 0;"><p>Received Remaining: </p></td>
	<td align="center" style="padding: 15px 0 15px 0;"><p>Rs. '.$row['received'].'</p></td>
</tr>
<tr>
	<td align="center" style="padding: 15px 0 15px 0;"><p style="font-weight:bold;">Amount Payable: </p></td>
	<td align="center" style="padding: 15px 0 15px 0;"><p style="font-weight:bold;">Rs. '.$row['balance'].'</p></td>
</tr>
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