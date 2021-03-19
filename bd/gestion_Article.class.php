<?php

// Inclusion de la classe MysqlConfig
// à partir de l'emplacement actuel (dossier "modeles")
//require_once '../../configs/mysql_config.class.php';

/**
 * Classe utilitaire de gestion de la Base de Données
 *
 * @author OALBERT
 */
class GestionArticles {
// <editor-fold defaultstate="collapsed" desc="Champs statiques">

    /**
     * Objet de la classe PDO
     * @var PDO
     */
    private static $pdoCnxBase = null;

    /**
     * Objet de la classe PDOStatement
     * @var PDOStatement
     */
    private static $pdoStResults = null;
    private static $requete = ""; //texte de la requête
    private static $resultat = null; //résultat de la requête

// </editor-fold>
// <editor-fold defaultstate="collapsed" desc="Méthodes statiques">

    /**
     * Permet de se connecter à la base de données
     */
    public static function seConnecter() {

        if (!isset(self::$pdoCnxBase)) { //S'il n'y a pas encore eu de connexion
            try {
                self::$pdoCnxBase = new PDO('mysql:host=' . MysqlConfig::SERVEUR . ';dbname=' . MysqlConfig::BASE, MysqlConfig::UTILISATEUR, MysqlConfig::MOT_DE_PASSE);
                self::$pdoCnxBase->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); //méthode de la classe PDO
                self::$pdoCnxBase->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ); //méthode de la classe PDO
                self::$pdoCnxBase->query("SET CHARACTER SET utf8"); //méthode de la classe PDO
            } catch (Exception $e) {
                // l’objet pdoCnxBase a généré automatiquement un objet de type Exception
                echo 'Erreur : ' . $e->getMessage() . '<br />'; // méthode de la classe Exception
                echo 'Code : ' . $e->getCode(); // méthode de la classe Exception
            }
        }
    }

    public static function seDeconnecter() {
        self::$pdoCnxBase = null;
        //si on n'appelle pas la méthode, la déconnexion a lieu en fin de script
    }

    /**
     * Retourne la liste des Catégories
     * @return type Tableau d'objets
     */
    public static function getLesCategories() {
        return self::getLesTuplesByTable("Categorie");
    }

    /**
     * Retourne la liste des Produits
     * @return type Tableau d'objets
     */
    public static function getLesNews() {
        self::seConnecter();

        self::$requete = "select * from artcile";
        self::$pdoStResults = self::$pdoCnxBase->prepare(self::$requete);
        self::$pdoStResults->execute();
        self::$resultat = self::$pdoStResults->fetchAll();

        self::$pdoStResults->closeCursor();

        return self::$resultat;
    }

    /**
     * Retourne la liste des produits d'une catégorie donnée
     * @param type $libelleCategorie Libellé de la catégorie
     * @return type
     */
    public static function getLesNewsByCategorie($libelleCategorie) {
        self::seConnecter();

        self::$requete = "SELECT * FROM artcile N,Categorie C where N.idCategorie = C.id AND libelle = :libCateg";
        self::$pdoStResults = self::$pdoCnxBase->prepare(self::$requete);
        self::$pdoStResults->bindValue('libCateg', $libelleCategorie);
        self::$pdoStResults->execute();
        self::$resultat = self::$pdoStResults->fetchAll();

        self::$pdoStResults->closeCursor();

        return self::$resultat;
    }

    /**
     * Retourne LE produit dont l'id est passé en paramètre
     * @param type $idProduit id du produit
     * @return type
     */
    public static function getProduitById($idProduit) {
        return self::getLeTupleTableById("produit", $idProduit);
    }

    public static function getNbProduits3() {
        self::seConnecter();

        //self::$requete = "SELECT Count(*) FROM Produit";
        self::$requete = "SELECT Count(*) AS nbProduits FROM Produit";
        self::$pdoStResults = self::$pdoCnxBase->prepare(self::$requete);
        self::$pdoStResults->execute();
        self::$resultat = self::$pdoStResults->fetch();

        self::$pdoStResults->closeCursor();

        //return self::$resultat;
        return self::$resultat->nbProduits;
    }
    public static function getNbProduits1() {
        self::seConnecter();

        //self::$requete = "SELECT Count(*) FROM Produit";
        self::$requete = "SELECT Count(*) AS nbProduits FROM Produit";
        self::$pdoStResults = self::$pdoCnxBase->prepare(self::$requete);
        self::$pdoStResults->execute();
        self::$resultat = self::$pdoStResults->fetch();

        self::$pdoStResults->closeCursor();

        //return self::$resultat;
        return self::$resultat->nbProduits;
    }
    
    /**
     * Ajoute une ligne dans la table Catégorie     
     * @param type $libelleCateg Libellé de la Catégorie
     */
    public static function ajouterCategorie($libelleCateg) {

        self::seConnecter();

        self::$requete = "insert into Categorie(libelle) values(:libelle)";
        self::$pdoStResults = self::$pdoCnxBase->prepare(self::$requete);
        self::$pdoStResults->bindValue('libelle', $libelleCateg);
        self::$pdoStResults->execute();
      
    }
    
public static function ajouterNews($titre,$contenue,$auteur){
    
    self::seConnecter();
        
    self::$requete = "insert into article (art_titre, art_commentaire, art_categorie, `art_date`,art_idadmin )
    values ('$titre', '$commentaire','$categorie', NOW(), $iduser)";
    self::$pdoStResults = self::$pdoCnxBase->prepare(self::$requete);
    self::$pdoStResults->bindValue('titre',$titre);
    self::$pdoStResults->bindValue('contenue',$contenue);
    self::$pdoStResults->bindValue('auteur',$auteur);
    self::$pdoStResults->execute();

}
    
    private static function getLesTuplesByTable($table) {
        self::seConnecter();

        self::$requete = "select * from $table";
        self::$pdoStResults = self::$pdoCnxBase->prepare(self::$requete);
        self::$pdoStResults->execute();
        self::$resultat = self::$pdoStResults->fetchAll();

        self::$pdoStResults->closeCursor();

        return self::$resultat;
    }

    private static function getLeTupleTableById($table,$id) {
        self::seConnecter();

        self::$requete = "select * from $table where id=:idTable";
        self::$pdoStResults = self::$pdoCnxBase->prepare(self::$requete);
        self::$pdoStResults->bindValue('idTable', $id);
        self::$pdoStResults->execute();
        self::$resultat = self::$pdoStResults->fetch();

        self::$pdoStResults->closeCursor();

        return self::$resultat;
    }


// </editor-fold>
}
?>

<?php
//header('Content-Type: text/html; charset=UTF-8');
//$nombre = GestionBoutique::getNbProduits1();
//var_dump($nombre);
// Tests des services (méthodes) de la classe GestionBoutique
//-----------------------------------------------------------


//var_dump(GestionBoutique::getNbProduits());
//$nbProduits = GestionBoutique::getNbProduits();
//echo "Il y a $nbProduits produit(s) dans la boutique...";

//$leProduit = GestionBoutique::getProduitById(1);
//var_dump($leProduit);

//-----------------------------------------------------------
//EXERCICE 1
//-----------------------------------------------------------
//echo "Produit retourné : <br/>";
//echo "--------------------<br/>";
//echo " id : $leProduit->id <br/>";
//echo " nom : $leProduit->nom <br/>";
//echo " description : $leProduit->description <br/>";
//echo " prix : $leProduit->prix <br/>";
//echo " Fichier de l'image : $leProduit->image";
//------------------------------------------------------------
//$lesCategories = GestionBoutique::getLesCategories();
//var_dump($lesCategories);

//echo $lesCategories[2]->libelle;

//echo "Le libellé de la 2ème catégorie est : " . $lesCategories[2]->libelle. "</br>";

//------------------------------------------------------------------------------
//EXERCICE 2
//------------------------------------------------------------------------------
//echo "Il y a ".  count($lesCategories). " catégories dans la base : </br>";
//echo "-------------------------------------</br>";
//foreach ($lesCategories as $uneCategorie)
//{    
//    echo "$uneCategorie->libelle (catégorie $uneCategorie->id) </br>";
//}
//------------------------------------------------------------------------------

?>