<?php
    require_once("../../database.php");
    require_once("../../models/posts.php");
    
    $link = db_connect();
    $query = "SELECT * FROM Posts WHERE id = (SELECT MAX(id) from Posts)";
    $post = mysqli_query($link, $query);
	$post = mysqli_fetch_assoc($post);

    delete_post($link, $post['id']);

    if($post['image_name'] != NULL){
        delete_image($post['image_name']);
    }
