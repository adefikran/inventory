<html>
<head>
    <title>Export Data Pengiriman</title>
</head>
<body>
<style type="text/css">
    body{
        font-family: sans-serif;
    }
    table{
        margin: 20px auto;
        border-collapse: collapse;
    }
    table th,
    table td{
        border: 1px solid #3c3c3c;
        padding: 3px 8px;

    }
    a{
        background: blue;
        color: #fff;
        padding: 8px 10px;
        text-decoration: none;
        border-radius: 2px;
    }
</style>

<?php
header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=Data Pengiriman.xls");
?>

<center>
    <h1>Data Pengiriman</h1>
</center>

<table border="1">
    <tr>
        <th>ID Pesanan</th>
        <th>Tanggal Buat</th>
        <th>Tanggal Perbaharui</th>
        <th>Status</th>
        <th>Catatan</th>
        <th>Kurir</th>
    </tr>
    <?php
    include "../controller/connection.php";

    $from = $_POST['from'];
    $to = $_POST['to'];

    $sql = "SELECT * FROM t_delivery WHERE updated::date BETWEEN '$from'::date AND '$to'::date";
    $result = pg_query($sql);

    while ($row = pg_fetch_row($result)) {
        $entryKurir = "SELECT * FROM m_deliver WHERE nip = '$row[6]'";
        $entry = pg_query($entryKurir);
        $rowKurir = pg_fetch_row($entry);

        ?>
        <tr>
            <td><?php echo $row[1]; ?></td>
            <td><?php echo $row[2]; ?></td>
            <td><?php echo $row[3]; ?></td>
            <td><?php echo $row[4]; ?></td>
            <td><?php echo $row[5]; ?></td>
            <td><?php echo $row[6] . " - " . $rowKurir[1]; ?></td>
        </tr>
        <?php
    }

    pg_close();
    ?>
</table>
</body>
</html>
