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
   if ( isset( $_GET['idi'] ) ) {
    /* récupérer les données du formulaire en utilisant 
       la valeur des attributs name comme clé 
      */
    $idArt = $_GET['idi']; 
    $idCom = $_GET['com'];
    $idNom = $_GET['nom'];

    // echo $idNom, $idCom, $idArt;
    $ReqComment = $bdd->prepare("DELETE FROM `commentaire` WHERE idArticles = ".$idArt);
    $ReqComment->execute();
    // afficher le résultat
    $ReqArt = $bdd->prepare("DELETE FROM `articles` WHERE `articles`.`id` =".$idArt);
    $ReqArt->execute();
   ;
    unlink($_GET['img']);
    header('location: userspace.php?id='.$idCom);
    exit;
 }

 if(isset($_GET['id_moi'])){
     $idArt = $_GET['id'];
     $img = $_GET['img'];
     $posteur = $_GET['posteur'];
     $ReqArt = $bdd->prepare("DELETE FROM `articles` WHERE `articles`.`id` =".$idArt);
     $ReqArt->execute();
     unlink($_GET['img']);
     header('location: articlesList.php?id='.$_GET['id_moi']);
     
 }
?>