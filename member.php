<?php require_once("includes/header.php")?> 
<?php include_once("includes/DB_connection.php")?> 
<?php include_once("includes/functions.php");?>


	<?php check_if_member();
	?>

	<body style="background:url('images/back.png') "> 

		<div id="container" style="position:relative;overflow:auto;height:100%;width:auto;">

		<div id="header" style="position:auto;background-color:black;height:10%;
		width:97%;float:left;">
	<h1 align="center"><b><font color="LightCyan">Home page</font></b></h1>

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

	<div id="menu" style="background-color:#FFD700;height:90%;width:20%; float:left;" >


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
				<fieldset style="position:absolute;left:35%;top:20%;display:block;text-align:left">
					<legend>Profile</legend>
				<?php
				$time=0;
				$query2="SELECT COUNT(donation_date) as count from donation_info where id='{$_SESSION["user_id"]}' and donation_date!='0000-00-00'";
				$buff2=mysql_query($query2,$connection);
				confirm_query($buff2);
				while($count_total=mysql_fetch_array($buff2)){
					$time=$count_total["count"];
				}

				$query1="select * from member_status where id='{$_SESSION["user_id"]}'";
				$buff1=mysql_query($query1,$connection);
				confirm_query($buff1);
				$query="select * from member_info 
				where id='{$_SESSION["user_id"]}'";
				$buff=mysql_query($query,$connection);
				confirm_query($buff);
				while($member_info=mysql_fetch_array($buff)){
					while($status_info=mysql_fetch_array($buff1)){
						echo "<h3>Name :&nbsp;&nbsp;&nbsp;&nbsp;".$member_info['name']."</h3></br>";
						echo "<h3>Department :&nbsp;&nbsp;&nbsp;&nbsp;".$member_info['dept']."</h3></br>";
						echo "<h3>Blood Group :&nbsp;&nbsp;&nbsp;&nbsp;".$member_info['blood_group']."</h3></br>";
						echo "<h3>Status :&nbsp;&nbsp;&nbsp;&nbsp;".$member_info['role']."</h3></br>";
						echo "<h3>No of donation :&nbsp;&nbsp;&nbsp;&nbsp;".$time."</h3></br>";
						if($status_info['due_date']=='0000-00-00'){
							echo "<h3>Donation Due Date :&nbsp;&nbsp;&nbsp;&nbsp;Any time</h3></br>";
						}
						else echo "<h3>Donation Due Date :&nbsp;&nbsp;&nbsp;&nbsp;".$status_info['due_date']."</h3></br>";
						if($status_info['availability']=='yes'){
						echo "<h3>Availability :&nbsp;&nbsp;&nbsp;&nbsp;Available ( Updated by ".$status_info['by_whom']." )</h3></br>";
						}
						else echo "<h3>Availability :&nbsp;&nbsp;&nbsp;&nbsp;Not Available ( Updated by ".$status_info['by_whom']." )</h3></br>";
						echo "<h3>contact No. :&nbsp;&nbsp;&nbsp;&nbsp;".$member_info['contact_no']."</h3></br>";
						echo "<h3>Address :&nbsp;&nbsp;&nbsp;&nbsp;room no- ".$member_info['room'].", ".$member_info['hall']." Hall.</h3></br>";
						
					}
				}

			?>
			
			</fieldset>
	</div>

				
</div>	
		
	</body>
<?php include("includes/footer.php")?>
