<?php
// Inclusion de la classe MysqlConfig
require_once 'bd/mysql_config.class.php';
// Inclusion de la gestion user
require_once 'bd/gestion_user.class.php';
require_once 'bd/gestion_Article.class.php';
// Inclusion de l'entete
require 'include/deb.php';

    $sql = "SELECT * from article where art_categorie = 1 or 2 or 3 or 4 or 5 or 6 or 7 or 8 or 9 or 10 or 11 or 12 or 13 or 14";
    $rs_articles = mysqli_query($CO, $sql) or die(mysqli_error($CO));
    while ($article = mysqli_fetch_array($rs_articles))
    {
        $titre = $article['art_titre'];
        $commentaire = $article['art_commentaire'];
        $categorie = $article['art_categorie'];
        $date = $article ['art_date'];
        $a = $article['art_id'];
    }
     
// Affectation d'une variable $cas en fonction du paramètre d'URL
// Avec opérateur conditionnel
$cas = (!isset($_REQUEST['cas'])) ? 'afficherAccueil' : $_REQUEST['cas'];

//Aiguillage vers le bon corps de page
switch ($cas) {
 case 'afficherAccueil': {
            require 'pages/v_acceuil.php';
            break;
        }
    case 'afficherAdmin': { //version sans BD
            if (isset($_REQUEST['categorie'])) {
                if (file_exists('pages/a_' . $_REQUEST['categorie'] . '.php')) {
                    require 'pages/a_' . $_REQUEST['categorie'] . '.php';
                } else {
                    require 'pages/v_error404.php';
                }
            }
            else {
                    require 'pages/v_error404.php';
            }
            break;
        }
 case 'afficherEnt': { //version sans BD
            if (isset($_REQUEST['categorie'])) {
                if (file_exists('pages/e_' . $_REQUEST['categorie'] . '.php')) {
                    require 'pages/e_' . $_REQUEST['categorie'] . '.php';
                } else {
                    require 'pages/v_error404.php';
                }
            }
            else {
                    require 'pages/v_error404.php';
            }
            break;
        }
case 'afficherSco': { //version sans BD
            if (isset($_REQUEST['categorie'])) {
                if (file_exists('pages/s_' . $_REQUEST['categorie'] . '.php')) {
                    require 'pages/s_' . $_REQUEST['categorie'] . '.php';
                } else {
                    require 'pages/v_error404.php';
                }
            }
            else {
                    require 'pages/v_error404.php';
            }
            break;
        }
case 'afficherAutres': { //version sans BD
            if (isset($_REQUEST['categorie'])) {
                if (file_exists('pages/v_' . $_REQUEST['categorie'] . '.php')) {
                    require 'pages/v_' . $_REQUEST['categorie'] . '.php';
                } else {
                    require 'pages/v_error404.php';
                }
            }
            else {
                    require 'pages/v_error404.php';
            }
            break;
        }


      case 'afficherNews': {
        if (isset($_REQUEST['categorie'])) {
            require 'pages/admin.php';    
        } else {
                    require 'pages/erreur404.php';
                }
            break;
        }


case 'afficherModif': {
            require 'pages/modif.php?id='.$a;
            break;
        }
        
    default : {
            require 'pages/v_erreur404.php';
            break;
        }
}



// Inclusion du pied de page

require 'include/footer.php';
