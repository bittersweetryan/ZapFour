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
		<div class="threecol">
			<div class="product">
				<p class="productImg"><img alt="Sperry" src="images/products/sperry-1.jpg" /></p>
				<h3>Sperry Top Sider</h3>
				<p>Authentic Original</p>
				<p>$85.00</p>
			</div>
		</div>
		<div class="threecol">
			<div class="product">
				<p class="productImg"><img alt="Swim trunks" src="images/products/trunks.jpg" /></p>
				<h3>Hurley</h3>
				<p>One Only Boardshort</p>
				<p>$41.75</p>
			</div>
		</div>
		<div class="threecol">
			<div class="product">
				<p class="productImg"><img alt="Sperry" src="images/products/sperry-2.jpg" /></p>
				<h3>Sperry Top Sider</h3>
				<p>Authentic Original</p>
				<p>$75.00</p>
			</div>
		</div>
		<div class="threecol last">
			<div class="product">
				<p class="productImg"><img alt="Sperry" src="images/products/sperry-1.jpg" /></p>
				<h3>Sperry Top Sider</h3>
				<p>Authentic Original</p>
				<p>$85.00</p>
			</div>
		</div>
	</div>
	<div class="row products">
		<div class="threecol">
			<div class="product">
				<p class="productImg"><img alt="Sperry" src="images/products/sperry-1.jpg" /></p>
				<h3>Sperry Top Sider</h3>
				<p>Authentic Original</p>
				<p>$85.00</p>
			</div>
		</div>
		<div class="threecol">
			<div class="product">
				<p class="productImg"><img alt="Swim trunks" src="images/products/trunks.jpg" /></p>
				<h3>Hurley</h3>
				<p>One Only Boardshort</p>
				<p>$41.75</p>
			</div>
		</div>
		<div class="threecol">
			<div class="product">
				<p class="productImg"><img alt="Sperry" src="images/products/sperry-2.jpg" /></p>
				<h3>Sperry Top Sider</h3>
				<p>Authentic Original</p>
				<p>$75.00</p>
			</div>
		</div>
		<div class="threecol last">
			<div class="product">
				<p class="productImg"><img alt="Sperry" src="images/products/sperry-1.jpg" /></p>
				<h3>Sperry Top Sider</h3>
				<p>Authentic Original</p>
				<p>$85.00</p>
			</div>
		</div>
	</div>
</div>

</body>
</html>