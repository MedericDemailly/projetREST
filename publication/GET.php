<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

if($_SERVER['REQUEST_METHOD'] == 'GET') {
    include_once '../config/dbConnection.php';
    include_once '../model/publication.php';

    $database = new Database();
    $db= $database->getConnexion();

    $publication = new \model\publication($db);
    $postedData = file_get_contents('php://input');
    $postedData = json_decode($postedData,true);

    if(isset($postedData['idPublication'])) {
        $publication->idPublication = $postedData['idPublication'];
        $stmt = $publication->GETPubli();
    } else if (isset($postedData['idUtilisateur'])) {
        $publication->idUtilisateur = $postedData['idUtilisateur'];
        $stmt = $publication->GETPubliUtilisateur();
    } else {
        $stmt = $publication->GET();
    }

    $tab =[];    

    while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        extract($row);

        $product = [
            "idPublication" => $idPublication,
            "dateP"         => $dateP,
            "contenu"       => $contenu,
            "auteur"        => $identifiant
        ];

        $tab['publication'][] = $product;
    }
    if($tab['publication'] != null) {
        deliver_response(200, "Done", $tab['publication']);
    } else {
        deliver_response(401, "N'existe pas", null);
    }
} else {
    http_response_code(405);
    echo json_encode(["message" => "La methode n'est pas autorisee"]);
}