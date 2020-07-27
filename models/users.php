<?php

function check_for_user_error($link, $target){
    if(!$target){
        die(mysqli_error($link));
    }
}

function create_user($link, $nickname, $password){
    $password = md5($password);
    $query = "INSERT INTO `Users` (`id`, `nickname`, `password`) VALUES (NULL, '$nickname', '$password')";
    $result = mysqli_query($link, $query);
    check_for_user_error($link, $result);
}

function check_user($link, $nickname, $password){
    $password = md5($password);
    $query = "SELECT * FROM Users WHERE `nickname` = '$nickname' AND `password` = '$password'";
    $result = mysqli_query($link, $query);

    $rows = mysqli_num_rows($result);

    return $rows;
}





