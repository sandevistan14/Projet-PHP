<?php

if (!isset($_COOKIE["Connected"])) {
        header('Location: /modules/blog/views/inscriptionpage.php');
        exit();

} else {
    header('Location: /modules/blog/views/homepage.php');
    exit();
}




