<?php
    require_once("../utilisateur/jwt_utils.php");

    $bearer = get_bearer_token();

    if(is_jwt_valid($bearer)) {

        $tokenParts = explode('.', $bearer);
        $payload = base64_decode($tokenParts[1]);
        $role = explode(',', $payload);
        echo $role[1];

        $http_method = $_SERVER['REQUEST_METHOD'];

        switch($role[1]){
            case '"role":"publisher"':
                switch($http_method){
                    case"GET":

                        include_once("../publication/GET.php");
                        break;
                    case"DELETE":
                        include_once("../publication/DELETE.php");
                        break;
                    case"PATCH":
                        include_once("../publication/PATCH.php");
                        break;
                    case"POST":
                        include_once("../publication/POST.php");
                        break;
                    default :
                        break;
                }
                break;
            case '"role":"moderator"' :
                switch($http_method){
                    case"GET":
                        include_once("../publication/GET.php");
                        break;
                    case"DELETE":
                        include_once("../publication/DELETE.php");
                        break;
                    case"PATCH":
                        deliver_response(400,"En tant que moderateur vous ne pouvez pas modifier de message",null);
                        break;
                    case"POST":
                        deliver_response(400,"En tant que moderateur vous ne pouvez pas poster de messages",null);
                        break;
                    default :
                        break;
                }
                break;
            case '"role":null' :
                switch($http_method){
                    case "GET":
                        include("../publication/GET.php");
                        break;
                    case"DELETE":
                        deliver_response(400,"Sans etre connecte vous ne pouvez pas supprimer de message",null);
                        break;
                    case"PATCH":
                        deliver_response(400,"Sans etre connecte vous ne pouvez pas modifier de message",null);
                        break;
                    case"POST":
                        deliver_response(400,"Sans etre connecte vous ne pouvez pas poster de message",null);
                        break;
                    default :
                        break;
                }

        }
    } else{
        deliver_response(400,"Token pas valide",null);
    }