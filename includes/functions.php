<?php
	function confirm_query($result_set){
		if(!$result_set){
			die("Database Query Failed".mysql_error());
		}
	}

	function check_if_super_admin(){
		if(isset($_SESSION["user_id"])){
			if($_SESSION["role"]!='super_admin'){
				header("Location:logout.php");
			}
		}
		else{
			header("Location:login.php");

		}
	}

	function check_if_admin(){
		if(isset($_SESSION["user_id"])){
			if($_SESSION["role"]!='admin'){
				header("Location:logout.php");
			}
		}
		else{
			header("Location:login.php");

		}
	}

	function check_if_member(){
		if(isset($_SESSION["user_id"])){
			if($_SESSION["role"]!='member'){
				header("Location:logout.php");
			}
		}
		else{
			header("Location:login.php");

		}

	}

	function check_if_logged_in(){
		if(!isset($_SESSION["user_id"])){
			header("Location:login.php");
		}

	}
?>