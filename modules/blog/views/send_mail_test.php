<?php
$destinataire = "ayoub.essalhia@gmail.com";
$sujet = "Exemple d'envoi d'e-mail en PHP";
$message = "Ceci est un exemple d'envoi d'e-mail en utilisant la fonction mail() en PHP.";
$headers = "From: yuta@alwaysdata.net";

if (mail($destinataire, $sujet, $message, $headers)) {
    echo "E-mail envoyé avec succès à $destinataire";
} else {
    echo "L'envoi de l'e-mail a échoué";
}
?>