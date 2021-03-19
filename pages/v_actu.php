 <div class="accueil">
 <div class="commentaire">
<td><br><center>
<h2 class="titredepages">Actualité</h2>


 	<br>

<?php
    $sql = "SELECT * from article where art_categorie = 16";
	$rs_articles = mysqli_query($CO, $sql) or die(mysqli_error($CO));
	while ($article = mysqli_fetch_array($rs_articles))
	{
		$titre = $article['art_titre'];
		$commentaire = $article['art_commentaire'];
        $categorie = $article['art_categorie'];
	    $date = $article ['art_date'];
		$user = $article['art_idadmin'];
		$a = $article['art_id'];
		echo "
                    <center><table  class='news'><hr width='95%' color='black'><tr><td  width=2000px><p id='noir'><b><i>".$titre."</i></b></p></center>
		<tr><td> <p id='noir'> ".$commentaire."</p>		<tr><td id=tout colspan=2 height=30px><center><p><i>Actu du : $date</i></p> </table><br>  </center></center>
		";
		if (is_authentified())
		{
		echo " <a class='input1' href='pages/admin/modif.php?id=".$a."'>Modifier</a><br>";
		}
}
		?><br>

<!-- 	 <tr><td id=dgb><center><p><i>Ajouté par l'utilisateur : $user</i></p></center> -->


 <!-- 		<tr><td colspan=2 height=30px><center><p><i>Poster le : ".$date."</i></p> --></div></div>