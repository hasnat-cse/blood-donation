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
	<h1 align="center"><b><font color="LightCyan">Home page</font></b></h1>

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


	<div id="content" style="position:relative;overflow:auto;height:90%;width:80%;text-align:center;
				float:left;">
			</br></br></br></br></br></br> 
				<p style="text-align=center;"> <font face="IMPACT" size="5" color="black">
					This is the homepage of <b><u>SuperAdmin</b></u> of <b>BLOOD DONATION DATA MANAGEMENT SYSTEM.</b> </br></br>He has the supreme power of doing any changes to this system. He should give responsibility </br></br> of others hall to that personwho is the best. Because a responsible person can make</br></br>  this website dynamic and updated so no harrassmentwill occur. People will get </br></br> best service from this website. <b><u>SuperAdmin</b></u> should be carefull about his duty.
				</font>
				</p> 

</div>

				
	</div>	
		
	</body>
<?php include("includes/footer.php")?>
