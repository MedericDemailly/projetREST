<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    include_once '../config/dbConnection.php';
    include_once '../model/avis.php';

    $database = new Database();
    $db= $database->getConnexion();

    $avis = new \model\avis($db);
    $postedData = file_get_contents('php://input');
    $postedData = json_decode($postedData,true);

    $avis->idUtilisateur = $postedData['idUtilisateur'];
    $avis->aimer = $postedData['aimer'];
    $avis->idPublication = $postedData['idPublication'];
    if($avis->POST()) {
        deliver_response(200, "Done", null);
    } else {
        deliver_response(405, "Unauthorized method", NULL);
    }
}

function deliver_response($status, $status_message, $data) {
    /// Paramétrage de l'entête HTTP, suite
    header("HTTP/1.1 $status $status_message");
    /// Paramétrage de la réponse retournée
    $response['status'] = $status;
    $response['status_message'] = $status_message;
    $response['data'] = $data;
    /// Mapping de la réponse au format JSON
    $json_response = json_encode($response);
    echo $json_response;
}