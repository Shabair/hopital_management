<?php include'../db/db.php';?>
<?php include'../main/head.php';?>
<style type="text/css" media="print">
    @page { 
        size: portrait;
    }
    body { 
        writing-mode: tb-rl;
    }
	.t-b-m-0 {
    	margin-top:0px;
    	margin-bottom:0px;
    }
</style>

<style type="text/css">
	.t-b-m-0 {
    	margin-top:0px;
    	margin-bottom:0px;
    }
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

$invoiceGenId = $_GET['id'];

$sql = "SELECT * FROM invoicegen WHERE invoiceGenId = '$invoiceGenId'";

$query = mysqli_query($connect_me, $sql);
if(mysqli_num_rows($query) > 0){
	
while($row=mysqli_fetch_assoc($query)){
$patientId = $row["patientId"];
$pDetail = getPersonalDetail($patientId);
?>
<?php 
$sql2 = "SELECT * FROM cat WHERE catId = '".$pDetail["catId"]."'";
$query2 = mysqli_query($connect_me, $sql2);
if(mysqli_num_rows($query2) > 0){
	$row2 = mysqli_fetch_assoc($query2);
}
 ?>
<div class="table-responsive">
<table width="60%" id="myTable" cellpadding="1" align="center" style="margin-top:0px;">
<?php

echo '<tbody style="border:1px solid #000;"	>
	<td align="center" colspan="2"><img src="../images/invoiceLogo.png" width="70px" /></td>
		<td colspan="4">
		<center>
		<h2 style="margin:0;padding:0;font-family: serif;"><strong>Zohra Memorial<br /> Hospital <strong></h2><h4></h4>  </h3>
		<h6 style="margin-top:-10px;margin-bottom:0px;padding:0;">(UNDER THE MANAGEMENT OF JAFFAR HILBRO TRUST SIALKOT)</h6>
		</center>
		</td>
	</tr>
	<tr>
		<td><h6><strong> '.date("d-M-y", strtotime($row['date'])).' |<strong></h6></td>
		<td colspan="2"><h5><strong>'.getDoctorName($pDetail['doctorId']).'</strong></h5></td>
		<td colspan="2" style="border:1px solid #000;text-align:center;"><h5><strong>'.getCatName($pDetail['catId']).'</strong></h5></td>
		<td rowspan="3" style="border:1px solid #000;text-align:center;">
			<div class="t-b-m-0">Sr#: <strong>'.$row['serialNo'].'</strong></div>
			<div class="t-b-m-0">Token#: <strong>'.$row['tokenNo'].'</strong></div>
			<div class="t-b-m-0">H. Charges#: <strong>'.$row2['catPrice'].'</strong></div>
			<div class="t-b-m-0">Dr.Fee#: <strong>'.$row['fee'].'</strong></div>
			<div class="t-b-m-0">Total: <strong>'.$row['total'].'</strong></div>
		</td>
	</tr>
	<tr>
		<td colspan="2"><h4>Name: <strong>'.$pDetail['patientName'].'</strong></h4></td>
		<td><h4>Age: <strong>'.$pDetail['patientAge'].'</strong></h4></td>
		<td colspan="2"><h4>Gender: <strong>'.$pDetail['patientGender'].'</strong></h4></td>
	</tr>
	<tr>
		<td><h5>Tmp: _____</h5></td>
		<td><h5>Pulse: _____</h5></td>
		<td><h5>BP: _____</h5></td>
		<td colspan="2"><h5>LMP: _____</h5></td>
	</tr>
	</tbody>
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
			echo "<p class='form-control-static'>Nothing is Pending</h5>";		
	echo "</div>";
echo "</div></td></tr>";
}
?>
</section>
	
</div>
<script>
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