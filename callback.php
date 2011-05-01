<?
	require_once("classes/Application.php");
	session_start();
	
	
	
	
	
	$_SESSION["FS"]->setFSAuthToken($_GET["code"]);
?>



<?=$_SESSION["FS"]->getFSAuthToken()?>