<?php
require '_assets/includes/autoloader.php';

$cookie_name = "Connected";
$cookie_value = "Corentin/FziaAFOEAsosmlsd";
setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/"); // 86400 = 1 day


if (!isset($_COOKIE[$cookie_name])) {
    echo "Cookie named '" . $cookie_name . "' is not set!";

} else {
    echo "Cookie '" . $cookie_name . "' is set!<br>";
    echo "Value is: " . $_COOKIE[$cookie_name];
}



class Homepage {
public function show(): void {
    ob_start();
?>

    <h1>Les derniers billets du blog</h1>












    <?php
    $content = ob_get_clean();
    (new \Blog\Views\Layout('Yuta', $content))->show();
    }
}
(new Homepage())->show();