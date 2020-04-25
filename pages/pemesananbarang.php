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
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition skin-blue sidebar-mini">

<?php
    include '../controller/connection.php';

    $itemsId = array();
    $itemsName = array();

    $sql = "SELECT * FROM m_barang";
    $result = pg_query($sql);

    while ($row = pg_fetch_row($result)) {
        array_push($itemsId, $row[0]);
        array_push($itemsName, $row[1]);
    }

    pg_close();
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
                <form action="" method="POST" onSubmit="return validasi()" id="add_name">
                    <table class="table table-bordered" id="dynamic_field">
                        <tr>
                            <td>
                                <select name="name[]" id="name" class="form-control name-list">
                                    <?php
                                        for ($i = 0; $i < count($itemsId); $i++) {
                                            ?>
                                            <option value="<?php echo $itemsId[$i]; ?>"><?php $itemsName[$i]; ?></option>
                                            <?php
                                        }
                                    ?>
                                </select>
                            </td>
                            <td><button type="button" name="add" id="add" class="btn btn-success">Add More</button></td>
                        </tr>
                    </table>
                    <input type="button" name="submit" id="submit" value="Submit">
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

<script>
    $(document).ready(function () {
        var i = 1;
        $('#add').click(function () {
            i++;
            var phpText0 = "<?php for ($i = 0; $i < count($itemsId); $i++) {?>";
            var phpText1 = "<?php echo $itemsId[$i]; ?>";
            var phpText3 = "<?php $itemsName[$i]; ?>";
            var phpText4 = "<?php}?>";
//            $('#dynamic_field').append('<tr id="row'+i+'"><td><input type="text" name="name[]" id="name" placeholder="Enter Name" class="form-control name-list"></td><td><button name="remove" id="'+i+'" class="btn btn-danger btn_remove">X</button></td></tr>');
            $('#dynamic_field').append('<tr id="row'+i+'"> <td> <select name="name[]" id="name" class="form-control name-list">'+phpText0+'"<option value="'+phpText1+'">'+phpText3+'"</option>"'+phpText4+'"</select></td><td><button name="remove" id="'+i+'" class="btn btn-danger btn_remove">X</button></td> </tr>');
        });

        $(document).on('click', '.btn_remove', function () {
            var button_id = $(this).attr("id");
            $('#row'+button_id+'').remove();
        });

        $('#submit').click(function () {
            $.ajax({
                url:"../controller/name.php",
                method:"POST",
                data:$('#add_name').serialize(),
                success:function (data) {
                    alert(data);
                    $('#add_name')[0].reset();
                }
            });
        });
    });
</script>

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
