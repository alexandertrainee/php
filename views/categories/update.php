<?php

    session_start();
    if(!isset($_SESSION['nickname'])){
        header('Location: ../../index.php?page=1');
    }

    require_once("../../database.php");
    $link = db_connect();
    $category_id = $_GET['id'];
    $query = "SELECT * FROM `Categories` WHERE `id` = '$category_id'";
    $category = mysqli_query($link, $query);
    $category = mysqli_fetch_assoc($category);
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
        </div><br>
        <form method="post" action="../../controllers/categories/update.php">
            <label>
                Title:
                <input type="text" name="title" value="<?= $category['title']?>"/>
                <input type="hidden" name="id" value="<?= $category['id'] ?>"/>
            </label>
            <input type="submit" value="Update"/>
        </form>
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