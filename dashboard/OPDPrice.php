<?php include'../db/db.php';?>
<?php include'../main/head.php';?>
<style>
.form-horizontal .form-group {
    margin-right: 0px; 
    margin-left: 0px; 
}
</style>
<body>
<div id="wrapper">
<?php include 'hospSidebar.php'?>
<section>

<form class="form-horizontal">
<legend>Current Pricing of OPD </legend>
  <div class="form-group">
    <label class="control-label col-sm-2" for="general">General:</label>
    <div class="col-sm-4">
      <p class="form-control-static form-control" id="general"></p>
    </div>
  </div>

  <div class="form-group">
    <label class="control-label col-sm-2" for="general2">General 2:</label>
    <div class="col-sm-4">
      <p class="form-control-static form-control" id="general2"></p>
    </div>
  </div>
  
  <div class="form-group">
    <label class="control-label col-sm-2" for="anti">Anti-Natal:</label>
    <div class="col-sm-4">
      <p class="form-control-static form-control" id="anti"></p>
    </div>
  </div>

  <div class="form-group">
    <label class="control-label col-sm-2" for="anti2">Anti-Natal 2:</label>
    <div class="col-sm-4">
      <p class="form-control-static form-control" id="anti2"></p>
    </div>
  </div>
  
	<div class="form-group">
		<label class="col-md-4 control-label"></label>
	  <div class="col-sm-2">
	  <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#opd">Edit</button>
	  </div>
	</div>
		
		
</form>


<!-- Modal -->
<div id="opd" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Update the OPD Pricing</h4>
      </div>
      <div class="modal-body">  

		<form id="myForm" class="form-horizontal" method="post">
		<fieldset>

		<p id="result"></p>
		

		<div class="form-group">
		  <label class="col-md-4 control-label" for="generalOPD">General OPD</label>  
		  <div class="col-md-5">
		  <input id="generalOPD" name="generalOPD" class="form-control input-md" required="" type="number">   
		  </div>
		</div>

		<div class="form-group">
		  <label class="col-md-4 control-label" for="generalOPD2">General 2 OPD</label>  
		  <div class="col-md-5">
		  <input id="generalOPD2" name="generalOPD2" class="form-control input-md" required="" type="number">   
		  </div>
		</div>

		<div class="form-group">
		  <label class="col-md-4 control-label" for="antiOPD">Anti-Natal OPD</label>  
		  <div class="col-md-5">
		  <input id="antiOPD" name="antiOPD" class="form-control input-md" required="" type="number">   
		  </div>
		</div>

		<div class="form-group">
		  <label class="col-md-4 control-label" for="antiOPD2">Anti-Natal 2 OPD</label>  
		  <div class="col-md-5">
		  <input id="antiOPD2" name="antiOPD2" class="form-control input-md" required="" type="number">   
		  </div>
		</div>

		<div class="form-group">
			<label class="col-md-4 control-label"></label>
		  <div class="col-sm-2">
		  <button onclick="return updateOPD()" class="btn btn-info btn-block" class="form-control input-sm" required="">Update</button>
		  </div>
		</div>

		</fieldset>
		</form>


      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>





</section>



<script>
// setInterval(getOPDPrice, 1000);

// function getOPDPrice(){
	$.ajax({
		method:"POST",
		url:"insert.php?p=getOutdoorOPDPrice",
		dataType:"JSON",
		success: function(resp){
			// alert(resp);
			// var labId = addZero(resp.labId)
			$("#general").html(resp.general);
			$("#general2").html(resp.general2);
			$("#anti").html(resp.anti);
			$("#anti2").html(resp.anti2);
			$("#generalOPD").val(resp.general);
			$("#generalOPD2").val(resp.general2);
			$("#antiOPD").val(resp.anti);
			$("#antiOPD2").val(resp.anti2);
		}
	});	
	// alert(catId);
// }


function updateOPD(){
	
	var generalOPD = $("#generalOPD").val();
	var antiOPD = $("#antiOPD").val();
	var generalOPD2 = $("#generalOPD2").val();
	var antiOPD2 = $("#antiOPD2").val();
	
		$.ajax({
		method:"POST",
		url:"insert.php?p=updateOPDPrice",
		dataType:"text",
		data:"generalOPD="+generalOPD+"&generalOPD2="+generalOPD2+"&antiOPD="+antiOPD+"&antiOPD2="+antiOPD2,
			success: function(response){
				// alert(response);
				alert("Successfuly Updated");
				// $("#demo").innerHTML = response;
				setTimeout(location.reload.bind(location), 1000);
			}
		});
}
</script>
	
</div>
<?php include'footer.php';?>
</body>
</html>	