<?php require_once("includes/header.php")?> 
<?php include_once("includes/DB_connection.php")?> 
<?php include_once("includes/functions.php");?>


	<?php check_if_super_admin();
	?>

	<body style="background:url('images/back.png') ">

		<div id="container" style="position:relative;overflow:auto;height:100%;width:auto;">

		<div id="header" style="position:auto;background-color:black;height:10%;
		width:97%;float:left;">
	<h1 align="center"><b><font color="LightCyan">Reset Member Password </font></b></h1>

	<h2 align="right"><font color="silver">Super Admin</font>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					<a href="logout.php"><font color="white">Logout</font></a></h2>';

</div>

	<div id="menu" style="background-color:#FFD700;height:90%;width:20%; float:left;" >


		<ul>
		<a href="super_admin.php"><font color="black">Home</font></a>
	</br>
		<a href="edit_admins.php"><font color="black">Edit Hall Admin</font></a>
	</br>
		<a href="edit_halls.php"><font color="black">Edit Hall Name</font></a>
	</br>
		<a href="see_members_super_admin.php"><font color="black">See Member Info</font></a>
	</br>
		<a href="change_status_super_admin.php"><font color="black">Change Donation Status</font></a>
	</br>
		<a href="reset_pass_super_admin.php"><font color="black">Reset Member Password</font></a>
	</br>
		<a href="search_donors_super_admin.php"><font color="black">Search For Donor</font></a>
	</br>
		<a href="change_password.php"><font color="black">Change Password</font></a>
		
	</ul>

</div>


	<div id="content" style="position:relative;overflow:auto;height:90%;width:80%;text-align:center;">

			

		<form action="reset_pass_super_admin.php" method="post">

			<?php
				if(isset($_POST["user_name"]) && isset($_POST["password"])){

						if($_POST["user_name"]=='' || $_POST["password"]=='' || $_POST["password1"]==''){
							echo '<h2 align="center"><u><b><font color="black"></br>Please Fill up all the given fields</font></u></b></h2>';
						}
						else{
							$query="SELECT * FROM member_info where user_name='{$_POST["user_name"]}'";
	 						$buff=mysql_query($query,$connection);
	 						confirm_query($buff);

	 						$check="";

	 						while($member_info=mysql_fetch_array($buff)){
	 							$check=$member_info['role'];
								
							}
							if($_POST["password"]==$_POST["password1"]){

								if($check=='super_admin'){
									echo '<h2 align="center"><u><b><font color="black"></br>Yov have to change super admin password through change password option </font></u></b></h2>';
								}
							elseif ($check=='') {
							 		echo '<h2 align="center"><u><b><font color="black"></br>You entered invalid User Name</font></u></b></h2>';
							 } 
							else{
									$query="UPDATE member_info
									set password='{$_POST["password"]}'
									where user_name='{$_POST["user_name"]}'";
									$buff=mysql_query($query,$connection);
									confirm_query($buff);
									echo '<h2 align="center"><u><b><font color="black"></br>Password has been changed </font></u></b></h2>';
								}

							}
							else{
								echo '<h2 align="center"><u><b><font color="black"></br>Password mismatch </font></u></b></h2>';
							}
							
							
						}
				}
				else{

				}
			?>

			</br></br></br></br></br>
		
			<li style="text-align:center">
 					<label for="user_name">User Name:</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
 					
 					<input type="text" id="user_name" name="user_name">
 				</li>
 			</br>
 			<li style="text-align:center">
 					<label for="password">Type New Password:</label>
 					
 					<input type="password" id="password" name="password">
 				</li>
 			</br>
 			<li style="text-align:center">
 					<label for="password1">Retype New Password:</label>&nbsp;&nbsp;&nbsp;&nbsp;
 					
 					<input type="password" id="password1" name="password1">
 				</li>
 			</br>
 			<input type="Submit" value="Reset">

		</form>
</div>

				
	</div>	
		
	</body>
<?php include("includes/footer.php")?>
