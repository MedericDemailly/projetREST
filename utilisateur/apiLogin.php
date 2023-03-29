<?php
    require_once('jwt_utils.php');
    require_once('../config/dbConnection.php');
    require_once('../model/utilisateur.php');
    $utilisateur = htmlspecialchars($_GET['username']);
    $mdp = htmlspecialchars($_GET['password']);

    $database = new Database();
    $db = $database->getConnexion();

    $user = new \model\utilisateur($db);

    /// Paramétrage de l'entête HTTP (pour la réponse au Client)
    header("Content-Type:application/json");

    /// Identification du type de méthode HTTP envoyée par le client
    $http_method = $_SERVER['REQUEST_METHOD'];
    if($http_method != "POST"){
        deliver_response(405,"ERREUR : Méthode non supportée",null);
    }else {
        if (empty($utilisateur) && empty($mdp)) {
            deliver_response(400, "Identifiant ou mot de passe non renseigne", null);
            die();
        } else {
            $stmt = $user->GET();
            if (!$stmt) {
                die('Erreur lors de la création du statement');
            }
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                extract($row);
                if ($utilisateur == $identifiant) {
                    if ($mdp == $motDePasse) {
                        session_start();
                        $token=generate_jwt(
                            ["alg" => "SHA256", "typ" => "JWT"],
                            ["idUtilisateur" => $idUtilisateur, "role" => $role, "exp" => time() + 3600]
                        );
                        $_SESSION['token']=$token;
                        header('Location: ../login/loginVerify.php');
                        die();
                    } else {
                        deliver_response(400, "Mot de passe incorrect", null);
                        die();
                    }
                }
            }
            deliver_response(400, "Identifiant incorrect", null);
            die();
        }
    }

        /// Envoi de la réponse au Client
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