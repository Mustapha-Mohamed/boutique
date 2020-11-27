<?php
require_once('header.php');


if(!isset($_SESSION['user_id'])){

if(isset($_POST['submit'])){

$username= $_POST['username'];
$email= $_POST['email'];
$password = $_POST['password'];
$repeatpassword = $_POST['repeatpassword'];
$pays= $_POST['pays'];
$ville= $_POST['ville'];
$adresse= $_POST['adresse'];
$nom= $_POST['nom'];
$prenom= $_POST['prenom'];
$telephone= $_POST['telephone'];


if($username&&$email&&$password&&$repeatpassword){
    
    if($password==$repeatpassword){
        $bd->query("INSERT INTO users (username, email, password, pays,ville, adresse, nom, prenom, telephone) VALUES ('$username','$email','$password', '$pays','$ville','$adresse','$nom','$prenom','$telephone')");
        echo 'Vous avez créer votre compte';
    }else{
        echo'les mots de passe ne sont pas identiques';
    }
}else{
    echo'Veuillez remplir tout les champs';
}

}

?>
<body>
<br/>
<h1>S'enregistrer</h1>

<form action ="" method="POST">

    <h4>Votre pseudo <input type ="text" name="username"/></h4>
    <h4>Votre email <input type="email" name="email"/></h4>
    <h4>Votre mot de passe <input type="password" name="password"/></h4>
    <h4>Répétez votre mot de passe <input type="password" name="repeatpassword"/></h4>
    <h4>Votre pays <input type ="text" name="pays"/></h4>
    <h4>Votre ville <input type ="text" name="ville"/></h4>
    <h4>Votre adresse <input type ="text" name="adresse"/></h4>
    <h4>Votre nom <input type ="text" name="nom"/></h4>
    <h4>Votre prenom <input type ="text" name="prenom"/></h4>
    <h4>Votre telephone <input type ="tel" name="telephone"/></h4>
   
    <input type ="submit" name="submit"/>

</form>
</body>
<?php

}else{

    header('location:my_account.php');
}

echo'<br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>';
require_once('footer.php');

?>


