<?PHP

require_once("classes/Config.class.php");
require_once("classes/FoursquareAPI.class.php");

	define("WEBPATH","/home/ryan/htdocs/z4");

$Config = new Config();
$FSQ = new FoursquareAPI($Config->getFSClientID(),$Config->getFSSecret());

if(array_key_exists("code",$_GET)){
		$token = $foursquare->GetToken($_GET['code'],$_SESSION["FS"]->getFSCallbackURI());
		$_SESSION["FS"]->setFSAuthToken($token);
}

define("TIMEOUT", 2000);

//display errors to the browse, make development life easier.
error_reporting(E_ALL); ini_set("display_errors", 1);

//check for existance of requried modules
if ( !function_exists('curl_init') ) die("Required CURL module not installed.  Cannot fetch weather data.");

//autoload classes, make life easer!
spl_autoload_register(function ($className) {
       require_once WEBPATH.DIRECTORY_SEPARATOR.'classes'.DIRECTORY_SEPARATOR.$className.'.php';
}); 
?>