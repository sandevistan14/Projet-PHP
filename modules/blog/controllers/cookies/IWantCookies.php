<?php
$cookie_name = "WantCookies";
$cookie_value2 = "yes";
setcookie($cookie_name, $cookie_value2, time() + (86400000 * 30), "/"); // 86400 = 1 day

header('Location: /modules/blog/views/inscriptionpage.php');
exit();