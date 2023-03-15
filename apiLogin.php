<?php
    require_once('jwt_utils.php');
    require_once('dbConnection.php');

    /// Librairies éventuelles (pour la connexion à la BDD, etc.)
    //include('mylib.php');

    /// Paramétrage de l'entête HTTP (pour la réponse au Client)
    header("Content-Type:application/json");

    /// Identification du type de méthode HTTP envoyée par le client
    $http_method = $_SERVER['REQUEST_METHOD'];
    if($http_method !="POST"){
        deliver_response(405,"ERREUR : Méthode non supportée",null);
    }else{
        /// Cas de la méthode POST
        /// Récupération des données envoyées par le Client
        $postedData = file_get_contents('php://input');
        $values = json_decode($postedData,true);
        if(!isset($values['user']) || !isset($values['mdp'])){
            deliver_response(400,"Identifiant ou mot de passe non renseigné",null);
            die();  
        } else{
            $query = "SELECT idUtilisateur, identifiant, motDePasse, role FROM utilisateur";
            $req = $linkpdo -> prepare($query);
            if($req == false){
                die('Erreur lors de la création du statement');
            }
            $req2 = $req->execute();
            if($req2 == false){
                    die('Erreur execute');
            }
            while($row = $req -> fetch()) {
                if($values['user']==$row['identifiant']){
                    if($values['mdp'] == $row['motDePasse']){
                        deliver_response(201, "Connexion réussie", ["token"=>generate_jwt(
                            ["alg"=> "SHA256", "typ"=>"JWT"],
                            ["idUtilisateur"=>$row['idUtilisateur'],"role"=>$row['role'], "exp"=> time()+3600]
                            )]);
                    }
                    else {
                        deliver_response(400,"Mot de passe incorrect",null);
                        die();
                    }
                } 
            }
            deliver_response(400,"Identifiant inconnu",null);
            die();
        }
    }
    /// Envoi de la réponse au Client
    function deliver_response($status, $status_message, $data){
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
   ?>