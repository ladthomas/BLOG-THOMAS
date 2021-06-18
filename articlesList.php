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
//GET DATA IN URL //

ini_set('display_errors','Off');
    //ReqSELECT //
    $ReqSelect = $bdd->prepare("SELECT * FROM userdb WHERE id =".$_GET['id']);
    $ReqSelect->execute();
    $data = $ReqSelect->fetch();   
    // ARTICLES AND IMAGES
    
    $ReqShowArticles = $bdd->prepare("SELECT * FROM `articles`");
    $ReqShowArticles->execute();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="./Assets/css/main.css">
    <!-- <meta name="viewport" content="width=device-width, initial-scale=1.0"> -->
    <title>Document</title>
</head>
<style>
    .sousHeader a {
        text-decoration: none;
        background-color: #312929;
        color: white;
        margin:20px;
        position: relative;
        right: 10px;
    }
    .sousHeader {
        width: 100%;
        background-color: #312929;
    }
    .body {
    background-color: white;
    padding: 50px;
    height: 800px;
}
body{
    background-color:white;
}
</style>
<body>
<div class="header">
        <center>
            <a class="" href="#">ACTUALITES</a>

            <a href="#">COURANTS MUSICAUX</a>

            <img src="./Assets/IMAGES/665307d67b6f5375d30c6f46cd020420 (2).jpg" class="img-header"    alt="" srcset="">

            <a href="#">BIOGRAPHIE</a>

            <a href="topten.html">TOP 10</a>

            <span>

            <a href="#"><i class='fa fa-search' style='font-size:24px'></i></a>

            <a style ="padding-left: 0px;" href="#"><i class="fa fa-user" style="font-size:23px"></i></a>

            </span>            
        </center>
    </div>
<div class="sousHeader">
    <center>
    <?php 
    if(isset($_GET['id']) AND $_GET['id'] > 0){
?><span style="color:red;text-transform:uppercase;"><?= $data['nom'] ?></span>
<a href="userspace.php?id=<?= $_GET['id'] ?>">Actualités</a>
 <?php
if($data['is_Admin'] == "yes"){
    ?>
    <a style="color: #FFFA47;" href="articlesList.php?id=<?= $_GET['id'] ?>">Liste des articles</a>
    <a href="userList.php?id=<?= $_GET['id'] ?>">Liste des utilisateurs</a>
    <a href="categoryList.php?id=<?= $_GET['id'] ?>">Liste des Categories</a>
    <a  href="newletter.php?id=<?= $_GET['id'] ?>">NewsLetter</a>
    <?php
}
?>
    
    <a href="profilUpdate.php?id=<?= $_GET['id'] ?>">Profil</a>
    <a href="postArticles.php?id=<?= $_GET['id'] ?>">Poster Articles</a>
    <a href="login.php">Deconnexion</a>
<?php
}else{
?>    
<a href="login.php">Connexion</a>
<?php
}
?>
    </center>

</div>
<div class="body">

    <h2>List des Articles</h2>
    <div class="wrapper-colonne">
    <?php
    
while ($dataReqShowArticles = $ReqShowArticles->fetch()){
    ?>
    <div style="margin:20px;" class="cols">    
    <a style="position:relative;right:-180px;height:20px;" href="suppression.php?id=<?= $dataReqShowArticles['id'] ?>&com=<?= $dataReqShowArticles['posteur'] ?>&nom=<?= $data['nom']?>&img=<?= $dataReqShowArticles['images'] ?>&id_moi=<?= $_GET['id'] ?>">Delete</a>
    <br><br>

    <img style="width:250px;"src="<?= $dataReqShowArticles['images'] ?>" alt="" srcset="">
        
    <h4><?= $dataReqShowArticles['titre'] ?></h4>
    <p>Categories <?= $dataReqShowArticles['categories'] ?></p>
    <p style="font-size:10px;">publier à <?= $dataReqShowArticles['date'] ?></p>
    <?php
    if(!empty($_GET['id'])){
    ?>
     <form action="commentback.php" method="get">
    <input style="display:none;" type="text" name="idArt" id="" value="<?= $dataReqShowArticles['id'] ?>">
    <input style="display:none;" type="text" name="idUser" id="" value="<?= $data['id'] ?>">
    <input style="display:none;" type="text" name="idBlog" id="" value="<?= $data["nom"] ?>">
    <input style=" border:5px;border-color:gray;" type="text" name="reply" id="" placeholder="Commenter ici ...">
    <input style=" width:70px;height:20px;background-color:black;color:white;border:0px;border-radius:10px;" type="submit" name="envoyez" value="envoyez">
    </form>
    <br>
    <?php
    }
   ?>
    <div style="height:90px;overflow:scroll;background-color:gray;">
    <?php
    $SelectCom = $bdd->prepare("SELECT *  FROM commentaire WHERE idArticles =".$dataReqShowArticles['id']);
    $SelectCom->execute();
    while ($dataReqCom = $SelectCom->fetch()){

        ?>
        <br>
        <span><?= $dataReqCom['posteur']?></span>:
        <span><?= $dataReqCom['messages']?></span><br>
       
        
        <?php
    
}?>

</div>


</div>
<?php
    
}
    ?>
</div>
</body>
</html>