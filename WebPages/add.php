<?php 
session_start();
	include("connect.php");
	include("functions.php");

	$user_data = check_login($con);
	$id = $user_data['UserID'];

if (isset($_GET['delete'])){
	$Cid = $_GET['delete'];
	$Uid = $user_data['ID'];
	$con->query("DELETE FROM personalfeed WHERE UserID ='$Uid' AND CategoryID ='$Cid'") or die($mysqli->error());

	header("Location: profile.php");
}

if (isset($_GET['add'])){
	$Cid = $_GET['add'];
	$Uid = $user_data['ID'];
	$con->query("INSERT INTO personalfeed (UserID, CategoryID) VALUES ($Uid, $Cid)") or die($mysqli->error());

	header("Location: profile.php");
}
?>



