<?php

namespace modules\blog\views;

require '/home/yuta/www/_assets/includes/autoloader.php';
require_once __DIR__ .  '/../../../_assets/composer/vendor/autoload.php';

session_start();
if (!isset($_SESSION["currentUser"])) {
    header("Location: connectionPage.php");
    exit();
}
if (!$_SESSION['currentUser']->isActive()) {
    header("Location: verificationPage.php");
    exit();
}

class Settings
{
    public function show(): void
    {
        ob_start();

        $loader = new \Twig\Loader\FilesystemLoader(__DIR__ . '/../../../_assets/utils/templates');
        $twig = new \Twig\Environment($loader, ['cache' => false,]);

        $userClient = $_SESSION["currentUser"];
        echo $twig->render('Settings.html', ['user' => $userClient]);

        $content = ob_get_clean();
        (new layout('Yuta', $content))->show();
    }
}

(new Settings())->show();