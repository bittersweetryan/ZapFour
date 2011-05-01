<?PHP
define("TIMEOUT", 2000);
define("WEBPATH", "/var/www/ryan.lootcouncil.com");
//display errors to the browse, make development life easier.
error_reporting(E_ALL); ini_set("display_errors", 1);
//check for existance of requried modules
if ( !function_exists('curl_init') ) die("Required CURL module not installed.  Cannot fetch weather data.");

//autoload classes, make life easer!
spl_autoload_register(function ($className) {
       require_once WEBPATH.DIRECTORY_SEPARATOR.'classes'.DIRECTORY_SEPARATOR.$className.'.php';
}); 
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
    <head>
        <title>FUN</title>
    </head>
    <body>
        <?PHP
        $forecast = new forecast(53189);
        ?>
    </body>
</html>