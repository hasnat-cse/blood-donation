<?php require_once("includes/header.php")?>
<?php include_once("includes/functions.php")?>
<?php include_once("includes/DB_connection.php");?>

<?php check_if_admin();
	?>	
	<body style="background:url('images/back.png') ">

		<div id="container" style="position:relative;overflow:auto;height:100%;width:auto;">

		<div id="header" style="position:auto;background-color:black;height:10%;
		width:97%;float:left;">
	<h1 align="center"><b><font color="LightCyan">Donation History</font></b></h1>

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


		<div id="content" style="position:relative;overflow:auto;height:90%;width:78%;text-align:center;
				float:left;">

		<?php
	$query="select donation_date from donation_info where id='{$_SESSION["user_id"]}'";
	$buff=mysql_query($query,$connection);
	confirm_query($buff);
	$check=0;
	while($member_info=mysql_fetch_array($buff)){
		if($member_info['donation_date']!='0000-00-00')
			$check=1;
	}
	if($check==0){
		echo "</br></br></br></br></br></br>";
		echo "<h3><center><b><strong>You didn't donate blood yet</b></strong></center></h3></br>";
	}
	else{
	echo "</br></br></br></br>";
	echo "<h3><center><b><u><strong>Your Previous Donation Dates with Places</b></u></strong></center></h3></br>";
	echo "<table border='1'	align='center'>
	<tr style='color:black'>
	<th>Date</th>
	<th>Donation Place</th>
	</tr>";
	$query="select donation_date,d_place from donation_info where id='{$_SESSION["user_id"]}'";
	$buff=mysql_query($query,$connection);
	confirm_query($buff);
	while($member_info=mysql_fetch_array($buff)){
		if($member_info['donation_date']!='0000-00-00'){
			echo "<tr style='color:black'>";
			echo "<td>".$member_info['donation_date']."</td>";
			echo "<td>".$member_info['d_place']."</td>";
			echo "</tr>";
		}
	}
	echo "</table>";
	}
	?>

		</div>		
	</div>
	</body>

<?php require_once("includes/footer.php")?>