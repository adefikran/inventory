<html>
<head>
    <title>Export Data Pesanan</title>
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
header("Content-Disposition: attachment; filename=Data Pesanan.xls");
?>

<center>
    <h1>Data Pesanan</h1>
</center>

<table border="1">
    <tr>
        <th>ID Pesanan</th>
        <th>Penginput</th>
        <th>Tanggal Buat</th>
        <th>Tanggal Perbaharui</th>
        <th>Alamat Pengiriman</th>
        <th>Status</th>
        <th>Barang</th>
        <th>Jumlah</th>
        <th>Catatan</th>
    </tr>
    <?php
    include "../controller/connection.php";

    $from = $_POST['from'];
    $to = $_POST['to'];

    $sql = "SELECT * FROM t_transaction WHERE created::date BETWEEN '$from'::date AND '$to'::date";
    $result = pg_query($sql);

    while ($row = pg_fetch_row($result)) {
        $sqlDetail = "SELECT * FROM t_transaction_detail where transaction_id = $row[0]";
        $resultDetail = pg_query(@$sqlDetail);

        while($rowDetail = pg_fetch_row(@$resultDetail)) {
            $entrySql = "SELECT * FROM m_user WHERE nip = '$row[1]'";
            $entry = pg_query($entrySql);
            $rowEntry = pg_fetch_row($entry);

            $barangSql = "SELECT * FROM m_barang WHERE id = '$rowDetail[2]'";
            $resultBarang = pg_query($barangSql);
            $rowBarang = pg_fetch_row($resultBarang);

            ?>
            <tr>
                <td><?php echo $rowDetail[1]; ?></td>
                <td><?php echo $rowEntry[0] . " - " . $rowEntry[1]; ?></td>
                <td><?php echo $row[2]; ?></td>
                <td><?php echo $row[3]; ?></td>
                <td><?php echo $row[5]; ?></td>
                <td><?php echo $rowBarang[0] . " - " . $rowBarang[1]; ?></td>
                <td><?php echo $rowDetail[3]; ?></td>
                <td><?php echo $rowDetail[4]; ?></td>
            </tr>
            <?php
        }
    }

    pg_close();
    ?>
</table>
</body>
</html>
