<?php
	
	session_start();
	
	require_once("classes/foursquareAPI.php");
	require_once("classes/Application.php");
	require_once("includes/dBug.php");
	
	// This file is intended to be used as your redirect_uri for the client on Foursquare
	
	// Set your client key and secret
	//$client_key = "LCSLN3T0TOVU2O3PCYSL312FYGDPTPIAKGYTI0GMKLWZFP31";
	//$client_secret = "K2BYPPF0SNZYO0A5V0SRCYIZQXKCP3ZPOBXMT2QCDVNTXEAC";
	//$redirect_uri = "http://localhost/z4/callback.php";
	
	// Load the Foursquare API library
	
	$foursquare = new FoursquareAPI($_SESSION["FS"]->getFSClientID(),$_SESSION["FS"]->getFSSecret());
	
	// If the link has been clicked, and we have a supplied code, use it to request a token
	if(array_key_exists("code",$_GET)){
		$token = $foursquare->GetToken($_GET['code'],$_SESSION["FS"]->getFSCallbackURI());
		$_SESSION["FS"]->setFSAuthToken($token);
	}
?>
<!doctype html>
<html>
<head>
	<title>PHP-Foursquare :: Token Request Example</title>
</head>
<body>
<h1>Token Request Example</h1>
<p>
	<?php 
	// If we have not received a token, display the link for Foursquare webauth
	if(!isset($token)){ 
		echo "<a href='".$foursquare->AuthenticationLink($_SESSION["FS"]->getFSCallbackURI())."'>Connect to this app via Foursquare</a>";
	// Otherwise display the token
	}else{
		echo "Your auth token: $token";
	}
	
	?>
	
</p>
	<a href="authenticated.php">Now make an authenticated request</a>
<hr />
</body>
</html>
