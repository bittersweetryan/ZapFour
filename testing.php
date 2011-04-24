<?php
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
?>