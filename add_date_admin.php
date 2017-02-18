<?php require_once("includes/header.php")?>
<?php include_once("includes/functions.php")?>
<?php include_once("includes/DB_connection.php");?>

<?php check_if_admin();
	?>	
	<body style="background:url('images/back.png') ">

		<div id="container" style="position:relative;overflow:auto;height:100%;width:auto;">

		<div id="header" style="position:auto;background-color:black;height:10%;
		width:97%;float:left;">
	<h1 align="center"><b><font color="LightCyan">Add Donation Date</font></b></h1>

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

		<form action="add_date_admin.php" method="POST">
			<div id="content" style="position:relative;height:90%;width:78%;text-align:center;
				float:left;">
					</br></br></br></br></br></br></br>
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					<label	for="d_date">New Donation Date:</label>
					<input type="text" placeholder="YYYY-MM-DD" name="d_date"/></br></br>
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					<label	for="place">Donation Place:</label>
					<input type="text" placeholder="place" name="place"/></br></br>
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					&nbsp;&nbsp;&nbsp;&nbsp;
				<input type="Submit"  value="add"/>
		<?php
		if(isset($_POST["d_date"])){
		if($_POST["d_date"]=="")
		{
			echo "</br></br><center>Enter Donation date at First</center></br>";
		}
		else{
		$query="select donation_date from donation_info 
				where donation_date='{$_POST["d_date"]}' and id='{$_SESSION["user_id"]}'";
		$buff=mysql_query($query,$connection);
		confirm_query($buff);
		$check=0;
		while($member_info=mysql_fetch_array($buff)){
			$check=1;
		}
		if($check==0){
			$query="INSERT INTO
					donation_info(id,donation_date,d_place)
					values('{$_SESSION["user_id"]}','{$_POST["d_date"]}','{$_POST["place"]}')";
			$buff=mysql_query($query,$connection);
			confirm_query($buff);
			echo "</br></br></br></br><h3><b><center>Date Succesfully Added</u></center></h3></br>";
		}
		else echo "</br></br></br></br><h3><b><center>Date Already exists</u></center></h3></br>";
		}

	}
	?>
		</div>
		</form>	
	</div>
	</body>

<?php require_once("includes/footer.php")?>