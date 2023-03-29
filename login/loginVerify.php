<?php
    session_start();
    require_once('../utilisateur/jwt_utils.php');
    if(!is_jwt_valid($_SESSION['token'])){
        echo 'TOKEN INVALIDE';
        die();
    }

    $tokenParts = explode('.', $_SESSION['token']);
    $payload = base64_decode($tokenParts[1]);
    $role = explode(',', $payload);

    if($role[1] == '"role":"moderator"') {
        header("Location: ../index/moderator.php");
    } else if($role[1] == '"role":"publisher"') {
        header("Location: ../index/publisher.php");
    } else {
        header("Location: ../index/invited.php");
    }