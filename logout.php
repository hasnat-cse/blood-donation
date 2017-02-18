<?php require_once("includes/header.php");?>
<?php include_once("includes/functions.php");?>
<?php include_once("includes/DB_connection.php");?>
	
<?php
	session_destroy();
	header("Location:login.php");
?>

<?php include("includes/footer.php");?>