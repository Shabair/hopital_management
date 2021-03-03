<?php include'../db/db.php';?>
<?php include'../main/head.php';?>

<body>
<div id="wrapper">
<?php include 'hospSidebar.php'?>
<section>
<form id="myForm" class="form-horizontal" method="post">
<fieldset>

<legend>Update Your Record</legend>

<p id="result"></p>

  <input id="adminId" value="<?php echo $_SESSION['id']; ?>" class="form-control input-md" required="" type="hidden">   


<div class="form-group">
  <label class="col-md-4 control-label" for="name">Your Name</label>  
  <div class="col-md-5">
  <input id="name" class="form-control input-md" required="" type="text">   
  </div>
</div>

<div class="form-group">
  <label class="col-md-4 control-label" for="email">Your Email</label>  
  <div class="col-md-5">
  <input id="email" class="form-control input-md" required="" type="email">   
  </div>
</div>

<div class="form-group">
  <label class="col-md-4 control-label" for="password">Your Password</label>  
  <div class="col-md-5">
  <input id="password" class="form-control input-md"  required="" type="password">   
  </div>
</div>

<div class="form-group">
    <label class="col-md-4 control-label"></label>
  <div class="col-sm-2">
  <button onclick="return invoice()" class="btn btn-info btn-block" type="button" required="">Update</button>
  </div>
</div>

</fieldset>
</form>


</section>



<script>
		var adminId = $("#adminId").val();
	$.ajax({
		method:"POST",
		url:"modalData.php?adminId="+adminId,
		dataType:"JSON",
		success: function(res){
			$("#name").val(res.adminName);
			$("#password").val(res.adminPassword);
			$("#email").val(res.adminEmail);
		}
	});
	
function invoice(){
	var name = $("#name").val();
	var email = $("#email").val();
	var password = $("#password").val();
	if(name == "" || email == "" || password == ""){
		return false;
	}else{
		$.ajax({
		method:"POST",
		url:"ajax.php?p=profile",
		dataType:"text",
		data:"name="+name+"&email="+email+"&password="+password,
		success: function(response){			
		alert("Successfully Changed the credential. \n Next Time Please Sign in with New Credential.\n Now Lgging You Out!");			
		window.location.assign("../main/logout.php");
		}
	});
	}
} 
</script>
	
</div>
</body>
</html>	