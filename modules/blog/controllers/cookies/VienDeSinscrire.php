<?php
$cookie_name = "Connected";
$cookie_value2 = "yes";
setcookie($cookie_name, $cookie_value2, time() + (86400000 * 30), "/"); // 86400 = 1 day

header('Location: /index.php');
exit();