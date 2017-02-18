<?php require_once("includes/header.php")?> 
<?php include_once("includes/DB_connection.php")?> 
<?php include_once("includes/functions.php");?>


	<?php check_if_super_admin();
	?>

	<body style="background:url('images/back.png') ">

		<div id="container" style="position:relative;overflow:auto;height:100%;width:auto;">

		<div id="header" style="position:auto;background-color:black;height:10%;
		width:97%;">
	<h1 align="center"><b><font color="LightCyan">Change Donation Status of Member</font></b></h1>

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


	<div id="content" style="position:relative;overflow:auto;height:90%;width:80%;text-align:center">

			

		<form action="change_status_super_admin.php" method="post">

			<?php
				if(isset($_POST["user_name"])){
					
					$query="SELECT * from member_info where user_name='{$_POST["user_name"]}'";
					$buff=mysql_query($query,$connection);
					confirm_query($buff);

					$id=0;
					$check=0;
					
					while($staff_info=mysql_fetch_array($buff)){
							$id=$staff_info["id"];
					}

					if($_POST["user_name"]==''){
						echo '<h2 align="center"><u><b><font color="black">Please Insert User_Name</font></u></b></h2>';
					}
					else{
							$query="SELECT user_name from member_info where user_name='{$_POST["user_name"]}'";
							$buff=mysql_query($query,$connection);
							confirm_query($buff);						
					
							while($staff_info=mysql_fetch_array($buff)){
								$check=1;
							}

							if($check==1){
								$query="UPDATE member_status
								set availability='{$_POST["availability"]}',by_whom='superadmin'
								where id=$id";
								$buff=mysql_query($query,$connection);
								confirm_query($buff);

								echo '<h2 align="center"><u><b><font color="black">Member Status has been changed</font></u></b></h2>';

							}
							else{

								echo '<h2 align="center"><u><b><font color="black">You entered invalid User Name</font></u></b></h2>';

							}
					
					}
				}
			?>

			</br></br></br>
		
			<li style="text-align:center">
 					<label for="user_name">User Name:</label>&nbsp;&nbsp;&nbsp;
 					<input type="text" id="user_name" name="user_name">
 				</li>
 			</br>
 				<li style="text-align:center">
 					<label for="availability">Availability:</label>
 					<select id="availability" name="availability">
						
						<option value="yes">Yes</option>
						
						<option value="no">No</option>
					</select>
 				</li>
 			</br>

 			<input type="Submit" value="Change">

 		

		</form>
</div>

				
	</div>	
		
	</body>
<?php include("includes/footer.php")?>
