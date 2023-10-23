<?php
    session_start();
    echo var_dump($_SESSION);
?>
<form action="auth.php" method="post">
    <label for="username">Nom d'utilisateur :</label>
    <input type="text" id="ident" name="ident"><br>
    <label for="pwd">Mot de passe :</label>
    <input type="password" id="password" name="password"><br>
    <input type="submit" value="Se connecter">
</form>