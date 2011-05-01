<?php
	session_start();
	include_once("init.php");
	include_once("foursquare.php");
	
	$foursquare = new FoursquareAPI($Config->getFSClientID(),$Config->getFSSecret(),$Config->getFSCallbackURI());
	
	// If the link has been clicked, and we have a supplied code, use it to request a token
	if(array_key_exists("code",$_GET)){
		$token = $foursquare->GetToken($_GET['code'],$_SESSION["FS"]->getFSCallbackURI());
		$_SESSION["FS"]->setFSAuthToken($token);
	}
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
    <head>
        <title>FUN</title>
    </head>
    <body>
    <?php 
	// If we have not received a token, display the link for Foursquare webauth
	if(!isset($token)){ 
		echo "<a href='".$foursquare->AuthenticationLink()."'>Connect to this app via Foursquare</a>";
	// Otherwise display the token
	}else{
		echo "Your auth token: $token";
	}
	
	?>
    </body>
</html>