<?php
    try {
        $linkpdo = new PDO("mysql:host=localhost;dbname=projetrest", 'root', '');
    } catch (Exception $e) {
        die('Erreur de connexion à la base de données: ' . $e->getMessage());
    }
?>