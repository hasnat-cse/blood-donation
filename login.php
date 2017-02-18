<?php require_once("includes/header.php")?>
<?php include_once("includes/functions.php")?>
<?php include_once("includes/DB_connection.php");?>

<?php

	if(isset($_POST["user_name"])){
		
		$query="select * from member_info 
				where user_name='{$_POST["user_name"]}'";
		$buff=mysql_query($query,$connection);
		confirm_query($buff);
		$valid_log_flag=0;
		while($staff_info=mysql_fetch_array($buff)){
			
			$valid_log_flag=1;
			
			if(($staff_info["password"]==($_POST["pass"]))){
				$_SESSION["user_id"]=$staff_info["id"];

				if($staff_info["role"]=="super_admin"){
					$_SESSION["role"]=$staff_info["role"];
					header("Location:super_admin.php");
				}			
				else if($staff_info["role"]=="admin"){
					$_SESSION["hall"]=$staff_info["hall"];
					$_SESSION["role"]=$staff_info["role"];
					header("Location:admin.php");				
				}
				else{
					$_SESSION["hall"]=$staff_info["hall"];
					$_SESSION["role"]=$staff_info["role"];
					header("Location:member.php");
				}
			}
			else{ 
				echo "Password Mistake";
				header("Location:login.php");
			}
			
			if(!$valid_log_flag){
				echo "Invalid Id"."<br/>";
				header("Location:login.php");
			}
		}
	}

?>


	<body style="background:url('images/back.png') ">
		<marquee behavior="alternate"><h1 align="center"><strong><b><u>Blood Donation DBMS</u></b></strong></h1></marquee>
		
		<!--<style>
		a:hover
		{
		background-color:yellow;
		}
		</style>-->


		
		<br/><br/>
		<form action="login.php" method="POST">

			</br></br></br></br></br>
			
	
			<div style="text-align:center;">

				<fieldset style="position:absolute;left:35%;top:30%;display:block;">
					<legend>BDDBMS</legend>
				</br>
				<ul style="">
					<li>
						<label for="user_name">User Name:</label>&nbsp;&nbsp;&nbsp;&nbsp;
						<input id="user_name" name="user_name"/></br>
					</li>
				</br>
					<li>
						<label for="pass">Password:</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<input id="pass"  type="password" name="pass"/></br>
					</li>
					
				</ul>
				<input type="submit" value="Log In"/>

				</fieldset>

				</br></br></br></br></br></br></br></br></br></br></br>
				
			</div>

			

		</form>

		<p align="center">
		</br></br></br>
		<a href="create_account.php"><button type="button">Create Account</button></a>		
		</p>
		<p align="right">
		
			
				<br/><br/><br/><br/>
				<a href="contact_us.php"><u><b>Contact Us</u></b><a/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<a href="about.php" target="_blank"><u><b>About</u></b><a/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<p style="text-align:center;float:bottom;">
		<b>&copy; Shefaul Shaown</b> &amp; <b>Arif Hasnat</b>
	</p>
			</p>

	</body>
	

<?php include("includes/footer.php")?>
