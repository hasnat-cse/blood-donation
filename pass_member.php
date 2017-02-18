<?php require_once("includes/header.php")?> 
<?php include_once("includes/DB_connection.php")?> 
<?php include_once("includes/functions.php");?>


<?php 
	check_if_member();
	?>

	<body style="background:url('images/back.png') ">

		<div id="container" style="position:relative;overflow:auto;height:100%;width:auto;">

		<div id="header" style="position:auto;background-color:black;height:10%;
		width:97%;float:left;">
	<h1 align="center"><b><font color="LightCyan">Change Password </font></b></h1>

	<?php

			$query="select * from member_info 
				where id='{$_SESSION["user_id"]}'";
			$buff=mysql_query($query,$connection);
			confirm_query($buff);

			while($staff_info=mysql_fetch_array($buff)){

			echo '<h2 align="right"><font color="silver">'.$staff_info["name"].'</font>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					<a href="logout.php"><font color="white">Logout</font></a></h2>';
			}

			?>


</div>

	<div id="menu" style="background-color:#FFD700;overflow:auto;height:90%;width:20%; float:left;" >


		<ul>
		<ul>

		<a href="member.php"><font color="black">Home</font></a>
	</br>
		<a href="search_donors_member.php"><font color="black">Search For Donor</font></a>
	</br>
		<a href="donation_history_member.php"><font color="black">Donation History</font></a>
	</br>
		<a href="add_date_member.php"><font color="black">Add Donation Date</font></a>
	</br>
		<a href="edit_info_member.php"><font color="black">Edit Personal Info</font></a>	
	</br>
	<a href="pass_member.php"><font color="black">Change Password</font></a>	
	</br>

	</ul>

</div>


	<div id="content" style="position:relative;overflow:auto;height:90%;width:80%;text-align:center;
				float:left;">

				<?php 
	check_if_logged_in();



	if(isset($_POST["old_pass"])){

		//echo $_POST["old_pass"];

		$query="select password from member_info 
				where id='{$_SESSION["user_id"]}'";
		$buff=mysql_query($query,$connection);
		confirm_query($buff);

		while($staff_info=mysql_fetch_array($buff)){
			$pass=$staff_info["password"];
		}
			$old_pass='';



			if(($pass==($_POST["old_pass"]))){
				
				if($_POST["new_pass"]==$_POST["new_pass_1"] && $_POST["new_pass"]!=""){
	
					$query="update member_info
							set password='{$_POST['new_pass']}'
							where id='{$_SESSION["user_id"]}'";
					$buff=mysql_query($query,$connection);
					confirm_query($buff);

					$old_pass=$_POST["new_pass"];

					echo'<p><h2 align="center"><u><b>Password has been changed successfully</u></b></h2></p>';	
				}					
				else{
					echo'<p><h2 align="center"><u><b>Password type missmatch</u></b></h2></p>';	
				}
			}
			elseif($old_pass==$_POST["old_pass"]){ 
	
			}
			else{ 
				echo'<p><h2 align="center"><u><b>Password mistaken. Retype your old password</u></b></h2></p>';
			}
		
		
	}
?>

				</br></br></br></br></br></br></br>
				
				<form action=pass_member.php method="POST">

					<li style="text-align:center">
										
						<label for="old_pass">Old Password:</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<input id="old_pass" placeholder="****" type="password" name="old_pass"/></br>
					</li>
				</br>
					
					<li style="text-align:center">
						<label for="new_pass">New Password:</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<input id="new_pass" placeholder="****" type="password" name="new_pass"/></br>
					</li>
				</br>
					<li style="text-align:center">	
						<label for="new_pass_1">Reconfirm Password:</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<input id="new_pass_1" placeholder="****" type="password" name="new_pass_1"/></br>
					</li>
				</br>				
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="submit" value="Change Password"/>

			</form>


</div>

				
	</div>	
		
	</body>
<?php include("includes/footer.php")?>
