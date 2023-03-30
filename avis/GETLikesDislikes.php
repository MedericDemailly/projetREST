<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

if($_SERVER['REQUEST_METHOD'] == 'GET') {
    include_once '../config/dbConnection.php';
    include_once '../model/avis.php';

    $database = new Database();
    $db= $database->getConnexion();

    $avis = new \model\avis($db);
    $stmt = $avis->likeCount();

    $tab =[];

    while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        extract($row);

        $product = [
            "idPublication" => $idPublication,
            "likes"         => $likes,
            "dislikes"      => $dislikes
        ];

        $tab['avis'][] = $product;
    }

    deliver_response(200, "Avis", $tab['avis']);
} else {
    http_response_code(405);
    echo json_encode(["message" => "La methode n'est pas autorisee"]);
}
