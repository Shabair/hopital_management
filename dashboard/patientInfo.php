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

$patientId = $_GET['id'];

$sql = "SELECT * FROM patient WHERE patientId = '$patientId'";

$query = mysqli_query($connect_me, $sql);
if(mysqli_num_rows($query) > 0){
	
while($row=mysqli_fetch_assoc($query)){

$sql1 = "SELECT * FROM invoice WHERE patientId = '$patientId'";
$query1 = mysqli_query($connect_me, $sql1);
if(mysqli_num_rows($query1) > 0){
$row1 = mysqli_fetch_assoc($query1);
$advance = $row1['advance'];
$admissionFee = $row1['admissionFee'];
}else{
$advance = "Please Add Advance Charges in Invoice to See";	
$admissionFee = "Please Add Admission Charges in Invoice to See";	
}
?>
<div class="table-responsive">
<table class="table table-bordered" id="myTable" border="1" cellpadding="10" width="100%" style="border-collapse:collapse;">
<?php

echo '

<tr><td colspan="1"><img src="../images/invoiceLogo.png" class="img-responsive" width="100px" /></td><td colspan="3"><center><h2>Zohra Memorial Hospital Indoor Patient Detail</h2></center></td></tr>

	<tr><td colspan="2"><p>Token ID: <strong>'.$row['patientId'].'</strong></p></td>
	<td colspan="2"><p>Admission Date: <strong>'.date('d-M-Y', strtotime($row["admDate"])).'</strong></p></td></tr>
	<tr><td><p>Name: <strong>'.$row['patientName'].'</strong></p></td>
	<td><p>S/D/W Of: <strong>'.$row['patientNameOf'].'</strong></p></td>
	<td><p>Age: <strong>'.$row['patientAge'].'</strong></p></td></tr>
	<tr><td><p>Phone: <strong>0'.$row['patientPhone'].'</strong></p></td>
	<td><p>Address: <strong>'.$row['patientAddress'].'</strong></p></td>
	<td><p>Gender: <strong>'.$row['patientGender'].'</strong></p></td></tr>
	<tr><td><p>Doctor Name: <strong>'.getDoctorName($row['doctorId']).'</strong></p></td>
	<td><p>Advance: <strong>'.$advance.'</strong></p></td>
	<td><p>Admission: <strong>'.$admissionFee.'</strong></p></td></tr>
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