<?php

   $r="../";
        
        include $r."config/connexion.php";
        
include $r . 'models/matieres_premieres.class.php';
        
  $gestionnaire_mat_premiere = new GestionnaireMatierePremiere($dbb);
        
  $nom_mat = "";
  
  
        if(isset($_GET['term']))
        {
            $nom_mat= htmlspecialchars($_GET['term']);
        }
        
        
      $requete=$gestionnaire_mat_premiere->RechercherMatierePremiere($nom_mat);
        
        
      
       $infos_mat=array();
       
       $i=0;$tab=[];
       while($donnee = $requete->fetch()) // on effectue une boucle pour obtenir les données
        {
           
          
		  
           if(!empty($donnee))
           {
                $tab[$i]=['id'=>$donnee['id_mat'],"label"=>$donnee['nom_mat']]; // et on ajoute celles-ci à notre tableau
				
           }
		   $i++;
          
        }
		$infos_mat=$tab;

       
        if(empty($infos_mat))
        {
            array_push($infos_mat, "Aucun nom de matière première ne correspond à votre saisie");
        }
        
        echo json_encode($infos_mat);
      
        
        
        