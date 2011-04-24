<?php
    # config.php file

    $MYSQL_USER = 'z4';
    $MYSQL_PASS = 'lemmein';
    $MYSQL_DATABASE = 'z4';
    $MYSQL_HOST = 'localhost';

    // Connect to the DB
    $sql = mysql_connect($MYSQL_HOST, $MYSQL_USER, $MYSQL_PASS);
    mysql_select_db($MYSQL_DATABASE, $sql);
    if (!$sql) {
       die('Could not connect: '. mysql_errno() . mysql_error());
    }

?>