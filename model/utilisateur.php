<?php

namespace model;

class utilisateur {
    private $connexion;
    private $table = "utilisateur";
    public $idPublication;
    public $idUtilisateur;
    public $aimer;

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