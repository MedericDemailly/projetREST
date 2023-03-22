<?php

namespace model;

class avis {
    private $connexion;
    private $table = "avis";
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

    public function POST(){
        $sql = "INSERT INTO " . $this->table . " VALUES( :idPublication, :idUtilisateur, :aimer";
        $query = $this->connexion->prepare($sql);

        $query->bindParam(":idPublication", $this->idPublication);
        $query->bindParam(":idUtilisateur", $this->idUtilisateur);
        $query->bindParam(":aimer", $this->aimer);

        return $query->execute();
    }

}