<?php
/*
    # sample4b.php file
    # retrieving and displaying multiple record

    include_once('includes/config.php');
    include_once('includes/query.php');

    $selectQuery = 'SELECT * FROM `sample_table` WHERE `date` < NOW()';

    $result = new Query($selectQuery,$sql);
    if($result->Error()) echo $result->Error();
    else {
        // print our results
        echo "<table><tr><th>id</th><th>name</th><th>date</th></tr>";
        while($row = $result->FetchAssoc()){
            echo "<tr>";
            echo "<td>" . $row['id'] . "<td>\n";
            echo "<td>" . $row['name'] . "<td>\n";
            echo "<td>" . $row['date'] . "<td>\n";
            echo "</tr>";
        }
        echo "</table>";
        $result->Free();
        unset($row);
    }

    $result->Close($sql);
 */
?>

<?php

require_once 'includes/foursquare.php';          //loading the class
$fq = new fourSquare("ryan.anklam@gmail.com", "Dyn0mite");  //fetching the check-in data
include_once('includes/dBug.php');
//new dBug($myVariable);

new dBug($fq);
?>


<div id="foursquare" style="text-align:center">
    <h2>Last known location:</h2>

    <!--displaying the foursquare logo for the venue type-->
    <img src="<?=$fq->venueIcon?>" />

    <!--displaying the venue name and the venue type-->
    <?=$fq->venueName?> (<?=$fq->venueType?>)<br>

    <!--Displaying the map-->
    <img src="<?=$fq->getMapUrl(150, 150)?>" /><br/>

    <!-- displaying the user comment-->
    "<i><?=$fq->comment?></i>"<br>
</div>
