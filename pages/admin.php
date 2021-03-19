<?php if (!isset($_SESSION['user']))
  header('location:index.php');
?>
 
   <div class="commentaire">
<CENTER><h1  class="titredepages">Bienvenue dans :</h1><h2 id="noir"><i>l'espace administrateur</i></h2></center><br>
</table>



<?php
if (isset($_POST["titre"]))
{
	$titre = mysqli_real_escape_string($CO, $_POST["titre"]);
	$commentaire = addslashes ($_POST["commentaire"]);
    $categorie = $_POST["categorie"];
    $sql = 	"insert into article (art_titre, art_commentaire, art_categorie, `art_date` )
	values ('$titre', '$commentaire','$categorie', NOW())";
	mysqli_query($CO, $sql) or die(mysqli_error($CO));
    $message_ajout = "<b>Bien ajouté</b>";
}

?>

<center>
<table border class="comm">
   <tr>
   <td id="tout">
   <center>
   <form method=post> 
     <p span id="orange">Titre de l'article: <br><textarea autofocus type="text" name="titre" class="input1" placeholder="titre" /></textarea></p> 
      <p span id="orange">Commentaire: <br /><textarea name="commentaire" rows="10" cols="60" class="input2" placeholder="Votre commentaire"></textarea></p> 
	  <p span id="orange">Catégorie :</p>
	  <select name="categorie" class="cat"> 
      <option id="gris">--Coaching Entreprise--
	  <option value=1>Prise de parole en public
      <option value=2>Média training 
      <option value=3>Leadership
      <option value=4>Cohésion d'équipe
      <option value=5>Mise en scène d'événements spectacle sur mesure 
      <option value=6>Dynamiques collaboratives
      <option value=7>Théâtre Forum
      <option value=8>Prise de post
      <option id="gris">--Coaching Scolaire Etudiant--
      <option value=9>Coaching Scolaire Etudiant
      <option value=10>Autonomie
      <option value=11>Confiance / Estime de soi
      <option value=12>Motivation apprentissage
      <option value=13>Préparation examen
      <option value=14>Atelier Parentalité
      <option value=15>Théâtre forum
      <option id="gris">--Autre--
      <option value=16>Actualité
      <option value=17>Qui sommes nous ?         	
	  </select>
	  <br>

      <!--<p span id="orange">Choisissez une photo avec une taille inférieure à 2 Mo.</p> 
      <input type="file" name="photo"> 
      <br/><br/> -->
	  <br>
<input type="submit" value="Envoyer" class="button">  
<br>
   </form>
   <br> 
   </table><br>
    	<p class="titredepages">Voit tout les postes :</p>

    	<?php
    $sql = "SELECT * from article where art_categorie = 1 or 2 or 3 or 4 or 5 or 6 or 7 or 8 or 9 or 10 or 11 or 12 or 13 or 14";
	$rs_articles = mysqli_query($CO, $sql) or die(mysqli_error($CO));
	while ($article = mysqli_fetch_array($rs_articles))
	{
		$titre = $article['art_titre'];
		$commentaire = $article['art_commentaire'];
        $categorie = $article['art_categorie'];
	    $date = $article ['art_date'];
		$a = $article['art_id'];
		echo "<br><table class='comm'>
		<tr><td height=20px colspan=2><center><p><b><i>".$titre."</i></b></p></center>
		<tr><td height=80px><center> <p> ".$commentaire."</p> </center></center>   
		";
		{
		echo "<a class='input1' href='pages/modif.php?id=".$a."'>Modifier</a>";
		}
		echo "</table><br>";
		}
		echo " </table><br><br> ";

		?>
    </div>
</div>


