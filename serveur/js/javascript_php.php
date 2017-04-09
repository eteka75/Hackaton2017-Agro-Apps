<?php

$r="../";
if(isset($racine))$r=$racine;

?>

<script>
    
    $(function(e)
    {
         $("input:file").fileinput({'showUpload': true, 'previewFileType': 'any'});
         
         
         $('#ajouter_etape_form').on('click',function(e)
         {
             
             $('#form_ajout_etape').slideToggle(500);
         });
         
         
         //
          $("#form_produit_fini").on('submit', function (e)
        {
            e.preventDefault();
            $data = "?" + $(this).serialize() + "&ajouter_produit=1";

            $div = $(this).parent().find("#message_produit_fini").empty();

            $("#load").show();

            $formData = new FormData($(this)[0]);



            $.ajax(
                    {
                        url: $(this).attr("action") + $data,
                        type: "POST",
                        data: $formData,
                        dataType: 'json',
                        async: false,
                        cache: false,
                        contentType: false,
                        processData: false,
                        success: function (json)
                        {
                            if (json.codeErreur === 0)
                            {
                                $div.addClass("alert alert-success alert-block alert-dismissable ");
                                $div.append("<button class='close' type='button' data-dismiss='alert'>&times;</button>");
                                $div.show(1000).append("<p>" + json.message + "</p>").delay(10000).hide(1000);

                                    $(this).children("input").val("");
                                window.location.reload();

                            }
                            else
                            {
                                $div.addClass("alert alert-danger alert-block alert-dismissable ");
                                $div.append("<button class='close' type='button' data-dismiss='alert'>&times;</button>");
                                $div.show(1000).append("<p>" + json.message + "</p>").delay(10000).hide(1000);
                            }
                        },
                        error: function (resultat, statut, erreur)
                        {


                            $div.addClass("alert alert-danger alert-block alert-dismissable");
                            $div.append("<button class='close' type='button' data-dismiss='alert'>&times;</button>");
                            $div.show(1000).append("<p>" + statut + " :  " + erreur + "</p>").delay(10000).hide(1000);

                        },
                        complete: function (resultat, statut)
                        {

                            $("#load").hide();
                        }
                    });

        });
        
        
        //ajout de matiere premiere
          $("#form_ajout_matiere_premiere").on('submit', function (e)
        {
            e.preventDefault();
            $data = "?" + $(this).serialize() + "&ajouter_matiere_premiere=1";

            $div = $(this).parent().find("#message_matiere_premiere").empty();

            $("#load").show();

            $formData = new FormData($(this)[0]);



            $.ajax(
                    {
                        url: $(this).attr("action") + $data,
                        type: "POST",
                        data: $formData,
                        dataType: 'json',
                        async: false,
                        cache: false,
                        contentType: false,
                        processData: false,
                        success: function (json)
                        {
                            if (json.codeErreur === 0)
                            {
                                $div.addClass("alert alert-success alert-block alert-dismissable ");
                                $div.append("<button class='close' type='button' data-dismiss='alert'>&times;</button>");
                                $div.show(1000).append("<p>" + json.message + "</p>").delay(10000).hide(1000);

                                    $(this).children("input").val("");
                                window.location.reload();

                            }
                            else
                            {
                                $div.addClass("alert alert-danger alert-block alert-dismissable ");
                                $div.append("<button class='close' type='button' data-dismiss='alert'>&times;</button>");
                                $div.show(1000).append("<p>" + json.message + "</p>").delay(10000).hide(1000);
                            }
                        },
                        error: function (resultat, statut, erreur)
                        {


                            $div.addClass("alert alert-danger alert-block alert-dismissable");
                            $div.append("<button class='close' type='button' data-dismiss='alert'>&times;</button>");
                            $div.show(1000).append("<p>" + statut + " :  " + erreur + "</p>").delay(10000).hide(1000);

                        },
                        complete: function (resultat, statut)
                        {

                            $("#load").hide();
                        }
                    });

        });
        
        //ajout d'étapes à la préparation d'un produit
        $("#form_ajout_etape").on('submit', function (e)
        {
            e.preventDefault();
            $data = "?" + $(this).serialize() + "&ajouter_etape=1";

            $div = $(this).parent().find("#message_ajout_etape").empty();

            $("#load").show();

            $formData = new FormData($(this)[0]);

            $.ajax(
                    {
                        url: $(this).attr("action") + $data,
                        type: "POST",
                        data: $formData,
                        dataType: 'text',
                        async: false,
                        cache: false,
                        contentType: false,
                        processData: false,
                        success: function (json)
                        {
                            alert(json);
                            if (json.codeErreur === 0)
                            {
                                $div.addClass("alert alert-success alert-block alert-dismissable ");
                                $div.append("<button class='close' type='button' data-dismiss='alert'>&times;</button>");
                                $div.show(1000).append("<p>" + json.message + "</p>").delay(10000).hide(1000);

                                    $(this).children("input").val("");
                                window.location.reload();

                            }
                            else
                            {
                                $div.addClass("alert alert-danger alert-block alert-dismissable ");
                                $div.append("<button class='close' type='button' data-dismiss='alert'>&times;</button>");
                                $div.show(1000).append("<p>" + json.message + "</p>").delay(10000).hide(1000);
                            }
                        },
                        error: function (resultat, statut, erreur)
                        {


                            $div.addClass("alert alert-danger alert-block alert-dismissable");
                            $div.append("<button class='close' type='button' data-dismiss='alert'>&times;</button>");
                            $div.show(1000).append("<p>" + statut + " :  " + erreur + "</p>").delay(10000).hide(1000);

                        },
                        complete: function (resultat, statut)
                        {

                            $("#load").hide();
                        }
                    });

        });
        
        
         /* RECHERCHE PAR TITRE*/
        $('#matiere').autocomplete(
                {
                    source: "<?php echo $racine; ?>controleurs/autocompletion_matiere_premiere.php",
                    select: function (event, ui)//lors de la selection
                    {
                        $id_actu = ui.item.value.split("-", 1);
                        $idOnglet = $(this).attr("data-onglet");

                       // document.location = "<?php echo $_SERVER['PHP_SELF']; ?>?u=actu&onglet=" + $idOnglet + "&id_actu=" + $id_actu;

                    },
                    minLength: 1,
                    position:
                            {
                                my: 'top',
                                at: 'bottom'
                            }
                });

    });
</script>
