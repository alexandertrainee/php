<?php
    require_once("../../database.php");
    require_once("../../models/categories.php");
    
    $link = db_connect();
    delete_category($link, $_GET['id']);

    header('Location: index.php');
