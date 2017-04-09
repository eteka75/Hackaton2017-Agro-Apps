<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of produits_finis
 *
 * @author Francis
 */
class Produits_finis {
    //put your code here
    
    protected  $id_pro;
    protected $nom_produit_fini;
    protected $image_pro;
    protected $description;
    protected $materiels_utilises;
    protected  $ingredients;
    protected $conditions;
    protected $conservation;
    protected  $donnees_tech;
    protected $cout;
    protected $devise;
    protected $id_matiere_premiere;
    
    
    function getDevise() {
        return $this->devise;
    }

    function setDevise($devise) {
        $this->devise = $devise;
    }

        function getDescription() {
        return $this->description;
    }

    function setDescription($description) {
        $this->description = $description;
    }

        
    function getId_pro() {
        return $this->id_pro;
    }

    function getNom_produit_fini() {
        return $this->nom_produit_fini;
    }

    function getImage_pro() {
        return $this->image_pro;
    }

    function getMateriels_utilises() {
        return $this->materiels_utilises;
    }

    function getIngredients() {
        return $this->ingredients;
    }

    function getConditions() {
        return $this->conditions;
    }

    function getConservation() {
        return $this->conservation;
    }

    function getDonnees_tech() {
        return $this->donnees_tech;
    }

    function getCout() {
        return $this->cout;
    }

    function getId_matiere_premiere() {
        return $this->id_matiere_premiere;
    }

    function setId_pro($id_pro) {
        $this->id_pro = $id_pro;
    }

    function setNom_produit_fini($nom_produit_fini) {
        $this->nom_produit_fini = $nom_produit_fini;
    }

    function setImage_pro($image_pro) {
        $this->image_pro = $image_pro;
    }

    function setMateriels_utilises($materiels_utilises) {
        $this->materiels_utilises = $materiels_utilises;
    }

    function setIngredients($ingredients) {
        $this->ingredients = $ingredients;
    }

    function setConditions($conditions) {
        $this->conditions = $conditions;
    }

    function setConservation($conservation) {
        $this->conservation = $conservation;
    }

    function setDonnees_tech($donnees_tech) {
        $this->donnees_tech = $donnees_tech;
    }

    function setCout($cout) {
        $this->cout = $cout;
    }

    function setId_matiere_premiere($id_matiere_premiere) {
        $this->id_matiere_premiere = $id_matiere_premiere;
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


class GestionnaireProduitsFinis
{
    protected $dbb; 
    
    function __construct(PDO $dbb) {
        $this->dbb = $dbb;
    }
    
    function getDetailsProduitsFinis($id_pro)
    {
        $query = $this->dbb->prepare("select * from produits_finis where id_pro=:id_pro");
        
        $query->bindValue(":id_pro",$id_pro,PDO::PARAM_INT);
        $query->execute();
        
        return $query->fetch();
    }
    
    function getDetailsSurComposition($id_pro)
    {
         $query = $this->dbb->prepare("select * from mode_operatoire where id_pro=:id_pro");
        
        $query->bindValue(":id_pro",$id_pro,PDO::PARAM_INT);
        $query->execute();
        
        return $query->fetchAll();
    }
    
    function getMeilleursProduits($number=4){
        
        $query = $this->dbb->prepare("select * from produits_finis order by id_pro desc limit 0,:number");
       $query->bindValue(":number", $number, PDO::PARAM_INT);
       $query->execute();
        return $query->fetchAll();
    }
    
    
    function EnregistrerProduitFini(Produits_finis $produit){
        
        $query = $this->dbb->prepare("INSERT INTO `produits_finis`( `nom_pro`, `image_pro`, `description`, `materiels`, `ingredients`, `condition`, `conservation`, `donnee_tech`, `montant`, `devise`, `id_mat`) VALUES (:nom,:image,:desc,:materiel,:ingredient,:condition,:conservation,:donnee_tech,:montant,:devise,:id_mat) ");
        
               
        
                $query->bindValue(":nom", $produit->getNom_produit_fini(), PDO::PARAM_STR);
                $query->bindValue(":image", $produit->getImage_pro(), PDO::PARAM_STR);
                $query->bindValue(":desc", $produit->getDescription(), PDO::PARAM_STR);
                $query->bindValue(":materiel", $produit->getMateriels_utilises(), PDO::PARAM_STR);
                $query->bindValue(":ingredient",$produit->getIngredients(), PDO::PARAM_STR);
                $query->bindValue(":condition", $produit->getConditions(), PDO::PARAM_STR);
                $query->bindValue(":conservation", $produit->getConservation(), PDO::PARAM_STR);
                $query->bindValue(":donnee_tech", $produit->getDonnees_tech(), PDO::PARAM_STR);
                $query->bindValue(":montant", $produit->getCout());
                $query->bindValue(":devise", $produit->getDevise(), PDO::PARAM_STR);
                $query->bindValue(":id_mat", $produit->getId_matiere_premiere(), PDO::PARAM_STR);
                
                
                $query->execute();
                
                
                return $query->rowCount();
    }
    
    function getTotalProduit()
    {
        $query = $this->dbb->prepare("select count(*) as total_produit from produits_finis");
        
        $query->execute();
        
        return $query->fetch();
    }
    
    function getAllProduitsFinis()
    {
        $query = $this->dbb->prepare("select *  from produits_finis");
        
        $query->execute();
        
        return $query->fetchAll();
    }
    
    

}