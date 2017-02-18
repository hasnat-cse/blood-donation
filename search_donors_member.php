<?php require_once("includes/header.php")?>
<?php include_once("includes/functions.php");?>	
<?php include_once("includes/DB_connection.php");?>
	
<?php 
	check_if_member();
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
	<h1 align="center"><b><font color="LightCyan">Search For Donor</font></b></h1>

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
		<form action="search_donors_member.php" method="POST">
			<div id="content" style="position:relative;height:90%;width:20%;text-align:center;
			float:left;">
			
			</br></br></br></br></br></br></br>
			<ul>
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
					&nbsp;&nbsp;&nbsp;
					<select id="blood_group" name="blood_group">
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

				$date=date('Y-m-d');
				$query1="select id,availability from member_status where availability='yes' and due_date<='$date'";
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
					$date=date('Y-m-d');
					$query1="select id,availability from member_status where availability='yes' and due_date<='$date'";
					$buff1=mysql_query($query1,$connection);
					confirm_query($buff1);

					echo "<center><h3><b><u><strong>Available Donors from ".$_POST["Hall"]." hall of ".$_POST["blood_group"]."</b></u></strong></h3></center></br>";
				echo "<table border='1'	align='center'>
				<tr style='color:black'>
				<th>Name</th>
				<th>Dept</th>
				<th>Hall</th>
				<th>Room</th>
				<th>Contact NO</th>
				<th>Blood Group</th>
				</tr>";
				while($id_info=mysql_fetch_array($buff1)){
					$query="select * from member_info 
					where hall like '{$_POST["Hall"]}%' and blood_group like '{$_POST["blood_group"]}' and id='{$id_info["id"]}'";
					$buff=mysql_query($query,$connection);
					confirm_query($buff);
					while($member_info=mysql_fetch_array($buff)){
						echo "<tr style='color:black'>";
						echo "<td>".$member_info['name']."</td>";
						echo "<td>".$member_info['dept']."</td>";
						echo "<td>".$member_info['hall']."</td>";
						echo "<td>".$member_info['room']."</td>";
						echo "<td>".$member_info['contact_no']."</td>";
						echo "<td>".$member_info['blood_group']."</td>";
						echo "</tr>";
					}
				}
				echo "</table>";

				
				if($_POST["blood_group"]=='A+'){

					$date=date('Y-m-d');
					$query1="select id,availability from member_status where availability='yes' and due_date<='$date'";
					$buff1=mysql_query($query1,$connection);
					confirm_query($buff1);

					$check2=0;

					while($id_info=mysql_fetch_array($buff1)){

					$query="select * from member_info 
						where hall like '{$_POST["Hall"]}%' and blood_group In('O-','O+','A-') and id='{$id_info["id"]}'";
						$buff=mysql_query($query,$connection);
						confirm_query($buff);

						while($member_info=mysql_fetch_array($buff)){
							$check2=1;
						}
					}
					if($check2==1){

						$date=date('Y-m-d');
					$query1="select id,availability from member_status where availability='yes' and due_date<='$date'";
					$buff1=mysql_query($query1,$connection);
					confirm_query($buff1);

					echo "<center><h3><b><u><strong></br></br>Available Donors from ".$_POST["Hall"]." hall who can also donate to ".$_POST["blood_group"]."</b></u></strong></h3></center></br>";
					echo "<table border='1'	align='center'>
					<tr style='color:black'>
					<th>Name</th>
					<th>Dept</th>
					<th>Hall</th>
					<th>Room</th>
					<th>Contact NO</th>
					<th>Blood Group</th>
					</tr>";
					while($id_info=mysql_fetch_array($buff1)){
						$query="select * from member_info 
						where hall like '{$_POST["Hall"]}%' and blood_group In('O-','O+','A-') and id='{$id_info["id"]}'";
						$buff=mysql_query($query,$connection);
						confirm_query($buff);
						while($member_info=mysql_fetch_array($buff)){
							echo "<tr style='color:black'>";
							echo "<td>".$member_info['name']."</td>";
							echo "<td>".$member_info['dept']."</td>";
							echo "<td>".$member_info['hall']."</td>";
							echo "<td>".$member_info['room']."</td>";
							echo "<td>".$member_info['contact_no']."</td>";
							echo "<td>".$member_info['blood_group']."</td>";
							echo "</tr>";
						}
					}
					echo "</table>";
					}
					else{
						echo "<center><h3><b><u><strong></br></br>There are no members to show of another group</b></u></strong></h3></center></br>";
					}

					}

					if($_POST["blood_group"]=='A-'){

					$date=date('Y-m-d');
					$query1="select id,availability from member_status where availability='yes' and due_date<='$date'";
					$buff1=mysql_query($query1,$connection);
					confirm_query($buff1);

					$check2=0;

					while($id_info=mysql_fetch_array($buff1)){

					$query="select * from member_info 
						where hall like '{$_POST["Hall"]}%' and blood_group In('O-') and id='{$id_info["id"]}'";
						$buff=mysql_query($query,$connection);
						confirm_query($buff);

						while($member_info=mysql_fetch_array($buff)){
							$check2=1;
						}
					}
					if($check2==1){

						$date=date('Y-m-d');
					$query1="select id,availability from member_status where availability='yes' and due_date<='$date'";
					$buff1=mysql_query($query1,$connection);
					confirm_query($buff1);

					echo "<center><h3><b><u><strong></br></br>Available Donors from ".$_POST["Hall"]." hall who can also donate to ".$_POST["blood_group"]."</b></u></strong></h3></center></br>";
					echo "<table border='1'	align='center'>
					<tr style='color:black'>
					<th>Name</th>
					<th>Dept</th>
					<th>Hall</th>
					<th>Room</th>
					<th>Contact NO</th>
					<th>Blood Group</th>
					</tr>";
					while($id_info=mysql_fetch_array($buff1)){
						$query="select * from member_info 
						where hall like '{$_POST["Hall"]}%' and blood_group In('O-') and id='{$id_info["id"]}'";
						$buff=mysql_query($query,$connection);
						confirm_query($buff);
						while($member_info=mysql_fetch_array($buff)){
							echo "<tr style='color:black'>";
							echo "<td>".$member_info['name']."</td>";
							echo "<td>".$member_info['dept']."</td>";
							echo "<td>".$member_info['hall']."</td>";
							echo "<td>".$member_info['room']."</td>";
							echo "<td>".$member_info['contact_no']."</td>";
							echo "<td>".$member_info['blood_group']."</td>";
							echo "</tr>";
						}
					}
					echo "</table>";
					}
					else{
						echo "<center><h3><b><u><strong></br></br>There are no members to show of another group</b></u></strong></h3></center></br>";
					}

					}

					if($_POST["blood_group"]=='AB+'){

					$date=date('Y-m-d');
					$query1="select id,availability from member_status where availability='yes' and due_date<='$date'";
					$buff1=mysql_query($query1,$connection);
					confirm_query($buff1);

					$check2=0;

					while($id_info=mysql_fetch_array($buff1)){

					$query="select * from member_info 
						where hall like '{$_POST["Hall"]}%' and blood_group In('A+','A-','B+','B-','O+','O-','AB-') and id='{$id_info["id"]}'";
						$buff=mysql_query($query,$connection);
						confirm_query($buff);

						while($member_info=mysql_fetch_array($buff)){
							$check2=1;
						}
					}
					if($check2==1){

						$date=date('Y-m-d');
					$query1="select id,availability from member_status where availability='yes' and due_date<='$date'";
					$buff1=mysql_query($query1,$connection);
					confirm_query($buff1);

					echo "<center><h3><b><u><strong></br></br>Available Donors from ".$_POST["Hall"]." hall who can also donate to ".$_POST["blood_group"]."</b></u></strong></h3></center></br>";
					echo "<table border='1'	align='center'>
					<tr style='color:black'>
					<th>Name</th>
					<th>Dept</th>
					<th>Hall</th>
					<th>Room</th>
					<th>Contact NO</th>
					<th>Blood Group</th>
					</tr>";
					while($id_info=mysql_fetch_array($buff1)){
						$query="select * from member_info 
						where hall like '{$_POST["Hall"]}%' and blood_group In('A+','A-','B+','B-','O+','O-','AB-') and id='{$id_info["id"]}'";
						$buff=mysql_query($query,$connection);
						confirm_query($buff);
						while($member_info=mysql_fetch_array($buff)){
							echo "<tr style='color:black'>";
							echo "<td>".$member_info['name']."</td>";
							echo "<td>".$member_info['dept']."</td>";
							echo "<td>".$member_info['hall']."</td>";
							echo "<td>".$member_info['room']."</td>";
							echo "<td>".$member_info['contact_no']."</td>";
							echo "<td>".$member_info['blood_group']."</td>";
							echo "</tr>";
						}
					}
					echo "</table>";
					}
					else{
						echo "<center><h3><b><u><strong></br></br>There are no members to show of another group</b></u></strong></h3></center></br>";
					}

					}

					if($_POST["blood_group"]=='AB-'){

					$date=date('Y-m-d');
					$query1="select id,availability from member_status where availability='yes' and due_date<='$date'";
					$buff1=mysql_query($query1,$connection);
					confirm_query($buff1);

					$check2=0;

					while($id_info=mysql_fetch_array($buff1)){

					$query="select * from member_info 
						where hall like '{$_POST["Hall"]}%' and blood_group In(A-','B-','O-') and id='{$id_info["id"]}'";
						$buff=mysql_query($query,$connection);
						confirm_query($buff);

						while($member_info=mysql_fetch_array($buff)){
							$check2=1;
						}
					}
					if($check2==1){

						$date=date('Y-m-d');
					$query1="select id,availability from member_status where availability='yes' and due_date<='$date'";
					$buff1=mysql_query($query1,$connection);
					confirm_query($buff1);

					echo "<center><h3><b><u><strong></br></br>Available Donors from ".$_POST["Hall"]." hall who can also donate to ".$_POST["blood_group"]."</b></u></strong></h3></center></br>";
					echo "<table border='1'	align='center'>
					<tr style='color:black'>
					<th>Name</th>
					<th>Dept</th>
					<th>Hall</th>
					<th>Room</th>
					<th>Contact NO</th>
					<th>Blood Group</th>
					</tr>";
					while($id_info=mysql_fetch_array($buff1)){
						$query="select * from member_info 
						where hall like '{$_POST["Hall"]}%' and blood_group In('A-','B-','O-') and id='{$id_info["id"]}'";
						$buff=mysql_query($query,$connection);
						confirm_query($buff);
						while($member_info=mysql_fetch_array($buff)){
							echo "<tr style='color:black'>";
							echo "<td>".$member_info['name']."</td>";
							echo "<td>".$member_info['dept']."</td>";
							echo "<td>".$member_info['hall']."</td>";
							echo "<td>".$member_info['room']."</td>";
							echo "<td>".$member_info['contact_no']."</td>";
							echo "<td>".$member_info['blood_group']."</td>";
							echo "</tr>";
						}
					}
					echo "</table>";
					}
					else{
						echo "<center><h3><b><u><strong></br></br>There are no members to show of another group</b></u></strong></h3></center></br>";
					}

					}

					if($_POST["blood_group"]=='B+'){

					$date=date('Y-m-d');
					$query1="select id,availability from member_status where availability='yes' and due_date<='$date'";
					$buff1=mysql_query($query1,$connection);
					confirm_query($buff1);

					$check2=0;

					while($id_info=mysql_fetch_array($buff1)){

					$query="select * from member_info 
						where hall like '{$_POST["Hall"]}%' and blood_group In('B-','O+','O-') and id='{$id_info["id"]}'";
						$buff=mysql_query($query,$connection);
						confirm_query($buff);

						while($member_info=mysql_fetch_array($buff)){
							$check2=1;
						}
					}
					if($check2==1){

						$date=date('Y-m-d');
					$query1="select id,availability from member_status where availability='yes' and due_date<='$date'";
					$buff1=mysql_query($query1,$connection);
					confirm_query($buff1);

					echo "<center><h3><b><u><strong></br></br>Available Donors from ".$_POST["Hall"]." hall who can also donate to ".$_POST["blood_group"]."</b></u></strong></h3></center></br>";
					echo "<table border='1'	align='center'>
					<tr style='color:black'>
					<th>Name</th>
					<th>Dept</th>
					<th>Hall</th>
					<th>Room</th>
					<th>Contact NO</th>
					<th>Blood Group</th>
					</tr>";
					while($id_info=mysql_fetch_array($buff1)){
						$query="select * from member_info 
						where hall like '{$_POST["Hall"]}%' and blood_group In('B-','O+','O-') and id='{$id_info["id"]}'";
						$buff=mysql_query($query,$connection);
						confirm_query($buff);
						while($member_info=mysql_fetch_array($buff)){
							echo "<tr style='color:black'>";
							echo "<td>".$member_info['name']."</td>";
							echo "<td>".$member_info['dept']."</td>";
							echo "<td>".$member_info['hall']."</td>";
							echo "<td>".$member_info['room']."</td>";
							echo "<td>".$member_info['contact_no']."</td>";
							echo "<td>".$member_info['blood_group']."</td>";
							echo "</tr>";
						}
					}
					echo "</table>";
					}
					else{
						echo "<center><h3><b><u><strong></br></br>There are no members to show of another group</b></u></strong></h3></center></br>";
					}

					}

					if($_POST["blood_group"]=='B-'){

					$date=date('Y-m-d');
					$query1="select id,availability from member_status where availability='yes' and due_date<='$date'";
					$buff1=mysql_query($query1,$connection);
					confirm_query($buff1);

					$check2=0;

					while($id_info=mysql_fetch_array($buff1)){

					$query="select * from member_info 
						where hall like '{$_POST["Hall"]}%' and blood_group In('O-') and id='{$id_info["id"]}'";
						$buff=mysql_query($query,$connection);
						confirm_query($buff);

						while($member_info=mysql_fetch_array($buff)){
							$check2=1;
						}
					}
					if($check2==1){

						$date=date('Y-m-d');
					$query1="select id,availability from member_status where availability='yes' and due_date<='$date'";
					$buff1=mysql_query($query1,$connection);
					confirm_query($buff1);

					echo "<center><h3><b><u><strong></br></br>Available Donors from ".$_POST["Hall"]." hall who can also donate to ".$_POST["blood_group"]."</b></u></strong></h3></center></br>";
					echo "<table border='1'	align='center'>
					<tr style='color:black'>
					<th>Name</th>
					<th>Dept</th>
					<th>Hall</th>
					<th>Room</th>
					<th>Contact NO</th>
					<th>Blood Group</th>
					</tr>";
					while($id_info=mysql_fetch_array($buff1)){
						$query="select * from member_info 
						where hall like '{$_POST["Hall"]}%' and blood_group In('O-') and id='{$id_info["id"]}'";
						$buff=mysql_query($query,$connection);
						confirm_query($buff);
						while($member_info=mysql_fetch_array($buff)){
							echo "<tr style='color:black'>";
							echo "<td>".$member_info['name']."</td>";
							echo "<td>".$member_info['dept']."</td>";
							echo "<td>".$member_info['hall']."</td>";
							echo "<td>".$member_info['room']."</td>";
							echo "<td>".$member_info['contact_no']."</td>";
							echo "<td>".$member_info['blood_group']."</td>";
							echo "</tr>";
						}
					}
					echo "</table>";
					}
					else{
						echo "<center><h3><b><u><strong></br></br>There are no members to show of another group</b></u></strong></h3></center></br>";
					}

					}

					if($_POST["blood_group"]=='O+'){

					$date=date('Y-m-d');
					$query1="select id,availability from member_status where availability='yes' and due_date<='$date'";
					$buff1=mysql_query($query1,$connection);
					confirm_query($buff1);

					$check2=0;

					while($id_info=mysql_fetch_array($buff1)){

					$query="select * from member_info 
						where hall like '{$_POST["Hall"]}%' and blood_group In('O-') and id='{$id_info["id"]}'";
						$buff=mysql_query($query,$connection);
						confirm_query($buff);

						while($member_info=mysql_fetch_array($buff)){
							$check2=1;
						}
					}
					if($check2==1){

						$date=date('Y-m-d');
					$query1="select id,availability from member_status where availability='yes' and due_date<='$date'";
					$buff1=mysql_query($query1,$connection);
					confirm_query($buff1);

					echo "<center><h3><b><u><strong></br></br>Available Donors from ".$_POST["Hall"]." hall who can also donate to ".$_POST["blood_group"]."</b></u></strong></h3></center></br>";
					echo "<table border='1'	align='center'>
					<tr style='color:black'>
					<th>Name</th>
					<th>Dept</th>
					<th>Hall</th>
					<th>Room</th>
					<th>Contact NO</th>
					<th>Blood Group</th>
					</tr>";
					while($id_info=mysql_fetch_array($buff1)){
						$query="select * from member_info 
						where hall like '{$_POST["Hall"]}%' and blood_group In('O-') and id='{$id_info["id"]}'";
						$buff=mysql_query($query,$connection);
						confirm_query($buff);
						while($member_info=mysql_fetch_array($buff)){
							echo "<tr style='color:black'>";
							echo "<td>".$member_info['name']."</td>";
							echo "<td>".$member_info['dept']."</td>";
							echo "<td>".$member_info['hall']."</td>";
							echo "<td>".$member_info['room']."</td>";
							echo "<td>".$member_info['contact_no']."</td>";
							echo "<td>".$member_info['blood_group']."</td>";
							echo "</tr>";
						}
					}
					echo "</table>";
					}
					else{
						echo "<center><h3><b><u><strong></br></br>There are no members to show of another group</b></u></strong></h3></center></br>";
					}

					}

				}
				else{
					echo "<center><h3><b><u><strong></br></br>There are no members to show</b></u></strong></h3></center></br>";
				}
				
			}
	?>
		</div>		

	</div>

	
	</body>


<?php require_once("includes/footer.php")?>	

