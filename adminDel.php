<?php
try
{
	// On se connecte à MySQL
	$bdd = new PDO('mysql:host=localhost;dbname=ladthomas;charset=utf8', 'root', '');
}
catch(Exception $e)
{
	// En cas d'erreur, on affiche un message et on arrête tout
        die('Erreur : '.$e->getMessage());
}
   // Vérifier si le formulaire est soumis 

 if(isset($_GET['posteur'])){
     $idArt = $_GET['id'];
     $img = $_GET['img'];
     $posteur = $_GET['posteur'];
     $ReqArt = $bdd->prepare("DELETE FROM `articles` WHERE `articles`.`id` =".$idArt);
     $ReqArt->execute();
     unlink($_GET['img']);
     header('location: articlesList.php?id='.$_GET['posteur']);
     
 }
?>