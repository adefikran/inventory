<?php
    include 'connection.php';

    $name = $_POST['name'];
    $stock = $_POST['stock'];

    $sql = "INSERT INTO m_barang (name, stock, created, createdby, updated updatedby) VALUES 
            ('$name', $stock, now(), '11111', now(), '11111')";
    $result = pg_query($sql);
    $cmdtuples = pg_affected_rows($result);

    if ($cmdtuples > 0) {
        echo '<script>alert("Entry Barang ' . $name. ' Berhasil")</script>';
        echo '<script>window.location = "../pages/entrystok.php";</script>';
    }

    pg_close();
?>