<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <?php
        require_once('./utilisateur/jwt_utils.php');
    ?>
</head>
<body>
    <?php
        if(!is_jwt_valid($_SESSION['token'])){
            echo 'TOKEN INVALIDE';
            die();
        }
    ?>
    <p> Texte </p>
</body>
</html>