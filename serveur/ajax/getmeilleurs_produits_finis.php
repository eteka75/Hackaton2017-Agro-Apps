<?php

require '../config/connexion.php';
require '../models/produits_finis.class.php';

$gestionnaire_produit_fini = new GestionnaireProduitsFinis($dbb);

$detail_etapes = array();

$number = 4;
if(isset($_GET['number']))
{
    $number = intval($_GET['number']);
    
}

$meilleurs_produits = $gestionnaire_produit_fini->getMeilleursProduits($number);

echo json_encode($meilleurs_produits);
