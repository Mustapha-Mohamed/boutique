
<?php

session_start();

$user="mouss";
$password_definit="mouss";
if(isset($_POST['submit'])){

$username = $_POST['username'];
$password = $_POST['password'];

if($username&&$password){
    if($username==$user&&$password==$password_definit){
        $_SESSION['username']=$username;
        header('location: admin.php');
    }
    else{
        echo'identifiants eronnées';
    }
}
    else{
        echo'veuillez remplir tout les champs !';
    }
}




?>


<h1>Administration - connexion  </h1>
<link rel="icon" type="image/jpg" href="images/ecommerce.jpg">
<link rel="stylesheet" href="index.css"/>
<form action="" method="POST">
<h3>Pseudo :</h3><input type="text" name="username"/><br/><br/>
<h3>Mot-de-passe: </h3><input type="password" name="password"/><br/><br/>
<input type="submit" name ="submit"/><br/><br/>
</form>
