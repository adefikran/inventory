<?php
    include 'connection.php';

    $name = $_POST['name'];
    $stock = $_POST['stock'];
    $nip = $_GET['nip'];

    $sql = "INSERT INTO m_barang (name, stock, created, createdby, updated, updatedby) VALUES 
            ('$name', $stock, now(), '$nip', now(), '$nip')";
    $result = pg_query($sql);

    if ($result) {
        echo '<script>alert("Entry Barang ' . $name. ' Berhasil")</script>';
        echo '<script>window.location = "../pages/entrystok.php";</script>';
    } else {
        echo '<script>alert("Entry Barang ' . $name. ' Gagal. Silahkan coba lagi.!")</script>';
        echo '<script>window.location = "../pages/entrystok.php";</script>';
    }

    pg_close();
?>