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
	<h1 align="center"><b><font color="LightCyan">Edit Hall Admin</font></b></h1>

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
	
	<form action="edit_admins.php" method="POST">

			<div id="content" style="position:relative;height:90%;width:40%;text-align:center;
				float:left;">
					
				
				</br></br></br></br></br></br></br>
			<ul style="text-align:left">
			
				<li>
					<label for="hall">Select Hall:</label>
					<select id="hall" name="hall">	
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
					<label	for="new_user_name">Admin User Name:</label>
					<input id="new_user_name" name="new_user_name"/></br></br>
				</li>
				
					</br></br>
			</ul>
			<input type="Submit" value="Change"/>
		<?php 
	
	if(isset($_POST["new_user_name"])){
		if($_POST["new_user_name"]!=""){
		$n_id=0;
		$check2=0;
		$check1=0;
		$o_id=0;
		$query1="select id from hall_names 
				where hall_name like '{$_POST["hall"]}%'";
		$buff1=mysql_query($query1,$connection);
		confirm_query($buff1);
		
		while($member_info=mysql_fetch_array($buff1)){
				$o_id=$member_info['id'];
			}
			
		$query1="select id from member_info 
		where user_name='{$_POST["new_user_name"]}'";
		$buff1=mysql_query($query1,$connection);
		confirm_query($buff1);
		while($member_info=mysql_fetch_array($buff1)){
				$n_id=$member_info['id'];
				$check2=1;
			}
		if($check2==1){
			$query1="update hall_names 
				set id=$n_id where hall_name like '{$_POST["hall"]}%'";
			$buff1=mysql_query($query1,$connection);
			confirm_query($buff1);
			
			$query1="select id from hall_names 
				where id=$o_id";
			$buff1=mysql_query($query1,$connection);
			confirm_query($buff1);
			while($member_info=mysql_fetch_array($buff1)){
				$check1=1;
			}
			if($check1==0){
				$query1="update member_info 
					set role='member' where id=$o_id";
				$buff1=mysql_query($query1,$connection);
				confirm_query($buff1);
				}
			
			$query1="update member_info 
				set role='admin' where user_name='{$_POST["new_user_name"]}'";
			$buff1=mysql_query($query1,$connection);
			confirm_query($buff1);
			
			echo "</br></br></br></br><h3><b><center>New Admin Added Successfully</center></b></h3></br>";
		}
		else echo "</br></br></br></br><h3><b><center>Enter a Valid User Name</center></b></h3></br>";
	}
	else echo "</br></br></br></br><h3><b><center>Enter User Name at First</center></b></h3></br>";
	}
?>	
			</div>
		</form>
			<div id="content" style="position:relative;overflow:auto;height:90%;width:40%;text-align:center;
				float:left;">
 	  		
		 	 <?php
				$query1="select * from hall_names";
				$buff1=mysql_query($query1,$connection);
				confirm_query($buff1);
				echo "</br></br></br></br></br></br>";
				echo "<center><h3><b><u><strong>Hall Admins</b></u></strong></h3></center></br>";
				echo "<table border='1'	align='center'>
				<tr style='color:black'>
				<th>Hall</th>
				<th>User name</th>
				<th>Name</th>
				<th>Contact No</th>
				</tr>";
				while($id_info=mysql_fetch_array($buff1)){
					$query="select * from member_info 
					where id='{$id_info['id']}'";
					$buff=mysql_query($query,$connection);
					confirm_query($buff);
					while($member_info=mysql_fetch_array($buff)){
						echo "<tr style='color:black'>";
						echo "<td>".$id_info['hall_name']."</td>";
						echo "<td>".$member_info['user_name']."</td>";
						echo "<td>".$member_info['name']."</td>";
						echo "<td>".$member_info['contact_no']."</td>";
						echo "</tr>";
					}
				}
				echo "</table>";
			?>	

		</div>

				
	</div>	
		
	</body>
<?php include("includes/footer.php")?>
