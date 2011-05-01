<?PHP
define("TIMEOUT", 2000);

//display errors to the browse, make development life easier.
error_reporting(E_ALL); ini_set("display_errors", 1);

//check for existance of requried modules
if ( !function_exists('curl_init') ) die("Required CURL module not installed.  Cannot fetch weather data.");
//define("WEBPATH","/var/www/ryan.lootcouncil.com/");
//define("WEBPATH","/home/ryan/htdocs/z4/");
define("WEBPATH","C:\\xampp\htdocs\z4");
//autoload classes, make life easer!
spl_autoload_register(function ($className) {
       require_once WEBPATH.DIRECTORY_SEPARATOR.'classes'.DIRECTORY_SEPARATOR.$className.'.php';});
	  
$Config = new Config();
?>