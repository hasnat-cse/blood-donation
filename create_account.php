<?php require_once("includes/header.php")?>
<?php include_once("includes/DB_connection.php");?> 
<?php include_once("includes/functions.php");?>


<body style="background:url('images/back.png') ">

	<marquee behavior="alternate"><h1 align="center"><strong><b><u>Blood Donation DBMS</u></b></strong></h1></marquee>
	</br></br>
	<h2 align="center"><strong><b><font color="Navy">Create Account</font></b></strong></h2>
	
	<p align="right">
				<a href="login.php"><b><button>Go Login Page</b></button><a/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	</p>

	<?php
		if(isset($_POST["user_name"]) && isset($_POST["pass"]) && isset($_POST["name"]) && isset($_POST["room"]) && isset($_POST["contact_no"])){
			
			if($_POST["user_name"]=="" || $_POST["pass"]==""|| $_POST["re_pass"]==""|| $_POST["dept"]==""  || $_POST["name"]=="" || $_POST["contact_no"]=="")
			{	
				echo "<h2><u></br></br><center>Please Fill Up All The Mandatory  Fields</center></br></u></h2>";
			}
			else{
				if ($_POST["vercode"] != $_SESSION["vercode"] OR $_SESSION["vercode"]=='')  {
				echo '<p><h1 align="center"><u>Incorrect verification code</u></h1></p>';
				} 
				else {
			
				$query="SELECT * FROM member_info WHERE user_name='{$_POST["user_name"]}'";
			$buff = mysql_query($query,$connection);
			confirm_query($buff);

			//$flag=0;
			$u_name1='';

			while($staff_info=mysql_fetch_array($buff)){	//if no row return then the condition is false
				$u_name1=$staff_info["user_name"];
				//$flag=1;
			}

			//if($flag==0){
		//		$u_name1="garbage";
		//	}

			if($u_name1==$_POST["user_name"])
			{
				echo '<p><h1 align="center"><u>Your given User name is already aquired.Please enter a new User name</u></h1></p>';

			}
			elseif($_POST["pass"]!=$_POST["re_pass"]){
				echo '<p><h1 align="center"><u>Retype Your Password</u></h1></p>';
			}
			else{
				$query="INSERT INTO
					member_info(user_name,password,name,dept,hall,room,contact_no,blood_group)
					values('{$_POST["user_name"]}','{$_POST["pass"]}','{$_POST["name"]}','{$_POST["dept"]}','{$_POST["Hall"]}','{$_POST["room"]}','{$_POST["contact_no"]}'
						,'{$_POST["blood_group"]}')";
					$buff=mysql_query($query,$connection);
					confirm_query($buff);

			$query="SELECT * FROM member_info WHERE user_name='{$_POST["user_name"]}'";
			$buff = mysql_query($query,$connection);
			confirm_query($buff);

			while($staff_info=mysql_fetch_array($buff)){
				$id=$staff_info["id"];
			}
			$query="INSERT INTO
				donation_info(id,donation_date)
				values($id,'{$_POST["last_date"]}')";
			$buff=mysql_query($query,$connection);
			confirm_query($buff);

			$query="select * from member_info 
				where user_name='{$_POST["user_name"]}'";
			$buff=mysql_query($query,$connection);
			confirm_query($buff);
			
			while($staff_info=mysql_fetch_array($buff)){
				$_SESSION["user_id"]=$staff_info["id"];
				$_SESSION["role"]=$staff_info["role"];
				$_SESSION["hall"]=$staff_info["hall"];

				header("Location:member.php");
			}

			

			}

			}	
		}
			
		}
?>

	<form action="create_account.php" method="post">

	<div id="content" style="text-align:center;">		
			
 			<fieldset style="position:absolute;left:35%;top:30%;display:block;float:left;text-align:left;">
 				<legend>Account Creation</legend>
 				</br>
 			<ul >

 				<li style="color:red"> 
 					<label for="user_name">User Name:</label>
 					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
 					<input type="text" placeholder="User_Name" name="user_name"> *
 				</li>
 			</br>

				<li style="color:red">
 					<label for="pass">Password:</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
 					<input type="password" placeholder="****" name="pass"> *
 				</li>
 				</br>
 				<li style="color:red">
 					<label for="re_pass">Retype Password:</label>
 					<input type="password" placeholder="****" name="re_pass"> *
 				</li>
 				</br>

 				<li style="color:red">
 					<label for="name">Name:</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
   					<input type="text" placeholder="Name" name="name"> *
   				</li>
   				</br>

   				<li style="color:red">
 					<label for="dept">Department:</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

 					<input type="dept" placeholder="dept" name="dept"> *
 				</li>
 				</br>

   				<li>
   					<label for="Hall">Hall:</label>
   					<select id="Hall" name="Hall">	
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
   				</br>

   				<li>
   					<label for="room">Room:</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
   					<input type="text" placeholder="100/100-A" name="room"></br>
   				</li>
   				</br>

   				<li style="color:red">
   					<label for="contact_no">Contact No:</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
   					<input type="text" placeholder="01********" name="contact_no"> *</br> 
   				</li>
   				</br>
   				<li style="color:red">
   					<label for="blood_group">Blood Group:</label>
   					<select id="blood_group" name="blood_group">
					<option value="A+">A+</option>
					<option value="A-">A-</option>
					<option value="B+">B+</option>
					<option value="B-">B-</option>
					<option value="AB+">AB+</option>
					<option value="AB-">AB-</option>
					<option value="O+">O+</option>
					<option value="O-">O-</option>
					</select> *
   				</li>
   				</br>
     				<li>
   					<label for="last_date">Last Donation Date:</label>
   					<input type="text" placeholder="YYYY-MM-DD" name="last_date" value="0000-00-00"></br>
   				</li>
   				</br>
   			</ul>
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<img src="captcha.php"></br>
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				Enter Code: <input type="text" name="vercode" /> 
   			<ul style="text-align:center;"></br>
				<input type="Submit" style="width: 60px; padding:1.5px; border: 2px" value="Submit">
			</ul>

			<P style="text-align:center">
			<font color="red">*</font> Fields are mandatory to be filled up.
			</P>
		
		</fieldset>

		

	</div>
	
</form>

</body>





<?php include("includes/footer.php")?>


