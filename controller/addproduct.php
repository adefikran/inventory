<?php
    include 'connection.php';

    $name = $_POST['name'];
    $stock = $_POST['stock'];
    $nip = $_GET['nip'];

    $update = $_GET['update'];
    if (!is_null($update)) {
        $sql = "UPDATE m_barang set name = '$name', stock = $stock WHERE id = $update";
        $result = pg_query($sql);

        if ($result) {
            echo '<script>alert("Perbaharui Barang ' . $name. ' Berhasil")</script>';
            echo '<script>window.location = "../pages/entrystok.php?nip=' . $nip . '";</script>';
        } else {
            echo '<script>alert("Perbaharui Barang ' . $name. ' Gagal. Silahkan coba lagi.!")</script>';
            echo '<script>window.location = "../pages/entrystok.php?nip=' . $nip . '";</script>';
        }
    } else {
        $sql = "INSERT INTO m_barang (name, stock, created, createdby, updated, updatedby) VALUES 
            ('$name', $stock, now(), '$nip', now(), '$nip')";
        $result = pg_query($sql);

        if ($result) {
            echo '<script>alert("Entry Barang ' . $name. ' Berhasil")</script>';
            echo '<script>window.location = "../pages/entrystok.php?nip=' . $nip . '";</script>';
        } else {
            echo '<script>alert("Entry Barang ' . $name. ' Gagal. Silahkan coba lagi.!")</script>';
            echo '<script>window.location = "../pages/entrystok.php?nip=' . $nip . '";</script>';
        }
    }

    pg_close();
?>