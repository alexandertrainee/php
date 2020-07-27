<?php
    session_start();
    require_once("database.php");
    require_once("models/posts.php");
    $link = db_connect();
    // $posts = show_all_posts($link);

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

     $posts = show_all_posts($link, $start, $limit);
     
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
        <title id="site">My Blog</title>
    </head>
    <body>
        <header>
            <img src="img/logo.png" alt="logo" style="width:100px; height: 50px;"/>
            <a href="controllers/categories/index.php">List of categories</a>
            <?php 
                if(isset($_SESSION['nickname'])){
                    echo "<a href='views/categories/create.php'>Add category</a> ";
                    echo "<a href='controllers/users/logout.php'>Log out</a>";
                } else {
                    echo "<a href='views/users/login.php'>Log in</a>";
                }
            ?>
        </header>

        <?php foreach($posts as $p): ?>
        <hr>
            <div>Post title: <?=$p['title']?></div><br>
            <div>Post date: <?=$p['date']?></div><br>
            <a href="controllers/posts/show.php?id=<?=$p['id']?>"><input type="button" value="Read more"/></a>
            <?php 
                if(isset($_SESSION['nickname'])){
                    echo "<a href='views/posts/update.php?id='" . $p['id'] . "</a>" . "<input type='button' value='Edit'/></a>";
                }
            ?>
        <?php endforeach ?><br><br>
        Pagination:
        <?php
            if ($currentpage != 1) $pervpage = '<a href= ./index.php?page=1><<</a>
                <a href= ./index.php?page='. ($currentpage - 1) .'><</a> ';

            if ($currentpage != $total_pages) $nextpage = ' <a href= ./index.php?page='. ($currentpage + 1) .'>></a>
                                            <a href= ./index.php?page=' .$total_pages. '>>></a>';

            if($currentpage - 2 > 0) $page2left = ' <a href= ./index.php?page='. ($currentpage - 2) .'>'. ($currentpage - 2) .'</a> | ';
            if($currentpage - 1 > 0) $page1left = '<a href= ./index.php?page='. ($currentpage - 1) .'>'. ($currentpage - 1) .'</a> | ';
            if($currentpage + 2 <= $total_pages) $page2right = ' | <a href= ./index.php?page='. ($currentpage + 2) .'>'. ($currentpage + 2) .'</a>';
            if($currentpage + 1 <= $total_pages) $page1right = ' | <a href= ./index.php?page='. ($currentpage + 1) .'>'. ($currentpage + 1) .'</a>';

            echo $pervpage.$page2left.$page1left.'<b>'.$currentpage.'</b>'.$page1right.$page2right.$nextpage;

        ?>
        <br><br>

        <footer style="text-align: center; position:fixed; bottom:0; width: 100%">
            <span style="padding-right: 10px; ">&#169;</span><span id="year"></span><span style="padding-left: 10px;"id="footer"></span>
        </footer>

        <script>
            let elem = document.getElementById('year');
            let site = document.getElementById('site');
            let footer = document.getElementById('footer');
            elem.innerHTML = new Date().getFullYear();
            footer.innerHTML = site.innerText;
        </script>
    </body>
</html>