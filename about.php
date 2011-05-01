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
<title>ZapFour - How Does It Make Compulsive Shoppers</title>
<script src="js/jquery-1.5.1.min.js" type="text/javascript"></script>
<script src="js/jquery-ui-1.8.12.custom.min.js" type="text/javascript"></script>
<script src="http://cdn.jquerytools.org/1.2.5/jquery.tools.min.js" type="text/javascript"></script>
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	
	<!-- 1140px Grid styles for IE -->
	<!--[if lte IE 9]><link rel="stylesheet" href="css/ie.css" type="text/css" media="screen" /><![endif]-->

	<!-- The 1140px Grid - http://cssgrid.net/ -->
	<link rel="stylesheet" href="css/1140.css" type="text/css" media="screen" />
	
	<!-- Your styles -->
	<link rel="stylesheet" href="css/styles.css" type="text/css" media="screen" />
	
	<!--css3-mediaqueries-js - http://code.google.com/p/css3-mediaqueries-js/ - Enables media queries in some unsupported browsers-->
	<script type="text/javascript" src="js/css3-mediaqueries.js"></script>
	
	<script type="text/javascript">
		$(document).ready(function() {
			$("[title]").tooltip();
		}); 
	</script>
	
</head>

<body>
<?php include("includes/header.php"); ?>

<div id="content" class="container">
	<div class="row">
		<div class="twelvecol">
		<h3>about ZapFour</h3>
		<p>ZapFour is an app developed to offer an different shopping experience. Product suggestions are based on your local weather and your last 6 FourSquare check-ins. Products that you otherwise might not have considered are presented in a fun way. Discounts will also be offered.</p>
		</div>
	</div>
</div>

</body>
</html>