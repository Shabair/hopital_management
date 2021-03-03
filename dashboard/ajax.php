<?php 
include '../db/db.php'; 

if($_GET['p'] == 'delPaId'){
	$patientId = $_POST['delPaId'];
	$sql = "DELETE FROM patient WHERE patientId = '$patientId'";
	if(mysqli_query($connect_me, $sql)){
		echo "<strong><div class='alert alert-success'>Success!</strong>Record has been deleted.</div>";
	}else{
		echo "<strong><div class='alert alert-danger'>Failed!</strong>Record couldn't be deleted.</div>";
	}
	
}

if($_GET['p'] == 'delInId'){
	$invoiceId = $_POST['id'];
	$sql = "DELETE FROM invoice WHERE invoiceId = '$invoiceId'";
	if(mysqli_query($connect_me, $sql)){
		echo "<strong><div class='alert alert-success'>Success!</strong>Record has been deleted.</div>";
	}else{
		echo "<strong><div class='alert alert-danger'>Failed!</strong>Record couldn't be deleted.</div>";
	}
	
}

if($_GET['p'] == 'paidReport'){
	$frmDate = $_POST['frmDate'];
	$toDate = $_POST['toDate'];
	$count = 0;
$sql = "SELECT * FROM invoice WHERE date BETWEEN '$frmDate' AND '$toDate' AND status = 'paid' ORDER BY invoiceId DESC";
$query = mysqli_query($connect_me, $sql);
if(mysqli_num_rows($query)>0){
while($row = mysqli_fetch_assoc($query)){

$invoiceId = $row["invoiceId"];

$sql1 = "SELECT * FROM patient WHERE patientId = ".$row['patientId']."";
$query1 = mysqli_query($connect_me, $sql1);
while($row1 = mysqli_fetch_assoc($query1)){
	$patientName = $row1['patientName'];
	$patientAddress = $row1['patientAddress'];
}
			echo "<tr>";
				echo "<td>".++$count."</td>";					
				echo "<td>".$row["invoiceId"]."</td>";
				echo "<td>".$patientName."</td>";
				echo "<td>".$patientAddress."</td>";
				echo "<td>".$row["total"]."</td>";
				echo "<td>".$row["balance"]."</td>";
				echo "<td>".date('d-m-Y', strtotime($row["date"]))."</td>";
				echo "<td>".$row["status"]."</td>";
				echo "<td>
				<input type='button' id='$invoiceId' name='edit' value='Edit' class='btn btn-success btn-sm inv'></input>
				<a data-toggle='tooltip' title='Take Invoice' data-placement='top' href='invoiceBillIndoor.php?invid=$invoiceId' class='btn btn-primary btn-sm'><span class='glyphicon glyphicon-print'></span></a>				
				<a data-toggle='tooltip' title='Delete' data-placement='top' onclick='prompt($invoiceId)' class='btn btn-danger btn-sm'><span class='glyphicon glyphicon-trash'></span></a>
				</td>";			
				echo "</tr>";
	}
}else{
		echo "<tbody>";
			echo "<tr>";
				echo "<td colspan='11'></td>";				
			echo "</tr>";
		echo "</tbody>";
}

	
}

if($_GET['p'] == 'unpaidReport'){
	$frmDate = $_POST['frmDate'];
	$toDate = $_POST['toDate'];
	$count = 0;
$sql = "SELECT * FROM invoice WHERE date BETWEEN '$frmDate' AND '$toDate' AND status = 'unpaid' ORDER BY invoiceId DESC";
$query = mysqli_query($connect_me, $sql);
if(mysqli_num_rows($query)>0){
while($row = mysqli_fetch_assoc($query)){

$invoiceId = $row["invoiceId"];

$sql1 = "SELECT * FROM patient WHERE patientId = ".$row['patientId']."";
$query1 = mysqli_query($connect_me, $sql1);
while($row1 = mysqli_fetch_assoc($query1)){
	$patientName = $row1['patientName'];
	$patientAddress = $row1['patientAddress'];
}
			echo "<tr>";
				echo "<td>".++$count."</td>";					
				echo "<td>".$row["invoiceId"]."</td>";
				echo "<td>".$patientName."</td>";
				echo "<td>".$patientAddress."</td>";
				echo "<td>".$row["total"]."</td>";
				echo "<td>".$row["balance"]."</td>";
				echo "<td>".date('d-m-Y', strtotime($row["date"]))."</td>";
				echo "<td>".$row["status"]."</td>";
				echo "<td>
				<input type='button' id='$invoiceId' name='edit' value='Edit' class='btn btn-success btn-sm inv'></input>
				<a data-toggle='tooltip' title='Take Invoice' data-placement='top' href='invoiceBillIndoor.php?invid=$invoiceId' class='btn btn-primary btn-sm'><span class='glyphicon glyphicon-print'></span></a>				
				<a data-toggle='tooltip' title='Delete' data-placement='top' onclick='prompt($invoiceId)' class='btn btn-danger btn-sm'><span class='glyphicon glyphicon-trash'></span></a>
				</td>";			
				echo "</tr>";
	}
}else{
		echo "<tbody>";
			echo "<tr>";
				echo "<td colspan='11'></td>";				
			echo "</tr>";
		echo "</tbody>";
}

	
}


if($_GET['p'] == 'profile'){

	$adminId = $_SESSION['id'];

	$adminName = mysqli_real_escape_string($connect_me, $_POST['name']);	
	$adminEmail = mysqli_real_escape_string($connect_me, $_POST['email']);	
	$adminPassword = mysqli_real_escape_string($connect_me, $_POST['password']);	

	
	$sql = "UPDATE admin SET adminName = '$adminName', adminEmail = '$adminEmail', adminPassword = '$adminPassword' WHERE adminId = '$adminId'";

	if(mysqli_query($connect_me, $sql)){
    
	echo "<div class='alert alert-success'>Succesfully Added</div>";
	
	} else{

    echo "ERROR: Could not able to execute $sql. " . mysqli_error($connect_me);
	echo "<div class='alert alert-danger'>Some Error Occured.</div>";
	}
}
?>
