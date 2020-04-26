<html>
<head>
    <title>INVENTORY SYSTEM | Admin</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
    <?php
    function fillBarang() {
        include '../controller/connection.php';

        $output = '';
        $sql = "SELECT * FROM m_barang";
        $result = pg_query($sql);

        while ($row = pg_fetch_row($result)) {
            $output .= '<option value="' . $row[0] . '">' . $row[1] . '</option>';
        }

        pg_close();
        return $output;
    }
    ?>

    <div class="container">
        <h3 align="center">Fomulir Pemesanan Barang</h3>
        <br />
        <form method="post" id="insert_form">
            <div class="table-responsive">
                <table class="table table-bordered" id="item_table">
                    <tr>
                        <th>Nama Barang</th>
                        <th>Quantity</th>
                        <th><button type="button" name="add" class="btn btn-success btn-sm add"><span class="glyphicon glyphicon-plus"></span></button> </th>
                    </tr>
                </table>
                <br />
                <div align="center">
                    <input type="submit" name="submit" class="btn btn-info" value="Insert" />
                </div>
            </div>
        </form>
    </div>
</body>
</html>

<script>
    $(document).ready(function () {
        $(document).on('click', '.add', function () {
            var html = '';
            html += '<tr>';
            html += '<td><select name="item_name[]" class="form-control item_name"><option value="">Pilih Barang</option><?php echo fillBarang(); ?></select></td>';
            html += '<td><input type="text" name="item_quantity[]" class="form-control item_quantity" /></td>';
            html += '<td><button type="button" name="remove" class="btn btn-danger btn-sm remove"><span class="glyphicon glyphicon-minus"></span></button></td>';
            html += '</tr>';

            $('#item_table').append(html);
        });

        $(document).on('click', '.remove', function () {
            $(this).closest('tr').remove();
        });
    });
</script>