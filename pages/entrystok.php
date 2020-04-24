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
    $paramDelete = $_GET['delete'];
    $paramNip = $_GET['nip'];
    $paramName = $_GET['name'];
    if (!is_null($paramDelete)) {
        include '../controller/connection.php';

        $sql = "DELETE FROM m_barang WHERE id = $paramDelete";
        $result = pg_query($sql);

        if ($result) {
            echo '<script>alert("Hapus Barang ' . $paramName. ' Berhasil")</script>';
            echo '<script>window.location = "../pages/entrystok.php?nip=' . $paramNip .'";</script>';
        } else {
            echo '<script>alert("Hapus Barang ' . $paramName. ' Gagal. Silahkan coba lagi.!")</script>';
            echo '<script>window.location = "../pages/entrystok.php?nip=' . $paramNip .'";</script>';
        }
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
                Fomulir Entry Stok Barang
            </h1>
        </section>
        <section class="content">
            <form action="../controller/addproduct.php?nip=<?php echo $_GET['nip']; ?>" method="POST" onSubmit="return validasi()">
                <fieldset>
                    <legend></legend>
                    <p>
                        <label>Nama Barang : </label>
                        <input type="text" id="name" name="name" placeholder="Nama Barang" value="<?php echo $_GET['name']; ?>" />
                    </p>
                    <p>
                        <label>Stok : </label>
                        <input type="number" id="stock" name="stock" placeholder="Stok Barang" value="<?php echo $_GET['stock']; ?>" />
                    </p>
                    <p>
                        <input type="submit" name="submit" value="Entry" />
                    </p>
                </fieldset>
                <br>
                <div ng-controller="listController">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="box">
                                <div class="box-header">
                                    <h3 class="box-title">Daftar Barang</h3>
                                    <br/>
                                </div>
                                <div class="box-body table-responsive no-padding">
                                    <table class="table table-hover">
                                        <tr>
                                            <th>Nama Barang</th>
                                            <th>Stok</th>
                                            <th>Tanggal Buat</th>
                                            <th>Pengentry</th>
                                            <th>Tanggal Update</th>
                                            <th>Pengupdate</th>
                                            <th>Action</th>
                                        </tr>

                                        <?php
                                        include '../controller/connection.php';

                                        $sql = "SELECT * FROM m_barang";
                                        $result = pg_query($sql);

                                        while ($row = pg_fetch_row($result)) {
                                            $entrySql = "SELECT * FROM m_user WHERE nip = '$row[4]'";
                                            $entry = pg_query($entrySql);
                                            $rowEntry = pg_fetch_row($entry);

                                            ?>
                                            <tr>
                                                <td><?php echo $row[1]; ?></td>
                                                <td><?php echo $row[2]; ?></td>
                                                <td><?php echo $row[3]; ?></td>
                                                <td><?php echo $rowEntry[1]; ?></td>
                                                <td><?php echo $row[5]; ?></td>
                                                <td><?php echo $row[6]; ?></td>
                                                <td>
                                                    <a href="entrystok.php?nip=<?php echo $_GET['nip']; ?>&update=<?php echo $row[0]; ?>&name=<?php echo $row[1]; ?>&stock=<?php echo $row[2]; ?>">Perbaharui</a>
                                                    &nbsp;&nbsp;
                                                    <a href="entrystok.php?nip=<?php echo $_GET['nip']; ?>&delete=<?php echo $row[0]; ?>&name=<?php echo $row[1]; ?>">Hapus</a>
                                                </td>
                                            </tr>
                                            <?php
                                        }

                                        pg_close();
                                        ?>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
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

<script type="text/javascript">
    function validasi() {
        var name = document.getElementById("name").value;
        var stock = document.getElementById("stock").value;
        if (name != "" && stock!="") {
            return true;
        }else{
            alert('Nama Barang dan Stok harus di isi !');
            return false;
        }
    }
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
