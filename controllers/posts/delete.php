<?php
    require_once("../../database.php");
    require_once("../../models/posts.php");
    
    $link = db_connect();
    $post = get_post($link, $_GET['id']);
    delete_post($link, $_GET['id']);

    if($post['image_name'] != NULL){
        delete_image($post['image_name']);
    }

    header('Location: ../categories/show.php?id='.$post['category_id'] . '&page=1');
