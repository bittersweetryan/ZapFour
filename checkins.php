<?php 
	require_once("classes/foursquareAPI.php");
	require_once("classes/Application.php");
	require_once("includes/dBug.php");
	session_start();
?>
<!doctype html>$users
<html>
<head>
	<title>PHP-Foursquare :: Authenticated Request Example</title>
</head>
<body>
<hr />
<?php 
	// Set your client key and secret
	$client_key = $_SESSION["FS"]->getFSClientID();
	$client_secret = $_SESSION["FS"]->getFSSecret();  
	// Set your auth token, loaded using the workflow described in tokenrequest.php
	$auth_token = $_SESSION["FS"]->getFSAuthToken();
	// Load the Foursquare API library
	$foursquare = new FoursquareAPI($client_key,$client_secret);
	$foursquare->SetAccessToken($auth_token);
	
	// Perform a request to a authenticated-only resource
	$response = $foursquare->GetRecentCheckins();
	$checkins = json_decode($response);
	
	// NOTE:
	// Foursquare only allows for 500 api requests/hr for a given client (meaning the below code would be
	// a very inefficient use of your api calls on a production application). It would be a better idea in
	// this scenario to have a caching layer for user details and only request the details of users that
	// you have not yet seen. Alternatively, several client keys could be tried in a round-robin pattern 
	// to increase your allowed requests.

new dBug($checkins);	
?>
