<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of etapes_compositions
 *
 * @author Francis
 */
class Etapes_compositions {
    //put your code here
    
    protected $id_etape;
    protected $detail;
    protected $image;
    protected $ordre;
    protected $produit_fini_concerne;
    
    
    function getId_etape() {
        return $this->id_etape;
    }

    function getDetail() {
        return $this->detail;
    }

    function getImage() {
        return $this->image;
    }

    function getOrdre() {
        return $this->ordre;
    }

    function getProduit_fini_concerne() {
        return $this->produit_fini_concerne;
    }

    function setId_etape($id_etape) {
        $this->id_etape = $id_etape;
    }

    function setDetail($detail) {
        $this->detail = $detail;
    }

    function setImage($image) {
        $this->image = $image;
    }

    function setOrdre($ordre) {
        $this->ordre = $ordre;
    }

    function setProduit_fini_concerne($produit_fini_concerne) {
        $this->produit_fini_concerne = $produit_fini_concerne;
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


class GestionnaireEtapesCompositions 
{
    protected $dbb;
    
    function __construct(PDO $dbb) {
        $this->dbb = $dbb;
    }
    
    function AjouterEtape(Etapes_compositions $etapes)
    {
        $query = $this->dbb->prepare("insert into mode_operatoire set detail=:detail, image=:image,ordre=:ordre,id_pro=:id_pro");
        
        $query->bindValue(":detail", $etapes->getDetail(), PDO::PARAM_STR);
        $query->bindValue(":image", $etapes->getImage(), PDO::PARAM_STR);
        $query->bindValue(":ordre", $etapes->getOrdre(), PDO::PARAM_STR);
        $query->bindValue(":id_pro", $etapes->getProduit_fini_concerne(), PDO::PARAM_INT);
        
        $query->execute();
        
        return $query->rowCount();
    }
    
    
    function verifEtapeExistePourProduit($id_pro){
        
        $query = $this->dbb->prepare("select * from mode_operatoire where id_pro=:id_pro");
        $query->bindValue(":id_pro", $id_pro, PDO::PARAM_INT);
        $query->execute();
        
        return $query->fetchAll();
    }
    function getTotalEtape(){
        
        $query = $this->dbb->prepare("select count(*) as total_etape from mode_operatoire");
        
        $query->execute();
        
        return $query->fetch();
    }
    
    function getOrdreEtapePourProduit($id_pro)
    {
        $existe = $this->verifEtapeExistePourProduit($id_pro);
        
        if(!empty($existe))
        {
            $query = $this->dbb->prepare("select max(ordre)+1 as nouvel_ordre from mode_operatoire where id_pro=:id_produit");
            $query->bindValue(":id_produit", $id_pro, PDO::PARAM_INT);

            $query->execute();

            $ordre = $query->fetch();
            return $ordre['nouvel_ordre'];
        }
        return 1;
    }
    
    function getAllEtapeProduit($id_pro)
    {
        $query = $this->dbb->prepare("select * from mode_operatoire where id_pro=:id_pro order by ordre asc ");
        
        $query->bindValue(":id_pro", $id_pro, PDO::PARAM_INT);
        $query->execute();
        
        return $query->fetchAll();
    }

}