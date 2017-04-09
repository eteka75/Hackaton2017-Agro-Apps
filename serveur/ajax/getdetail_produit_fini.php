<?php


require '../config/connexion.php';
require '../models/produits_finis.class.php';

$gestionnaire_produit_fini = new GestionnaireProduitsFinis($dbb);

$detail_produit = array();

if(isset($_GET['id_pro']))
{
    $id_pro = htmlspecialchars($_GET['id_pro']);
    
    $detail_produit = $gestionnaire_produit_fini->getDetailsProduitsFinis($id_pro);
}

echo json_encode($detail_produit);
