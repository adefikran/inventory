<?php
    include 'connection.php';

    $nip = $_GET['nip'];
    $action = $_GET['action'];
    $order = $_GET['order'];

    if ($action == 1) {
        $deliveryAction = $_POST["deliver_action"];
        $deliveryKurir = $_POST["deliver_kurir"];

        $sql = "UPDATE t_transaction SET status = '$deliveryAction', updated = now() WHERE id = $order";
        $resultUpdate = pg_query($sql);

        if ($resultUpdate) {
            if ($deliveryAction == "DELIVERY") {
                $sql = "INSERT INTO t_delivery (transaction_id, created, updated, status, deliver_id, note) VALUES ($order, now(), now(), '$deliveryAction', '$deliveryKurir', '')";
                $result = pg_query($sql);

                if ($result) {
                    echo '<script>alert("Pesanan berhasil di perbaharui menjadi ' . $deliveryAction . '")</script>';
                    echo '<script>window.location = "../pages/pengantaranbarang.php?nip=' . $nip . '";</script>';
                } else {
                    echo '<script>alert("Gagal melakukan pengaturan pengantaran")</script>';
                    echo '<script>window.location = "../pages/pengantaranbarang.php?nip=' . $nip . '";</script>';
                }
            } else {
                echo '<script>alert("Pesanan berhasil di perbaharui menjadi ' . $deliveryAction . '")</script>';
                echo '<script>window.location = "../pages/pengantaranbarang.php?nip=' . $nip . '";</script>';
            }
        } else {
            echo '<script>alert("Gagal mengubah status pesanan")</script>';
            echo '<script>window.location = "../pages/pengantaranbarang.php?nip=' . $nip . '";</script>';
        }
    } else if ($action == 2) {

    }

    pg_close();
?>