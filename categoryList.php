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
    
    $ReqShowCategorie = $bdd->prepare("SELECT * FROM `categories`");
    $ReqShowCategorie->execute();

    //INSERT CATEGORIE //
    if(isset($_POST['categorie'])){

        $categorie = htmlspecialchars($_POST['categorie']);

        $InsertCat = $bdd->prepare("INSERT INTO `categories`(`nom`) VALUES (?)");
        $InsertCat->execute(array($categorie));
        header('location: categoryList.php?id='.$_GET['id']);
    }

    //FIN//
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
    <a href="articlesList.php?id=<?= $_GET['id'] ?>">Liste des articles</a>
    <a href="userList.php?id=<?= $_GET['id'] ?>">Liste des utilisateurs</a>
    <a  style="color: #FFFA47;" href="categoryList.php?id=<?= $_GET['id'] ?>">Liste des Categories</a>
    <a href="newletter.php?id=<?= $_GET['id'] ?>">NewsLetter</a>
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
<form method="post">
<h3>Ajouter des categories</h3>
<input style="margin:2px;height:30px;border-radius:10px;padding-Left:5px;" type="text" name="categorie" id="" placeholder="Categorie ici"><br><br>
<input  style="background-color:red;color:white;height:30px;width:80px;border:0px;border-radius:20px;" type="submit" value="submit">
</form>

    <h2>Articles</h2>
    <?php
    
while ($dataReqShowCategorie = $ReqShowCategorie->fetch()){
    ?>
    
<p style="width:100%;height:20px;color:white;background-color:grey;padding:10px;">
<?= $dataReqShowCategorie['nom'] ?>
<a style="margin-left:85%;color:red;text-decoration:none;border-radius:40px;"href="deleteCategorie.php?id=<?= $_GET['id'] ?> &CatData=<?= $dataReqShowCategorie['id'] ?>"> Delete</a> </p>

<?php
    
}
    ?>
</div>
</body>
</html>