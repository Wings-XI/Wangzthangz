<?php
    set_time_limit(0);

    $mysqli = new mysqli("localhost","website","5?i}d#nN.G5-","wings");
    $query = "SELECT itemId FROM item_equipment WHERE itemId = 28671 ORDER BY itemId";
    if ($result = $mysqli -> query( $query )) {
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $source_url  = 'https://static.ffxiah.com/images/icon/' . $row['itemId'] . '.png';
                $destination = $row['itemId'] . '.png';
                if ( file_exists( $destination ) ) {
                    continue;
                }
                echo $source_url . ' => ' . $destination;
                echo '<br>';
                copy($source_url, $destination);
                sleep(1);
            }
        }
    }
?>