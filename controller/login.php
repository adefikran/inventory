<?php
    include 'connection.php';

    $nip = $_POST['nip'];
    $password = $_POST['password'];

    $login = pg_query("SELECT * FROM m_user WHERE nip = 'nip' AND password = '$password'");
    $cek = pg_num_rows($login);

    if($cek > 0){
        session_start();
        $_SESSION['username'] = $nip;
        $_SESSION['name'] = $login[1];
        $_SESSION['status'] = "login";
        header("location:../pages/dashboard.php");
    }else{
        header("location:../index.php");
    }
?>