<?php 
include("connect.php");
	include("functions.php");


	if($_SERVER['REQUEST_METHOD'] == "POST")
	{
		//something was posted
		$Email = $_POST['Email'];
		$Passwords = $_POST['Passwords'];
		$Forename = $_POST['Forename'];
		$Surname = $_POST['Surname'];

		if(!empty($Email) && !empty($Passwords) && !empty($Forename) && !empty($Surname))
		{

			//save to database
			$UserID = random_num(20);
			$query = "insert into users (UserID,Forename,Surname,Email,Passwords) values ('$UserID','$Forename','$Surname','$Email','$Passwords')";

			mysqli_query($con, $query);

			header("Location: login.php");
			die;
		}else
		{
			echo "Please enter some valid information!";
		}
	}
 ?>

 <!DOCTYPE html>
 <html>
 <head>
 	<title>NewsDoch - Sign Up</title>
 	<style type="text/css">
	body{
		background-color: #5EAD8C;
	}
	#text{

		height: 25px;
		border-radius: 5px;
		padding: 4px;
		border: solid thin #aaa;
		width: 100%;
	}

	#button{

		padding: 10px;
		width: 100px;
		color: white;
		background-color: lightblue;
		border: none;
	}

	#box{

		background-color: #ddd;
		margin: auto;
		width: 300px;
		padding: 20px;
	}
	.containerLogo{
	margin: auto;
	width: 300px;
	padding: 20px;
}

.containerLogo img{
	float: center;
	width: 300px;
	height: 220px;
	padding: 0 0px 0 0;
}
	</style>
 </head>
 <body>
 	<div class="containerLogo">
 		<img class="Logo" src="images/SPTLogo.png" alt="Logo">
 	</div>
 	<!-- Post method to create a user in DB -->
 	<div id="box">
		
		<form method="post">
			<div style="font-size: 20px;margin: 10px;color: white;">Signup</div>
			<label for="Email">Email:</label>
			<input id="text" type="text" name="Email"><br><br>
			<label for="Passwords">Password:</label>
			<input id="text" type="password" name="Passwords"><br><br>
			<label for="Forename">Forename:</label>
			<input id="text" type="text" name="Forename"><br><br>
			<label for="Surname">Surname:</label>
			<input id="text" type="text" name="Surname"><br><br>

			<input id="button" type="submit" value="Signup"><br><br>

			<a href="login.php">Click to Login</a><br><br>
		</form>
	</div>

 </body>
 </html>