<?php
	session_start();
	include_once("init.php");
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