<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title id="site">My Blog</title>
    </head>
    <body>
        <div>
            <a href="../../index.php?page=1">Main page</a>
            <?php 
                if(isset($_SESSION['nickname'])){
                    echo "<a href='create.php'>Add category</a> ";
                    echo "<a href='../../views/posts/create.php?id='" . $category['id'] . ">Add post to category </a>";
                    echo "<a href='../../controllers/users/logout.php'>Log out</a>";
                } else {
                    echo "<a href='../../views/users/login.php'>Log in</a>";
                }
            ?>
        </div><br>

        <div>Category: <?=$category['title']?></div><br>

        <?php 
            if(isset($_SESSION['nickname'])){
                echo "<a href='../../views/categories/update.php?id='" . $category['id'] . "</a>" . "<input type='button' value='Edit'/></a>";
                echo "<a href='../../controllers/categories/delete.php?id='" . $category['id'] . "</a>" . "<input type='button' value='Delete'/></a>";
            }
        ?>

        <?php foreach($posts as $p): ?>
            <hr>
                <div>Post title: <?=$p['title']?></div><br>
                <div>Post date: <?=$p['date']?></div><br>
                <a href="../../controllers/posts/show.php?id=<?=$p['id']?>"><input type="button" value="Read more"/></a>
        <?php endforeach ?><br><br>
        <span>Pagination:</span>
        <?php
            if ($currentpage != 1) $pervpage = '<a href= ./show.php?id='. $category['id'] .'&page=1><<</a>
                <a href= ./show.php?id='. $category['id'] .'&page='. ($currentpage - 1) .'><</a> ';

            if ($currentpage != $total_pages) $nextpage = ' <a href= ./show.php?id='. $category['id'] .'&page='. ($currentpage + 1) .'>></a>
                                            <a href= ./show.php?id='. $category['id'] .'&page=' .$total_pages. '>>></a>';

            if($currentpage - 2 > 0) $page2left = ' <a href= ./show.php?id='. $category['id'] .'&page='. ($currentpage - 2) .'>'. ($currentpage - 2) .'</a> | ';
            if($currentpage - 1 > 0) $page1left = '<a href= ./show.php?id='. $category['id'] .'&page='. ($currentpage - 1) .'>'. ($currentpage - 1) .'</a> | ';
            if($currentpage + 2 <= $total_pages) $page2right = ' | <a href= ./show.php?id='. $category['id'] .'&page='. ($currentpage + 2) .'>'. ($currentpage + 2) .'</a>';
            if($currentpage + 1 <= $total_pages) $page1right = ' | <a href= ./show.php?id='. $category['id'] .'&page='. ($currentpage + 1) .'>'. ($currentpage + 1) .'</a>';

            echo $pervpage.$page2left.$page1left.'<b>'.$currentpage.'</b>'.$page1right.$page2right.$nextpage;

        ?>
        <br><br>

        <footer style="text-align: center; position:fixed; bottom:0; width: 100%">
            <span style="padding-right: 10px;">&#169;</span><span id="year"></span><span style="padding-left: 10px;"id="footer"></span>
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