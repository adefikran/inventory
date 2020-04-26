<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>INVENTORY SYSTEM | Admin</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="stylesheet" href="../style/css/bower_components/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../style/css/bower_components/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="../style/css/bower_components/Ionicons/css/ionicons.min.css">
    <link rel="stylesheet" href="../style/css/dist/css/AdminLTE.min.css">
    <link rel="stylesheet" href="../style/css/dist/css/skins/_all-skins.min.css">
    <link rel="stylesheet" href="../style/css/bower_components/morris.js/morris.css">
    <link rel="stylesheet" href="../style/css/bower_components/jvectormap/jquery-jvectormap.css">
    <link rel="stylesheet" href="../style/css/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
    <link rel="stylesheet" href="../style/css/bower_components/bootstrap-daterangepicker/daterangepicker.css">
    <link rel="stylesheet" href="../style/css/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script async='async' src='//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js'></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition skin-blue sidebar-mini">

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

<div class="wrapper">
    <header class="main-header">
        <a href="dashboard.php" class="logo">
            <span class="logo-mini"><b>D</b>M</span>
            <span class="logo-lg"><b>Inventory</b>System</span>
        </a>

        <nav class="navbar navbar-static-top">
            <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
                <span class="sr-only">Toggle navigation</span>
            </a>

            <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">
                    <li class="dropdown user user-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <span class="hidden-xs"><?php echo $_GET['nip']; ?></span>
                        </a>
                        <ul class="dropdown-menu">
                            <!-- Menu Footer-->
                            <li class="user-footer">
                                <div class="pull-right">
                                    <form action="../controller/logout.php" method="get">
                                        <input type="submit" class="btn btn-default btn-flat" value="Sign out">
                                    </form>
                                </div>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </nav>
    </header>
    <aside class="main-sidebar">
        <section class="sidebar">
            <br>
            <br>
            <!--MENU SLIDER-->
            <ul class="sidebar-menu" data-widget="tree">
                <li class="header">MAIN MENU</li>
                <li><a href="entrystok.php?nip=<?php echo $_GET['nip']; ?>"><i class="pull-right-container"></i>Fomulir Entry Stok Barang</a></li>
                <li><a href="pemesananbarang.php?nip=<?php echo $_GET['nip']; ?>"><i class="pull-right-container"></i>Formulir Pemesanan Barang</a></li>
                <li><a href="pengantaranbarang.php?nip=<?php echo $_GET['nip']; ?>"><i class="pull-right-container"></i>Formulir Pengantaran Barang</a></li>
                <li><a href="laporanstokbarang.php?nip=<?php echo $_GET['nip']; ?>"><i class="pull-right-container"></i>Laporan Stok Barang</a></li>
                <li><a href="laporanpemesananbarang.php?nip=<?php echo $_GET['nip']; ?>"><i class="pull-right-container"></i>Laporan Pemesanan Barang</a></li>
                <li><a href="laporanpengirimanbarang.php?nip=<?php echo $_GET['nip']; ?>"><i class="pull-right-container"></i>Laporan Pengiriman Barang</a></li>
            </ul>
        </section>
    </aside>

    <div class="content-wrapper">
        <section class="content-header">
            <h1>
                Fomulir Pemesanan Barang
            </h1>
        </section>
        <section class="content">
            <div class="form-group">
                <form method="post" id="insert_form">
                    <div class="table-repsonsive">
                        <span id="error"></span>
                        <table class="table table-bordered" id="item_table">
                            <thead>
                            <tr>
                                <th>Enter Item Name</th>
                                <th>Category</th>
                                <th>Sub Category</th>
                                <th><button type="button" name="add" class="btn btn-success btn-xs add"><span class="glyphicon glyphicon-plus"></span></button></th>
                            </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                        <div align="center">
                            <input type="submit" name="submit" class="btn btn-info" value="Insert" />
                        </div>
                    </div>
                </form>
            </div>
        </section>
    </div>

    <aside class="control-sidebar control-sidebar-dark">
        <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
            <li><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>
            <li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
        </ul>

    </aside>
    <div class="control-sidebar-bg"></div>
</div>

<script src="../style/css/bower_components/jquery/dist/jquery.min.js"></script>
<script src="../style/css/bower_components/jquery-ui/jquery-ui.min.js"></script>
<script>
    $.widget.bridge('uibutton', $.ui.button);
</script>
<script src="../style/css/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="../style/css/bower_components/raphael/raphael.min.js"></script>
<script src="../style/css/bower_components/morris.js/morris.min.js"></script>
<script src="../style/css/bower_components/jquery-sparkline/dist/jquery.sparkline.min.js"></script>
<script src="../style/css/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="../style/css/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<script src="../style/css/bower_components/jquery-knob/dist/jquery.knob.min.js"></script>
<script src="../style/css/bower_components/moment/min/moment.min.js"></script>
<script src="../style/css/bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
<script src="../style/css/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<script src="../style/css/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<script src="../style/css/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<script src="../style/css/bower_components/fastclick/lib/fastclick.js"></script>
<script src="../style/css/dist/js/adminlte.min.js"></script>
<script src="../style/css/dist/js/pages/dashboard.js"></script>
<script src="../style/css/dist/js/demo.js"></script>
</body>
</html>
<script>
    $(document).ready(function(){

        var count = 0;

        $(document).on('click', '.add', function(){
            count++;
            var options = '<?php echo fillBarang(); ?>';
            var html = '';
            html += '<tr>';
            html += '<td><input type="text" name="item_name[]" class="form-control item_name" /></td>';
            html += '<td><select name="item_category[]" class="form-control item_category" data-sub_category_id="'+count+'"><option value="">Select Category</option>"'+options+'"</select></td>';
            html += '<td><select name="item_sub_category[]" class="form-control item_sub_category" id="item_sub_category'+count+'"><option value="">Select Sub Category</option></select></td>';
            html += '<td><button type="button" name="remove" class="btn btn-danger btn-xs remove"><span class="glyphicon glyphicon-minus"></span></button></td>';
            $('tbody').append(html);
        });

        $(document).on('click', '.remove', function(){
            $(this).closest('tr').remove();
        });

        $(document).on('change', '.item_category', function(){
            var category_id = $(this).val();
            var sub_category_id = $(this).data('sub_category_id');
            $.ajax({
                url:"fill_sub_category.php",
                method:"POST",
                data:{category_id:category_id},
                success:function(data)
                {
                    var html = '<option value="">Select Sub Category</option>';
                    html += data;
                    $('#item_sub_category'+sub_category_id).html(html);
                }
            })
        });

        $('#insert_form').on('submit', function(event){
            event.preventDefault();
            var error = '';
            $('.item_name').each(function(){
                var count = 1;
                if($(this).val() == '')
                {
                    error += '<p>Enter Item name at '+count+' Row</p>';
                    return false;
                }
                count = count + 1;
            });

            $('.item_category').each(function(){
                var count = 1;

                if($(this).val() == '')
                {
                    error += '<p>Select Item Category at '+count+' row</p>';
                    return false;
                }

                count = count + 1;

            });

            $('.item_sub_category').each(function(){

                var count = 1;

                if($(this).val() == '')
                {
                    error += '<p>Select Item Sub category '+count+' Row</p> ';
                    return false;
                }

                count = count + 1;

            });

            var form_data = $(this).serialize();

            if(error == '')
            {
                $.ajax({
                    url:"insert.php",
                    method:"POST",
                    data:form_data,
                    success:function(data)
                    {
                        if(data == 'ok')
                        {
                            $('#item_table').find('tr:gt(0)').remove();
                            $('#error').html('<div class="alert alert-success">Item Details Saved</div>');
                        }
                    }
                });
            }
            else
            {
                $('#error').html('<div class="alert alert-danger">'+error+'</div>');
            }

        });

    });
</script>