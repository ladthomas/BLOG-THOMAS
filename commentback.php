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
   if ( isset( $_GET['envoyez'] ) ) {
     /* récupérer les données du formulaire en utilisant 
        la valeur des attributs name comme clé 
       */
     $idArt = $_GET['idArt']; 
     $idBlog = $_GET['idBlog']; 
     $msg = $_GET['reply'];
     $idUser = $_GET['idUser'];
     // afficher le résultat
     $ReqComment = $bdd->prepare("INSERT INTO commentaire(messages,posteur,idArticles) VALUES(?,?,?) ");
     $ReqComment->execute(array($msg,$idBlog,$idArt));
     header('location: userspace.php?id='.$idUser);
     exit;
  }
?>