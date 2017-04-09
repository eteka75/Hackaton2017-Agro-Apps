<?php

$r = "../";
if (isset($racine))
    $r = $racine;


include $r . "config/config.php";
include $r . "config/connexion.php";


$gestionnaire_produit_fini = new GestionnaireProduitsFinis($dbb);
$gestionnaire_matiere_premiere = new GestionnaireMatierePremiere($dbb);
$gestionnaire_etape = new GestionnaireEtapesCompositions($dbb);

$list_matieres = $gestionnaire_matiere_premiere->getAllMatieresPremieres();


$total_produit = $gestionnaire_produit_fini->getTotalProduit();

if (isset($_GET['ajouter_produit'])) {
    if (!empty($_POST['nom_pro']) && !empty($_POST['description']) && !empty($_POST['conditionnement']) && !empty($_POST['conservation']) && !empty($_POST['matiere_premiere']) && !empty($_POST['materiels_utilises']) && !empty($_POST['ingredients'])) {
        $_SESSION['data-produit-fini'] = $_POST;


        $nom_image = "";
        if ($_FILES["image"]["error"] == UPLOAD_ERR_OK) {

            $infosfichier = pathinfo($_FILES['image']['name']);
            $extension_upload = $infosfichier['extension'];
            $tmp_name = $_FILES["image"]["tmp_name"];
            $name = $_FILES["image"]["name"];

            //concatenation des noms d'image
            $nom_image = $name . "_" . $total_produit['total_produit'] . "." . $extension_upload;

            move_uploaded_file($tmp_name, $r . 'images/' . $nom_image);
        } else {
            $message = "Le fichier est trop volumineux...";

            $codeErreur = 1;

            $_SESSION['data-produit-fini']['message'] = $message;
            $_SESSION['data-produit-fini']['codeErreur'] = 1;
        }


        $donneesProduits = array(
            "nom_produit_fini" => $_POST['nom_pro'],
            "description" => $_POST['description'],
            "conditions" => $_POST['conditionnement'],
            "conservation" => $_POST['conservation'],
            "image_pro" => $nom_image,
            "materiels_utilises" => $_POST['materiels_utilises'],
            "ingredients" => $_POST['ingredients'],
            "donnees_tech" => $_POST['donnees_techn'],
            "cout" => $_POST['montant'],
            "devise" => $_POST['devise'],
            "id_matiere_premiere" => $_POST['matiere_premiere'],
        );


        $produits_finis = new Produits_finis($donneesProduits);

        $count = $gestionnaire_produit_fini->EnregistrerProduitFini($produits_finis);

        if (!empty($count)) {
            $_SESSION['data-produit-fini'] = null;

            $message = "Enregistrement effectué...";
            $codeErreur = 0;


            $_SESSION['data-produit-fini']['message'] = $message;
            $_SESSION['data-produit-fini']['codeErreur'] = 0;
        } else {
            $message = "Un erreur est survenue lors de l'enregistrement...";
            $codeErreur = 1;

            $_SESSION['data-produit-fini']['message'] = $message;
            $_SESSION['data-produit-fini']['codeErreur'] = 1;
        }
    } else {
        $_SESSION['data-produit-fini']['message'] = "Veuillez remplir tous les champs...";
        $_SESSION['data-produit-fini']['codeErreur'] = 1;

        $message = "Veuillez remplir tous les champs...";
        $codeErreur = 1;
    }

    $donneesAjax = array(
        "message" => $message,
        "codeErreur" => $codeErreur
    );

    echo json_encode($donneesAjax);
}


//aJOUT DE MATIERE PREMIRE



$total_produit = $gestionnaire_matiere_premiere->getTotalMatierePremiere();

if (isset($_GET['ajouter_matiere_premiere'])) {
    if (!empty($_POST['nom_matiere']) && !empty($_POST['description'])) {
        $_SESSION['data-matiere-premiere'] = $_POST;


        $nom_image = "";
        if ($_FILES["image"]["error"] == UPLOAD_ERR_OK) {

            $infosfichier = pathinfo($_FILES['image']['name']);
            $extension_upload = $infosfichier['extension'];
            $tmp_name = $_FILES["image"]["tmp_name"];
            $name = $_FILES["image"]["name"];

            //concatenation des noms d'image
            $nom_image = $name . "_" . $total_produit['total_mat'] . "." . $extension_upload;

            move_uploaded_file($tmp_name, $r . 'images/' . $nom_image);
        } else {
            $message = "Le fichier est trop volumineux...";

            $codeErreur = 1;

            $_SESSION['data-matiere-premiere']['message'] = $message;
            $_SESSION['data-matiere-premiere']['codeErreur'] = 1;
        }


        $donnees_matiere_premiere = array(
            "nom_mat" => $_POST['nom_matiere'],
            "description" => $_POST['description'],
            "image_mat" => $nom_image
        );



        $matiere_premiere = new Matieres_premieres($donnees_matiere_premiere);

        $count = $gestionnaire_matiere_premiere->EnregistrerMatierePremiere($matiere_premiere);
        if (!empty($count)) {
            $_SESSION['data-matiere-premiere'] = null;

            $message = "Enregistrement effectué...";


            $_SESSION['data-matiere-premiere']['message'] = $message;
            $_SESSION['data-matiere-premiere']['codeErreur'] = 0;
            $codeErreur = 0;
        } else {
            $message = "Un erreur est survenue lors de l'enregistrement...";

            $_SESSION['data-matiere-premiere']['message'] = $message;
            $_SESSION['data-matiere-premiere']['codeErreur'] = 1;
            $codeErreur = 1;
        }
    } else {
        $_SESSION['data-matiere-premiere']['message'] = "Veuillez remplir tous les champs...";
        $_SESSION['data-matiere-premiere']['codeErreur'] = 1;

        $message = "Veuillez remplir tous les champs...";
        $codeErreur = 1;
    }

    $donneesAjax = array(
        "message" => $message,
        "codeErreur" => $codeErreur
    );

    echo json_encode($donneesAjax);
}


//aJOUT ETAPE

$total_etape = $gestionnaire_etape->getTotalEtape();

//var_dump($_POST);
if (isset($_GET['ajouter_etape'])) {
    if (!empty($_POST['detail']) && !empty($_POST['produit_fini'])) {
        $_SESSION['data-ajout-etape'] = $_POST;


        $nom_image = "";
        if ($_FILES["image"]["error"] == UPLOAD_ERR_OK) {

            $infosfichier = pathinfo($_FILES['image']['name']);
            $extension_upload = $infosfichier['extension'];
            $tmp_name = $_FILES["image"]["tmp_name"];
            $name = $_FILES["image"]["name"];

            //concatenation des noms d'image
            $nom_image = $name . "_" . $total_etape['total_etape'] . "." . $extension_upload;

            move_uploaded_file($tmp_name, $r . 'images/' . $nom_image);
        } else {
            $message = "Le fichier est trop volumineux...";

            $codeErreur = 1;

            $_SESSION['data-data-ajout-etape']['message'] = $message;
            $_SESSION['data-data-ajout-etape']['codeErreur'] = 1;
        }

        
        $id_pro = $_POST['produit_fini'];
        
        $nouvel_etape = $gestionnaire_etape->getOrdreEtapePourProduit($id_pro);

        $donnees_etape = array(
            "detail" => $_POST['detail'],
            "ordre" => $nouvel_etape,
            "image" => $nom_image,
            "produit_fini_concerne" => $id_pro
        );



        $nouvelle_etape = new Etapes_compositions($donnees_etape);
        
        $count = $gestionnaire_etape->AjouterEtape($nouvelle_etape);
        if (!empty($count)) {
            $_SESSION['data-data-ajout-etape'] = null;

            $message = "Etape bien ajoutée..";


            $_SESSION['data-data-ajout-etape']['message'] = $message;
            $_SESSION['data-data-ajout-etape']['codeErreur'] = 0;
            $codeErreur = 0;
        } else {
            $message = "Un erreur est survenue lors de l'ajout de cette étape...";

            $_SESSION['data-data-ajout-etape']['message'] = $message;
            $_SESSION['data-data-ajout-etape']['codeErreur'] = 1;
            $codeErreur = 1;
        }
    } else {
        $_SESSION['data-data-ajout-etape']['message'] = "Veuillez remplir tous les champs...";
        $_SESSION['data-data-ajout-etape']['codeErreur'] = 1;

        $message = "Veuillez remplir tous les champs...";
        $codeErreur = 1;
    }

    $donneesAjax = array(
        "message" => $message,
        "codeErreur" => $codeErreur
    );

    echo json_encode($donneesAjax);
}