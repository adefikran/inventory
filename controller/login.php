<?php
    $nip = $_POST['nip'];
    $password = $_POST['password'];

    $db = pg_connect("host=ec2-52-6-143-153.compute-1.amazonaws.com port=5432 dbname=dfmdrkhqrs7bcb user=qduzbatmrhpxym password=7da9ed9d8e99236811f4f90337240dcc9c5f6bad6a622b9e4606f911b67f4b02");
    $sql = "SELECT * FROM m_user WHERE nip = 'nip' AND password = '$password'";
    echo $sql;
    $login = pg_exec($db, $sql);
    $cek = pg_numrows($login);

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