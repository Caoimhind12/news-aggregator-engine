<?php 
session_start();

	include("connect.php");
	include("functions.php");

	$user_data = check_login($con);
	$sql = "SELECT * FROM news WHERE SiteName = 'cbs' AND CategoryID = '4' ORDER BY ID DESC LIMIT 10";
	$sql2 = "SELECT * FROM news WHERE SiteName = 'bbc' AND CategoryID = '4' ORDER BY ID DESC LIMIT 10";
	$sql3 = "SELECT * FROM news WHERE SiteName = 'sky' AND CategoryID = '4' ORDER BY ID DESC LIMIT 10";
 ?>

 <!DOCTYPE html>
 <html>
 <head>
 	<title>Spill The Taigh - Basketball</title>
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
          <div class="logo"><p><img src="images/SPTLogo.png" height="65px"></div>
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
<!-- Contain for displaying 3 columns -->
<div class = "containerOne">
 	<h1><ul>Home of Basketball</ul></h1>
 	</div>

 	<br>
 	<div class = "row">
 <div class="column">
 	<!-- Displays CBS news -->
	<h2>CBS</h2>	
		<table class="content-table">
			<tr>
			<th>Site</th>
			<th>Headline</th>
			<th>Date</th>
			<th></th>
			</tr>
			<tr>
			<?php


			$result = ($con->query($sql));

			if($result->num_rows >0){
			while($row = $result->fetch_assoc()){
			echo"<tr><td>". $row["SiteName"] . "</td><td><a href = 'https://www.cbssports.com" . $row["ArticleID"] . "'>"
			. $row["Headline"] . "</a></td><td>"
			. $row["ArticleDate"] . "</td><td>";
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

	<div class="column">
		<!-- Displays BBC news -->
		<h2>BBC</h2>
		<table class="content-table">
			<tr>
			<th>Site</th>
			<th>Headline</th>
			<th>Date</th>
			<th></th>
			</tr>
			<tr>
			<?php


			$result2 = ($con->query($sql2));

			if($result2->num_rows >0){
			while($row = $result2->fetch_assoc()){
			echo"<tr><td>". $row["SiteName"] . "</td><td><a href = 'https://www.bbc.co.uk" . $row["ArticleID"] . "'>"
			. $row["Headline"] . "</a></td><td>"
			. $row["ArticleDate"] . "</td><td>";
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

	<div class="column">
		<!-- Displays SKY news -->
		<h2>Sky News</h2>
		<table class="content-table">
			<tr>
			<th>Site</th>
			<th>Headline</th>
			<th>Date</th>
			<th></th>
			</tr>
			<tr>
			<?php


			$result3 = ($con->query($sql3));

			if($result3->num_rows >0){
			while($row = $result3->fetch_assoc()){
			echo"<tr><td>". $row["SiteName"] . "</td><td><a href = '" . $row["ArticleID"] . "'>"
			. $row["Headline"] . "</a></td><td>"
			. $row["ArticleDate"] . "</td><td>";
			}

			}
			else{
			echo"NO RESULTS";
			}
			$con->close();
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