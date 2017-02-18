<?php require_once("includes/header.php")?>
<?php include_once("includes/functions.php")?>
<?php include_once("includes/DB_connection.php");?>

	<body style="background:url('images/back.png') ">
		<marquee behavior="alternate"><h1 align="center"><strong><b><u>Blood Donation DBMS</u></b></strong></h1></marquee>
		</br></br>
	<h2 align="center"><strong><b><font color="Navy">Contact Information</font></b></strong></h2>
	
	<p align="right">
				<br/>
				<a href="login.php"><b><button>Go Login Page</b></button><a/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	</p>
	
	<?php
				$query1="select * from hall_names";
				$buff1=mysql_query($query1,$connection);
				confirm_query($buff1);
				echo "</br></br></br></br>";
				echo "<center><h3><b><u><strong>Hall Admins</b></u></strong></h3></center></br>";
				echo "<table border='1'	align='center'>
				<tr style='color:black'>
				<th>Hall</th>
				<th>Name</th>
				<th>Contact No</th>
				</tr>";
				while($id_info=mysql_fetch_array($buff1)){
					$query="select * from member_info 
					where id='{$id_info['id']}'";
					$buff=mysql_query($query,$connection);
					confirm_query($buff);
					while($member_info=mysql_fetch_array($buff)){
						echo "<tr  style='color:black'>";
						echo "<td>".$id_info['hall_name']."</td>";
						echo "<td>".$member_info['name']."</td>";
						echo "<td>".$member_info['contact_no']."</td>";
						echo "</tr>";
					}
				}
				echo "</table>";
			?>
	</body>
<?php include("includes/footer.php")?>
