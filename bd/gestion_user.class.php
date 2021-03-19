<?php




/**
 * Classe utilitaire de gestion de la Base de Données
 *
 */
class GestionUser {
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

    private static $autorisationInscription  = null;

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
    /*Inscription
     * Inscription utilisateurs
     */

// Vérification si un utilisateur n'a pas déjà utiliser se pseudo ou l'email si il est utilisé il empêche l'utilisateur de créer son compte 
       public static function userExistant($postName,$mail){
        self::seConnecter();
        
        self::$requete = "SELECT * FROM utilisateur WHERE login = :login OR email = :mail ";
        self::$pdoStResults = self::$pdoCnxBase->prepare(self::$requete);
        self::$pdoStResults->bindValue('login', $postName, PDO::PARAM_STR);
        self::$pdoStResults->bindValue('mail', $mail, PDO::PARAM_STR);
        self::$pdoStResults->execute();
        self::$resultat = self::$pdoStResults->fetch();

        self::$pdoStResults->closeCursor();
        
        if (self::$resultat == null) {
            self::$autorisationInscription = 1;

            
        }else{
             self::$autorisationInscription = 0;
        }
        return self::$autorisationInscription;
    }
        /*
     * Connexion de l'utilisateur
     */
    public static function Connexion($postName,$postMdp){
        $resultat = self::verificationConnexion($postName);
     	if($resultat == false) {}
     		else{
        $hash = $resultat->pwd;

        if(password_verify($postMdp, $hash)){
              $login = 1;
          }else{
              $login = null;
          }
          if($login == 1){
              $_SESSION['id'] = $resultat->id;
              $_SESSION['user'] = $resultat->login;
              $_SESSION['email'] =  $resultat->email;
              $_SESSION['numero'] = $resultat->numero;
              $_SESSION['ville'] = $resultat->ville;
          }else{
              $erreur = "Pseudo ou Mot de passe incorrect";
          }
      }
    }
    /*
     * Création d'un tableauu
     */
    public static function verificationConnexion($postName){
        self::seConnecter();

        self::$requete = "SELECT * FROM utilisateur WHERE login = :login";
        self::$pdoStResults = self::$pdoCnxBase->prepare(self::$requete);
        self::$pdoStResults->bindValue('login', $postName);
        self::$pdoStResults->execute();
        self::$resultat = self::$pdoStResults->fetch();

        self::$pdoStResults->closeCursor();
        
        return self::$resultat;
    }
 
    // Création d'un nouvelle utilisateur
public static function Inscription($postName,$postPassword,$email,$numero,$ville){

    
        if(GestionUser::userExistant($postName,$email,$numero,$ville) != 1){
            $erreur = "Pseudo déja utilisé";
            
        }else{
            self::seConnecter();

            $mot_de_passe_hashe = password_hash($postPassword, PASSWORD_BCRYPT);

            self::$requete = "insert into utilisateur(login,pwd,email,numero,ville) values(:login,:pwd,:email,:numero,:ville)";
            self::$pdoStResults = self::$pdoCnxBase->prepare(self::$requete);
            self::$pdoStResults->bindValue('login', $postName);
            self::$pdoStResults->bindValue('pwd', $mot_de_passe_hashe);
            self::$pdoStResults->bindValue('email', $email);
            self::$pdoStResults->bindValue('numero', $numero);
            self::$pdoStResults->bindValue('ville', $ville);

            self::$pdoStResults->execute();

            self::$pdoStResults->closeCursor();

        }
    }

}

// </editor-fold>

 ?>