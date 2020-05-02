<html>
<head>
    <title>Export Data Barang</title>
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
header("Content-Disposition: attachment; filename=Data Barang.xls");
?>

<center>
    <h1>Data Barang</h1>
</center>

<table border="1">
    <tr>
        <th>Nama</th>
        <th>Stok</th>
        <th>Tanggal Buat</th>
        <th>Penginput</th>
        <th>Tanggal Perbaharui</th>
        <th>Pembaharui</th>
    </tr>
    <?php
    include "../controller/connection.php";

    $from = $_POST['from'];
    $to = $_POST['to'];

    $sql = "SELECT * FROM m_barang WHERE updated::date BETWEEN '$from'::date AND '$to'::date";
    $result = pg_query($sql);

    while ($row = pg_fetch_row($result)) {
        ?>
        <tr>
            <td><?php echo $row[1]; ?></td>
            <td><?php echo $row[2]; ?></td>
            <td><?php echo $row[3]; ?></td>
            <td><?php echo $row[4]; ?></td>
            <td><?php echo $row[5]; ?></td>
            <td><?php echo $row[6]; ?></td>
        </tr>
        <?php
    }

    pg_close();
    ?>
</table>
</body>
</html>
