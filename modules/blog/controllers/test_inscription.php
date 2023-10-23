<!DOCTYPE html>
<html>
<head>
    <title>Formulaire d'inscription</title>
</head>
<body>
<h2>Inscription</h2>
<form action="inscription.php" method="post">
    <label for="username">Nom d'utilisateur :</label>
    <input type="text" name="username" id="username" required>

    <br><br>

    <label for="email">Adresse e-mail :</label>
    <input type="email" name="email" id="email" required>

    <br><br>

    <label for="password">Mot de passe :</label>
    <input type="password" name="password" id="password" required>

    <br><br>

    <input type="submit" value="Inscrire">
</form>
</body>
</html>