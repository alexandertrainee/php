<?php

    session_start();
    if(!isset($_SESSION['nickname'])){
        header('Location: ../../index.php?page=1');
    }

    require_once("../../database.php");
    require_once("../../models/categories.php");

    $link = db_connect();
    $category = get_category($link, $_GET['id']);

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
        <a href="../../controllers/categories/show.php?id=<?=$category['id']?>">Back</a>
    </div><br>
    <label>Add post:</label><br><br>
    <form id="info" method="post" action="../../controllers/posts/create.php">
        <label>Title:</label><br><br>
        <input type="text" name="title" value=""/><br><br>
        <label>Text:</label><br><br>
        <textarea name="text"></textarea><br><br>
        <label>
            <span>Publish date:</span>
            <input type="date" name="date" value=""/>
            <input type="hidden" name="category_id" value="<?= $category['id'] ?>"/>
        </label>
    </form>

    <form id="js-form" method="post">
	    <input id="js-file" type="file" name="file">
    </form>

    <div id="result" style="display: none;"></div>

    <div id="button1">
        <button>Send form</button>
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
                url: '../../controllers/posts/create.php',
                data: form1.serialize(),
                success: function() {
                    console.log("Post created");
                }
            }).then(function(){
                $('#js-form').ajaxSubmit({
                        type: 'POST',
                        url: '../../controllers/post_images/create.php',
                        target: '#result',
                        data: form2.serialize(),
                        success: function(data) {
                            if(Number.isInteger(Number(data))){
                                window.location.href = "../../controllers/posts/show.php?id=" + data;
                            } else {
                                $.ajax({
                                    type: "GET",
                                    url: '../../controllers/post_images/error.php',
                                    success: function() {
                                        console.log("Post deleted");
                                    }
                                })
                            }
                        }
                });
            });
        });

    </script>

    <script>
        var dateControl = document.querySelector('input[type="date"]');
        var time = new Date();
        var year = time.getFullYear();
        var month = time.getMonth();
        var day = time.getDate();

        month < 10 ? month = '0' + month : 0;
        day < 10 ? day = '0' + day : 0;

        dateControl.value = time.getFullYear() + '-' + month + '-' + day;

        let elem = document.getElementById('year');
        let site = document.getElementById('site');
        let footer = document.getElementById('footer');
        elem.innerHTML = new Date().getFullYear();
        footer.innerHTML = site.innerText;
    </script>

</body>
</html>