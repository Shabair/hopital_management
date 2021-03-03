<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

<title>Zohra Memorial Hospital</title>


	<link href="../css/bootstrap.min.css" rel="stylesheet">
	<link href="../css/bootstrap-theme.min.css" rel="stylesheet">
	<link href="../css/Custom.css" rel="stylesheet">
	<link href="../css/fonts.css" rel="stylesheet">
	<link href="../css/Custom.css" rel="stylesheet">
	<link href="../css/select2.min.css" rel="stylesheet">
	<link href="../css/simple-sidebar.css" rel="stylesheet">
	<link href="../css/print.css" rel="stylesheet">
	<link href="../css/jquery.dataTables.min.css" rel="stylesheet">
	<link href="../css/buttons.dataTables.min.css" rel="stylesheet">
	<link rel="shortcut icon" href="../images/invoiceLogo.png">
	
	<script src="../js/jquery.min.js"></script>
	<script src="../js/bootstrap.min.js"></script>
	<script src="../js/npm.js"></script>
	<script src="../js/print.min.js"></script>
	<script src="../js/jquery.dataTables.min.js"></script>
	<script src="../js/dataTables.buttons.min.js"></script>
	<script src="../js/custom.js"></script>
	<script src="../js/select2.min.js"></script>
	<script src="../js/mousetrap.min.js"></script>
	<script type="text/javascript" language="javascript">
        $(function() {
            $(this).bind("contextmenu", function(e) {
                e.preventDefault();
            });
        }); 
	</script>
	<script type="text/javascript" language="javascript">
	function ap(){
		window.location.assign("../dashboard/addPatient.php");
	}
	function aig(){
		window.location.assign("../dashboard/addInvoiceGen.php");	
	}
	function al(){
	window.location.assign("../dashboard/addLab.php");	
	}
	function hc(){
	window.location.assign("../dashboard/addHospCharges.php");	
	}
		Mousetrap.bind('alt+i', function(e) {ap();});
		Mousetrap.bind('alt+o', function(e) {aig();});
		Mousetrap.bind('alt+l', function(e) {al();});
		Mousetrap.bind('alt+h', function(e) {hc();});
		Mousetrap.bind('alt+f1', function() {$('#help').modal('show');});
	</script>
	<style>
	.jumbotron{
		background-color: rgba(0,0,0,0.2);
		font-family: Altair-Thin-trial;
		color:white;
		
	}
	img:hover{
		opacity: 1;
	}

	.img-circle{
		opacity: 0.5;
	}
	.select2-container--default .select2-selection--single{
		border-radius: 5px; 
		padding-top:10px;
	}
	.select2-container .select2-selection--single {
    height:40px;
	}
	</style>
</head>