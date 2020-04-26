<?php
    include 'connection.php';

    if (isset($_POST["item_category"])) {
        $nip = $_GET['nip'];
        $sql = "INSERT INTO t_transaction (nip, created, updated, destination) VALUES ('$nip', now(), now(), '')";
        $result = pg_query($query);

        if ($result) {
            $sql = "SELECT * FROM t_transaction ORDER BY id DESC";
            $transaction = pg_query($sql);
            $row = pg_fetch_row($login);

            for ($count = 0; $count < count($_POST["item_category"]); $count++) {
                $data = array(
                    ':item_category'    => $_POST["item_category"],
                    ':item_quantity'    => $_POST["item_quantity"],
                    ':item_note'        => $_POST["item_note"]
                );

                $query = "INSERT INTO t_transaction_detail (transaction_id, barang_id, quantity, note) VALUES ($row[0], :item_category, :item_quantity, :item_note)";
                $result = pg_query($query);
            }

            echo 'ok';
        }
    }
?>