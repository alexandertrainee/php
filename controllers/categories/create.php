<?php

    require_once("../../database.php");
    require_once("../../models/categories.php");
    
    $link = db_connect();
    new_category($link, $_POST['title']);
    $latest_id = mysqli_insert_id($link);

    header('Location: show.php?id='.$latest_id . '&page=1');
