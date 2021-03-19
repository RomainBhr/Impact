 <div class="accueil">
 <div class="commentaire">
<td><br><center>
<h2 class="titredepages">Théâtre forum</h2>


 	<br>

<?php
    $sql = "SELECT * from article where art_categorie = 15";
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
                    <table  class='news'><hr width='95%' color='black'><tr><td  width=2000px><p id='noir'><b><i>".$titre."</i></b></p></center>
		<tr><td> <p id='noir'> ".$commentaire."</p> </center></center> </table><br>  
		";
		if (isset($_SESSION['user']))
		{
		echo "<a class='input1' href='pages/modif.php?id=".$a."'>Modifier</a>";
		}
}
		?><br>

<!-- 	 <tr><td id=dgb><center><p><i>Ajouté par l'utilisateur : $user</i></p></center> -->


 <!-- 		<tr><td colspan=2 height=30px><center><p><i>Poster le : ".$date."</i></p> --></div></div>