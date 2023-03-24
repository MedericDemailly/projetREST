<?php
require_once("../utilisateur/jwt_utils.php");

$match = get_bearer_token();

if(is_jwt_valid($match)){

    $paylod = base64_decode($match[1]);
    $http_method = $_SERVER['REQUEST_METHOD'];

    switch($paylod["role"]){

        case "publisher":
            switch($http_method){
                case"GET":
                    include_once("../publication/GET.php");
                    include_once("../avis.php");
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
        case "moderator" :
            switch($http_method){
                case"GET":
                    include_once("../publication/GET.php");
                    include_once("../avis.php");
                    include_once("../utilisateur.php");
                    break;
                case"DELETE":
                    include_once("../publication/DELETE.php");
                    break;
                case"PATCH":
                    deliver_response(400,"En tant que moderateur vous ne pouvez pas modifier de message",null);
                    break;
                case"POST":
                    deliver_response(400,"En tant que modérateur vous ne pouvez pas poster de messages",null);
                    break;
                default :
                    break;
            }
        default : 
            switch($http_method){
                case"GET":
                    include_once("../publication/GET.php");
                    include_once("../utilisateur.php");
                    break;
                case"DELETE":
                    deliver_response(400,"Sans être connecté vous ne pouvez pas supprimer de message",null);
                    break;
                case"PATCH":
                    deliver_response(400,"Sans être connecté vous ne pouvez pas modifier de message",null);
                    break;
                case"POST":
                    deliver_response(400,"Sans être connecté vous ne pouvez pas poster de message",null);
                    break;
                default :
                    break;
        }

    }
}else{
    deliver_response(400,"Token pas valide",null);
}
?>