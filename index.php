<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <?php
        session_start();
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