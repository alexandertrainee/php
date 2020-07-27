<?php
    session_start();

    if(isset($_SESSION['nickname'])){
        header('Location: ../../index.php?page=1');
    }

    require_once("../../database.php");
    require_once("../../models/users.php");
    
    
    $nickname = $_POST['nickname'];
    $password = $_POST['password'];
    $link = db_connect();

    if(check_user($link, $nickname, $password)){

        $_SESSION['nickname'] = $nickname;
        $_SESSION['signup_succcess'] = "Success sign in";

        header('Location: ../../index.php?page=1');

    } else {
        $_SESSION['msg'] = "Wrong password or login";
        header('Location: ../../views/users/login.php');
    }
