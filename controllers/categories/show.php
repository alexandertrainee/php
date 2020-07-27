<?php
    require_once("../../database.php");
    require_once("../../models/categories.php");
    require_once("../../models/posts.php");

    $link = db_connect();
    $category = get_category($link, $_GET['id']);

    $limit = 5;
    $total = mysqli_query($link, "SELECT COUNT(*) FROM Posts ");
    $total = mysqli_fetch_row($total);
    $total_pages = ceil($total[0]/ $limit);
    printf($pages);

    if (isset($_GET['page']) && is_numeric($_GET['page'])) {
        $currentpage = (int) $_GET['page'];
     } else {
        $currentpage = 1;
     } 

     if ($currentpage > $total_pages) {
        $currentpage = $total_pages;
     }
     if ($currentpage < 1) {
        $currentpage = 1;
     }

     $start = $currentpage * $limit - $limit;

     $posts = get_all_posts_from_category($link, $_GET['id'], $start, $limit);

    include("../../views/categories/show.php");
