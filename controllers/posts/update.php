<?php
    require_once("../../database.php");
    require_once("../../models/posts.php");

    $link = db_connect();
    edit_post($link, $_POST['id'], $_POST['title'], $_POST['text'], $_POST['date']);
    print($_POST['id']);
    // header('Location: show.php?id='.$_POST['id']);

