<?php

 $r="../";
         
         if(isset($racine))$r=$racine;
         
$gestionnaire_produit_fini = new GestionnaireProduitsFinis($dbb);

$all_produits_finis = $gestionnaire_produit_fini->getAllProduitsFinis();