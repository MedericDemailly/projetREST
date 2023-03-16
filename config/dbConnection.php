<?php
class Database {
    private $server = "127.0.0.1";
    private $name = "root";
    private $mdp = "";
    private $namebdd = "projetrest";
    public $connexion;

    public function getConnexion() {
        $this->connexion = null;

        try {
            $this->connexion = new PDO("mysql:host=".$this->server.";dbname=".$this->namebdd,$this->name,$this->mdp);
            $this->connexion->exec("set names utf8"); //on force les transac en utf-8
        } catch(PDOException $e) {
            echo "Erreur connexion bdd : ".$e->getMessage();
        }

        return $this->connexion;
    }
}