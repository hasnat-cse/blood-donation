<?php require_once("includes/header.php")?>
<?php include_once("includes/functions.php");?>	
<?php include_once("includes/DB_connection.php");?>
	
<?php 
	check_if_super_admin();
	?>

	<head>
	<script>
	function printDiv(divName) {
     var printContents = document.getElementById(divName).innerHTML;
     var originalContents = document.body.innerHTML;

     document.body.innerHTML = printContents;

     window.print();

     document.body.innerHTML = originalContents;
}
	</script>
</head>

	<body style="background:url('images/back.png') ">

		<div id="container" style="position:relative;overflow:auto;height:100%;width:auto;">

		<div id="header" style="position:auto;background-color:black;height:10%;
		width:97%;float:left;">
	<h1 align="center"><b><font color="LightCyan">See Member Information</font></b></h1>

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
		<form action="see_members_super_admin.php" method="POST">
			<div id="content" style="position:relative;height:90%;width:20%;text-align:center;
			float:left;">
			</br></br></br></br></br></br></br>
			<ul style="text-align:left">
				<li>
					<label for="Hall">Hall:</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					
					<select id="Hall" name="Hall">
						<?php
							$query= "select hall_name from hall_names";
							$buff=mysql_query($query,$connection);
							confirm_query($buff);
							while($hall_row=mysql_fetch_array($buff)){
								if(isset($_POST["Hall"])){
									if($hall_row["hall_name"]==$_POST["Hall"])
										echo "<option value=".$hall_row["hall_name"]." selected >".$hall_row["hall_name"]."</Option>";
									else
										echo "<option value=".$hall_row["hall_name"].">".$hall_row["hall_name"]."</Option>";
								}
								else
									echo "<option value=".$hall_row["hall_name"].">".$hall_row["hall_name"]."</Option>";
							}

						?>
					</select></br>	
				</li>
				</br>
				<li>
					<label for="blood_group">Blood Group:</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					
					<select id="blood_group" name="blood_group">
					<option value="%">All</option>
					<option value="A+" <?php
						if(isset($_POST["blood_group"])){
							if($_POST["blood_group"]=='A+')
								echo 'selected';
						}
					?> >A+</option>
					<option value="A-" <?php
						if(isset($_POST["blood_group"])){
							if($_POST["blood_group"]=='A-')
							echo 'selected';
						}
					?> >A-</option>
					<option value="B+" <?php
						if(isset($_POST["blood_group"])){
							if($_POST["blood_group"]=='B+')
							echo 'selected';
						}
					?> >B+</option>
					<option value="B-" <?php
						if(isset($_POST["blood_group"])){
							if($_POST["blood_group"]=='B-')
							echo 'selected';
						}
					?> >B-</option>
					<option value="AB+" <?php
						if(isset($_POST["blood_group"])){
							if($_POST["blood_group"]=='AB+')
							echo 'selected';
						}
					?> >AB+</option>
					<option value="AB-" <?php
						if(isset($_POST["blood_group"])){
							if($_POST["blood_group"]=='AB-')
							echo 'selected';
						}
					?> >AB-</option>
					<option value="O+" <?php
						if(isset($_POST["blood_group"])){
							if($_POST["blood_group"]=='O+')
							echo 'selected';
						}
					?> >O+</option>
					<option value="O-" <?php
						if(isset($_POST["blood_group"])){
							if($_POST["blood_group"]=='O-')
							echo 'selected';
						}
					?> >O-</option>
					</select></br>	
				</li>
				</br>	
				<li>
					<label for="availability">Status:</label>
					<select id="availability" name="availability">
					<option value="%">All</option>
					<option value="yes" <?php
						if(isset($_POST["availability"])){
							if($_POST["availability"]=='yes')
							echo 'selected';
						}
					?> >Available</option>
					<option value="no" <?php
						if(isset($_POST["availability"])){
							if($_POST["availability"]=='no')
							echo 'selected';
						}
					?> >Not Available</option>
					</select></br>	
				</li>
				</br>

			</ul>
			<input type="Submit" value="Show"/>
			</br></br>
			<input type="button" target="_blank" onclick="printDiv('subcontent')" 
				value="print" />
		</div>
		</form>

		<div id="subcontent" style="position:relative;overflow:auto;height:90%;width:60%;text-align:center;
				float:left;">


	
	<?php
			if(isset($_POST["Hall"])){
				$query1="select id,availability from member_status where availability like '{$_POST["availability"]}'";
				$buff1=mysql_query($query1,$connection);
				confirm_query($buff1);

				$check=0;

				while($id_info=mysql_fetch_array($buff1)){



				$query="select * from member_info 
					where hall like '{$_POST["Hall"]}%' and blood_group like '{$_POST["blood_group"]}' and id='{$id_info["id"]}'";
					$buff=mysql_query($query,$connection);
					confirm_query($buff);
					while($member_info=mysql_fetch_array($buff)){
						$check=1;
					}
				}



				echo "</br></br></br></br></br></br>";

				if($check==1)
				{
					$query1="select id,availability from member_status where availability like '{$_POST["availability"]}'";
				$buff1=mysql_query($query1,$connection);
				confirm_query($buff1);
					echo "<center><h3><b><u><strong>Member of ".$_POST["Hall"]." hall</b></u></strong></h3></center></br>";
				echo "<table border='1'	align='center'>
				<tr style='color:black'>
				<th>User Name</th>
				<th>Name</th>
				<th>Dept</th>
				<th>Hall</th>
				<th>Room</th>
				<th>Contact NO</th>
				<th>Blood Group</th>
				<th>Availability</th>
				</tr>";
				while($id_info=mysql_fetch_array($buff1)){
					$query="select * from member_info 
					where hall like '{$_POST["Hall"]}%' and blood_group like '{$_POST["blood_group"]}' and id='{$id_info["id"]}'";
					$buff=mysql_query($query,$connection);
					confirm_query($buff);
					while($member_info=mysql_fetch_array($buff)){
						echo "<tr style='color:black'>";
						echo "<td>".$member_info['user_name']."</td>";
						echo "<td>".$member_info['name']."</td>";
						echo "<td>".$member_info['dept']."</td>";
						echo "<td>".$member_info['hall']."</td>";
						echo "<td>".$member_info['room']."</td>";
						echo "<td>".$member_info['contact_no']."</td>";
						echo "<td>".$member_info['blood_group']."</td>";
						echo "<td>".$id_info['availability']."</td>";
						echo "</tr>";
					}
				}
				echo "</table>";

				}
				else{
					echo "<center><h3><b><u><strong>There are no members to show</b></u></strong></h3></center></br>";
				}
				
			}
	?>
		</div>		

	</div>

	
	</body>


<?php require_once("includes/footer.php")?>	

