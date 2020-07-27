<?php 

function check_for_error($link, $target){
    if(!$target){
        die(mysqli_error($link));
    }
}

function show_all_categories($link){
    $query = "SELECT * FROM Categories ORDER BY id DESC";
    $result = mysqli_query($link, $query);

    check_for_error($link, $result);

    $n = mysqli_num_rows($result);
    $categories = array();

    for($i = 0; $i < $n; $i++){
        $row = mysqli_fetch_assoc($result);
        $categories[] = $row; 
    }

    return $categories;
}

function get_category($link, $category_id){
    $query = sprintf("SELECT * FROM Categories WHERE id=%d", (int)$category_id);
    $result = mysqli_query($link, $query);

    check_for_error($link, $result);

    $category = mysqli_fetch_assoc($result);

    return $category;
}

function new_category($link, $category_title){
    $query = "INSERT INTO `Categories` (`id`, `title`) VALUES (NULL, '$category_title')";
    $result = mysqli_query($link, $query);

    check_for_error($link, $result);
}

function edit_category($link, $category_id, $category_title){
    $query = "UPDATE `Categories` SET `title` = '$category_title' WHERE `Categories`.`id` = '$category_id'";
    $result = mysqli_query($link, $query);

    check_for_error($link, $result);
}

function delete_category($link, $category_id){
    $query = "DELETE FROM `Categories` WHERE `Categories`.`id` = '$category_id'";
    $result = mysqli_query($link, $query);
    check_for_error($link, $result);
    $query = "DELETE FROM `Posts` WHERE `Posts`.`category_id` = '$category_id'";
    $result = mysqli_query($link, $query);
    check_for_error($link, $result);
}

