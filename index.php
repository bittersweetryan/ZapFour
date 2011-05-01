<?php
	session_start();
	include_once("init.php");
	include_once("foursquare.php");
	include_once("includes/dBug.php");
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
    <head>
        <title>ZapFour</title>
    </head>
    <body>
    <?php 
	// If we have not received a token, display the link for Foursquare webauth
	if($foursquare->GetAccessToken() == ""){ 
		echo "<a href='".$foursquare->AuthenticationLink()."'>Connect to this app via Foursquare</a>";
	// Otherwise display the token
	}else{
		echo "Your auth token: $token";
	}
	
	?>
    </body>
</html>