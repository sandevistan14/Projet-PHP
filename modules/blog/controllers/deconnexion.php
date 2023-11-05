<?php

session_start();
unset($_SESSION['currentUser']);

//renvoie sur la page connexion
header('Location: https://yuta.alwaysdata.net/');
exit();