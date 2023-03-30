<?php
    require_once("../utilisateur/jwt_utils.php");

        $http_method = $_SERVER['REQUEST_METHOD'];
                switch($http_method){
                    case"GET":
                        include_once("../publication/GET.php");
                        break;
                    case"DELETE":
                        if(is_user_allowed()){
                            include_once("../publication/DELETE.php");
                            break;
                        } else{
                            deliver_response(401, "Token invalide ou permission refusé",NULL);
                            break;
                        }
                    case"PATCH":
                        if(is_user_allowed()){
                            include_once("../publication/PATCH.php");
                            break;
                        } else{
                            deliver_response(401, "Token invalide ou permission refusé",NULL);
                            break;
                        }   
                    case"POST":
                        if(is_user_allowed()){
                            include_once("../publication/POST.php");
                            break;
                        } else{
                            deliver_response(401, "Token invalide ou permission refusé",NULL);
                            break;
                        }
                    default :
                        break;
                }

function is_user_allowed(){
    $bearer = get_bearer_token();
    $tokenParts = explode('.', $bearer);
    $payload = base64_decode($tokenParts[1]);
    $role = json_decode($payload)->role;
    if($role == "moderator" || $role == "publisher") {
        $validRole = true;
    } else {
        $validRole = false;
    }
    return (is_jwt_valid($bearer) && $validRole);
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