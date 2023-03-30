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

    public function GETAll() {
        $sql = "SELECT idUtilisateur, idPublication, aimer from " . $this->table . " ORDER BY idPublication, aimer";
        $query = $this->connexion->prepare($sql);

        $query->execute();

        return $query;
    }

    public function GETPubli() {
        $sql = "SELECT idUtilisateur, idPublication, aimer from " . $this->table . " WHERE idPublication = :idPublication ORDER BY aimer";
        $query = $this->connexion->prepare($sql);

        $query->bindParam(":idPublication", $this->idPublication);

        $query->execute();

        return $query;
    }

    public function POST(){
        $sql = "INSERT INTO " . $this->table . " VALUES(:idPublication, :idUtilisateur, :aimer)";
        $query = $this->connexion->prepare($sql);

        $query->bindParam(":idPublication", $this->idPublication);
        $query->bindParam(":idUtilisateur", $this->idUtilisateur);
        $query->bindParam(":aimer", $this->aimer);

        return $query->execute();
    }

    public function DELETE(){
        $sql = "DELETE FROM " . $this->table . " WHERE idPublication = :idPublication AND idUtilisateur = :idUtilisateur";
        $query = $this->connexion->prepare($sql);

        $query->bindParam(":idPublication", $this->idPublication);
        $query->bindParam(":idUtilisateur", $this->idUtilisateur);

        return $query->execute();
    }

    public function PATCH(){
        $sql = "UPDATE " . $this->table . " SET aimer = :aimer WHERE idPublication = :idPublication AND idUtilisateur = :idUtilisateur";
        $query = $this->connexion->prepare($sql);

        $query->bindParam(":aimer", $this->aimer);
        $query->bindParam(":idPublication", $this->idPublication);
        $query->bindParam(":idUtilisateur", $this->idUtilisateur);

        return $query->execute();
    }

    public function GetAvisAll() {
        $sql = "select idPublication, sum(aimer=1) as likes, sum(aimer=0) as dislikes from ".$this->table." GROUP BY idPublication";
        $query = $this->connexion->prepare($sql);

        $query->execute();
        return $query;
    }

    public function GetAvisPubli() {
        $sql = "select idPublication, sum(aimer=1) as likes, sum(aimer=0) as dislikes from ".$this->table." WHERE idPublication = :idPublication";
        $query = $this->connexion->prepare($sql);

        $query->bindParam(":idPublication", $this->idPublication);

        $query->execute();
        return $query;
    }

}