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

ini_set('display_errors','Off');
// unlink("ok.txt");
//GET DATA IN URL //

if(isset($_GET["id"])){
    $ReqShowCategorie = $bdd->prepare("SELECT * FROM `categories`");
    $ReqShowCategorie->execute();
    
    //ReqSELECT //
    $ReqSelect = $bdd->prepare("SELECT * FROM userdb WHERE id =".$_GET['id']);
    $ReqSelect->execute();
    $data = $ReqSelect->fetch();
    $count = $ReqSelect->rowCount();
    if($count == 1){
        if(isset($_POST["submit"])){

    // ARTICLES AND IMAGES
    $target_dir = "upload/";
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    
    $titre = htmlspecialchars($_POST['titre']);
    $resume = htmlspecialchars($_POST['resume']);
    $contenu = htmlspecialchars($_POST['contenu']);
    $categories = htmlspecialchars($_POST['categories']);
    

        // Verification de l'image
    if(isset($_POST["submit"])) {

        $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
        if($check !== false) {
            echo "";
            $uploadOk = 1;
        } else {
            echo "";
            $uploadOk = 0;
        }
        }
    
        // Si le fichier exist deja
        if (file_exists($target_file)) {
        echo "";
        $uploadOk = 0;
        }
    
        // Taille du fichier
        if ($_FILES["fileToUpload"]["size"] > 1000000) {
        echo "";
        $uploadOk = 0;
        }
    
        // Format autorisé
        if($imageFileType != "jpg" && $imageFileType != "JPEG" && $imageFileType != "JPG" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif" ) {
        echo "";
        $uploadOk = 0;
        }
        if( $uploadOk != 0){
            move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file);
            $ReqInsert = $bdd->prepare("INSERT INTO 
            `articles` (`id`, `titre`, `resumee`, `contenu`, `categories`,
             `images`, `actif`,`posteur`, `date`) 
            VALUES (NULL, ?, ?, ?, ?, ?, 'oui',?,
             current_timestamp());");
            $ReqInsert->execute(array($titre,$resume,$contenu,$categories,$target_file,$_GET['id']));
            echo "";
        }elseif(empty($_POST['fileToUpload'])){   
            $ReqInsert = $bdd->prepare("INSERT INTO 
            `articles` (`id`, `titre`, `resumee`, `contenu`, `categories`,
             `images`, `actif`,`posteur`, `date`) 
            VALUES (NULL, ?, ?, ?, ?, ?, 'oui',?,
             current_timestamp());");
            $ReqInsert->execute(array($titre,$resume,$contenu,$categories,$target_file,$_GET['id']));
            echo "";
        }else{
            echo "";
        }
        
} 

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
    <a   href="newletter.php?id=<?= $_GET['id'] ?>">NewsLetter</a>
    <?php
}
?>
    
    <a href="profilUpdate.php?id=<?= $_GET['id'] ?>">Profil</a>
    <a style="color: #FFFA47;" href="postArticles.php?id=<?= $_GET['id'] ?>">Poster Articles</a>
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
</div>
    <center>
    <h4 style="color:white;">POST ARTICLES</h4>
    <form method="post" enctype="multipart/form-data">

    <input type="text" name="titre" id="" placeholder="titre" required> ||
     <span style="color:white;font-size:20px;"> Category :</span>     
    <select name="categories" id="cars">
    <?php
    
    while ($dataReqShowCategorie = $ReqShowCategorie->fetch()){
        ?>
    <option><?= $dataReqShowCategorie["nom"] ?></option>
    <?php 
    }
    ?>
    </select>
    <br>
    <textarea name="resume" id="" cols="30" rows="10" placeholder="Résumé" required></textarea>
    <textarea name="contenu" id="" cols="30" rows="10" placeholder="Contenu" required></textarea>
    <br>
    Select image to upload:
    <input type="file" name="fileToUpload" id="fileToUpload"> <br>
    <input type="submit" value="Soumettre" class="btn-btn-sbmit" name="submit">
    </form>
    </center>
    <br><br><br><br>
</body>
</html>
<?php
}}
?>