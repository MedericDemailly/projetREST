<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    include_once '../config/dbConnection.php';
    include_once '../model/publication.php';

    $database = new Database();
    $db= $database->getConnexion();

    $publication = new \model\publication($db);
    $postedData = file_get_contents('php://input');
    $postedData = json_decode($postedData,true);

    $publication->idUtilisateur = $postedData['idUtilisateur'];
    $publication->contenu = $postedData['contenu'];
    if($publication->POST()) {
        deliver_response(200, "Done", null);
    } else {
        http_response_code(405);
        echo json_encode(["message" => "La methode n'est pas autorisee"]);
    }
}