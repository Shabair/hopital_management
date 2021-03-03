<?php include'../db/db.php';?>
<?php include'../main/head.php';?>

<body>
<div id="wrapper">
<?php include 'hassan_sidebar.php'?>

<section>
<form class="form-inline" method="post" enctype="multipart/form-data">
<fieldset>
 <button type="button" onclick="printJS('myTable', 'html')"><span class="glyphicon glyphicon-print"></span></button> 
<!-- <button onclick="printfunction()" class="glyphicon glyphicon-print"></button> -->
<?php 

$patient_id = $_GET['id'];

$sql = "SELECT * FROM billing_table WHERE invoice_id = '$patient_id'";

$query = mysqli_query($connect_me, $sql);
if(mysqli_num_rows($query) > 0){
	
while($row=mysqli_fetch_assoc($query)){
$sql1 = "SELECT * FROM register_patient WHERE patient_id = ".$row['patient_id']."";
$query1 = mysqli_query($connect_me, $sql1);
while($row1 = mysqli_fetch_assoc($query1)){
	$name = $row1['name'];
}

?>
<div class="table-responsive">
<table  class="table table-bordered"  id="myTable">
<?php
echo "<div class='clearfix'>";
echo "<div class='col-sm-3'>";
echo "<tr>";
echo "<td style='text-align:center;'colspan='3'><center><legend>Patient Bill Detail</legend></center></td>";
echo "</tr>";
echo "</div>";

echo "<tr><div class='col-sm-9'>";
echo "<td><div class='form-group'>";
	echo "<label class='control-label'>Patient Name:</label>";
		echo "<div class='col-sm-10'>";
			echo "<p class='form-control-static'>".$name."</p>";		
		echo "</div>";
echo "</div></td>";


echo "<td><div class='form-group'>";
	echo "<label class='control-label'>Total Bill:</label>";
		echo "<div class='col-sm-10'>";
			echo "<p class='form-control-static'>".$row['amount']."</p>";		
		echo "</div>";
echo "</div></td></tr>";

echo "<tr><td><div class='form-group'>";
	echo "<label class='control-label'>Date & Time:</label>";
		echo "<div class='col-sm-10'>";
			echo "<p class='form-control-static'>".$row['date_time']."</p>";		
		echo "</div>";
echo "</div></td>";


echo "<td><div class='form-group'>";
	echo "<label class='control-label'>Status:</label>";
		echo "<div class='col-sm-10'>";
			echo "<p class='form-control-static'>".$row['status']."</p>";		
	echo "</div>";
echo "</div></td></tr>";

echo "</div>";
echo "</div>";

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

</body>
</html>	