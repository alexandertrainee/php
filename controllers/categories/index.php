<?php
    require_once("../../database.php");
    require_once("../../models/categories.php");

    $link = db_connect();
    $categories = show_all_categories($link);

    include("../../views/categories/index.php");
