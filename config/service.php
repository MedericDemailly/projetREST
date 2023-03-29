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
                        }
                    case"PATCH":
                        if(is_user_allowed()){
                            include_once("../publication/PATCH.php");
                            break;
                        } else{
                            deliver_response(401, "Token invalide ou permission refusé",NULL);
                        }   
                    case"POST":
                        if(is_user_allowed()){
                            include_once("../publication/POST.php");
                            break;
                        } else{
                            deliver_response(401, "Token invalide ou permission refusé",NULL);
                        }
                    default :
                        break;
                }

function is_user_allowed(){
    $bearer = get_bearer_token();
    $tokenParts = explode('.', $bearer);
    $payload = base64_decode($tokenParts[1]);
    $role = explode(',', $payload);
    $validRole = ($role == "moderator" || $role == "publisher");
    return (is_jwt_valid($bearer) && $validRole);
}