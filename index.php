<?php

if (!isset($_COOKIE["Connected"])) {
        header('Location: /modules/blog/views/connectionPage.php');
        exit();

} else {
    header('Location: /modules/blog/views/homePage.php');
    exit();
}




