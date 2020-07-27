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
        <a href="login.php">Log in</a>

        <form action="../../controllers/users/signup.php" method="post">
            <label>Nickname</label>
            <input type="text" name="nickname" placeholder="Enter your nickname"><br><br>
            <label>Password:</label>
            <input type="password" name="password" placeholder="Enter your password"><br><br>
            <label>Confirm password:</label>
            <input type="password" name="password_confirm" placeholder="Confirm your password"><br><br>
            <button type="submit">Sign Up</button>
        </form>

        <?php
            if($_SESSION['msg']){
                echo '<p>' . $_SESSION['msg'] . '</p>';
            }
            unset($_SESSION['msg']);
        ?>

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