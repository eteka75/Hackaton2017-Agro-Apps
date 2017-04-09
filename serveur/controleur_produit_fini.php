<?php

$r = "../";
if (isset($racine))
    $r = $racine;

$gestionnaire_produit_fini = new GestionnaireProduitsFinis($dbb);
$gestionnaire_matiere_premiere = new GestionnaireMatierePremiere($dbb);

$list_matieres = $gestionnaire_matiere_premiere->getAllMatieresPremieres();


