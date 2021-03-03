<?php include'../db/db.php';?>
<?php include'../main/head.php';?>
<style type="text/css" media="print">
    @page { 
        size: portrait;
    }
    body { 
        writing-mode: tb-rl;
    }
	#m
</style>
<body>
<div id="wrapper">
<?php include 'hospSidebar.php'?>

<section>
<form class="form-inline" method="post" enctype="multipart/form-data">
<fieldset>
<!-- <button type="button" onclick="printJS('myTable', 'html')"><span class="glyphicon glyphicon-print"></span></button> -->
 <button onclick="printData()" class="glyphicon glyphicon-print"></button> 
<?php 

$labId = $_GET['id'];

$sql = "SELECT * FROM lab WHERE labId = '$labId'";

$query = mysqli_query($connect_me, $sql);
if(mysqli_num_rows($query) > 0){
	
while($row = mysqli_fetch_assoc($query)){
	
// $lDetail = getLabTestDetail($row['labId']);
$pDetail = getPersonalDetail($row['patientId']);

?>
<div class="table-responsive">
<table id="myTable" border="1" width="100%" height="500px" cellpadding="10" style="border-collapse:collapse;padding-top:100px;">
<?php
echo '<tbody>
<tr><td colspan="1"><img src="../images/invoiceLogo.png" class="img-responsive" width="100px" /></td><td colspan="5"><center><h2>ZOHRA MEMORIAL HOSPITAL</h2><h5>(UNDER THE MANAGEMENT OF JAFFAR HILBRO TRUST SIALKOT)</h5></center></td></tr>
	<tr><td colspan="6"><h1><center>Laboratory, X-Ray, USG Receipt</center></h1></td></tr>
	<tr>
		<td colspan="1" style="border:1px solid #000;">
			<p>Receipt No: <strong>'.$row['labId'].'</strong></p>
		</td>
		<td colspan="4"></td>
		<td colspan="1" style="border:1px solid #000;text-align:right;">
			<p>Date: <strong>'.date("d-M-Y", strtotime($row['labTestDate'])).'</strong></p>
		</td>
	</tr>
	<tr>
		<td colspan="6" style="border:1px solid #000;">
			<p>Prescribed By: <strong>'.getDoctorName($row['doctorId']).'</strong></p>
		</td>
	</tr><br>
	<tr>
		<td colspan="3"><p>Name: <strong>'.$pDetail['patientName'].'</strong></p></td>
		<td colspan="3"><p>S.D.W/O: <strong>'.$pDetail['patientNameOf'].'</strong></p></td>
	</tr>
	<tr>
		<td><p>Age: <strong>'.$pDetail['patientAge'].'</strong></p></td>
		<td><p>Gender: <strong>'.$pDetail['patientGender'].'</strong></p></td>
		<td colspan="4"><p>Address: <strong>'.$pDetail['patientAddress'].'</strong></p></td>
	</tr>
	<tr>
		<td colspan="5" style="text-align:right;"><p><strong>Test Detail</strong></p></td>
		<td><p><strong>Amount</strong></p></td>
	</tr>'
	;
	
	$sql1 = "SELECT * FROM labtest WHERE labId = '".$row['labId']."'";
	$query1 = mysqli_query($connect_me, $sql1);
	while($row1 = mysqli_fetch_assoc($query1)){	
	echo '<tr>
			<td colspan="5" style="text-align:right;"><p>'.getCatName($row1['catId']).'</p></td>
			<td><p>Rs. '.getCatPrice($row1['catId']).'</p></td>
		</tr>
	';
	}
	
	echo '
	<tr>
		<td colspan="5" style="text-align:right;"><p><strong>Total</strong></p></td>
		<td  style="text-align:left;"><p><strong>Rs. '.$row['total'].'</strong></p></td>
	</tr>
	</tbody>';


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
<script>
	$('#myTable').DataTable();

    function generate() {
	    var doc = new jsPDF();
		var elem = document.getElementById("myTable");
		var res = doc.autoTableHtmlToJson(elem);
		doc.autoTable(res.columns, res.data, {startY: 20});
		doc.save("table.pdf");
    }
	
function printData()
{
   var divToPrint=document.getElementById("myTable");
   newWin= window.open("");
   newWin.document.write(divToPrint.outerHTML);
   newWin.print();
   newWin.close();

   }
</script>
</body>
</html>	