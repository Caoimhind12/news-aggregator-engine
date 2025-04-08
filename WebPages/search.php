<?php 
session_start();

	include("connect.php");
	include("functions.php");

 ?>

 <!DOCTYPE html>
 <html>
 <head>
 	<title>NewsDoch - Index Page</title>
 	<link rel="stylesheet" href="main.css">
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

<!-- Displays Search Results -->

<h1>Search Results</h1>
<div class = "search-container">
<?php 
	if (isset($_POST['submit-search'])) {
		$search = mysqli_real_escape_string($con, $_POST['search']);
		$sql = "SELECT * FROM news WHERE Headline LIKE '%$search%' OR ArticleText LIKE '%$search%' OR SiteName LIKE '%$search%' OR ArticleDate LIKE '%$search%'";
		$result = mysqli_query($con,$sql);
		$queryResult = mysqli_num_rows($result);

		echo "There are ".$queryResult." results.";
		if ($queryResult > 0){
			while ($row = mysqli_fetch_assoc($result)){
				echo"<div><h3>". $row["SiteName"] . "</h3><p><a href = '" . $row["ArticleID"] . "'>"
			. $row["Headline"] . "</a></p><p>"
			. $row["ArticleDate"] . "</p></div>";
			}
		}else
		{
			echo "There are no results that match your search!";
		}
	}

 ?>
</div>

<!-- Footer -->
<div class="footer">
            <!Footer Class -->
            <! Social Media Logos -->
        <a href="https://www.facebook.com/RainbowRehoming/"><img src="Images/FacebookLogoWhite.png" style="width:30px;height:30px;"></a>
            <a href="https://twitter.com/RainbowRehoming"><img src="Images/TwitterLogoWhite.png" style="width:30px;height:30px;"></a>
            <a href="https://www.youtube.com/user/RainbowRehoming"><img src="Images/YouTubeLogoWhite.png" style="width:30px;height:30px;"></a>
            <a href="https://www.instagram.com/rainbowrehomingcentre/?hl=en"><img src="Images/InstagramLogoWhite.png" style="width:30px;height:30px;"></a>
        </div>
        <div class="footer2">
            <!Footer Class -->
            <! Copyright -->
            &copy; SpillTheTaigh
        </div>
 </body>
 </html>