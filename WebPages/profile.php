<?php  
session_start();
include("connect.php");
	include("functions.php");

	$user_data = check_login($con);
	$id = $user_data['UserID'];
	$Uid = $user_data['ID'];
 	$sql = "SELECT c.* FROM category c INNER JOIN personalfeed p ON c.CategoryID = p.CategoryID AND p.UserID = '$Uid' ORDER BY c.CategoryID";
 	$sqlNo = "SELECT * FROM category WHERE CategoryID NOT IN(SELECT CategoryID FROM personalfeed WHERE UserID ='$Uid')";

 if(isset($_POST['add'])){
 	$CategoryID = $_POST['CategoryID'];
 	$mysqli->query("INSERT INTO personalfeed (UserID, CategoryID) VALUES ('$Uid','$CategoryID')") or die($mysqli->error);
 }

?>

<!DOCTYPE html>
<html>
<head>
	<title>Spill The Taigh - Profile</title>	
	<link rel="stylesheet" href="main.css">
	<style>
		.containerOne h1 ul{
  font-family: 'Courier New', monospace;
  text-decoration: underline;
}
h2{
  font-family: 'Courier New', monospace;
}
 	</style>
</head>
<body>
	<!-- Nav bar -->
<div class="wrapper">
    <div class="multi_color_border"></div>
    <div class="top_nav">
        <div class="left">
          <div class="logo"><p><a href="index.php"><img src="images/SPTLogo.png" height="65px" alt="Logo"></a></div>
          <form action = "search.php" class = "search_bar" method = "POST">
              <input type="text" name = "search" placeholder="Search">
              <button type = "submit" name="submit-search">Search</button>
          </form>
      </div> 
      <div class="right">
        <ul>
          <li><a href="profile.php">Profile</a></li>
          <li><a href="logout.php">Log Out</a></li>
        </ul>
      </div>
    </div>
    <div class="bottom_nav">
      <ul>
        <li><a href="index.php">Home</a></li>
        <li><a href="personalFeed.php">Personal Feed</a></li>
        <li><a href="Politics.php">Politics</a></li>
        <li><a href="business.php">Business</a></li>
        <li><a href="tech.php">Technology</a></li>
            <div class="dropdown">
    <button class="dropbtn">Sport 
      <i class="fa fa-caret-down"></i>
    </button>
    <div class="dropdown-content">
      <a href="football.php">Football</a>
      <a href="basketball.php">Basketball</a>
      <a href="boxing.php">Boxing</a>
    </div>
  </div>
        <div class="dropdown">
    <button class="dropbtn">Other 
      <i class="fa fa-caret-down"></i>
    </button>
    <div class="dropdown-content">
      <a href="science.php">Science</a>
      <a href="health.php">Health</a>
      <a href="entertainment.php">Entertainment</a>
    </div>
  </div>
      </ul>
  </div>
</div>
</div>
<div class="row">
	<div class="columnTwo">
		<h2>Selected Categories:</h2>
		<!-- Display table for removing categories -->
		<table class="content-table">
			<tr>
			<th>CategoryID</th>
			<th>Category Name</th>
			<th>Remove</th>
			</tr>
			<?php

			$result = ($con->query($sql));

			if($result->num_rows >0){
			while($row = $result->fetch_assoc()){
			$Cid =$row['CategoryID'];
			$categoryName =$row['CategoryName'];

			echo'<tr><td>' . $Cid . '</td>
			<td>' . $categoryName . '</td>
			<td><button><a href="add.php?delete=' . $Cid . '">Remove</a></button></td></tr>';
			}

			}
			else{
			echo"NO RESULTS";
			}
			?>

			</tr>
			<tr></tr>
		</table>
	</div>
	<div class="columnTwo">
	<h2>Unselected Categories:</h2>
	<!-- Display Table for adding categories -->
		<table class="content-table">
			<tr>
			<th>CategoryID</th>
			<th>Category Name</th>
			<th>Add</th>
			</tr>
			<tr>
			<?php

			$resultTwo = ($con->query($sqlNo));

			if($resultTwo->num_rows >0){
			while($row = $resultTwo->fetch_assoc()){
			$idC =$row['CategoryID'];
			$category=$row['CategoryName'];

			echo'<tr><td>'. $idC . '</td>
			<td>'. $category . '</td>
			<td><button><a href="add.php?add='. $idC .'">Add</a></button></td>
			</tr>';
			}

			}
			else{
			echo"NO RESULTS";
			}
			?>

			</tr>
			<tr></tr>
		</table>
	</div>
</div>
<!-- Footer -->
<div class="footer">
            <!-- Social Media Logos -->
        <a href="https://www.facebook.com"><img src="Images/FacebookLogoWhite.png" style="width:30px;height:30px;"></a>
            <a href="https://twitter.com"><img src="Images/TwitterLogoWhite.png" style="width:30px;height:30px;"></a>
            <a href="https://www.youtube.com"><img src="Images/YouTubeLogoWhite.png" style="width:30px;height:30px;"></a>
            <a href="https://www.instagram.com"><img src="Images/InstagramLogoWhite.png" style="width:30px;height:30px;"></a>
        </div>
        <div class="footer2">
            <!Footer Class -->
            <! Copyright -->
            &copy; SpillTheTaigh
        </div>
</body>
</html>