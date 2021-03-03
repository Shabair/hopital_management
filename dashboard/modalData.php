<?php 
include '../db/db.php'; 

if(!empty($_GET['invoiceId'])){
	$row2 = [];
	$invoiceId = $_GET['invoiceId'];
	$sql1 = "SELECT * FROM invoice WHERE invoiceId = '$invoiceId'";
	$query1 = mysqli_query($connect_me, $sql1);
	if(mysqli_num_rows($query1) > 0 ){
		$row1 = mysqli_fetch_assoc($query1);
		// echo json_encode($row2);
	
		$sql2 = "SELECT `patientDisease` FROM patient WHERE patientId = '".$row1['patientId']."'";
		$query2 = mysqli_query($connect_me, $sql2);
		if(mysqli_num_rows($query2) > 0 ){
			$row2 = mysqli_fetch_assoc($query2);
		}
		echo json_encode(array_merge($row1,$row2));
		// echo json_encode(array(
	
		// "patientDisease"=>$row2['patientDisease']
		
		// ));
	}
	
}
?>
<?php
if(!empty($_GET['p']) == 'updateIndoorPatient'){
	$patientId = $_POST['patientId'];
	$sql1 = "SELECT * FROM patient WHERE patientId = '$patientId'";
	$query1 = mysqli_query($connect_me, $sql1);
	if(mysqli_num_rows($query1) > 0 ){
		$row1 = mysqli_fetch_assoc($query1);
		
		$patientId = $row1['patientId'];
		$patientName = $row1['patientName'];
		$patientNameOf = $row1['patientNameOf'];
		$patientAge = $row1['patientAge'];
		$patientGender = $row1['patientGender'];
		$patientAddress = $row1['patientAddress'];
		$patientPhone = $row1['patientPhone'];
		$drName = $row1['doctorId'];
		$admDate = $row1['admDate'];
		
		echo json_encode(array(
	
		"patientId"=>$patientId,
		"patientName"=>$patientName,
		"patientNameOf"=>$patientNameOf,
		"patientAge"=>$patientAge,
		"patientGender"=>$patientGender,
		"patientAddress"=>$patientAddress,
		"patientPhone"=>$patientPhone,
		"admDate"=>$admDate,
		"drName"=>$drName		
		));
		
		}
		else{
			
		}
		

}
?>

<?php
if(!empty($_GET['adminId'])){
	$adminId = $_GET['adminId'];
	$sql1 = "SELECT * FROM admin WHERE adminId = '$adminId'";
	$query1 = mysqli_query($connect_me, $sql1);
	if(mysqli_num_rows($query1) > 0 ){
		$row1 = mysqli_fetch_assoc($query1);
		
		$adminName = $row1['adminName'];
		$adminEmail = $row1['adminEmail'];
		$adminPassword = $row1['adminPassword'];
		}
		
		echo json_encode(array(
	
		"adminName"=>$adminName,
		"adminEmail"=>$adminEmail,
		"adminPassword"=>$adminPassword		
		));
}
?>