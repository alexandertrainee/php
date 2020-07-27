<?php
    session_start();
    unset($_SESSION['nickname']);
    header('Location: ../../index.php?page=1');