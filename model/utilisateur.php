<?php

namespace model;

class Utilisateur {
    private $connexion;
    private $table = "utilisateur";
    public $idUtilisateur;
    public $identifiant;
    public $motDePasse;
    public $role;

    public function __construct($db) {
        $this->connexion = $db;
    }

    public function GET() {
        $sql = "SELECT * from " . $this->table;
        $query = $this->connexion->prepare($sql);

        $query->execute();

        return $query;
    }

}