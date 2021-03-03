<?php ob_start();?>
<?php session_start();?>
<?php 
$connect_me = mysqli_connect("localhost","root", "", "zohra");

if(mysqli_connect_errno($connect_me)){
	echo "failed to connect:" . mysqli_connect_error();	
}
function dbConnection(){
	$connect_me = mysqli_connect("localhost","root", "", "zohra");
	return $connect_me;
}

function getLabDetail($labId){
	
$connect_me = dbConnection();
	
$sql = "SELECT * FROM lab WHERE labId = '$labId'";
$query = mysqli_query($connect_me, $sql);
$row = mysqli_fetch_assoc($query);
return $row;
}

function getPersonalDetail($patientId){
	
$connect_me = dbConnection();
	
$sql = "SELECT * FROM patient WHERE patientId = '$patientId'";
$query = mysqli_query($connect_me, $sql);
$row = mysqli_fetch_assoc($query);
return $row;
}

function getPatientName($patientId){
	
$connect_me = dbConnection();
	
$sql = "SELECT * FROM patient WHERE patientId = '$patientId'";
$query = mysqli_query($connect_me, $sql);
$row = mysqli_fetch_assoc($query);
return $row['patientName'];
}

function getLabTestDetail($labId){
	
$connect_me = dbConnection();
	
$sql = "SELECT * FROM labtest WHERE labId = '$labId'";
$query = mysqli_query($connect_me, $sql);
while($row = mysqli_fetch_row($query)){
	
return $row;
}
}

function getDoctorName($doctorId){
	
$connect_me = dbConnection();
	
$sql = "SELECT * FROM doctor WHERE doctorId = '$doctorId'";
$query = mysqli_query($connect_me, $sql);
$row = mysqli_fetch_assoc($query);
return $row['doctorName'];
}

function getCatName($catId){
	
$connect_me = dbConnection();
	
$sql = "SELECT * FROM cat WHERE catId = '$catId'";
$query = mysqli_query($connect_me, $sql);
$row = mysqli_fetch_assoc($query);
return $row['catName'];
}

function getCatPrice($catId){
	
$connect_me = dbConnection();
	
$sql = "SELECT * FROM cat WHERE catId = '$catId'";
$query = mysqli_query($connect_me, $sql);
$row = mysqli_fetch_assoc($query);
return $row['catPrice'];
}


 ?>
