<?php require_once("includes/header.php")?> 
<?php include_once("includes/DB_connection.php")?> 
<?php include_once("includes/functions.php");?>


<?php 
	check_if_super_admin();
	?>

	<body style="background:url('images/back.png') ">

		<div id="container" style="position:relative;overflow:auto;height:100%;width:auto;">

		<div id="header" style="position:auto;background-color:black;height:10%;
		width:97%;float:left;">
	<h1 align="center"><b><font color="LightCyan">Edit Hall Name</font></b></h1>

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
	
	<form action="edit_halls.php" method="POST">

			<div id="content" style="position:relative;height:90%;width:40%;text-align:center;
				float:left;">
					</br></br></br></br>
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					<ul style="text-align:left">
				<li>		
					<h3 align="left"><u><b><font color="black">Add New Hall Name: </font></u></b></h3>
				</li>
				</br>
				<li>
					<label	for="hall">New Hall:</label>
					<input id="hall" name="hall"/></br></br>
					
				</li>
				<input type="Submit"  value="Add"/>
			</ul>

				</br></br>

			<ul style="text-align:left">
				<li>
					<h3 align="left"><u><b><font color="black">Edit Existing Hall Name: </font></u></b></h3>
				</li>
			</br>
				<li>
					<label for="o_hall">Select Hall:</label>
					<select id="o_hall" name="o_hall">	
						<?php
							$query= "select * from hall_names";
							$buff=mysql_query($query,$connection);
							confirm_query($buff);
							while($hall_row=mysql_fetch_array($buff)){
								echo "<option value=".$hall_row["hall_name"].">".$hall_row["hall_name"]."</Option>";
							}
						?>
					</select>
					</li>
					</br></br>
				<li>	
					<label	for="n_hall">New Name:</label>
					<input id="n_hall" name="n_hall"/></br></br>
				</li>
				<input type="Submit" value="Edit"/>
			</ul>
			
		<?php 
	
	if(isset($_POST["hall"])||isset($_POST["n_hall"])){
		$h_name=0;
		if($_POST["hall"]!=""){
		$h_name=1;
		$query="select hall_name from hall_names 
				where hall_name='{$_POST["hall"]}'";
		$buff=mysql_query($query,$connection);
		confirm_query($buff);
		$check=0;
		while($member_info=mysql_fetch_array($buff)){
			$check=1;
		}
		if($check==0){
			$query="INSERT INTO
					hall_names(hall_name)
					values('{$_POST["hall"]}')";
			$buff=mysql_query($query,$connection);
			confirm_query($buff);
			echo "</br></br></br></br><h3><b><center>New Hall is successfully added!</center></b></h3></br>";
		}
		else echo "</br></br></br></br><h3><b><center>Your entered Hall name Already Exists!</center></b></h3></br>";
	}
	
	if($_POST["n_hall"]!=""){
		$h_name=1;
		$query="select hall_name from hall_names 
				where hall_name='{$_POST["n_hall"]}'";
		$buff=mysql_query($query,$connection);
		confirm_query($buff);
		$check=0;
		while($member_info=mysql_fetch_array($buff)){
			$check=1;
		}
		if($check==0){
			$query="update 
					hall_names
					set hall_name='{$_POST["n_hall"]}'
					where hall_name like ('{$_POST["o_hall"]}%')";
			$buff=mysql_query($query,$connection);
			confirm_query($buff);
			echo "</br></br></br></br><h3><b><center>Hall is successfully edited!</center></b></h3></br>";
		}
		else echo "</br></br></br></br><h3><b><center>Your entered Hall name Already Exists!</center></b></h3></br>";
	}
	if($h_name==0) echo "</br></br></br></br><h3><b><center>Enter Hall name at First</center></b></h3></br>";
	}
?>	
			</div>
		</form>
			<div id="content" style="position:relative;overflow:auto;height:90%;width:40%;text-align:center;
				float:left;">
 	  		
		 	 <?php
				$query="select hall_name from hall_names";
				$buff=mysql_query($query,$connection);
				confirm_query($buff);
				$check=0;
				while($member_info=mysql_fetch_array($buff)){
						$check=1;
				}
				if($check==0) {
					echo "</br></br></br></br></br></br>";
					echo "<h3><center><b><strong>No Hall have been added Yet</b></strong></center></h3></br>";
				}
				else{
				echo "</br></br></br></br>";
				echo "<h3><center><b><u><strong>Already Added Halls</b></u></strong></center></h3></br>";
				echo "<table border='1'	align='center'>
				<tr style='color:black'>
				<th>Hall Name</th>
				</tr>";
				$query="select hall_name from hall_names";
				$buff=mysql_query($query,$connection);
				confirm_query($buff);
				while($member_info=mysql_fetch_array($buff)){
						echo "<tr style='color:black'>";
						echo "<td>".$member_info['hall_name']."</td>";
						echo "</tr>";
				}
				echo "</table>";
				}
			?>	

		</div>

				
	</div>	
		
	</body>
<?php include("includes/footer.php")?>
