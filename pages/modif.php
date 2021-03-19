<?php include "../include/entete.php";?>
 
   <?php

// function is_authentified() { return isset($_COOKIE['admin_id']); } 


// if(!is_authentified())
// {
//         header('location:index.php');
// }

$id = $_GET['id'];

   $iduser = $_COOKIE['admin_id'];
    /*$sql =   "insert into article (art_titre, art_commentaire, art_categorie, `art_date`,art_idadmin )
     values (".$titre.", ".$description.",".$categorie.", NOW(), ".$iduser.")";
   mysqli_query($CO, $sql) or die(mysqli_error($CO));*/
    $message_ajout = "<b>Bien ajouté</b>";
$bdd = new PDO("mysql:host=impactcowuromain.mysql.db;dbname=impactcowuromain;charset=utf8", "impactcowuromain", "Kingman21");


    $sql = "SELECT * from article where art_id = ". $id;

  $rs_articles = mysqli_query($CO, $sql) or die(mysqli_error($CO));
  while ($article = mysqli_fetch_array($rs_articles))
  {
    $article_titre = $article['art_titre'];
    $article_contenu = $article['art_commentaire'];
        $categorie = $article['art_categorie'];
      $date = $article ['art_date'];
    $a = $article['art_id'];


  }
  if(isset($_POST['btnModifier'])){
   if(!empty($_POST['art_titre']) AND !empty($_POST['art_commentaire'])) {
      $article_titre = htmlspecialchars($_POST['art_titre']);
      $article_contenu = htmlspecialchars($_POST['art_commentaire']);

         $message = 'Votre article a bien été posté';
         $update = $bdd->prepare('UPDATE article SET art_titre = ?, art_commentaire = ? WHERE art_id = ?');
         $update->execute(array($article_titre, $article_contenu, $id));
         header('Location:../index.php');
         $message = 'Votre article a bien été mis à jour !';
      
   } else {
      $message = 'Veuillez remplir tous les champs';
   }
 }
 if(isset($_POST['supprimer'])){
   $suppr = $bdd->prepare('DELETE FROM article WHERE art_id = :id');
   $suppr->bindValue(':id', $id,PDO::PARAM_INT);
   $suppr->execute();
   header('Location:../index.php');
 }
// $bdd = new PDO("mysql:host=127.0.0.1;dbname=article;charset=utf8", "root", "");
// $mode_edition = 0;
// if(isset($_GET['edit']) AND !empty($_GET['edit'])) {
//    $mode_edition = 1;
//    $edit_id = htmlspecialchars($_GET['edit']);
//    $edit_article = $bdd->prepare('SELECT * FROM article WHERE id = ?');
//    $edit_article->execute(array($edit_id));
//    if($edit_article->rowCount() == 1) {
//       $edit_article = $edit_article->fetch();
//    } else {
//       die('Erreur : l\'article n\'existe pas...');
//    }
// }



?>
 <div class="accueil">

 <div class="commentaire">
  <br><table class='comm'>

 <form method="post">
    <tr><td height=30px colspan=2><center><p><b><i>Titres :</i></b></p> <input type="text" class="input1" name="art_titre" value="<?= $article_titre ?>"></td></center>
    <tr><td height=100px><center><br><p><b><i>Commentaire :</i></b></p><textarea type='text' name='art_commentaire' class='input2' cols="80" rows="8" ><?= $article_contenu ?></textarea> </p> </center>
    <tr><td colspan=2 height=30px><center><p><i>Poster le : <?= $date?></i></p>   
      <select name='categorie'>
         <option value="<?= $categorie ?>"></option>
      </select>
            </center>  
            <input type="submit" value='Modifier' name="btnModifier" class='input1'>
            <input type="submit" value='Supprimer' name="supprimer" class='input1'>
  </form>
</div></table>
   <br /></div></div>
   <?php if(isset($message)) { echo $message; } ?>
<?php include "../include/footer.php";?>