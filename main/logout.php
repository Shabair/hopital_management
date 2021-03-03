<?php ob_start();?>
<?php session_start();?>

<?php
	 session_destroy();
	 header('location: login.php');
?>

<!--<body>

	
</body>
</html>-->