<?php

namespace model;

class publication {
    private $connexion;
    private $table = "publication";

    public $idPublication;
    public $dateP;
    public $contenu;
    public $idUtilisateur;

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