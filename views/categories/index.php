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
                    echo "<a href='../../controllers/users/logout.php'>Log out</a>";
                } else {
                    echo "<a href='../../views/users/login.php'>Log in</a>";
                }
            ?>
        </div><br>
        <div>
            <?php foreach($categories as $c): ?>
                <hr style="width: 300px; float:left;"><br>
                <div><a href="../../controllers/categories/show.php?id=<?=$c['id']?>&page=1">Category: <?=$c['title']?></a></div>
            <?php endforeach ?>
        </div>

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