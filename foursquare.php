<?php
$FSQ = new FoursquareAPI($Config->getFSClientID(),$Config->getFSSecret());

if(array_key_exists("code",$_GET)){
		$token = $foursquare->GetToken($_GET['code'],$_SESSION["FS"]->getFSCallbackURI());
		$_SESSION["FS"]->setFSAuthToken($token);
}

?>