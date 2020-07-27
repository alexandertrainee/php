<?php
    require_once("../../database.php");
    require_once("../../models/posts.php");
    
    $link = db_connect();
    new_post($link, $_POST['category_id'], $_POST['title'], $_POST['text'], $_POST['date']);
    $latest_id = mysqli_insert_id($link);

    print($latest_id);
    // header('Location: show.php?id='.$latest_id);

