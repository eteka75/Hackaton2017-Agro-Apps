<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of entreprise
 *
 * @author Francis
 */
class Entreprise {
    //put your code here
    
    protected $id_entreprise;
    protected $nom;
    protected $lieu;
    protected  $tel;
    protected $email;
    protected $autres;
    protected $latitude;
    protected $longitude;
    
    function getId_entreprise() {
        return $this->id_entreprise;
    }

    function getNom() {
        return $this->nom;
    }

    function getLieu() {
        return $this->lieu;
    }

    function getTel() {
        return $this->tel;
    }

    function getEmail() {
        return $this->email;
    }

    function getAutres() {
        return $this->autres;
    }

    function getLatitude() {
        return $this->latitude;
    }

    function getLongitude() {
        return $this->longitude;
    }

    function setId_entreprise($id_entreprise) {
        $this->id_entreprise = $id_entreprise;
    }

    function setNom($nom) {
        $this->nom = $nom;
    }

    function setLieu($lieu) {
        $this->lieu = $lieu;
    }

    function setTel($tel) {
        $this->tel = $tel;
    }

    function setEmail($email) {
        $this->email = $email;
    }

    function setAutres($autres) {
        $this->autres = $autres;
    }

    function setLatitude($latitude) {
        $this->latitude = $latitude;
    }

    function setLongitude($longitude) {
        $this->longitude = $longitude;
    }

              function __construct($donnees = array()) {

        foreach ($donnees as $key => $value) {
            $method = "set" . ucfirst($key);

            if (method_exists($this, $method)) {
                $this->$method($value);
            }
        }
    }


}


class GestionnaireEntreprise{
    protected $dbb; 
    
    function __construct(PDO $dbb) {
        $this->dbb = $dbb;
    }
    
    function getListeEntreprisesAchetantProduit($id_pro){
        
        $query = $this->dbb->prepare("select * from clients A, produits_clients B "
                . " where A.id_client = B.id_client  and id_pro=:id_pro");
        
        $query->bindValue(":id_pro", $id_pro, PDO::PARAM_INT);
        
        $query->execute();
        
        return $query->fetchAll();
    }

}