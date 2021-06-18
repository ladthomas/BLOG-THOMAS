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
   if ( isset( $_GET['id'] ) ) {
    /* récupérer les données du formulaire en utilisant 
       la valeur des attributs name comme clé 
      */
    $idDelet = $_GET['id']; 
    $userAdmin = $_GET['CatData'];
    // afficher le résultat
    $ReqArt = $bdd->prepare("DELETE FROM `categories` WHERE `categories`.`id` =".$userAdmin);
    $ReqArt->execute();
   ;
    header('location: categoryList.php?id='.$idDelet);
    exit;
 }
?>