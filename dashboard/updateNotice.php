<?php include'../db/db.php';?>
<?php include'../main/head.php';?>

<body>
<div id="wrapper">
<?php include 'pb_sidebar.php'?>

<section>
<form class="form-horizontal" method="post" enctype="multipart/form-data">
<fieldset>

<legend>Update the Register</legend>

<?php 

$pbRegisterId = $_GET['id'];

 if(isset($_POST['change'])){
	
	$dateRecieved = mysqli_real_escape_string($connect_me, $_POST['dateRecieved']);		
	$noticeCategoryId = mysqli_real_escape_string($connect_me, $_POST['noticeCategoryId']);		
	$appellant = mysqli_real_escape_string($connect_me, $_POST['appellant']);		
	$defendant = mysqli_real_escape_string($connect_me, $_POST['defendant']);		
	$totalCase = mysqli_real_escape_string($connect_me, $_POST['totalCase']);		
	$processName = mysqli_real_escape_string($connect_me, $_POST['processName']);		
	$hearingDate = mysqli_real_escape_string($connect_me, $_POST['hearingDate']);		
	$processPic = basename($_FILES['processPic']['name']);
	
	$path = "../images/processPic/" . $processPic;
	
	move_uploaded_file($_FILES['processPic']['tmp_name'], $path);
	
	if($_FILES["processPic"]["size"] > 500000) {
		
		$imagepath = $processPic;

		$save = "../images/processPic/" . $imagepath; //This is the new file you saving
		$file = "../images/processPic/" . $imagepath; //This is the original file

		list($width, $height) = getimagesize($file) ; 

		$modwidth = 600; 

		$diff = $width / $modwidth;

		$modheight = 500; 
		$tn = imagecreatetruecolor($modwidth, $modheight) ; 
		$image = imagecreatefromjpeg($file) ; 
		imagecopyresampled($tn, $image, 0, 0, 0, 0, $modwidth, $modheight, $width, $height) ; 

		imagejpeg($tn, $save, 100) ; 
	
	}
	
	$sql = "UPDATE pbregister SET processPic = '$processPic', noticeCategoryId='$noticeCategoryId', dateRecieved = '$dateRecieved', appellant = '$appellant', defendant = '$defendant', totalCase = '$totalCase', processName = '$processName', hearingDate = '$hearingDate' WHERE pbRegisterId = '$pbRegisterId'";
	if($query = mysqli_query($connect_me, $sql)){		
		echo "<div class='alert alert-success'>Photo Succesfully Changed</div>";
		//echo '<script>window.close();</script>';
		header("Location: viewRegister.php");
	}
	else{
		echo "<div class='alert alert-danger'>Some Error Occured.</div>";
		}
 }
?>

<?php 

$sql = "SELECT * FROM pbregister WHERE pbRegisterId = '$pbRegisterId'";

$query = mysqli_query($connect_me, $sql);

while($row=mysqli_fetch_assoc($query)){

echo "<div class='form-group'>";
	echo "<label class='col-sm-2 control-label'>Register Date:</label>";
		echo "<div class='col-sm-6'>";
			echo "<input value='".$row['pbRegisterDate']."' readonly class='form-control input-sm' type='date'>";
	echo "</div>";
echo "</div>";


echo "<div class='form-group'>";
	echo "<label class='col-sm-2 control-label'>Register No:</label>";
		echo "<div class='col-sm-6'>";
			echo "<input value='".$row['pbRegisterNumber']."' readonly class='form-control input-sm' type='text'></input>";
		echo "</div>";
echo "</div>";

	$sql2 = "SELECT * FROM dscourt WHERE dsCourtId = ".$row["dsCourtId"]."";
	$query2 = mysqli_query($connect_me, $sql2);
	while($row2=mysqli_fetch_assoc($query2)){
		$dsCourtName = $row2["dsCourtName"];
	}	

echo "<div class='form-group'>";
	echo "<label class='col-sm-2 control-label'>Court Name:</label>";
		echo "<div class='col-sm-6'>";
			echo "<input value='".$dsCourtName."' class='form-control input-sm' readonly   type='text'>";
		echo "</div>";
echo "</div>";

echo "<div class='form-group'>";
	echo "<label class='col-sm-2 control-label'>Plantiff:</label>";
		echo "<div class='col-sm-6'>";
			echo "<input value='".$row['appellant']."' name='appellant' class='form-control input-sm' type='text'></input>";
		echo "</div>";
echo "</div>";


echo "<div class='form-group'>";
	echo "<label class='col-sm-2 control-label'>Defendant:</label>";
		echo "<div class='col-sm-6'>";
			echo "<input value='".$row['defendant']."' name='defendant' class='form-control input-sm' type='text'></input>";
		echo "</div>";
echo "</div>";

echo "<div class='form-group'>";
	echo "<label class='col-sm-2 control-label'>Total Case Count:</label>";
		echo "<div class='col-sm-6'>";
			echo "<input value='".$row['totalCase']."' name='totalCase' class='form-control input-sm' type='number'></input>";
		echo "</div>";
echo "</div>";

echo "<div class='form-group'>";
	echo "<label class='col-sm-2 control-label'>Process Name:</label>";
		echo "<div class='col-sm-6'>";
			echo "<input value='".$row['processName']."' name='processName' class='form-control input-sm' type='text'></input>";
		echo "</div>";
echo "</div>";


echo "<div class='form-group'>";
	echo "<label class='col-sm-2 control-label'>Hearing Date:</label>";
		echo "<div class='col-sm-6'>";
			echo "<input value='".$row['hearingDate']."' name='hearingDate' class='form-control input-sm' type='date'></input>";
		echo "</div>";
echo "</div>";


echo "<div class='form-group'>";
	echo "<label class='col-sm-2 control-label'>Date Recieved:</label>";
		echo "<div class='col-sm-6'>";
			echo "<input value='".date('Y-m-d')."' name='dateRecieved' class='form-control input-sm'  type='date'></input>";
		echo "</div>";
echo "</div>";

?>

<div class="form-group">
  <label class="col-md-2 control-label" for="dsCourtId">Select Process Server:</label>
  <div class="col-md-6">
	<?php 
	
	$sql2 = "SELECT * FROM psuser WHERE psUserId <> '".$row['psUserId']."'";
	$query2 = mysqli_query($connect_me, $sql2);
	
	$sql3 = "SELECT * FROM psuser WHERE psUserId = '".$row['psUserId']."'";
	$query3 = mysqli_query($connect_me, $sql3);
	$row3 = mysqli_fetch_assoc($query3);

	echo "<select id='psUserId' name='psUserId' class='form-control '>";
		echo "<option value='".$row3["psUserId"]."'>".$row3["psUserName"]."</option>";
      while($row2 = mysqli_fetch_assoc($query2)){
		  echo "<option value='".$row2["psUserId"]."'>".$row2["psUserName"]."</option>";
	  }
    echo "</select>";
	?>
  </div>
</div>

<div class="form-group">
  <label class="col-md-2 control-label" for="dsCourtId">Select Notice Category:</label>
  <div class="col-md-6">
	<?php 
	$sql2 = "SELECT * FROM noticecategory ";
	$query2 = mysqli_query($connect_me, $sql2);
	echo "<select id='noticeCategoryId' name='noticeCategoryId' class='form-control js-example-basic-multiple' multiple='multiple'>";
      while($row2 = mysqli_fetch_assoc($query2)){
		  echo "<option value='".$row2["noticeCategoryId"]."'>".$row2["noticeCategoryDetail"]."</option>";
	  }
    echo "</select>";
	?>
  </div>
</div>


<script type="text/javascript">
$(".js-example-basic-multiple").select2({
	placeholder: "Select please",
  allowClear: true
});
</script>

<?php

echo "<div class='form-group'>";
	echo "<label class='col-sm-2 control-label'>Add Picture:</label>";
		echo "<div class='col-sm-6'>";
			echo "<input placeholder='Enter Detail' name='processPic' class='form-control input-sm' required type='file'></input>";
		echo "</div>";
echo "</div>";

?>

<div class="form-group">
    <label class="col-md-4 control-label"></label>
  <div class="col-sm-2">
  <input name="change" value="Update" class="btn btn-success btn-block" class="form-control input-sm" required="" type="submit">
  </div>
</div>

</fieldset>
</form>

<?php }?>
</section>
	
</div>

</body>
</html>	