<?php
session_start();
include_once 'lib.php';
if(!isset($_SESSION["id"]))
    header("location: index.php");


?>

<!DOCTYPE html>
<html>
<head>
<meta name="viewport" charset="UTF-8" content="width=device-width, initial-scale=1">

<link rel="stylesheet" type="text/css" href="stil.css">

</head>
<body>

<div class="header">
  <img src="src/cloud2.png" alt="cloud" width="65" height="35" style="float:left"> 
  <a href="logedIn.php" class="home1" >Home</a>
  <div class="header-right">    
	<a href=""><?php echo $_SESSION["ime"]  ?></a> 
	 <a href="logout.php">Logout</a>   
  </div>
</div>



<div class="kont3">

<h1>Double Transposition Cipher<h1> 
  <div class="kont2">
  <a href="enkriptuj.php" class="myButton">Encrypt</a>
  <a href="dekriptuj.php" class="myButton">Decrypt</a>

</div>


</div>


</body>
</html>
