<?php include'../db/db.php';?>

<?php 
function test($data) {
	  $data = trim($data);
	  $data = stripslashes($data);
	  $data = htmlspecialchars($data);
	  return $data;
}

function getHC($invoiceId) {
	$connect_me = dbConnection();

	$sql = "SELECT hospitalCharges FROM invoice WHERE invoiceId = '$invoiceId'";
	$query = mysqli_query($connect_me, $sql);
	$row = mysqli_fetch_assoc($query);
	return $row['hospitalCharges'];
}

if($_GET['p'] == 'getPatTypeDetail'){
	
		$patType = $_POST['patType'];
		
		$sql2 = "SELECT * FROM patient WHERE patientStatus = '$patType'";
		$query2 = mysqli_query($connect_me, $sql2);
		echo "<select id='patientId' name='patientId' class='form-control js-example-basic-multiple' multiple='multiple'>";
				echo "<option value=''>Choose Patient</option>";
		  while($row2 = mysqli_fetch_assoc($query2)){
			  echo "<option value='".$row2["patientId"]."'>000".$row2["patientId"]."-".$row2["patientName"]."-".$row2["patientPhone"]."-".$row2["patientStatus"]."</option>";
		  }
		echo "</select>";
}


?>	
<?php include'footer.php';?>