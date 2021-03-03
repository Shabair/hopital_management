<?php 
//ob_start(); session_start();

if(isset($_SESSION['id']))
{
	header('location:../dashboard/hosp.php');
}

	include_once("../db/db.php");
	
	if (isset($_POST['adminSubmit']) && !empty($_POST['adminEmail']) && !empty($_POST['adminPassword'])) {

		$email = strip_tags($_POST['adminEmail']);
		$password = strip_tags($_POST['adminPassword']);
		
		$sql = "SELECT * FROM admin WHERE adminEmail= '$email' LIMIT 1";
		$query = mysqli_query($connect_me, $sql);
		
	 	if(mysqli_num_rows($query) >0 ){
			// echo '<script>alert("Correct Username");</script>';
		$row = mysqli_fetch_assoc($query);			
			
			$adminId = $row['adminId'];	 
			$adminName = $row['adminName'];	 
			$adminEmail = $row['adminEmail'];	 
			$adminPassword = $row['adminPassword'];	 
			$adminPic = $row['adminPic'];
			
			$_SESSION['valid'] = true;
			$_SESSION['timeout'] = time();
			
				if($email == $adminEmail && $password == $adminPassword){
						
					echo '<script>alert("Correct Username");</script>';
					
					$_SESSION['id'] = $adminId;
					$_SESSION['name'] = $adminName;
					$_SESSION['email'] = $adminEmail;
					$_SESSION['password'] = $aminPassword;
					$_SESSION['pic'] = $adminPic;
					
					header("Location: ../dashboard/hosp.php");
									
				} else{
					echo '<script>alert("Wrong Username or Password");</script>';
				}	
		} else {
		echo '<script>alert("Something is Wrong with Your detail");</script>';
	   }
	}
	
?>

 <?php include'head.php';?>

<body class="fix-pic" style="background-image: url(../images/mainSlider.jpg);height:100vh;">
<div class="clearfix text-center">
	<div class="col-md-4 col-sm-4 col-lg-4 col-md-offset-4 col-sm-offset-4 col-lg-offset-4" style="padding-top:160px;">
		<div class="container-fluid">
			<div class="row">            
				<div class="login-panel panel panel-default">
				<div class="panel-heading"> Want to Go Back <a href='../index.php' >Home</a>
					</div>
						<div class="panel-body">
							<form class = "form-signin" role = "form" method="post">
								<h2 class="form-signin-heading">Zohra Memorial Hospital</h2>
									<fieldset>
										<div class="form-group">
											<input class="form-control" placeholder="Enter Your Email" name="adminEmail" type="email"  required autofocus>
										</div>
										<div class="form-group">
											<input class="form-control" placeholder="Enter Your Password" name="adminPassword" type="password" required>
										</div>
										
										<input data-scroll name="adminSubmit" value="Login" type="submit" class="btn-in">
										<a type="button" data-toggle="modal" style="cursor:pointer;color:white;" data-target="#myModal">Forgot Password?</a>
									</fieldset>
							</form>
						</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-sm">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">&copy; 6dearSoft</h4>
      </div>
      <div class="modal-body">
        <p>Please Contact to IT Wing.<br> For Any Query, Please feel free to email at: <br> cb8882@gmail.com.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-success" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>

</body>
</html>