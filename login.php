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

//ReqSelect User //
if(isset($_POST["mdp"])) {

    $mail = htmlspecialchars($_POST["email"]);
    $password = sha1($_POST["mdp"]);

        $ReqSelect = $bdd->prepare("SELECT * FROM userdb WHERE email = ? AND motdepasse = ? ");
        $ReqSelect->execute(array($mail,$password));
        $data = $ReqSelect->fetch();
        header('location: userspace.php?id='.$data["id"]); 
        
        
    
}

//
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="css/main.css">
    <!-- <meta name="viewport" content="width=device-width, initial-scale=1.0"> -->
    <link rel="stylesheet" href="Assets/css/main.css">
    <!-- <meta name="viewport" content="width=device-width, initial-scale=1.0"> -->
    <title>Document</title>
</head>
<body>
<style>
    body {
    background-image: url('./Assets/IMAGES/870x489_34-james-brown-getty-images.jpg');
    background-repeat:no-repeat;
    background-size: cover;
        }
</style>
<img src="./Assets/IMAGES/665307d67b6f5375d30c6f46cd020420 (2).jpg" style="width:150px" alt="">
    <center>
        <h1 style="color:white">Se connecter </h1>
        <form action="" method="post">
            <input  class="btn-btn-txt" type="mail" name="email" id="" placeholder="Email"> <br><br>
            <input class="btn-btn-txt" type="password" name="mdp" id="" placeholder="Mot de passe"><br>
            <br>
            <input class="btn-btn-sbmit" type="submit" name="submit" value="Connecte">
        </form>
        <a style="color:white;text-decoration:none;" href="index.php">Inscription</a> <br>
        <a style="color:white;text-decoration:none;"  href="userspace.php">Visitez sans inscription</a>
    </center>
</body>
</html>