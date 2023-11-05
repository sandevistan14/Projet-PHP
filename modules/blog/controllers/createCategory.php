<?php

namespace _assets\includes;

use modules\blog\models\Administrator;

require '/home/yuta/www/_assets/includes/autoloader.php';

session_start();

//Recupération des infos du formulaire
$nameCat = $_POST["InputName"];
settype($nameCat, "string");
$descCat = $_POST["InputDesc"];
settype($descCat, "string");

//Envoie de la catégorie sur la BD
if($_SESSION['currentUser']->createCategory($nameCat,$descCat)){
    header('Location: https://yuta.alwaysdata.net/?categoryCreated=1');
    exit();
}
else {
    header('Location: https://yuta.alwaysdata.net/?categoryCreated=0');
    exit();
}
