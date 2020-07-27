<?php
    session_start();

    if(isset($_SESSION['nickname'])){
        header('Location: ../../index.php?page=1');
    }
    
    require_once("../../database.php");
    require_once("../../models/users.php");
    
    
    $nickname = $_POST['nickname'];
    $password = $_POST['password'];
    $password_confirm = $_POST['password_confirm'];

    if($password === $password_confirm){
        $link = db_connect();
        create_user($link, $nickname, $password);

        $_SESSION['signup_succcess'] = "Success registration";
        header('Location: ../../views/users/login.php');

    } else {
        $_SESSION['msg'] = "Password mismatch";
        header('Location: ../../views/users/signup.php');
    }
