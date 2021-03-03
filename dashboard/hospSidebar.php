<?php

if(!isset($_SESSION['id']))
{
	header('location:../main/login.php');
}

?>
  <div class="modal fade" id="help" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title modal-success">Help Menu - Shortcut Keys</h4>
        </div>
        <div class="modal-body">
		<div class="row">
			<div class="col-md-2">
				<h4><span class="label label-default">ALT + f1</span></h4><br>
				<h4><span class="label label-default">ALT + i</span></h4><br>
				<h4><span class="label label-default">ALT + o</span></h4><br>
				<h4><span class="label label-default">ALT + L</span></h4><br>
				<h4><span class="label label-default">ALT + h</span></h4><br>
			</div>
			<div class="col-md-9">
				<h4>Help</h4><br>
				<h4>Click to open Add New Patient </h4><br>
				<h4>Click to open Add New Outdoor Invoice </h4><br>
				<h4>Click to open Add New Lab Test report </h4><br>
				<h4>Click to open Add New Hosp Charges Invoice </h4><br>
			</div>
		</div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>
  
<div class="loader"></div>
		<!-- Sidebar -->
        <div id="sidebar-wrapper" style="background-color:#004A69;">
            <ul class="sidebar-nav">
                <li class="sidebar-brand">
				<a href="#menu-toggle" id="menu-toggle"><span class="glyphicon glyphicon-option-vertical" style="color:#fff;font-size:24px;padding-left:15px;"></span></a>	
				<img class="logo-image thumbnail" src="../images/<?php echo $_SESSION['pic'];?>"></img>
                </li><br><br><br>		
                <li>
                    <a href="hosp.php"><span style='font-size:48px;' class="glyphicon glyphicon-home"></span>&nbsp Home</a>
                </li>
				<li>
                    <a data-toggle="collapse" href="#pat"><span style='font-size:48px;' class="glyphicon glyphicon-bed"></span>&nbsp Indoor<span class="caret"></span></a>
					<div id="pat" class="panel-collapse collapse">
						<ul class="list-group">
						<a href="indoorPatient.php"><li class="list-group-item">> Patient</li></a>
						<a href="invoice.php"><li class="list-group-item">> Invoice</li></a>					
						</ul>
					</div>
                </li> 
				<li>
                    <a href="invoiceGen.php"><span style='font-size:48px;' class="glyphicon glyphicon-print"></span>&nbsp Outdoor</a>
                </li> 
				<li>
                    <a href="hospCharges.php"><span style='font-size:48px;' class="glyphicon glyphicon-road"></span>&nbsp Hosp Charges</a>
                </li> 
				<li>
                    <a href="lab.php"><span style='font-size:48px;' class="glyphicon glyphicon-filter"></span>&nbsp Lab</a>
                </li>
				<li>
                    <a data-toggle="collapse" href="#rep"><span style='font-size:48px;' class="glyphicon glyphicon-paperclip"></span>&nbsp Reports<span class="caret"></span></a>
					<div id="rep" class="panel-collapse collapse">
						<ul class="list-group">
						<a href="invoiceReport.php"><li class="list-group-item">> Indoor</li></a>				
						<a href="invoiceGenReport.php"><li class="list-group-item">> Outdoor</li></a>				
						<a href="invoiceLabReport.php"><li class="list-group-item">> Lab</li></a>				
						<a href="invoiceHCReport.php"><li class="list-group-item">> HC</li></a>				
						</ul>
					</div>
                </li> 
				<li>
                    <a data-toggle="collapse" href="#set"><span style='font-size:48px;' class="glyphicon glyphicon-cog"></span>&nbsp Setting<span class="caret"></span></a>
					<div id="set" class="panel-collapse collapse">
						<ul class="list-group">
						<a href="profile.php"><li class="list-group-item">> Profile</li></a>							
						<a href="OPDPrice.php"><li class="list-group-item">> OPD Price</li></a>							
						<a href="backup.php"><li class="list-group-item">> Backup</li></a>							
						</ul>
					</div>
                </li> 				
            </ul>
        </div>
<div class="clearfix">
	<div class="col-md-12">
		<h4 class="alert alert-warning">Welcome
		<strong><?php echo $_SESSION['name']; ?></strong>
		<a href="../main/logout.php"><button style="float:right;" class="btn btn-default btn-xs"><span class="glyphicon glyphicon-logout">Logout</button></a>
		</h4>
	</div>
</div>
<!-- Responive sidebar -->
	<script>
    $("#menu-toggle").click(function(e) {
        e.preventDefault();
        $("#wrapper").toggleClass("toggled");
    });
    </script>

