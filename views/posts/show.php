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
                    echo "<a href='../categories/create.php'>Add category</a> ";
                    echo "<a href='../../controllers/users/logout.php'>Log out</a>";
                } else {
                    echo "<a href='../../views/users/login.php'>Log in</a>";
                }
            ?>
            
            <a href="../../controllers/categories/show.php?id=<?=$category['id']?>&page=1">Back</a><br>
        </div><br>
        <div>
            <div>Category: <?=$category['title']?></div><br><br>
            <div>Post title: <?=$post['title']?></div><br>
            <img src="<?= sprintf("../../img/%s", (string)$post['image_name']) ?>" id="img" width="150px" height="150px"/><br>
            <div>Post text: <?=$post['text']?></div><br>
            <div>Publish date: <?=$post['date']?></div><br>
        </div>

        <?php 
            if(isset($_SESSION['nickname'])){
                echo "<a href='../../views/posts/update.php?id='" . $post['id'] . "</a>" . "<input type='button' value='Edit'/></a>";
                echo "<a href='../../controllers/posts/delete.php?id='" . $post['id'] . "</a>" . "<input type='button' value='Delete'/></a>";
            }
        ?>

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