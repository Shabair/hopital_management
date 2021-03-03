<?php include'../db/db.php';?>
<?php include'../main/head.php';?>
<?php include'back.php';?>

<body>
<div id="wrapper">
<?php include 'hospSidebar.php'?>
<section>
<form id="myForm" class="form-horizontal" method="post">
<fieldset>

<legend style="padding-left:20px;">Backup</legend>

<p id="result"></p>


<div class="form-group text-center">
  <div class="col-md-5 col-md-offset-3">
  <input name="random" class="form-control input-md"  required="" type="text" placeholder="Write 'Backup' and Click Below">   
  </div>
</div>

<div class="form-group">
    <label class="col-md-4 control-label"></label>
  <div class="col-sm-2">
  <button class="btn btn-info btn-block" type="submit" name="backupDone" required="">Backup</button>
  </div>
</div>

</fieldset>
</form>


</section>

	
</div>
</body>
</html>	