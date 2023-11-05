<?php
namespace _assets\includes;


require '/home/yuta/www/_assets/includes/autoloader.php';

session_start();

if ($_POST["SelectCategorieModif"]!=0 && $_SESSION['currentUser']->isAdmin()){
    if(isset($_POST['InputModifName'])){
        $_SESSION['currentUser']->ModifyCategoryName($_POST["SelectCategorieModif"], $_POST['InputModifName']);
    }
    if(isset($_POST['InputModifDesc'])){
        $_SESSION['currentUser']->ModifyCategoryDescription($_POST["SelectCategorieModif"], $_POST['InputModifDesc']);
    }
    //renvoie sur l'index
    header('Location: https://yuta.alwaysdata.net/');
    exit();
}
else{
    header('Location: https://yuta.alwaysdata.net/');
    exit();
}
