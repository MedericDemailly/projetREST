<?php

namespace model;

class publication {
    private $connexion;
    private $table = "publication";
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