<?php

namespace _assets\includes;

require '/home/yuta/www/_assets/includes/autoloader.php';
include '../models/imageUploader.php';

use blog\models\imageUploader;
use DateTime;
use DateTimeZone;


session_start();
$client_id = "745432d53688fc5";
$uploadOk = 1;

//recup utilisateur
$user = $_SESSION['currentUser'];
$userId = $user->getId();

//Recup infos générales (titre, message, date);
$message = $_POST['inputMsg'];
settype($message, "string");


//Recup image, upload sur imgur
if(is_uploaded_file($_FILES ['inputImg'] ['tmp_name'])){
    $upload_data = imageUploader::uploadPicture($_FILES ['inputImg']['tmp_name'],$_FILES['inputImg']['size']);
    if($upload_data)
        $imgLink = $upload_data->data->link;
} else {
    $imgLink = null;
}

//recup id parent
if (isset($_POST['postId'])) {
    $parentId = $_POST['postId'];
}


//Envoie sur bd
$query = 'INSERT INTO POST 
    (ID_AUTHOR, PARENT_ID, TITLE, TEXT_CONTENT, ATTACHED_PICTURE, SEND_DATE, LAST_EDIT_DATE) 
    VALUES (?, ?, ?, ?, ?, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP)';
$request = Database::getInstance()->prepare($query);
$request->execute([$userId,$parentId,null,$message,$imgLink]);




//renvoie sur l'index
header('Location: https://yuta.alwaysdata.net/?id_Post=' . $parentId);

exit();
?>