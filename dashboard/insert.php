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
	
if($_GET['p'] == 'addIndoorPatient'){
	$sql = "INSERT INTO patient (patientName, patientNameOf, patientGender, patientAge,  patientAddress, patientPhone, patientStatus, admDate, catId, doctorId)
	VALUES 
	('".test($_POST['patientName'])."',
	'".test($_POST['patientNameOf'])."',
	'".test($_POST['patientGender'])."',
	'".test($_POST['patientAge'])."',
	'".test($_POST['patientAddress'])."',
	'".test($_POST['patientPhone'])."',
	'indoor',
	'".date("Y-m-d")."',
	'".test($_POST['catId'])."',
	'".test($_POST['doctorId'])."'
	)";

	if(mysqli_query($connect_me, $sql)){
		$patientId = mysqli_insert_id($connect_me);
		$sql1 = "INSERT INTO invoice (patientId, advance, admissionFee, total, date)
		VALUES 
		('$patientId',
		'".test($_POST['advance'])."',
		'".test($_POST['admissionFee'])."',
		'".test($_POST['admissionFee'])."',
		'".date("Y-m-d")."'		
		)";
		if(mysqli_query($connect_me, $sql1)){ 
			echo json_encode(array(
				"patientId"=>$patientId
			));
		}
	}
}

if($_GET['p'] == 'editIndoorPatient'){

	$patientId = $_POST['patientId'];

	$patientName = mysqli_real_escape_string($connect_me, $_POST['patientName']);	
	$patientNameOf = mysqli_real_escape_string($connect_me, $_POST['patientNameOf']);	
	$patientAge = mysqli_real_escape_string($connect_me, $_POST['patientAge']);	
	$patientGender = mysqli_real_escape_string($connect_me, $_POST['patientGender']);	
	$patientAddress = mysqli_real_escape_string($connect_me, $_POST['patientAddress']);	
	$patientPhone = mysqli_real_escape_string($connect_me, $_POST['patientPhone']);		
	$drName = mysqli_real_escape_string($connect_me, $_POST['drName']);		
	$admDate = mysqli_real_escape_string($connect_me, $_POST['admDate']);		
	
	
	$sql = "UPDATE patient SET patientName = '$patientName', patientNameOf = '$patientNameOf', patientAge = '$patientAge', patientGender = '$patientGender', patientAddress = '$patientAddress', patientPhone = '$patientPhone', doctorId = '$drName', admDate = '$admDate' WHERE patientId = '$patientId'";

	if(mysqli_query($connect_me, $sql)){
    
	echo "<div class='alert alert-success'>Succesfully Added</div>";
	
	} else{

    echo "ERROR: Could not able to execute $sql. " . mysqli_error($connect_me);
	echo "<div class='alert alert-danger'>Some Error Occured.</div>";
	}
}

if($_GET['p'] == 'inv'){

	$patientId = mysqli_real_escape_string($connect_me, $_POST['patientId']);	
	$childSpec = mysqli_real_escape_string($connect_me, $_POST['childSpec']);	
	$surgeonFee = mysqli_real_escape_string($connect_me, $_POST['surgeonFee']);	
	$OTAFee = mysqli_real_escape_string($connect_me, $_POST['OTAFee']);	
	$anesthesiaFee = mysqli_real_escape_string($connect_me, $_POST['anesthesiaFee']);	
	$hospitalCharges = mysqli_real_escape_string($connect_me, $_POST['hospitalCharges']);	
	$admissionFee = mysqli_real_escape_string($connect_me, $_POST['admissionFee']);	
	$advanceCharges = mysqli_real_escape_string($connect_me, $_POST['advanceCharges']);	
	$total = mysqli_real_escape_string($connect_me, $_POST['total']);	
	$received = mysqli_real_escape_string($connect_me, $_POST['received']);	
	$balance = mysqli_real_escape_string($connect_me, $_POST['balance']);	
	$status = mysqli_real_escape_string($connect_me, $_POST['status']);
	$date = date("Y-m-d");
	
	$sql = "INSERT INTO invoice (patientId, childSpec, surgeonFee, OTAFee, anesthesiaFee, hospitalCharges, admissionFee, advanceCharges, total, received, balance, status, date) VALUES ('$patientId', '$childSpec','$surgeonFee', '$OTAFee', '$anesthesiaFee', '$hospitalCharges', '$admissionFee', '$advanceCharges', '$total','$received', '$balance', '$status', '$date')";
	
	if($balance == '0'){
		$sql1 = "UPDATE patient SET dischargeDate = '$date' WHERE patientId = '$patientId'";
		mysqli_query($connect_me, $sql1);
	}
	
	if(mysqli_query($connect_me, $sql)){
    
	echo "<div class='alert alert-success'>Succesfully Added</div>";
	
	} else{

    echo "ERROR: Could not able to execute $sql. " . mysqli_error($connect_me);
	echo "<div class='alert alert-danger'>Some Error Occured.</div>";
	}
}

if($_GET['p'] == 'addInvoiceGen'){

	$sql = "INSERT INTO patient (patientName, patientNameOf, patientGender, patientAge, patientAddress, patientPhone, patientStatus, patientDisease, admDate, dischargeDate, catId, doctorId) 
	VALUES 
	('".test($_POST['patientName'])."',
	'".test($_POST['patientNameOf'])."',
	'".test($_POST['patientGender'])."',
	'".test($_POST['patientAge'])."',
	'".test($_POST['patientAddress'])."',
	'".test($_POST['patientPhone'])."',
	'outdoor',
	'".test($_POST['patientDisease'])."',
	'".date("Y-m-d")."',
	'".date("Y-m-d")."',
	'".test($_POST['catId'])."',
	'".test($_POST['doctorId'])."'
	)";
	if(mysqli_query($connect_me, $sql)){ 
		$patientId = mysqli_insert_id($connect_me);
		$sql1 = "INSERT INTO invoicegen (serialNo, tokenNo, patientId,doctorId, fee, otherCharges, total, date, year) 
		VALUES 
		('".test($_POST['serialNo'])."',
		'".test($_POST['tokenNo'])."',
		'$patientId',
		'".test($_POST['doctorId'])."',
		'".test($_POST['fee'])."',
		'".test($_POST['otherCharges'])."',
		'".test($_POST['total'])."',
		'".date("Y-m-d")."',
		'".date("Y")."'
		)";
		if(mysqli_query($connect_me, $sql1)){ 
			$invoiceGenId = mysqli_insert_id($connect_me);
					echo json_encode(array(
					"invoiceGenId"=>$invoiceGenId
					));
			// echo '<div class="w3-panel w3-green w3-card-4">Successfully Added.!!</div>';
		}else{
			// echo "ERROR: Could not able to execute $sql. " . mysqli_error($connect_me);
			// echo '<div class="w3-panel w3-red w3-card-4">Something Went Wrong!</div>';
		}
	} 
}

if($_GET['p'] == 'addLab'){
$catId = $_POST['catId'];
$catArr = explode(",",$catId);
$c = count($catArr);

	if($_POST['patientStatus'] == 'other'){
	$sql = "INSERT INTO patient (patientName, patientNameOf, patientGender, patientAge, patientAddress, patientPhone, patientStatus, admDate, dischargeDate) 
	VALUES 
	('".test($_POST['patientName'])."',
	'".test($_POST['patientNameOf'])."',
	'".test($_POST['patientGender'])."',
	'".test($_POST['patientAge'])."',
	'".test($_POST['patientAddress'])."',
	'".test($_POST['patientPhone'])."',
	'other',
	'".date("Y-m-d")."',
	'".date("Y-m-d")."'
	)";
	// echo $sql;
		if(mysqli_query($connect_me, $sql)){			
			$patientId = mysqli_insert_id($connect_me);
			$sql1 = "INSERT INTO lab (labTestDate, patientId, doctorId, patientStatus, total) 
			VALUES( 
			'".date("Y-m-d")."',
			'$patientId',
			'".test($_POST['doctorId'])."',
			'".test($_POST['patientStatus'])."',
			'".test($_POST['total'])."'
			)";
			// echo $sql1;
			if(mysqli_query($connect_me, $sql1)){ 
			$labId = mysqli_insert_id($connect_me);
				for($i=0;$i<$c;$i++){
					$sql2 = "INSERT INTO labtest (labId, catId, labTestDate) 
					VALUES 
					('$labId',
					'$catArr[$i]',
					'".date("Y-m-d")."'
					)";
					$query2 = mysqli_query($connect_me, $sql2);
				}
				// echo $sql2;
				if($query2){
					echo json_encode(array(
					"labId"=>$labId
					));
				}
				// echo '<div class="w3-panel w3-green w3-card-4">Successfully Added.!!</div>';
			}else{
				// echo "ERROR: Could not able to execute $sql. " . mysqli_error($connect_me);
				// echo '<div class="w3-panel w3-red w3-card-4">Something Went Wrong!</div>';
			}
		} 
	}
	
	
	if($_POST['patientStatus'] == 'indoor' || $_POST['patientStatus'] == 'outdoor'){
		$sql1 = "INSERT INTO lab (doctorId, labTestDate, patientId, patientStatus, total) 
		VALUES 
		('".test($_POST['doctorId'])."',
		'".date("Y-m-d")."',
		'".test($_POST['patientId'])."',
		'".test($_POST['patientStatus'])."',
		'".test($_POST['total'])."'
		)";
		if(mysqli_query($connect_me, $sql1)){ 
			$labId = mysqli_insert_id($connect_me);
			for($i=0;$i<$c;$i++){
				$sql2 = "INSERT INTO labtest (labId, catId, labTestDate) 
				VALUES 
				('$labId',
				'$catArr[$i]',
				'".date("Y-m-d")."'
				)";
				$query2 = mysqli_query($connect_me, $sql2);
			}
				if($query2){
					echo json_encode(array(
					"labId"=>$labId
					));
				}
		// echo '<div class="w3-panel w3-green w3-card-4">Successfully Added.!!</div>';
		}else{
			// echo "ERROR: Could not able to execute $sql. " . mysqli_error($connect_me);
			// echo '<div class="w3-panel w3-red w3-card-4">Something Went Wrong!</div>';
		}
	}
}

if($_GET['p'] == 'getInvoiceGenSerialNo'){
	$year = date("Y");
$sql = "SELECT serialNo FROM invoicegen WHERE year = '$year' ORDER BY invoiceGenId DESC LIMIT 1 ";
$query = mysqli_query($connect_me, $sql);
$row = mysqli_fetch_assoc($query);
$serialNo = $row['serialNo'];
$final = ++$serialNo;
		echo json_encode(array(
	
		"serialNo"=>$final,
		
		));
}

if($_GET['p'] == 'getLabId'){
$sql = "SELECT labId FROM lab ORDER BY labId DESC LIMIT 1";
$query = mysqli_query($connect_me, $sql);
$row = mysqli_fetch_assoc($query);
$labId = $row['labId'];
$final = ++$labId;
		echo json_encode(array(
	
		"labId"=>$final,
		
		));
}

if($_GET['p'] == 'getLabTestPrice'){
	$catId = $_POST['catId'];
	$catIdArr = explode(",",$catId);

	$result = "'".implode("','",$catIdArr)."'";
$sql = "SELECT SUM(catPrice) AS total FROM cat WHERE catId IN ($result)";
$query = mysqli_query($connect_me, $sql);
$row = mysqli_fetch_assoc($query);
$total = $row['total'];
		echo json_encode(array(
	
		"total"=>$total
		
		));
}

if($_GET['p'] == 'getInvoiceGenTokenNo'){
	$doctorId = $_POST['doctorId'];
	$date = date("Y-m-d");
$sql = "SELECT tokenNo FROM invoicegen WHERE date = '$date' AND doctorId = '$doctorId' ORDER BY invoiceGenId DESC LIMIT 1 ";
$query = mysqli_query($connect_me, $sql);
$row = mysqli_fetch_assoc($query);
$tokenNo = $row['tokenNo'];
$final = ++$tokenNo;
		echo json_encode(array(
	
		"tokenNo"=>$final,
		
		));
}

if($_GET['p'] == 'getWardFee'){
	$catId = $_POST['catId'];
$sql = "SELECT catPrice FROM cat WHERE catId = '$catId' LIMIT 1 ";
$query = mysqli_query($connect_me, $sql);
$row = mysqli_fetch_assoc($query);
$catPrice = $row['catPrice'];
		echo json_encode(array(
	
		"catPrice"=>$catPrice,
		
		));
}

if($_GET['p'] == 'getPatientId'){
$sql = "SELECT patientId FROM patient ORDER BY patientId DESC LIMIT 1";
$query = mysqli_query($connect_me, $sql);
$row = mysqli_fetch_assoc($query);
$patientId = $row['patientId'];
$final = ++$patientId;
		echo json_encode(array(
	
		"patientId"=>$final,
		
		));
}

if($_GET['p'] == 'getInvoiceId'){
$sql = "SELECT invoiceId FROM invoice ORDER BY invoiceId DESC LIMIT 1";
$query = mysqli_query($connect_me, $sql);
$row = mysqli_fetch_assoc($query);
$invoiceId = $row['invoiceId'];
$final = ++$invoiceId;
		echo json_encode(array(
	
		"invoiceId"=>$final,
		
		));
}

if($_GET['p'] == 'getPatientName'){
$sql = "SELECT patientName FROM patient WHERE patientId = '".$_POST['patientId']."'";
$query = mysqli_query($connect_me, $sql);
$row = mysqli_fetch_assoc($query);
$patientName = $row['patientName'];
		echo json_encode(array(
	
		"patientName"=>$patientName,
		
		));
}

if($_GET['p'] == 'invEdit'){
		
	$invoiceId = mysqli_real_escape_string($connect_me, $_POST['invoiceId']);	
	$patientId = mysqli_real_escape_string($connect_me, $_POST['patientId']);	
	$childSpec = mysqli_real_escape_string($connect_me, $_POST['childSpec']);	
	$surgeonFee = mysqli_real_escape_string($connect_me, $_POST['surgeonFee']);	
	$patientDisease = mysqli_real_escape_string($connect_me, $_POST['patientDisease']);	
	$patientDisease = test($patientDisease);
	$OTAFee = mysqli_real_escape_string($connect_me, $_POST['OTAFee']);	
	$anesthesiaFee = mysqli_real_escape_string($connect_me, $_POST['anesthesiaFee']);	
	$BTL = mysqli_real_escape_string($connect_me, $_POST['BTL']);	
	$HCV = mysqli_real_escape_string($connect_me, $_POST['HCV']);	
	$AC = mysqli_real_escape_string($connect_me, $_POST['AC']);	
	$Fridge = mysqli_real_escape_string($connect_me, $_POST['Fridge']);	
	$O2 = mysqli_real_escape_string($connect_me, $_POST['O2']);	
	$ExtraDays = mysqli_real_escape_string($connect_me, $_POST['ExtraDays']);	
	$RoomRent = mysqli_real_escape_string($connect_me, $_POST['RoomRent']);	
	$hospitalCharges = mysqli_real_escape_string($connect_me, $_POST['hospitalCharges']);	
	$staffNurseCharges = mysqli_real_escape_string($connect_me, $_POST['staffNurseCharges']);	
	$admissionFee = mysqli_real_escape_string($connect_me, $_POST['admissionFee']);	
	$advance = mysqli_real_escape_string($connect_me, $_POST['advance']);	
	$total = mysqli_real_escape_string($connect_me, $_POST['total']);	
	$received = mysqli_real_escape_string($connect_me, $_POST['received']);	
	$discount = mysqli_real_escape_string($connect_me, $_POST['discount']);	
	$returnCash = mysqli_real_escape_string($connect_me, $_POST['returnCash']);	
	$balance = mysqli_real_escape_string($connect_me, $_POST['balance']);	
	$status = mysqli_real_escape_string($connect_me, $_POST['status']);
	$date = date("Y-m-d");
	
	$sql = "UPDATE invoice SET childSpec = '$childSpec',  surgeonFee = '$surgeonFee', OTAFee = '$OTAFee', anesthesiaFee = '$anesthesiaFee', BTL = '$BTL', HCV = '$HCV', AC = '$AC', Fridge = '$Fridge', O2 = '$O2', ExtraDays = '$ExtraDays', RoomRent = '$RoomRent', hospitalCharges = '$hospitalCharges', staffNurseCharges = '$staffNurseCharges',  admissionFee = '$admissionFee', advance = '$advance',  total = '$total', received = '$received', balance = '$balance',  status = '$status', date = '$date', discount = '$discount' , returnCash = '$returnCash' WHERE invoiceId = '$invoiceId'";
	
	if($status == 'paid'){
		$sql1 = "UPDATE patient SET dischargeDate = '$date' WHERE patientId = '$patientId'";
		mysqli_query($connect_me, $sql1);
	}else{
		$sql1 = "UPDATE patient SET dischargeDate = NULL WHERE patientId = '$patientId'";
		mysqli_query($connect_me, $sql1);		
	}
	// $hosCh = explode(",",$hospChargesId);
	// $c = count($hosCh);
	// $val = getHC($invoiceId);
	
	if(mysqli_query($connect_me, $sql)){
    $sql2 = "UPDATE patient SET patientDisease = '$patientDisease' WHERE patientId = '$patientId'";
	mysqli_query($connect_me, $sql2);
		
	}else{

    echo "ERROR: Could not able to execute $sql. " . mysqli_error($connect_me);
	echo "<div class='alert alert-danger'>Some Error Occured.</div>";
	}
}


if($_GET['p'] == 'getLabRow'){
	$count = 0;
	$searchOption = $_POST['searchOption'];
	$searchValue = $_POST['searchValue'];
	
	$sql = "SELECT * FROM lab WHERE $searchOption LIKE '$searchValue' ORDER BY labId DESC";
	$query = mysqli_query($connect_me, $sql);
	while($row = mysqli_fetch_assoc($query)){

	$labId = $row["labId"];
	$patientId = $row["patientId"];
	$pDetail = getPersonalDetail($patientId);

	// print_r($pDetail);
			echo "<tr>";
				echo "<td>".++$count."</td>";			
				echo "<td>".$row["labId"]."</td>";
				echo "<td>".date('d-M-Y', strtotime($row["labTestDate"]))."</td>";
				echo "<td>".getDoctorName($row["doctorId"])."</td>";
				echo "<td>".$pDetail['patientName']."</td>";
				echo "<td>".$pDetail['patientAge']."</td>";
				echo "<td>".$pDetail['patientAddress']."</td>";
				echo "<td>".$pDetail['patientPhone']."</td>";
				echo "<td>".$row['total']."</td>";
				echo "<td>
				<a data-toggle='tooltip'title='print invoice' data-placement='left' href='labTestReport.php?id=$labId'  class='btn btn-info btn-sm'><span class='glyphicon glyphicon-print'></span></a></td>";		
			echo "</tr>";
		}
}



if($_GET['p'] == 'getInvoiceGenReport'){

	$frmDate = $_POST['frmDate'];
	$toDate = $_POST['toDate'];
$count = 0;
$sum = 0;
$hospitalCharges = 0;
$doctorCharges = 0;
if(!empty($_POST['doctorId'])){
$doctorId = $_POST['doctorId'];
$column = $_POST['column'];
$sql = "SELECT * FROM invoicegen WHERE $column = '$doctorId' AND date BETWEEN '$frmDate' AND '$toDate' ORDER BY invoiceGenId DESC";
}
else{
$sql = "SELECT * FROM invoicegen WHERE date BETWEEN '$frmDate' AND '$toDate' ORDER BY invoiceGenId DESC";
}
$query = mysqli_query($connect_me, $sql);
while($row = mysqli_fetch_assoc($query)){

$invoiceGenId = $row["invoiceGenId"];
$patientId = $row["patientId"];
$pDetail = getPersonalDetail($patientId);
//shaib change start

$sql3 = "SELECT * FROM cat WHERE catId = '".$pDetail["catId"]."'";
$query3 = mysqli_query($connect_me, $sql3);
if(mysqli_num_rows($query3) > 0){
	$row3 = mysqli_fetch_assoc($query3);
}


//shaib end
// print_r($pDetail);
		echo "<tr>";
			echo "<td>".++$count."</td>";			
			echo "<td>".$row["serialNo"]."</td>";
			echo "<td>".date('d-M-Y', strtotime($row["date"]))."</td>";
			echo "<td>".$row["tokenNo"]."</td>";
			echo "<td>".getDoctorName($pDetail['doctorId'])."</td>";
			echo "<td>".$pDetail['patientName']."</td>";
			echo "<td>".$pDetail['patientAge']."</td>";
			echo "<td>".$pDetail['patientAddress']."</td>";
			echo "<td>".$pDetail['patientPhone']."</td>";
			echo "<td>".$row3['catPrice']."</td>";
			$hospitalCharges = $hospitalCharges + $row3['catPrice'];
			echo "<td>".$row['fee']."</td>";
			$doctorCharges = $doctorCharges + $row['fee'];
			echo "<td>".$row['total']."</td>";
			$sum = $sum + $row['total'];
		echo "</tr>";
	}
		echo "<tr style='font-weight:bold;'>";
			echo "<td  align='right'colspan='9'>Grand Total</td>";
			echo "<td>".$hospitalCharges."</td>";
			echo "<td>".$doctorCharges."</td>";
			echo "<td>".$sum."</td>";
			echo "<td></td>";
		echo "</tr>";
}



if($_GET['p'] == 'getRowDataInvoiceGen'){
$sColumn = $_POST['sColumn'];
$sData = $_POST['sData'];
$count = 0;
$sql = "SELECT * FROM invoicegen WHERE $sColumn LIKE '$sData' ORDER BY invoiceGenId DESC";
$query = mysqli_query($connect_me, $sql);
while($row = mysqli_fetch_assoc($query)){

$invoiceGenId = $row["invoiceGenId"];
$patientId = $row["patientId"];
$pDetail = getPersonalDetail($patientId);

// print_r($pDetail);
			echo "<tr>";
				echo "<td>".++$count."</td>";			
				echo "<td>".$row["serialNo"]."</td>";
				echo "<td>".date('d-M-Y', strtotime($row["date"]))."</td>";
				echo "<td>".$row["tokenNo"]."</td>";
				echo "<td>".getDoctorName($pDetail['doctorId'])."</td>";
				echo "<td>".$pDetail['patientName']."</td>";
				echo "<td>".$pDetail['patientAge']."</td>";
				echo "<td>".$pDetail['patientAddress']."</td>";
				echo "<td>".$pDetail['patientPhone']."</td>";
				echo "<td>".$row['total']."</td>";
				echo "<td>
				<a data-toggle='tooltip'title='print invoice' data-placement='left' href='invoiceBill.php?id=$invoiceGenId'  class='btn btn-info btn-sm'><span class='glyphicon glyphicon-print'></span></a></td>";		
			echo "</tr>";
	}

}


if($_GET['p'] == 'getInvoiceReport'){
	
$iColumnData = $_POST['iColumnData'];
$frmDate = $_POST['frmDate'];
$toDate = $_POST['toDate'];

$count = 0;
$sum = 0;
$bal = 0;
$sql = "SELECT * FROM invoice WHERE status = '$iColumnData' AND date BETWEEN '$frmDate' AND '$toDate' ORDER BY invoiceId DESC";
$query = mysqli_query($connect_me, $sql);
if(mysqli_num_rows($query)>0){
while($row = mysqli_fetch_assoc($query)){

$invoiceId = $row["invoiceId"];

$sql1 = "SELECT * FROM patient WHERE patientId = ".$row['patientId']."";
$query1 = mysqli_query($connect_me, $sql1);
while($row1 = mysqli_fetch_assoc($query1)){
	$tokenId = $row1['patientId'];
	$patientName = $row1['patientName'];
	$patientAddress = $row1['patientAddress'];
}
	echo "<tr>";
		echo "<td>".++$count."</td>";					
		echo "<td>".$row["invoiceId"]."</td>";
		echo "<td>".$tokenId."</td>";
		echo "<td>".$patientName."</td>";
		echo "<td>".$patientAddress."</td>";
			$sinrec = $row["total"]-$row['balance'];
		echo "<td>&nbsp Rs ".$sinrec."</td>";
		echo "<td>".$row["status"]."</td>";		
		if($row["balance"] == 0 && $row["total"] == 0){
		echo "<td>Not Yet Discharged</td>";
		}else{
		echo "<td>&nbsp Rs ".$row["balance"]."</td>";	
		$bal = $bal + $row['balance'];
		}
		echo "<td>".date('d-M-Y', strtotime($row["date"]))."</td>";
		echo "<td>&nbsp Rs ".$row["total"]."</td>";
		$sum = $sum + $row['total'];
		$rec = $sum - $bal;
	echo "</tr>";
	}
		echo "<tr style='font-weight:bold;'>";
			echo "<td  style='padding:10px;'align='right'colspan='5'>Grand Recieved &nbsp</td>";
			echo "<td>&nbsp Rs. ".$rec."</td>";
			echo "<td  align='right'>Grand Balance &nbsp </td>";
			echo "<td>&nbsp Rs. ".$bal."</td>";
			echo "<td  align='right'>Grand Total &nbsp</td>";
			echo "<td>&nbsp Rs. ".$sum."</td>";
		echo "</tr>";
		
		echo "<tr>";
			echo "<td align='center' style='padding:10px;'colspan='10'>Grand Total: Rs. ".$sum."    |    Grand Recieved: Rs. ".$rec."     |      Grand Balance: Rs. ".$bal."</td>";
		echo "</tr>";
		
}else{
		echo "<tbody>";
			echo "<tr>";
				echo "<td colspan='10'></td>";				
			echo "</tr>";
		echo "</tbody>";
}	
	
}
	
if($_GET['p'] == 'getInvoiceLabReport'){
	$count = 0;
	$sum = 0;
	$dataId = $_POST['dataId'];
	$catId = $_POST['catId'];
	$frmDate = $_POST['frmDate'];
	$toDate = $_POST['toDate'];
	$column = $_POST['column'];
	
	$sql = "SELECT * FROM lab WHERE labId = '0'";
	if(!empty($_POST['dataId'])){
	$sql = "SELECT * FROM lab WHERE $column = '$dataId' AND labTestDate BETWEEN '$frmDate' AND '$toDate' ORDER BY labId DESC";
	}
	
	if($column == 'overAll'){
	$sql = "SELECT * FROM lab WHERE labTestDate BETWEEN '$frmDate' AND '$toDate' ORDER BY labId DESC";
	}
	
	if(!empty($_POST['catId']))	{
	$sql = "SELECT * FROM labtest WHERE catId = '$catId' AND labTestDate BETWEEN '$frmDate' AND '$toDate' ORDER BY labId DESC";	
	}
	//echo $sql;
	$query = mysqli_query($connect_me, $sql);
	while($row = mysqli_fetch_assoc($query)){

	$labId = $row["labId"];
	$labDetail = getLabDetail($labId);
	
	$pDetail = getPersonalDetail($labDetail['patientId']);

	// print_r($pDetail);
			echo "<tr>";
				echo "<td>".++$count."</td>";			
				echo "<td>".$row["labId"]."</td>";
				echo "<td>".date('d-M-Y', strtotime($row["labTestDate"]))."</td>";
				echo "<td>".getDoctorName($labDetail["doctorId"])."</td>";
				echo "<td>".$pDetail['patientName']."</td>";
				echo "<td>".$pDetail['patientAge']."</td>";
				echo "<td>".$pDetail['patientAddress']."</td>";
				echo "<td>".$pDetail['patientPhone']."</td>";
				if(!empty($_POST['dataId'])){
				echo "<td>".$labDetail['total']."</td>";
				$sum = $sum + $labDetail['total'];
				}
				if(!empty($_POST['catId']))	{
				echo "<td>".$priceSingle = getCatPrice($row['catId'])."</td>";
				$sum = $sum + $priceSingle;
				}
			echo "</tr>";
		}	
		echo "<tr style='font-weight:bold;'>";
			echo "<td  align='right'colspan='8'>Grand Total</td>";
			echo "<td>".$sum."</td>";
		echo "</tr>";
	
}	

if($_GET['p'] == 'getCatName'){

		echo json_encode(array(
	
		"catName"=>getCatName($_POST['catId'])
		));
}

if($_GET['p'] == 'getDoctorName'){

		echo json_encode(array(
	
		"doctorName"=>getDoctorName($_POST['doctorId'])
		));
}

if($_GET['p'] == 'getInvoiceRowData'){
$sColumn = $_POST['sColumn'];
$sData = $_POST['sData'];
$count = 0;
$sql = "SELECT * FROM invoice WHERE $sColumn LIKE '$sData' ORDER BY invoiceId DESC";

$query = mysqli_query($connect_me, $sql);
if(mysqli_num_rows($query)>0){
while($row = mysqli_fetch_assoc($query)){

$invoiceId = $row["invoiceId"];

$sql1 = "SELECT * FROM patient WHERE patientId = ".$row['patientId']."";
$query1 = mysqli_query($connect_me, $sql1);
while($row1 = mysqli_fetch_assoc($query1)){
	$tokenId = $row1['patientId'];
	$patientName = $row1['patientName'];
	$patientAddress = $row1['patientAddress'];
}
			echo "<tr>";
				echo "<td>".++$count."</td>";					
				echo "<td>".$row["invoiceId"]."</td>";
				echo "<td>".$tokenId."</td>";
				echo "<td>".$patientName."</td>";
				echo "<td>".$patientAddress."</td>";
				echo "<td>".$row["total"]."</td>";
				echo "<td>".$row["balance"]."</td>";
				echo "<td>".date('d-m-Y', strtotime($row["date"]))."</td>";
				echo "<td>".$row["status"]."</td>";
				echo "<td>
				<input type='button' id='$invoiceId' name='edit' value='Edit' class='btn btn-success btn-sm inv'></input>
				<a data-toggle='tooltip' title='Take Invoice' data-placement='top' href='invoiceBillIndoor.php?invid=$invoiceId' class='btn btn-primary btn-sm'><span class='glyphicon glyphicon-print'></span></a>				
				</td>";			
				echo "</tr>";
	}
}else{
			echo "<tr>";
				echo "<td colspan='11'></td>";				
			echo "</tr>";
}

	
}

if($_GET['p'] == 'getInvoicePatientData'){

$sColumn = $_POST['sColumn'];
$sData = $_POST['sData'];
$count = 0;

$sql = "SELECT * FROM patient WHERE $sColumn LIKE '%$sData%' AND patientStatus = 'indoor' ORDER BY patientId DESC";
echo $sql;
$query = mysqli_query($connect_me, $sql);
if(mysqli_num_rows($query) > 0){
	
while($row = mysqli_fetch_assoc($query)){
	
$patientId = $row["patientId"];
	
			echo "<tr>";
				echo "<td>".++$count."</td>";			
				echo "<td>".$row["patientId"]."</td>";
				echo "<td>".$row["patientName"]."</td>";
				echo "<td>".$row["patientNameOf"]."</td>";
				echo "<td>".$row["patientAge"]."</td>";
				echo "<td>".$row["patientGender"]."</td>";
				echo "<td>".$row["patientAddress"]."</td>";
				echo "<td>".$row["patientPhone"]."</td>";
				echo "<td>".getDoctorName($row["doctorId"])."</td>";
				echo "<td>".date('d-M-Y', strtotime($row["admDate"]))."</td>";
				if($row['dischargeDate'] == null){
				echo "<td>Not Discharged</td>";
				}else{
				echo "<td>".date('d-M-Y', strtotime($row["dischargeDate"]))."</td>";
				}
				echo "<td>
				<input type='button' id='$patientId' name='edit' value='Edit' class='btn btn-success btn-sm editData'></input>
				<a data-toggle='tooltip' title='Take Invoice' data-placement='top' href='invoiceBillIndoor.php?id=$patientId' class='btn btn-primary btn-sm'><span class='glyphicon glyphicon-print'></span></a>				
				<a data-toggle='tooltip' title='Take Patient Detail' data-placement='top' href='patientInfo.php?id=$patientId' class='btn btn-info btn-sm'><span class='glyphicon glyphicon-user'></span></a>	
				</td>";	
				// <a data-toggle='tooltip' title='Delete' data-placement='top' onclick='prompt($patientId)' class='btn btn-danger btn-sm'><span class='glyphicon glyphicon-trash'></span></a>				
				echo "</tr>";
	}
}else{
			echo "<tr>";
				echo "<td colspan='12'></td>";				
			echo "</tr>";
}

}


if($_GET['p'] == 'getOutdoorOPDPrice'){
	$sql = "SELECT * FROM cat WHERE catType = 'outdoor' ORDER BY catName DESC";
	$query = mysqli_query($connect_me, $sql);
	while($row = mysqli_fetch_assoc($query)){
		$price[] = $row['catPrice'];
	}
	// print_r($price);
		echo json_encode(array(
			"general"=>$price[0],
			"general2"=>$price[1],
			"anti"=>$price[2],
			"anti2"=>$price[3]
		));
}



if($_GET['p'] == 'updateOPDPrice'){
	
	$sql = "UPDATE cat SET catPrice = '".test($_POST['generalOPD'])."' WHERE catId = '1'";
	mysqli_query($connect_me, $sql);
		
	$sql1 = "UPDATE cat SET catPrice = '".test($_POST['antiOPD'])."' WHERE catId = '2'";
	mysqli_query($connect_me, $sql1);
	
	$sql = "UPDATE cat SET catPrice = '".test($_POST['generalOPD2'])."' WHERE catId = '55'";
	mysqli_query($connect_me, $sql);
		
	$sql1 = "UPDATE cat SET catPrice = '".test($_POST['antiOPD2'])."' WHERE catId = '56'";
	mysqli_query($connect_me, $sql1);
	
	
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


if($_GET['p'] == 'getRowHospCharges'){
$sColumn = $_POST['sColumn'];
$sData = $_POST['sData'];
$count = 0;
$sql = "SELECT * FROM hospcharges WHERE $sColumn LIKE '$sData' ORDER BY hospChargesId DESC";
$query = mysqli_query($connect_me, $sql);
while($row = mysqli_fetch_assoc($query)){

$hospChargesId = $row["hospChargesId"];
// $patientId = $row["patientId"];
$pDetail = getPersonalDetail($row["patientId"]);

// print_r($pDetail);
			echo "<tr>";
				echo "<td>".++$count."</td>";			
				echo "<td>".$row["hospChargesId"]."</td>";
				echo "<td>".date('d-M-Y', strtotime($row["date"]))."</td>";
				echo "<td>".$pDetail['patientName']."</td>";
				echo "<td>".$pDetail['patientAge']."</td>";
				echo "<td>".$pDetail['patientAddress']."</td>";
				echo "<td>".$pDetail['patientPhone']."</td>";
				echo "<td>".$row['total']."</td>";
				echo "<td>
				<a data-toggle='tooltip'title='print invoice' data-placement='left' href='hospChargesInvoice.php?id=$hospChargesId'  class='btn btn-info btn-sm'><span class='glyphicon glyphicon-print'></span></a></td>";		
			echo "</tr>";
	}

}


if($_GET['p'] == 'gethospChargesId'){
$sql = "SELECT hospChargesId FROM hospcharges ORDER BY hospChargesId DESC LIMIT 1";
$query = mysqli_query($connect_me, $sql);
$row = mysqli_fetch_assoc($query);
$hospChargesId = $row['hospChargesId'];
		echo json_encode(array(
	
		"hospChargesId"=>++$hospChargesId,
		
		));
}

if($_GET['p'] == 'addHospCharges'){

	$sql = "INSERT INTO patient (patientName, patientNameOf, patientGender, patientAge, patientAddress, patientPhone, patientStatus, admDate, dischargeDate) 
	VALUES 
	('".test($_POST['patientName'])."',
	'".test($_POST['patientNameOf'])."',
	'".test($_POST['patientGender'])."',
	'".test($_POST['patientAge'])."',
	'".test($_POST['patientAddress'])."',
	'".test($_POST['patientPhone'])."',
	'outdoor',
	'".date("Y-m-d")."',
	'".date("Y-m-d")."'
	)";
	if(mysqli_query($connect_me, $sql)){ 
		$patientId = mysqli_insert_id($connect_me);
		$sql1 = "INSERT INTO hospcharges (patientId, stitchingCharges, dressingCharges, bedCharges, total, date) 
		VALUES 
		('$patientId',
		'".test($_POST['stitchingCharges'])."',
		'".test($_POST['dressingCharges'])."',
		'".test($_POST['bedCharges'])."',
		'".test($_POST['total'])."',
		'".date("Y-m-d")."'
		)";
		if(mysqli_query($connect_me, $sql1)){ 
			$hospChargesId = mysqli_insert_id($connect_me);
					echo json_encode(array(
					"hospChargesId"=>$hospChargesId
					));
			// echo '<div class="w3-panel w3-green w3-card-4">Successfully Added.!!</div>';
		}else{
			// echo "ERROR: Could not able to execute $sql. " . mysqli_error($connect_me);
			// echo '<div class="w3-panel w3-red w3-card-4">Something Went Wrong!</div>';
		}
	} 
}


if($_GET['p'] == 'getHCInvoiceReport'){

	$count = 0;
	$sum = 0;
	
	$frmDate = $_POST['frmDate'];
	$toDate = $_POST['toDate'];

$sql = "SELECT * FROM hospcharges WHERE date BETWEEN '$frmDate' AND '$toDate' ORDER BY hospChargesId DESC";
$query = mysqli_query($connect_me, $sql);
while($row = mysqli_fetch_assoc($query)){

$pDetail = getPersonalDetail($row["patientId"]);

// print_r($pDetail);
		echo "<tr>";
			echo "<td>".++$count."</td>";			
			echo "<td>".$row["hospChargesId"]."</td>";
			echo "<td>".date('d-M-Y', strtotime($row["date"]))."</td>";
			echo "<td>".$pDetail['patientName']."</td>";
			echo "<td>".$pDetail['patientAge']."</td>";
			echo "<td>".$pDetail['patientAddress']."</td>";
			echo "<td>0".$pDetail['patientPhone']."</td>";
			echo "<td>".$row['total']."</td>";
			$sum = $sum + $row['total'];
		echo "</tr>";
	}
		echo "<tr style='font-weight:bold;'>";
			echo "<td  align='right'colspan='7'>Grand Total</td>";
			echo "<td>".$sum."</td>";
		echo "</tr>";
}



?>	