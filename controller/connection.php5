<?php
    $host = "ec2-52-6-143-153.compute-1.amazonaws.com";
    $dbName = "dfmdrkhqrs7bcb";
    $user = "qduzbatmrhpxym";
    $password = "7da9ed9d8e99236811f4f90337240dcc9c5f6bad6a622b9e4606f911b67f4b02";
    $db = pg_connect("host=$host port=5432 dbname=$dbName user=$user password=$password");
?>