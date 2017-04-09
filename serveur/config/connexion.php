<?php

$r="../";

if(isset($racine))
{
    $r = $racine;
}


try
{
$dbb = new PDO('mysql:host=localhost;dbname=hk', 'root', '');
$dbb->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$dbb->exec("SET CHARACTER SET utf8");
}
catch (Exception $e)
{
die('Erreur : ' . $e->getMessage());
}

//spl_autoload_register("chargerClasse");


