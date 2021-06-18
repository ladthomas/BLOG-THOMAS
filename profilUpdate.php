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
if(isset($_GET["id"])){
    $ReqSelect = $bdd->prepare("SELECT * FROM userdb WHERE id =".$_GET['id']);
    $ReqSelect->execute();
    $data = $ReqSelect->fetch();
    $count = $ReqSelect->rowCount();
    if($count == 1){

        if(isset($_POST["submit"])){
            $prenom = htmlspecialchars($_POST['prenom']);
            $email = htmlspecialchars($_POST["email"]);
            $bio = htmlspecialchars($_POST["biographie"]);
            
            if(isset($_POST['motdepasse'])){
             $motdepasse = sha1($_POST["motdepasse"]);   
            }else{
                $motdepasse = $date["motdepasse"];  
            }

            $UdpateData = $bdd->prepare("UPDATE `userdb` SET `nom` = 'Sara',
            `prenom` = '$prenom',
            `email` = '$email',
            `biographie` = '$bio',
            `motdepasse` = '$motdepasse',
            `is_Admin` = '".$data["is_Admin"]."' 
            WHERE `userdb`.`id` =".$_GET['id']);
            $UdpateData->execute();
            header('location: profilUpdate.php?id='.$_GET['id']);
        }
    //Cat
    $ReqShowCategorie = $bdd->prepare("SELECT * FROM `categories`");
    $ReqShowCategorie->execute();
    //
    //Abonnement 
    if(isset($_POST['newletter'])){
        $cat = htmlspecialchars($_POST['cat']);
        $InsertUserNL = $bdd->prepare("INSERT INTO `usernewsletter` (`id`, `mail`,`categorie`, `date`) VALUES (NULL, ?,?, current_timestamp());");
        $InsertUserNL->execute(array($data['email'],$cat));
    }
    //Desabonnement
    if(isset($_POST['newletters'])){

        $InsertUserNL = $bdd->prepare("DELETE FROM `usernewsletter` WHERE `usernewsletter`.`mail` = ?");
        $InsertUserNL->execute(array($data['email']));
    } 
    //SELECT USERNEWLETTER//
        $SelectUserNewLt = $bdd->prepare("SELECT * FROM `usernewsletter` WHERE mail = ? ");
        $SelectUserNewLt->execute(array($data['email']));
        $rowData = $SelectUserNewLt->rowCount();
    //FIN//

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="Assets/css/main.css">
    <!-- <meta name="viewport" content="width=device-width, initial-scale=1.0"> -->
    <title>Document</title>
    </head>
<style>

        textarea{
            border-radius: 20px;
            padding:20px;
            resize:none;
            margin-top:10px;
        }
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
    input {
        border:0px;
        width:200px;
        height:30px;
        background-color: white;
        margin:20px;
        padding:10px;
        border-radius:10px;
    }
    select {
        border:0px;
        width:200px;
        height:30px;
        border-radius:10px;
        padding:5px;
        background-color: white;
        margin:20px;
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
    <a href="categoryList.php?id=<?= $_GET['id'] ?>">Liste des Categories</a>
    <a href="newletter.php?id=<?= $_GET['id'] ?>">NewsLetter</a>
    <?php
}
?>
    
    <a   style="color: #FFFA47;" href="profilUpdate.php?id=<?= $_GET['id'] ?>">Profil</a>
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
<hr>
    <center>
    <h3 style="color:white;">Mise à Jour du Profil</h3>
    <form action="" method="post">
    <input type="text" name="nom" id="" value="<?= $data["nom"] ?>" disabled="disabled">
    <input type="text" name="prenom" id="" value="<?= $data["prenom"] ?>"><br>
    <input type="text" name="email" id="" value="<?= $data["email"] ?>">
    <input type="text" name="biographie" id="" value="<?= $data["biographie"] ?>" placeholder="biographie"><br>
    <input type="text" name="motdepasse" id="" placeholder="mot de passe">
    <br>
    <input type="submit" value="MàJ" name="submit" class="btn-btn-sbmit"> <br>
<?php if( $rowData == 0 ){
    ?>
        <select name="cat" id="cat">
    <?php
    
    while ($dataReqShowCategorie = $ReqShowCategorie->fetch()){
        ?>
        <option value="<?= $dataReqShowCategorie['nom'] ?>"><?= $dataReqShowCategorie['nom'] ?></option>
    <?php
        
    }
        ?>
    </select>
    <input type="submit" name="newletter" value="S'abonner à la Newsletter">
    <?php
}else{
?>
<input type="submit" name="newletters" value="Se desabonner à la Newsletter">
<?php
}
?>  
    </form>
    </center>
</body>
</html>
<?php
}
}
?>