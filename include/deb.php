<!DOCTYPE html>
	<html>
		<head>
			<meta charset="utf-8" />
            <link rel="stylesheet" href="public/styles/style.css" />
            <link rel="stylesheet" href="../public/styles/style.css" />
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
			<title>Impact Coaching</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
            <style type="text/css">
                 body
            {
                color:black;
                background-color:white;
                background-image:url(public/images/3.png);
                background-repeat:no-repeat;
                background-attachment:fixed;
                position: absolute;
                top: 0;
                bottom: 0;
                left: 0;
                right: 0;
                height: 100%;
                margin:0;
                padding:0;
                background-size: 100% ;
                width:100%;
                color:black;
                zoom:100%;
            }
            
html{zoom:90%;}
            </style>

		</head>
	<body>
 <?php
    $CO = mysqli_connect("impactcowuromain.mysql.db","impactcowuromain",                                                                                                                                                                                                 "Kingman21",
    "impactcowuromain")or die (myslqi_connect_error());
    ?>  
	<div class="menu">

		<div class="menugauche">
			<p>IMPACT COACHING</p>
		</div>

			<div class="menucentre">
				<nav class="nav1">
 <ul>
          <li class="menu-acc"><a href="index.php" href="index.php"class="text3">
		Accueil</a></li>
          <li class="menu-even"><a href="index.php?cas=afficherAutres&categorie=qui_sommes_nous"class="text4">Qui sommes nous ?</a>

            </li>
          <li class="menu-even"><a href="#">Coaching entreprise</a>
                    <ul class="submenu">
                        <li><a href="index.php?cas=afficherEnt&categorie=Prise-de-parole-en-public">Prise de parole en public</a></li>
                        <li><a href="index.php?cas=afficherEnt&categorie=media-training">M??dia training</a></li>
                        <li><a href="index.php?cas=afficherEnt&categorie=Leadership">Leadership</a></li>
                        <li><a href="index.php?cas=afficherEnt&categorie=Cohesion-d-equipe">Coh??sion d'??quipe</a></li>
                        <li><a href="index.php?cas=afficherEnt&categorie=Mise-en-sc??ne-d-??v??nement-spectacle-sur-mesure">Mise en sc??ne d'??v??nements spectacle sur mesure</a></li>
                        <li><a href="index.php?cas=afficherEnt&categorie=Dynamiques-collaboratives">Dynamiques collaboratives </a></li>
                        <li><a href="index.php?cas=afficherEnt&categorie=Th????tre-Forum"> Th????tre Forum</a></li>
                        <li><a href="index.php?cas=afficherEnt&categorie=Prise-de-post">Prise de poste </a></li>
                    </ul> 
                </li>
        <li class="menu-even"><a href="#">Coaching Scolaire Etudiant</A>
            <ul class="submenu">
                     
                        <li><a href="index.php?cas=afficherSco&categorie=Autonomie">Autonomie</a></li>
                        <li><a href="index.php?cas=afficherSco&categorie=Confiance-Estime-de-soi">Confiance / Estime de soi</a></li>
                        <li><a href="index.php?cas=afficherSco&categorie=Motivation-apprentissage">Motivation apprentissage</a></li>
                        <li><a href="index.php?cas=afficherSco&categorie=Preparation-examen">Pr??paration examen</a></li>
                        <li><a href="index.php?cas=afficherSco&categorie=Atelier-Parentalite">Atelier Parentalit??</a></li>
                        <li><a href="index.php?cas=afficherSco&categorie=Theatre-forum">Th????tre forum</a></li>
                    </ul>
        </li>
        <li class="menu-acc"><a class="text4" href="index.php?cas=afficherAutres&categorie=actu">Actualit??</A></li>
          <li class="menu-acc"><a class="text4" href="index.php#contact">Contact</A></li>          <?php
session_start();
if (isset($_SESSION['user'])){
?>
     <li class='menu-even'><a href='index.php?cas=afficherNews&categorie=admin'>Admin</a>
            <ul class='submenu2'>
                        <li><a href='index.php?cas=afficherAdmin&categorie=inscription'> Ajouter un admin</a></li>
                        <li><a href='index.php?cas=afficherAdmin&categorie=deco'> D??connexion</a></li>
             </ul>
        </li>
<?php 
}
?> 
 </ul>
				</nav>
			</div>


				
	</div>
         


