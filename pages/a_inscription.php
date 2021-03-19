
<!-- Php qui permet de renvoyer l'utilisateur sur l'index si il est connecté au site -->
<?php if (!isset($_SESSION['user']))
  header('location:index.php');
?>


<!-- Php qui permet la relation entre la bdd et le code, celà permet à l'utilisateur de s'inscrire -->
<?php
if(isset($_POST['butinscription'])) {
GestionUser::Inscription($_POST['login'],$_POST['pwd'],$_POST['email'],$_POST['numero'],$_POST['ville']);
   header('location:index.php?cas=afficherAdmin&categorie=connexion');
}?>
<div class="accueil">
    <div class="coadmin">      
      <p class="titredepages">Inscrivez-vous vous ici :</p>
        <!-- Formualire pour remplir son inscription -->
        <form method=post>
            <table  style=margin:auto;>

                <tr>
                    <td>
                        <p id="noir">Nom d'utilisateur :</p><td><input placeholder="Votre nom" autofocus name=login class="button" ><td><p><i></i></p><br>
                  <tr>
                    <td>
                        <p id="noir">Mot de passe :</p><td><input placeholder="Votre mot de passe" type=password name="pwd" class="button" ><td><p><i></i></p><br>   
                  <tr>
                    <td>
                        <p id="noir">Email :</p><td><input placeholder="Votre email" name="email" class="button" ><td><p><i></i></p><br>   
                  <tr>
                    <td>
                        <p id="noir">Numero :</p><td><input placeholder="Votre Numero" type=numero name="numero" class="button" ><td><p><i></i></p><br>   
                  <tr>
                    <td>
                        <p id="noir">Ville :</p><td><input placeholder="Votre ville" type=ville name="ville" class="button" ><td><p><i></i></p><br>   
                
                <tr><td><td><center><input name="butinscription" type=submit value="Je m'inscris !" class="button"></center>
                <tr>
                   
            </table>
            <br>
        </form>
    </div>
</div>