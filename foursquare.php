<?php
	if(!array_key_exists("foursquare",$_SESSION))
		$foursquare = new FoursquareAPI($Config->getFSClientID(),$Config->getFSSecret(),$Config->getFSCallbackURI());
	else
		$foursquare = $_SESSION["foursquare"];
	
	// If the link has been clicked, and we have a supplied code, use it to request a token
	if(array_key_exists("code",$_GET)){
		$token = $foursquare->GetToken($_GET['code'],$foursquare->getCallbackURL());
		$foursquare->SetAccessToken($token);
		
		$_SESSION["foursquare"] = $foursquare;
		
		
	}
	
	if($foursquare->GetAccessToken() != ""){
		$checkins = $foursquare->GetRecentCheckins(); 
	}
	
	print_r($checkins);
?>