<?php
namespace _assets\includes;

use PDOException;

require '/home/yuta/www/_assets/includes/autoloader.php';

session_start();

//Modification Nom utilisateur
if(isset($_POST['InputModifyName'])){
    if($_POST['InputModifyName'] != $_SESSION['currentUser']->getUsername()){
        try {
            $_SESSION['currentUser']->ModifyUsername($_POST['InputModifyName']);
        }catch (PDOException $Exception) {
            echo "Ya pas de panneau";
        }
    }
}

//Modification Photo profil
if(is_uploaded_file($_FILES ['inputModifyImg'] ['tmp_name'])){
    $_SESSION['currentUser']->ModifyPfp($_FILES['inputModifyImg']);
}

//renvoie sur l'index
header('Location: ../views/profilPage.php?id_user_profil=' . $_SESSION['currentUser']->getId());
exit();
?>