<?php
	include_once("init.php");
	session_start();
	include_once("includes/dBug.php");
	include_once("foursquare.php");
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<title>ZapFour - Making Compulsive Shoppers</title>

<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	
	<!-- 1140px Grid styles for IE -->
	<!--[if lte IE 9]><link rel="stylesheet" href="css/ie.css" type="text/css" media="screen" /><![endif]-->

	<!-- The 1140px Grid - http://cssgrid.net/ -->
	<link rel="stylesheet" href="css/1140.css" type="text/css" media="screen" />
	
	<!-- Your styles -->
	<link rel="stylesheet" href="css/styles.css" type="text/css" media="screen" />
	
	<!--css3-mediaqueries-js - http://code.google.com/p/css3-mediaqueries-js/ - Enables media queries in some unsupported browsers-->
	<script type="text/javascript" src="js/css3-mediaqueries.js"></script>
</head>

<body>
<?php include("includes/header.php"); ?>
    <?php 
	// If we have not received a token, display the link for Foursquare webauth
	if($foursquare->GetAccessToken() == ""){ 
		echo "<a href=" . $foursquare->AuthenticationLink() . ">Connect to this app via Foursquare</a>";
	}
	else{
	?>
	
	You are authenticated!!   

	<?php
	}
	?>

	<?php include("includes/footer.php"); ?>
    </body>
</html>