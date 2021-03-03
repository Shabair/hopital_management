<?php include'../db/db.php';?>
<?php include'../main/head.php';?>

<body>
<div id="wrapper">
<?php include 'hospSidebar.php'?>

<section>
<form class="form-inline" method="post" enctype="multipart/form-data">
<fieldset>
 <!-- <button type="button" onclick="printJS('myTable', 'html')"><span class="glyphicon glyphicon-print"></span></button> -->
<button onclick="printData()" class="glyphicon glyphicon-print"></button> 
<?php 

$hospChargesId = $_GET['id'];

$sql = "SELECT * FROM hospcharges WHERE hospChargesId = '$hospChargesId'";

$query = mysqli_query($connect_me, $sql);
if(mysqli_num_rows($query) > 0){
	
while($row=mysqli_fetch_assoc($query)){
$pDetail = getPersonalDetail($row['patientId']);
?>
<div class="table-responsive">
<table class="table table-bordered" id="myTable" border="1" cellpadding="10" width="100%" style="border-collapse:collapse;">
<?php

echo '

<tr><td colspan="1"><img src="../images/invoiceLogo.png" class="img-responsive" width="100px" /></td><td colspan="3"><center><h2>Zohra Memorial Hospital</h2></center></td></tr>

	<tr><td colspan="2"><p>HC Token ID: <strong>'.$row['hospChargesId'].'</strong></p></td>
	<td colspan="2"><p>Arrival: <strong>'.date('d-M-Y', strtotime($row["date"])).'</strong></p></td></tr>
	<tr><td><p>Name: <strong>'.$pDetail['patientName'].'</strong></p></td>
	<td><p>S/D/W Of: <strong>'.$pDetail['patientNameOf'].'</strong></p></td>
	<td><p>Age: <strong>'.$pDetail['patientAge'].'</strong></p></td></tr>
	<tr><td><p>Phone: <strong>0'.$pDetail['patientPhone'].'</strong></p></td>
	<td><p>Address: <strong>'.$pDetail['patientAddress'].'</strong></p></td>
	<td><p>Gender: <strong>'.$pDetail['patientGender'].'</strong></p></td></tr>
	<tr><td><p>Stitching Charges: <strong>Rs. '.$row['stitchingCharges'].'</strong></p></td>
	<td><p>Dressing Charges: <strong>Rs. '.$row['dressingCharges'].'</strong></p></td>
	<td><p>Bed Charges: <strong>Rs. '.$row['bedCharges'].'</strong></p></td></tr>
	<tr><td align="center" colspan="3"><p>Received the Sum of <strong>Rs. '.$row['total'].'</strong> as Hospital Charges</p></td></tr>
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
<?php include'footer.php';?>
</body>
</html>	