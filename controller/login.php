<?php
    include 'connection.php';

    $nip = $_POST['nip'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM m_user WHERE nip = '$nip' AND password = '$password'";
    $login = pg_query($sql);
    $row = pg_fetch_row($login);
    $cek = pg_numrows($login);

    if ($cek > 0) {
        session_start();
        $_SESSION['username'] = $nip;
        $_SESSION['name'] = $row[1];
        $_SESSION['status'] = "login";

        header("location:../pages/dashboard.php");
    } else {
        header("location:../index.php");

        echo '<script language="javascript" type="text/javascript"> 
                alert("NIP dan Password tidak valid");
                window.location = "../index.php";
        </script>';
    }
?>