<?php
    include 'connection.php';

    $number = count($_POST["name"]);
    if ($number > 0) {
        for ($i = 0; $i < $number; $i++) {
            if (trim($_POST["name"][$i]) != '') {
                $sql = "INSERT INTO detail barang";
                pg_query;
            }
        }

        echo 'Data Inserted';
    } else {
        echo "Enter Name";
    }
?>