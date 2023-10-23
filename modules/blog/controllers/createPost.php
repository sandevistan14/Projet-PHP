<?php

namespace _assets\includes;

require '/home/yuta/www/_assets/includes/autoloader.php';

use DateTime;
use DateTimeZone;

session_start();
$client_id = "745432d53688fc5";
$uploadOk = 1;

//recup utilisateur
$user = $_SESSION['currentUser'];
$userId = $user::getId();

//Recup infos générales (titre, message, date);
$title = $_POST['inputTitre'];
settype($titre, "string");
$message = $_POST['inputMsg'];
settype($message, "string");
$dateCreatePost = (new \DateTime)->__construct("now", new DateTimeZone("Europe/Berlin"));
$lastEditPost = $dateCreatePost;

//Recup image, upload sur imgur
if(isset($_POST['inputImg'])){
    $check = getimagesize($_FILES["inputImg"]["tmp_name"]);
    if($check !== false) {
        echo "File is an image - " . $check["mime"] . "." . '<br>';
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }
    if ($_FILES["inputImg"]["size"] > 10000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
    } else {
        $image_source = file_get_contents($_FILES['fileToUpload']['tmp_name']);

        $postFields = array('image' => base64_encode($image_source));

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://api.imgur.com/3/image');
        curl_setopt($ch, CURLOPT_POST, TRUE);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization: Client-ID ' . $client_id));
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
        $response = curl_exec($ch);
        curl_close($ch);

        $responseArr = json_decode($response);

        if(!empty($responseArr->data->link)){
            $imgurData = $responseArr;
            if(!empty($imgurData)){
                $imgLink = $imgurData->data->link;
            }
        }else{
        }
    }
} else {
    $imgLink = null;
}

//Envoie sur bd
$query = 'INSERT INTO POST 
    (ID_AUTHOR, PARENT_ID, TITLE, TEXT_CONTENT, ATTACHED_PICTURE, SEND_DATE, LAST_EDIT_DATE) 
    VALUES (?, ?, ?, ?, ?, ?, ?)';
$request = Database::getInstance()->prepare($query);
$request->execute([$userId,null,$title,$message,$imgLink,$dateCreatePost,$lastEditPost]); //rajouter les variables correpsondantes

//renvoie sur l'index
header('Location: ../views/homePage.php');
exit();
?>