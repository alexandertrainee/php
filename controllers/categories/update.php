<?php
    require_once("../../database.php");
    require_once("../../models/categories.php");

    $link = db_connect();
    edit_category($link, $_POST['id'], $_POST['title']);

    header('Location: show.php?id='.$_POST['id']);

