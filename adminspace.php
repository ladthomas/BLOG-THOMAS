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
    <link rel="stylesheet" href="css/main.css">
    <!-- <meta name="viewport" content="width=device-width, initial-scale=1.0"> -->
    <title>Document</title>
</head>
<body>
    <center>
    <h1>INSCRIPTION</h1>
    <form action="" method="post">
            <h4>Nom :</h4>
            <input type="text" name="firstname" id="">
            <h4>Prénom :</h4>
            <input type="text" name="lastname" id="">
            <h4>Email :</h4>
            <input type="mail" name="mail" id="">
            <h4>Mot de passe :</h4>
            <input type="password" name="password1" id="">
            <h4>Confirmer votre mot de passe :</h4>
            <input type="password" name="password2" id="">
            <br>
            <input type="submit" name="Send" value="Send">
    </form>
    </center>
</body>
</html>