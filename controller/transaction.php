<?php
    include 'connection.php';

    if (isset($_POST["item_category"])) {
        $nip = $_GET['nip'];
        $deliver = $_POST["deliver"];
        $sql = "INSERT INTO t_transaction (nip, created, updated, destination) VALUES ('$nip', now(), now(), '$deliver')";
        $result = pg_query($sql);

        if ($result) {
            $sql = "SELECT * FROM t_transaction ORDER BY id DESC";
            $transaction = pg_query($sql);
            $row = pg_fetch_row($transaction);

            for ($count = 0; $count < count($_POST["item_category"]); $count++) {
                $itemCategory = $_POST["item_category"][$count];
                $itemQuantity = $_POST["item_quantity"][$count];
                $itemNote = $_POST["item_note"][$count];

                $query = "INSERT INTO t_transaction_detail (transaction_id, barang_id, quantity, note) VALUES ($row[0], $itemCategory, $itemQuantity, '$itemNote')";
                $result = pg_query($query);
            }

            echo '<script>alert("Pesanan Berhasil di tambah")</script>';
            echo '<script>window.location = "../pages/pemesananbarang.php?nip=' . $nip . '";</script>';

        } else {
            echo '<script>alert("Pesanan Gagal di tambah")</script>';
            echo '<script>window.location = "../pages/pemesananbarang.php?nip=' . $nip . '";</script>';
        }
    }
?>