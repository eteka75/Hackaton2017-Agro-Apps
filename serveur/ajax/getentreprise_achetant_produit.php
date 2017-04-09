<?php

require '../config/connexion.php';
require '../models/entreprise.class.php';

$gestionnaire_entreprise = new GestionnaireEntreprise($dbb);
$list_entreprises = array();

if(isset($_GET['id_pro']))
{
    $id_pro = htmlspecialchars($_GET['id_pro']);
    
    $list_entreprises = $gestionnaire_entreprise->getListeEntreprisesAchetantProduit($id_pro);
}

echo json_encode($list_entreprises);
