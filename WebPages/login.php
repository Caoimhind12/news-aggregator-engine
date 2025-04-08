<?php 
session_start();
include("connect.php");
	include("functions.php");


	if($_SERVER['REQUEST_METHOD'] == "POST")
	{
		//something was posted
		$Email = $_POST['Email'];
		$Passwords = $_POST['Passwords'];

		if(!empty($Email) && !empty($Passwords))
		{

			//read from database
			$query = "select * from users where Email = '$Email' limit 1";
			$result = mysqli_query($con, $query);

			if($result)
			{
				if($result && mysqli_num_rows($result) > 0)
				{

					$user_data = mysqli_fetch_assoc($result);
					
					if($user_data['Passwords'] === $Passwords)
					{

						$_SESSION['UserID'] = $user_data['UserID'];
						header("Location: index.php");
						die;
					}
				}
			}
			
			echo "wrong username or password!";
		}else
		{
			echo "wrong username or password!";
		}
	}

 ?>

 <!DOCTYPE html>
 <html>
 <head>
 	<title>NewsDoch - Login</title>
 	<link rel="stylesheet" href="main.css">

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
	width: 380px;
	padding: 20px;
}

.containerLogo img{
	float: center;
	width: 350px;
	height: 250px;
	padding: 0 0 0 0;
}

	</style>
 </head>
 <body>
 	<div class="containerLogo">
 		<img class="Logo" src="images/SPTLogo.png" alt="Logo">
 	</div>
 	<!-- Post method for login verification -->
 	<div class ="containerOne">
	 <div id="box">
		
		<form method="post">
			<div style="font-size: 20px;margin: 10px;color: white;">Login</div>
			<label for="Email">Email:</label>
			<input id="text" type="text" name="Email"><br><br>
			<label for="Passwords">Password:</label>
			<input id="text" type="password" name="Passwords"><br><br>

			<input id="button" type="submit" value="Login"><br><br>

			<a href="signup.php">Click to Signup</a><br><br>
		</form>
	</div>
	</div>	
 </body>
 </html>