<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of matieres_premieres
 *
 * @author Francis
 */
class Matieres_premieres {
    //put your code here
    
    protected $id_mat;
    protected $nom_mat;
    protected $image_mat;
    protected $description_mat;
    
    function getId_mat() {
        return $this->id_mat;
    }

    function getNom_mat() {
        return $this->nom_mat;
    }

    function getImage_mat() {
        return $this->image_mat;
    }

    function getDescription_mat() {
        return $this->description_mat;
    }

    function setId_mat($id_mat) {
        $this->id_mat = $id_mat;
    }

    function setNom_mat($nom_mat) {
        $this->nom_mat = $nom_mat;
    }

    function setImage_mat($image_mat) {
        $this->image_mat = $image_mat;
    }

    function setDescription_mat($description_mat) {
        $this->description_mat = $description_mat;
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


class GestionnaireMatierePremiere 
{
    protected $dbb; 
    
    function __construct( PDO $dbb) {
        $this->dbb = $dbb;
    }

    public function getListMatierePremieresParPage($number=10, $page=1) {
        
        $query = $this->dbb->prepare("select * from matieres_premieres limit :debut,:number");
        $query->bindValue(":debut", ($page-1)*10, PDO::PARAM_INT);
        $query->bindValue(":number", $number, PDO::PARAM_INT);
                
        $query->execute();
        
        return $query->fetchAll();
                
    }
    
     public function getAllMatieresPremieres() {
        
        $query = $this->dbb->prepare("select * from matieres_premieres ");
        
                
        $query->execute();
        
        return $query->fetchAll();
                
    }
    
    function EnregistrerMatierePremiere(Matieres_premieres $mat){
        $query  = $this->dbb->prepare("insert into matieres_premieres set nom_mat=:nom_mat, image_mat=:image, description=:desc");
        $query->bindValue(":nom_mat", $mat->getNom_mat(), PDO::PARAM_STR);
        $query->bindValue(":image", $mat->getImage_mat(), PDO::PARAM_STR);
        $query->bindValue(":desc", $mat->getDescription_mat(), PDO::PARAM_STR);
        
        $query->execute();
        
        return $query->rowCount();
    }
    
    function getTotalMatierePremiere()
    {
        $query = $this->dbb->prepare("select count(*) as total_mat from matieres_premieres");
        $query->execute();
        
        return $query->fetch();
    }
    
    function RechercherMatierePremiere($val)
    {
         $query = $this->dbb->prepare("select * from matieres_premieres where nom_mat like '%".str_replace("'","''",$val)."%'");
         
         $query->execute();
         return $query;
    }
}