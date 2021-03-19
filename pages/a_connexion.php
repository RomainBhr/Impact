<!-- CORPS de la page-->

<!-- Php qui permet la relation entre la bdd et le code, celà permet à l'utilisateur de s'inscrire -->
 <?php if (isset($_SESSION['user']))
  header('location:index.php')
?> 


<!-- Php qui permet la relation entre la bdd et le code, celà permet à l'utilisateur de se connecter -->
<?php if(isset($_POST['connexion'])) {
header("location:index.php");

GestionUser::Connexion($_POST['login'],$_POST['pwd']);
}?>

<div class="accueil">
    <div class="coadmin">  
        <p class="titredepages">Connectez vous ici :</p>
        <form method=post>
                  <!-- Formualire pour remplir sa connexion -->
            <table style=margin:auto;>
                <tr><td>
                <tr>
                    <td>
                        <p id="noir">Nom :</p><td><input autofocus name=login class="button" placeholder="Votre nom"><br>
                <tr>
                    <td>
                        <p id="noir">Mot de passe : </p><td><input name=pwd type=password class="button" placeholder="Votre mot de passe"><br>

                <tr>
                    
                        <td colspan=2><center><input name='connexion' type=submit class="button" value="Je me connecte !"></center><br>

                <tr>
                    <br>
                    <td colspan=2><center><p><b>Vous n'êtes pas inscrits ?</b></p>

                    <a class="cont" href="index.php?cas=afficherInscription">Cliquez ici pour vous inscrire !</a>
            </table>
            <br>
        </form><!-- <?php var_dump($_SESSION['id']) ?> -->
    </div>
</div>