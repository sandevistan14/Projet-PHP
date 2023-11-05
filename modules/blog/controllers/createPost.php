<?php

namespace _assets\includes;

require '/home/yuta/www/_assets/includes/autoloader.php';
include '../models/imageUploader.php';

use blog\models\imageUploader;
use DateTime;
use DateTimeZone;


session_start();

//Recup infos générales (titre, message, date);
$title = $_POST['inputTitre'];
settype($titre, "string");
$message = $_POST['inputMsg'];
settype($message, "string");

//Recupération des catégories
$NbselectDisplayed = $_POST["NbselectDisplayed"];
$listCatOfPost = [];
if($NbselectDisplayed == 1){
    $cat1 = $_POST['Categorie1'];
    settype($cat1, "int");
    array_push($listCatOfPost, $cat1);
}
if ($NbselectDisplayed == 2){
    $cat1 = $_POST['Categorie1'];
    settype($cat1, "int");
    if ($_POST['Categorie2'] != $_POST['Categorie1']){
        $cat2 = $_POST['Categorie2'];
        array_push($listCatOfPost, $cat1, $cat2);
    }
    else{
        array_push($listCatOfPost, $cat1);
    }
}
if ($NbselectDisplayed == 3){
    $cat1 = $_POST['Categorie1'];
    settype($cat1, "int");
    if ($_POST['Categorie2'] != $_POST['Categorie1']){
        $cat2 = $_POST['Categorie2'];
        if ($_POST['Categorie3'] != $_POST['Categorie1'] && $_POST['Categorie3'] != $_POST['Categorie2'] ){
            $cat3 = $_POST['Categorie3'];
            array_push($listCatOfPost, $cat1, $cat2, $cat3);
        }
        else{
            array_push($listCatOfPost, $cat1, $cat2);
        }
    }
    else{
        array_push($listCatOfPost, $cat1);
    }
}
if ($NbselectDisplayed == 0){
    //Mettre par défaut la catégorie Divers
    $listCatOfPost[] = 1;
}


//Recup image, upload sur imgur
if(is_uploaded_file($_FILES ['inputImg'] ['tmp_name'])){
    $upload_data = imageUploader::uploadPicture($_FILES['inputImg']['tmp_name'],$_FILES['inputImg']['size']);
    if($upload_data)
        $imgLink = $upload_data->data->link;
} else {
    $imgLink = null;
}

// création de post
if($_SESSION['currentUser']->CreatePost($title,$message,$imgLink,$listCatOfPost)){
    // création réussie
    header('Location: https://yuta.alwaysdata.net/?postCreated=1');
    exit();
}
else {
    // création échouée
    header('Location: https://yuta.alwaysdata.net/?postCreated=0');
    exit();
}
?>