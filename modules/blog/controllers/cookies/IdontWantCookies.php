<?php

$cookie_name = "WantCookies";
$cookie_value1 = "no";
setcookie($cookie_name, $cookie_value1, time() + (86400 * 30), "/"); // 86400 = 1 day

header('Location: /modules/blog/views/connectionPage.php');
exit();