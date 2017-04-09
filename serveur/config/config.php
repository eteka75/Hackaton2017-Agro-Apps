<?php

session_start();
        $r = "../";

        if(isset($racine))
        {
            $r = $racine;
        }

        
        
include $r . 'models/produits_finis.class.php';
include $r . 'models/matieres_premieres.class.php';
include $r . 'models/etapes_compositions.class.php';