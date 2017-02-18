<?php require_once("includes/header.php")?> 
<?php include_once("includes/DB_connection.php")?> 
<?php include_once("includes/functions.php");?>


	<?php check_if_admin();
	?>

	<body style="background:url('images/back.png') ">

		<div id="container" style="position:relative;overflow:auto;height:100%;width:auto;">

		<div id="header" style="position:auto;background-color:black;height:10%;
		width:97%;float:left;">
	<h1 align="center"><b><font color="LightCyan">Edit Personal Info</font></b></h1>

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
		<form action="edit_info_admin.php" method="post">


		<?php
		check_if_logged_in();

		if(isset($_POST["name"]) && isset($_POST["room_no"]) && isset($_POST["contact_no"]) && isset($_POST["availability"])){
			
			$query="SELECT  availability from member_status where id='{$_SESSION["user_id"]}'";
			$buff=mysql_query($query,$connection);
			confirm_query($buff);
			$temp="";
			while ($id=mysql_fetch_array($buff)) {
				$temp=$id["availability"];
			}
			if($_POST["availability"]==$temp && $_POST["name"]=="" && $_POST["room_no"]=="" && $_POST["contact_no"]==""){
				echo "<h2><u></br></br><center>Please Enter atleast one field</center></br></u></h2>";
			}					
			else{
		
			if($_POST["name"]!=""){
				$query="UPDATE member_info
							set name='{$_POST["name"]}'
							where id='{$_SESSION["user_id"]}'";
			$buff=mysql_query($query,$connection);
			confirm_query($buff);

			}

			if($_POST["room_no"]!=""){
				$query="UPDATE member_info
							set room='{$_POST["room_no"]}'
							where id='{$_SESSION["user_id"]}'";
			$buff=mysql_query($query,$connection);
			confirm_query($buff);

			}

			if($_POST["contact_no"]!=""){
				$query="UPDATE member_info
							set contact_no='{$_POST["contact_no"]}'
							where id='{$_SESSION["user_id"]}'";
			$buff=mysql_query($query,$connection);
			confirm_query($buff);

			}

			if($_POST["availability"]!=""){
				$query="UPDATE member_status
							set availability='{$_POST["availability"]}',by_whom='me'
							where id='{$_SESSION["user_id"]}'";
			$buff=mysql_query($query,$connection);
			confirm_query($buff);
			
			}
			echo "<h2><u></br></br><center>Your info succesfully updated</center></br></u></h2>";
		}

		}
?>
	
 		<p > <br><br>


 				<li style="text-align:center">
 					<label for="name">Name:</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
 					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
 					<input type="text" id="name" placeholder=" <?php 

 						$query="SELECT name FROM member_info where id='{$_SESSION["user_id"]}'";
 						$buff=mysql_query($query,$connection);
 						confirm_query($buff);

 						while($member_info=mysql_fetch_array($buff)){
							
							echo $member_info['name'];
							
						}
 					?> " name="name">
 				</li>
 			</br>

 				<li style="text-align:center">
 					<label for="room_no">Room No:</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
 					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
   					<input type="text" id="room_no"placeholder=" <?php 

 						$query="SELECT room FROM member_info where id='{$_SESSION["user_id"]}'";
 						$buff=mysql_query($query,$connection);
 						confirm_query($buff);

 						while($member_info=mysql_fetch_array($buff)){
							
							echo $member_info['room'];
							
						}
 					?> " name="room_no">
   				</li>
   				</br>
   				<li style="text-align:center">
   					<label for="contact_no">Contact No:</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
   					<input type="text" id="contact_no"placeholder=" <?php 

 						$query="SELECT contact_no FROM member_info where id='{$_SESSION["user_id"]}'";
 						$buff=mysql_query($query,$connection);
 						confirm_query($buff);

 						while($member_info=mysql_fetch_array($buff)){
							
							echo $member_info['contact_no'];
							
						}
 					?> " name="contact_no"></br>
   				</li>
   				</br>
   				<li style="text-align:center">
 					<label for="availability">Availability:</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
 					<select id="availability" name="availability">	
						<option value="yes" <?php 

 						$query="SELECT availability FROM member_status where id='{$_SESSION["user_id"]}'";
 						$buff=mysql_query($query,$connection);
 						confirm_query($buff);

 						while($member_info=mysql_fetch_array($buff)){

 							if($member_info['availability']=='yes'){
 								echo 'selected';
 							}
							
						}?> >Yes
						</option>
						<option value="no" <?php 

 						$query="SELECT availability FROM member_status where id='{$_SESSION["user_id"]}'";
 						$buff=mysql_query($query,$connection);
 						confirm_query($buff);

 						while($member_info=mysql_fetch_array($buff)){

 							if($member_info['availability']=='no'){
 								echo 'selected';
 							}
							
						}?> >No
						</option>
					</select>
 				</li>
 			</br>
				<input type="Submit" style="width: 60px; padding:1.5px; border: 2px" value="Submit">
		
		</p>


</form> 

</div>

				
	</div>	
		
	</body>
<?php include("includes/footer.php")?>
