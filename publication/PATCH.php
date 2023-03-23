<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: PATCH");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

if($_SERVER['REQUEST_METHOD'] == 'PATCH') {
    include_once '../config/dbConnection.php';
    include_once '../model/publication.php';

    $database = new Database();
    $db= $database->getConnexion();

    $publication = new \model\publication($db);
    $postedData = file_get_contents('php://input');
    $postedData = json_decode($postedData,true);

    $publication->idPublication = $postedData['idPublication'];
    $publication->contenu = $postedData['contenu'];

    if($publication->PATCH()) {
        deliver_response(200, "Done", null);
    } else {
        http_response_code(405);
        echo json_encode(["message" => "La methode n'est pas autorisee"]);
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