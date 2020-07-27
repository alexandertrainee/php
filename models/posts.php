<?php 

function check_for_post_error($link, $target){
    if(!$target){
        die(mysqli_error($link));
    }
}

function show_all_posts($link, $start, $limit){
    $query = "SELECT * FROM `Posts` ORDER BY `id` DESC LIMIT $start, $limit";
    $result = mysqli_query($link, $query);

    check_for_post_error($link, $result);

    $n = mysqli_num_rows($result);
    $posts = array();

    for($i = 0; $i < $n; $i++){
        $row = mysqli_fetch_assoc($result);
        $posts[] = $row; 
    }

    return $posts;
}

function get_post($link, $post_id){
    $query = sprintf("SELECT * FROM Posts WHERE id=%d", (int)$post_id);
    $result = mysqli_query($link, $query);

    check_for_post_error($link, $result);

    $post = mysqli_fetch_assoc($result);

    return $post;
}

function new_post($link, $category_id, $post_title, $post_text, $post_date){

    $query = "INSERT INTO `Posts` (`id`, `category_id`, `title`, `text`, `date`) VALUES (NULL, '$category_id', '$post_title', '$post_text', '$post_date')";
    $result = mysqli_query($link, $query);

    check_for_post_error($link, $result);
}

function get_all_posts_from_category($link, $category_id, $start, $limit){

    $query = sprintf("SELECT * FROM Posts WHERE category_id=%d ORDER BY `id` DESC LIMIT $start, $limit", (int)$category_id);

    $result = mysqli_query($link, $query);

    check_for_post_error($link, $result);

    $n = mysqli_num_rows($result);
    $posts = array();

    for($i = 0; $i < $n; $i++){
        $row = mysqli_fetch_assoc($result);
        $posts[] = $row; 
    }

    return $posts;
}
function edit_post($link, $post_id, $post_title, $post_text, $date){
    $query = "UPDATE `Posts` SET `title` = '$post_title', `text` = '$post_text', `date` = '$date' WHERE `Posts`.`id` = $post_id";
    $result = mysqli_query($link, $query);

    check_for_post_error($link, $result);
}

function delete_post($link, $post_id){
    $query = "DELETE FROM `Posts` WHERE `Posts`.`id` = '$post_id'";
    $result = mysqli_query($link, $query);
    
    check_for_post_error($link, $result);
}

function set_image_name($link, $post_id, $image_name){
    $query = "UPDATE `Posts` SET `image_name` = '$image_name' WHERE `Posts`.`id` = $post_id";
    $result = mysqli_query($link, $query);

    check_for_post_error($link, $result);
}

function delete_image($image_name){
    $filepath =  $_SERVER['DOCUMENT_ROOT']. '/blog/img/'.$image_name;
    unlink($filepath);
}

