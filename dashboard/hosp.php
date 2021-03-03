<?php include'../db/db.php';?>
<?php include'../main/head.php';?>

<div id="wrapper">
<?php include 'hospSidebar.php'?>

<?php 
$today = date("d-M-Y");
$to_da = date("Y-m-d");
$sql = "SELECT * FROM patient WHERE patientStatus = 'indoor' AND dischargeDate IS NULL";
if($query = mysqli_query($connect_me, $sql)){
	$indoorCount = mysqli_num_rows($query);
}

$sql = "SELECT * FROM invoicegen WHERE date = '$to_da'";
if($query = mysqli_query($connect_me, $sql)){
	$outdoorCount = mysqli_num_rows($query);
}

$sql3 = "SELECT * FROM hospcharges WHERE date = '$to_da'";
if($query3 = mysqli_query($connect_me, $sql3)){
	$HCCount = mysqli_num_rows($query3);
}

$sql2 = "SELECT SUM(balance) AS pend FROM invoice";
if($query2 = mysqli_query($connect_me, $sql2)){
	$row2 = mysqli_fetch_assoc($query2);
	$pend = $row2['pend'];
}


$sql1 = "SELECT * FROM patient WHERE date LIKE '".$to_da."'";
if($query1 = mysqli_query($connect_me, $sql1)){
	$register_count = mysqli_num_rows($query1);
	if(empty($register_count)){
		$register_count=0;
	}
}

?>

<fieldset>

<a href="indoorPatient.php">
<div class="col-md-6">
	<div class="panel-group">
		<div class="panel panel-info">
			<div class="panel-heading">
				<div class="row">
					<div class="col-xs-9"><i class="animated flipInY glyphicon glyphicon-log-in" style="font-size:6.5em;"></i><h2>Total Indoor Patient <br><sup>Unpaid</sup></div>
					<div class="col-xs-3 text-right" style="font-size:2.5em;"><?php echo $indoorCount; ?></div>
				</div>
			</div>
		</div>
	</div>
</div>
</a>

<a href="invoiceGen.php">
<div class="col-md-6">
	<div class="panel-group">
		<div class="panel panel-info">
			<div class="panel-heading">
				<div class="row">
					<div class="col-xs-9"><i class="animated flipInY glyphicon glyphicon-log-out" style="font-size:6.5em;"></i><h2>Total Outdoor Patient <br><sup><?php echo $today ?></sup></div>
					<div class="col-xs-3 text-right" style="font-size:2.5em;"><?php echo $outdoorCount; ?></div>
				</div>
			</div>
		</div>
	</div>
</div>
</a>

<a href="hospCharges.php">
<div class="col-md-6">
	<div class="panel-group">
		<div class="panel panel-info">
			<div class="panel-heading">
				<div class="row">
					<div class="col-xs-9"><i class="animated flipInY glyphicon glyphicon-log-out" style="font-size:6.5em;"></i><h2>Total HC Patient <br><sup><?php echo $today ?></sup></div>
					<div class="col-xs-3 text-right" style="font-size:2.5em;"><?php echo $HCCount; ?></div>
				</div>
			</div>
		</div>
	</div>
</div>
</a>

<a href="invoiceReportUnpaid.php">
<div class="col-md-6">
	<div class="panel-group">
		<div class="panel panel-info">
			<div class="panel-heading">
				<div class="row">
					<div class="col-xs-9"><i class="animated flipInY glyphicon glyphicon-usd" style="font-size:6.5em;"></i><h2>Pending Amount<br><br></div>
					<div class="col-xs-3 text-right" style="font-size:2.5em;">Rs. <?php echo $pend; ?></div>
				</div>
			</div>
		</div>
	</div>
</div>
</a>

</fieldset> 

<script>
$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip();   
});
</script>
</div>
</body>
</html>

