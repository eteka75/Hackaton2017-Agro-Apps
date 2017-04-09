<?php

require '../config/connexion.php';
require '../models/produits_finis.class.php';

$gestionnaire_produit_fini = new GestionnaireProduitsFinis($dbb);

$p = array("");

if(isset($_GET['idprod']))
{
    $number = intval($_GET['idprod']);
    
    $p = $gestionnaire_produit_fini->getAllProduitsById($number);
}
echo json_encode($p);


