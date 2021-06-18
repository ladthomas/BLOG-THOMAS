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
$ReqSelect = $bdd->prepare("SELECT * FROM userdb WHERE id =".$_GET['id']);
$ReqSelect->execute();
$datas = $ReqSelect->fetch();
//LIST USER //
$UserList = $bdd->prepare("SELECT * FROM userdb ");
$UserList->execute();
//Inscription//
if(isset($_POST["Send"])) {
    $name = htmlspecialchars($_POST["firstname"]);
    $prenom = htmlspecialchars($_POST["lastname"]);
    $mail = htmlspecialchars($_POST["mail"]);
    $password1 = sha1($_POST["password1"]);
    $password2 = sha1($_POST["password2"]);

    if($password1 == $password2){

        $ReqInsert = $bdd->prepare("INSERT INTO userdb (nom,prenom,email,motdepasse,is_Admin) VALUES(?,?,?,?,'non')");
        $ReqInsert->execute(array($name,$prenom,$mail,$password1));
        // $ReqInsert->closeCusor();
        echo "Donnée envoyez avec succès";
        header('location: userList.php?id='.$_GET['id']);
    }else{
        echo "les deux mot de passe ne correspondent pas!";
    }
    
}
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
?><span style="color:red;text-transform:uppercase;"><?= $datas['nom'] ?></span>
<a href="userspace.php?id=<?= $_GET['id'] ?>">Actualités</a>
 <?php
if($datas['is_Admin'] == "yes"){
    ?>
    <a href="articlesList.php?id=<?= $_GET['id'] ?>">Liste des articles</a>
    <a   style="color: #FFFA47;"href="userList.php?id=<?= $_GET['id'] ?>">Liste des utilisateurs</a>
    <a href="categoryList.php?id=<?= $_GET['id'] ?>">Liste des Categories</a>
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
<hr>

    <center>
        <h2>Ajouter un utilisateur</h2>
        <hr>
<form action="" method="post">
            <input type="text" name="firstname" id="" placeholder="Nom">
           
            <input type="text" name="lastname" id="" placeholder="Prénom">
            
            <input type="mail" name="mail" id="" placeholder="Email">
            
            <p><input type="password" name="password1" id="" placeholder="Mot de passe "> - <input type="password" name="password2" id="" placeholder = "Confirmation de mot de passe "></p>            
            <br>
            <input class="btn-btn-sbmit" type="submit" name="Send" value="Send">
</form>
<br>
<hr>
        <h2>Liste des utilisateur</h2>
        <hr>
        <?php
            while($datas = $UserList->fetch()){
                if($datas['id'] != $_GET['id']){
                    //Update Data //
                    if(isset($_POST['Màj'])){
                        $nom = htmlspecialchars($_POST['nom']);
                        $prenom = htmlspecialchars($_POST['prenom']);
                        $mail = htmlspecialchars($_POST['mail']);
                        $Is_Admin = htmlspecialchars($_POST['is_Admin']);
                        $Update = $bdd->prepare("UPDATE `userdb` SET `nom` = '$nom', `prenom` = '$prenom', `email` = '$mail' , `is_Admin` = '$Is_Admin' WHERE `userdb`.`id` =".$datas['id']);
                        $Update->execute();
                        header('location: userList.php?id='.$_GET['id']);
                    }
                    
                    
                    ?>
                    <form action="" method="post">

                    <p>Nom : <input type="text" name="nom" id="" value="<?= $datas['nom'] ?>"> 
                        || Prenom : <input type="text" name="prenom" id="" value="<?= $datas['prenom'] ?>">  
                        || Email :  <input type="text" name="mail" id="" value="<?= $datas['email'] ?>">
                        || Admin :  <select name="is_Admin" id="cars">
                        <?php
                         if($datas['is_Admin'] == "yes"){
                             ?>
                            <option  value="yes" >yes</option>
                            <option  value="no">no</option>
                             <?php
                         }else{
                        ?>
                            <option value="no">no</option>
                            <option value="yes">yes</option>
                            </select>
                        <?php
                        }
                        ?>

                        || <a  href="deleteUser.php?id=<?= $datas['id']?>&userData=<?= $_GET['id'] ?>"> Supp</a> <br>
                        <input type="submit" name="Màj" value="Màj">
                        </p>
                    </form>
                    
                    <?php
                
             }
            }
        ?>
    </center>
</body>
</html> 