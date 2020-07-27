<?php
    require_once("../../database.php");
    require_once("../../models/posts.php");
    require_once("../../models/categories.php");
    $link = db_connect();

    $post = get_post($link, $_GET['id']);

    $category = get_category($link, $post['category_id']);

    include("../../views/posts/show.php");