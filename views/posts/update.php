<?php

    session_start();
    if(!isset($_SESSION['nickname'])){
        header('Location: ../../index.php?page=1');
    }

    require_once("../../database.php");
    require_once("../../models/categories.php");
    require_once("../../models/posts.php");
    $link = db_connect();
    $post = get_post($link, $_GET['id']);
    $category = get_category($link, $post['category_id']);
    $redirect_url = "../../controllers/posts/show.php?id=" . $post['id'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title id="site">My Blog</title>
</head>
    <body>
        <div >
            <a href="../../index.php?page=1">Main page</a>
            <a href="../../controllers/categories/show.php?id=<?=$category['id']?>">Back</a>
        </div><br>
        <form id="info" method="post" action="../../controllers/posts/update.php">
            <div>Category: <?=$category['title']?></div><br><br>
            <label>Title:</label><br><br>
            <input type="text" name="title" value="<?= $post['title']?>"/><br><br>
            <img src="<?= sprintf("../../img/%s", (string)$post['image_name']) ?>" id="img" width="150px" height="150px"/><br>
            <label>Post text:</label><br><br>
            <textarea name="text"><?= $post['text']?></textarea><br>
            <label>Published date:</label><br><br>
            <input type="date" name="date" value="<?= $post['date']?>"/><br><br>
            <input type="hidden" name="id" value="<?= $post['id'] ?>"/>
            <input type="submit" value="Update"/>  
            <a href="../../controllers/categories/delete.php?id=<?=$category['id']?>"><input type="button" value="Delete"/></a>
        </form>

        <form id="js-form" method="post">
            <input type="hidden" name="id" value="<?= $post['id'] ?>"/>
	        <input id="js-file" type="file" name="file">
        </form>

        <div id="result" style="display: none;"></div>

        <div id="button1">
            <button>Save form</button>
        </div>

        <footer style="text-align: center; position:fixed; bottom:0; width: 100%">
            <span style="padding-right: 10px;">&#169;</span><span id="year"></span><span style="padding-left: 10px;"id="footer"></span>
        </footer>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.3.0/jquery.form.min.js" integrity="sha384-qlmct0AOBiA2VPZkMY3+2WqkHtIQ9lSdAsAn5RUJD/3vA5MKDgSGcdmIv4ycVxyn" crossorigin="anonymous"></script>

        <script>
            $('#button1').click(function(){
                
                form1 = $('#info');
                form2 = $('#result');
                $.ajax({
                    type: "POST",
                    url: '../../controllers/posts/update.php',
                    data: form1.serialize(),
                    success: function() {
                        console.log("Post created");
                    }
                }).then(function(){
                    $('#js-form').ajaxSubmit({
                        type: 'POST',
                        url: '../../controllers/post_images/update.php',
                        target: '#result',
                        data: form2.serialize(),
                        success: function(data) {
                            console.log(data);
                            var r_url = "<?php echo $redirect_url; ?>";
                            window.location.href = r_url;
                        }
                    });
                });
            });
        </script>

        <script>
            let elem = document.getElementById('year');
            let site = document.getElementById('site');
            let footer = document.getElementById('footer');
            elem.innerHTML = new Date().getFullYear();
            footer.innerHTML = site.innerText;
        </script>
    </body>
</html>