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

    public function POST() {
        $sql = "INSERT INTO ".$this->table."(idPublication, contenu, idUtilisateur) VALUES(:idPublication, :contenu, :idUtilisateur)";
        $query = $this->connexion->prepare($sql);

        $query->bindParam(":idPublication", $this->idPublication);
        $query->bindParam(":contenu", $this->contenu);
        $query->bindParam(":idUtilisateur", $this->idUtilisateur);

        return $query->execute();
    }

    public function DELETE(){
        $sql = "DELETE from ". $this->table." where idPublication = ?";
        $query = $this->connexion->prepare($sql);

        $query->bindParm(1,$this->idPublication);

        if($$query->execute()){
            return true;
        }
        return false;
    }

    public function PATCH(){
        $sql = "UPDATE ". $this->table. " SET contenu = :contenu where idPublication = :idPublication";
        $query = $this->connexion->prepare($sql);

        $query->bindParam(":contenu",$this->contenu);
        $query->bindParam(":idPublication",$this->idPublication);

        return $query->execute();
    }
}