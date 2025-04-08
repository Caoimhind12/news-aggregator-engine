<?php 
session_start();

	include("connect.php");
	include("functions.php");

	$user_data = check_login($con);
	$Uid = $user_data['ID'];
	$sql = "SELECT n.* FROM news n INNER JOIN personalfeed p ON n.CategoryID = p.CategoryID AND p.UserID = '$Uid' ORDER BY n.ID DESC LIMIT 8";
 ?>

 <!DOCTYPE html>
 <html>
 <head>
 	<title>Spill The Taigh - Personal Feed</title>
 	<link rel="stylesheet" href="main.css">
  <link rel="stylesheet" href= "https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
  <link rel="stylesheet" href= "https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
 	<style type="text/css">
 		a:link {
  color: #43C676;
  background-color: transparent;
  text-decoration: none;
}
a:visited {
  color: #43C676;
  background-color: transparent;	
  text-decoration: none;
}
a:hover {
  color: #43C676;
  background-color: transparent;
  text-decoration: underline;
}

body{background-color:#eee}.socials i{margin-right: 14px;font-size: 17px;color: #d2c8c8;cursor: pointer}
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
          <div class="logo"><p><a href="index.php"><img src="images/SPTLogo.png" height="65px"></a></div>
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

<!-- Container for Header -->

<div class = "containerOne">
 	<h1><ul><?php echo $user_data['Forename']; ?>'s Feed</ul></h1>
 	</div>
 	<br>
 	<!-- Display feed of news -->
	</div>
	<?php 
	$result = ($con->query($sql));

			if($result->num_rows >0){
			while($row = $result->fetch_assoc()){
				echo 
				'<div class="container mt-4 mb-5">
				    <div class="d-flex justify-content-center row">
				        <div class="col-md-8">
				            <div class="feed p-2">
				                <div class="bg-white border mt-2">
				                    <div>
				                        <div class="d-flex flex-row justify-content-between align-items-center p-2 border-bottom">
				                            <div class="d-flex flex-row align-items-center feed-text px-2">
				                                <div class="d-flex flex-column flex-wrap ml-2"><span class="font-weight-bold"><a href="' . $row['ArticleID'] . '">' . $row['Headline'] . '</a></span><span class="text-black-50 time">' . $row['ArticleDate'] . '</span></div>
				                            </div>
				                            <div class="feed-icon px-2"><i class="fa fa-ellipsis-v text-black-50"></i></div>
				                        </div>
				                    </div>
				                    <div class="p-2 px-3"><span>' . $row['ArticleText'] . '</span></div>
				                </div>
				            </div>
				        </div>
				    </div>
				</div>';
			}
		}else{
			echo"NO RESULTS";
			}
 	?>
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