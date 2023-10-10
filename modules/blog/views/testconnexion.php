<?php
    $username = $_POST['username'];
//    echo  password_verify('cambodgeCITY', password_hash($_POST['pwd'], PASSWORD_BCRYPT)) . '<br>';
    $link = mysqli_connect('mysql-yuta.alwaysdata.net','yuta_ayoub','cambodgeCITY')
    or die('Erreur de connexion au serveur : ' . mysqli_connect_error());
    mysqli_select_db($link,'yuta_database') or die('Erreur dans la sélection de la base : ' . mysqli_error($link));
    $query = 'SELECT PASSWORD FROM YUTA_USER where USERNAME =\'' . $username . '\'';
    $result = mysqli_query($link, $query);
    if (!$result)
    {
        echo 'Impossible d\'exécuter la requête ', $query, ' : ', mysqli_error($link);
    }
    else
    {
        if (mysqli_num_rows($result) != 0)
        {
                if (password_verify($_POST['pwd'], mysqli_fetch_assoc($result)['PASSWORD']))
                    echo "connecté avec succès le couz.";
                else
                    echo "haha va te faire foutre";
        }
    }
    ?>
