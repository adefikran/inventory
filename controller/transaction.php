<?php
    include 'connection.php';

    $nip = $_GET['nip'];
    if (isset($_POST["item_category"])) {
        $pass = true;
        $stockPass = true;
        $nameStockPass = '';
        for ($count = 0; $count < count($_POST["item_category"]); $count++) {
            if ($_POST["item_category"][$count] == '') {
                $pass = false;
                break;
            }

            $idBarang = $_POST["item_category"][$count];
            $qty = $_POST["item_quantity"][$count];

            $sqlBarang = "SELECT * FROM m_barang where id = $idBarang";
            $resultBarang = pg_query($sqlBarang);
            $rowBarang = pg_fetch_row($resultBarang);
            if ($rowBarang < $qty) {
                $stockPass = false;
                $nameStockPass = $rowBarang[1];
                break;
            }
        }

        if (!$stockPass) {
            echo '<script>alert("Barang ' . $nameStockPass . ' tidak memiliki cukup stok")</script>';
            echo '<script>window.location = "../pages/pemesananbarang.php?nip=' . $nip . '";</script>';
        } else if ($pass) {
            $deliver = $_POST["deliver"];
            $sql = "INSERT INTO t_transaction (nip, created, updated, destination, status) VALUES ('$nip', now(), now(), '$deliver', 'PENDING')";
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

                    $query = "UPDATE m_barang SET stock = stock - $itemQuantity WHERE id = $itemCategory";
                    $result = pg_query($query);
                }

                echo '<script>alert("Pesanan Berhasil di tambah")</script>';
                echo '<script>window.location = "../pages/pemesananbarang.php?nip=' . $nip . '";</script>';

            } else {
                echo '<script>alert("Pesanan Gagal di tambah")</script>';
                echo '<script>window.location = "../pages/pemesananbarang.php?nip=' . $nip . '";</script>';
            }
        } else {
            echo '<script>alert("Pilih Barang terlebih dahulu")</script>';
            echo '<script>window.location = "../pages/pemesananbarang.php?nip=' . $nip . '";</script>';
        }
    } else {
        echo '<script>alert("Pesanan masih kosong")</script>';
        echo '<script>window.location = "../pages/pemesananbarang.php?nip=' . $nip . '";</script>';
    }

    pg_close();
?>