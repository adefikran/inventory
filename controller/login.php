<?php
    include 'connection.php';

    $nip = $_POST['nip'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM m_user WHERE nip = '$nip' AND password = '$password'";
    $login = pg_query($sql);
    $cek = pg_numrows($login);

    if($cek > 0){
        session_start();
        $_SESSION['username'] = $nip;
        $_SESSION['name'] = $login[1];
        $_SESSION['status'] = "login";

        echo '<script language="javascript">';
        echo 'alert("' . $login . '")';
        echo '</script>';

        header("location:../pages/dashboard.php");
    }else{
        echo '<script language="javascript">';
        echo 'alert("NIP dan Password tidak valid")';
        echo '</script>';
        header("location:../index.php");
    }
?>