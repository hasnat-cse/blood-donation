<?php require_once("includes/header.php")?> 
<?php include_once("includes/DB_connection.php")?> 
<?php include_once("includes/functions.php");?>


	<?php check_if_admin();
	?>

	<body style="background:url('images/back.png') ">

		<div id="container" style="position:relative;overflow:auto;height:100%;width:auto;">

		<div id="header" style="position:auto;background-color:black;height:10%;
		width:97%;float:left;">
	<h1 align="center"><b><font color="LightCyan">Change Donation Status of Member</font></b></h1>

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

	<div id="menu" style="background-color:#FFD700;overflow:auto;height:90%;width:22%; float:left;" >


		<ul>
			</br>
			<fieldset>
				<legend>Admin Panel</legend>
		<a href="see_members_admin.php"><font color="black">See Member Info</font></a>
		<a href="change_status_admin.php"><font color="black">Change Donation Status</font></a>
		<a href="reset_pass_admin.php"><font color="black">Reset Member Password</font></a>

</fieldset></br></br>
<fieldset>
	<legend>Personal Panel</legend>
		<a href="admin.php"><font color="black">Home</font></a>
		<a href="search_donors_admin.php"><font color="black">Search For Donor</font></a>
		<a href="donation_history_admin.php"><font color="black">Donation History</font></a>
		<a href="add_date_admin.php"><font color="black">Add Donation Date</font></a>
		<a href="edit_info_admin.php"><font color="black">Edit Personal Info</font></a>
		<a href="pass_admin.php"><font color="black">Change Password</font></a>
</fieldset>
		
	</ul>

</div>


	<div id="content" style="position:relative;overflow:auto;height:90%;width:78%;text-align:center;">

			

		<form action="change_status_admin.php" method="post">

			<?php
				if(isset($_POST["user_name"])){
					
					$query="SELECT * from member_info where user_name='{$_POST["user_name"]}'";
					$buff=mysql_query($query,$connection);
					confirm_query($buff);

					$id=0;
					$role='';
					$check=0;
					$hall='';
					$temp=0;
					
					while($staff_info=mysql_fetch_array($buff)){
							$id=$staff_info["id"];
							$role=$staff_info["role"];
							$hall=$staff_info['hall'];
							$check=1;
					}

					$query1="SELECT * FROM hall_names where hall_name='$hall'";
	 						$buff1=mysql_query($query1,$connection);
	 						confirm_query($buff1);

	 						while($id_info=mysql_fetch_array($buff1)){
	 							$temp=$id_info["id"];
								
							}

					if($_POST["user_name"]==''){
						echo '<h2 align="center"><u><b><font color="black">Please Insert User_Name</font></u></b></h2>';
					}
					else{
						if($role=='super_admin' || $role=='admin'){
							echo '<h2 align="center"><u><b><font color="black">You have not enough permission</font></u></b></h2>';

						}
						else{
							/*$query="SELECT user_name from member_info where user_name='{$_POST["user_name"]}'";
							$buff=mysql_query($query,$connection);
							confirm_query($buff);						
					
							while($staff_info=mysql_fetch_array($buff)){
								$check=1;
							}*/

							if($check==1){
								if($temp==$_SESSION["user_id"]){

									$query="UPDATE member_status
								set availability='{$_POST["availability"]}',by_whom='admin'
								where id=$id";
								$buff=mysql_query($query,$connection);
								confirm_query($buff);

								echo '<h2 align="center"><u><b><font color="black">Member Status has been changed</font></u></b></h2>';

								}
								else{
									echo '<h2 align="center"><u><b><font color="black">You have not enough permission</font></u></b></h2>';
								}
							}
							else{

								echo '<h2 align="center"><u><b><font color="black">You entered invalid User Name</font></u></b></h2>';

							}
							

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
 					<label for="availability">Availability:</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
 						
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
