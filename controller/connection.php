<?php
    $host = "ec2-52-71-85-210.compute-1.amazonaws.com";
    $dbName = "d5l18akars5l61";
    $user = "ikuhvmvgepghtr";
    $password = "fec0a5e874cdd16f36a1c56c3450dfeb876c8e63f2999589ea195d42e0994a2d";
    $db = pg_connect("host=$host port=5432 dbname=$dbName user=$user password=$password");
    echo "<script>console.log('Connection DB " . $dbName . " Success' );</script>";
?>