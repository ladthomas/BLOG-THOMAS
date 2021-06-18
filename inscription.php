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

//ReqInsert User //
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
        header('location: login.php');
    }else{
        echo "les deux mot de passe ne correspondent pas!";
    }
    
}

//
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- <meta name="viewport" content="width=device-width, initial-scale=1.0"> -->
    <link rel="stylesheet" href="./Assets/CSS/main.css">
    <title>Document</title>
</head>
<style>
    body {
    background-image: url('./Assets/IMAGES/870x489_34-james-brown-getty-images.jpg');
    background-repeat:no-repeat;
    background-size: cover;
        }
</style>
<body>
    <img src="./Assets/IMAGES/665307d67b6f5375d30c6f46cd020420 (2).jpg" alt="">
    <center>
        <form method="post">
            <input type="text" name="firstname" id="" class="btn-btn-txt" placeholder="Nom">
            <br/><br/>
            <input type="text" name="lastname" id="" class="btn-btn-txt" placeholder="Prenom">
            <br/><br/>
            <input type="email" name="mail" id="" class="btn-btn-txt" placeholder="Adresse email">
            <br/><br/>
            <input type="password" name="password1" id="" class="btn-btn-txt" placeholder="Mot de passe">
            <br/><br/>
            <input type="password" name="password2" id="" class="btn-btn-txt" placeholder="Confirmation du Mot de passe">
            <br/><br/>
            <input type="submit" value="Send" class="btn-btn-sbmit">   
        </form>
        
    </center>
</body>
</html>