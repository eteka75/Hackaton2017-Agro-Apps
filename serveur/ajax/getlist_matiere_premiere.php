<?php

require '../config/connexion.php';
require '../models/matieres_premieres.class.php';

$gestionnaire_matiere_premiere = new GestionnaireMatierePremiere($dbb);

$page=1;
$number=10;

if(isset($_GET['page']) && isset($_GET['number']))
{
    $page = intval($_GET['page']);
    $number = intval($_GET['number']);
}
    
    $list_matieres= $gestionnaire_matiere_premiere->getListMatierePremieresParPage($number, $page);
    
    echo json_encode($list_matieres);
