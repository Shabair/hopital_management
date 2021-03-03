<?php include'../db/db.php';?>


<?php 
if($_GET['p'] == 'invoice'){
	
	$count = 0;
	$sql = "SELECT * FROM invoice ORDER BY invoiceId DESC";
	$query = mysqli_query($connect_me, $sql);
	if(mysqli_num_rows($query)>0){
	while($row = mysqli_fetch_assoc($query)){

	$invoiceId = $row["invoiceId"];

	$sql1 = "SELECT * FROM patient WHERE patientId = ".$row['patientId']."";
	$query1 = mysqli_query($connect_me, $sql1);
	while($row1 = mysqli_fetch_assoc($query1)){
		$patientName = $row1['patientName'];
		$patientStatus = $row1['patientStatus'];
	}
				echo "<tr>";
					echo "<td>".++$count."</td>";					
					echo "<td>".$row["invoiceId"]."</td>";
					echo "<td>".$patientName."</td>";
					echo "<td>".$patientStatus."</td>";
					echo "<td>".$row["doctor"]."</td>";
					echo "<td>".$row["medicine"]."</td>";
					echo "<td>".$row["room"]."</td>";
					echo "<td>".$row["received"]."</td>";
					echo "<td>".$row["balance"]."</td>";
					echo "<td>".$row["date"]."</td>";
					echo "<td>".$row["status"]."</td>";
					echo "<td>
					<input type='button' id='$invoiceId' name='edit' value='Edit' class='btn btn-success btn-sm inv'></input>
					<a data-toggle='tooltip' title='Take Invoice' data-placement='top' href='patient_bill.php?invid=$invoiceId' class='btn btn-primary btn-sm'><span class='glyphicon glyphicon-print'></span></a>				
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


if($_GET['p'] == 'indoor'){
	
$count = 0;

$sql = "SELECT * FROM patient WHERE patientStatus = 'indoor' ORDER BY patientId DESC";
$query = mysqli_query($connect_me, $sql);
if(mysqli_num_rows($query) > 0){
	
while($row = mysqli_fetch_assoc($query)){
	
$patientId = $row["patientId"];
	
			echo "<tr>";
				echo "<td>".++$count."</td>";			
				echo "<td>".$row["patientName"]."</td>";
				echo "<td>".$row["patientAge"]."</td>";
				echo "<td>".$row["patientGender"]."</td>";
				echo "<td>".$row["patientAddress"]."</td>";
				echo "<td>".$row["patientPhone"]."</td>";
				echo "<td>".$row["patientCnic"]."</td>";
				echo "<td>".date('d-m-Y', strtotime($row["date"]))."</td>";
				echo "<td>".$row["timeStamp"]."</td>";
				echo "<td>
				<input type='button' id='$patientId' name='edit' value='Edit' class='btn btn-success btn-sm editData'></input>
				<a data-toggle='tooltip' title='Take Invoice' data-placement='top' href='patient_bill.php?id=$patientId' class='btn btn-primary btn-sm'><span class='glyphicon glyphicon-print'></span></a>				
				<a data-toggle='tooltip' title='Delete' data-placement='top' onclick='prompt($patientId)' class='btn btn-danger btn-sm'><span class='glyphicon glyphicon-trash'></span></a>
				</td>";		
				echo "</tr>";
	}
}else{
		echo "<tbody>";
			echo "<tr>";
				echo "<td colspan='8'></td>";				
			echo "</tr>";
		echo "</tbody>";
}	

}



if($_GET['p'] == 'outdoor'){
	
$count = 0;

$sql = "SELECT * FROM patient WHERE patientStatus = 'outdoor' ORDER BY patientId DESC";
$query = mysqli_query($connect_me, $sql);
if(mysqli_num_rows($query) > 0){
	
while($row = mysqli_fetch_assoc($query)){
	
$patientId = $row["patientId"];
	
			echo "<tr>";
				echo "<td>".++$count."</td>";			
				echo "<td>".$row["patientName"]."</td>";
				echo "<td>".$row["patientAge"]."</td>";
				echo "<td>".$row["patientGender"]."</td>";
				echo "<td>".$row["patientAddress"]."</td>";
				echo "<td>".$row["patientPhone"]."</td>";
				echo "<td>".$row["patientCnic"]."</td>";
				echo "<td>".date('d-m-Y', strtotime($row["date"]))."</td>";
				echo "<td>".$row["timeStamp"]."</td>";
				echo "<td>
				<input type='button' id='$patientId' name='edit' value='Edit' class='btn btn-success btn-sm editData'></input>
				<a data-toggle='tooltip' title='Take Invoice' data-placement='top' href='patient_bill.php?id=$patientId' class='btn btn-primary btn-sm'><span class='glyphicon glyphicon-print'></span></a>				
				<a data-toggle='tooltip' title='Delete' data-placement='top' onclick='prompt($patientId)' class='btn btn-danger btn-sm'><span class='glyphicon glyphicon-trash'></span></a>
				</td>";		
				echo "</tr>";
	}
}else{
		echo "<tbody>";
			echo "<tr>";
				echo "<td colspan='8'></td>";				
			echo "</tr>";
		echo "</tbody>";
}	

}


?>