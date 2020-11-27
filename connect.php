<?php
require_once('header.php');

if(!isset($_SESSION['user_id'])){

if(isset($_POST['submit'])){

$email = $_POST['email'];
$passeword= $_POST['password'];

if($email&&$passeword){
    $select = $bd->query("SELECT id FROM users WHERE email ='$email'");
    if($select->fetchColumn()){

        $select = $bd->query("SELECT * FROM users WHERE email ='$email'");
        $result = $select->fetch(PDO::FETCH_OBJ);
        $_SESSION['user_id']= $result->id;
        $_SESSION['user_name']= $result->username;
        $_SESSION['user_email']= $result->email;
        $_SESSION['user_password']= $result->password;
        header('location:header.php');

    }else{
        echo'mauvais identifiant';
    }
}else{
    echo'Veuillez remplir tout les champs';
}

}
?>

<br/>
<h1> Se connecter </h1>
<form action ="" method="POST">
    <h4>votre email <input type="email" name="email"/></h4>
    <h4> votre mot de passe <input type ="password" name="password"/></h4>
    <input type ="submit" name="submit"/>
</form>
<a href ="register.php">S'inscrire</a>
<br/>

<?php

}else{

    header('location:my_account.php');
}
echo'<br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>';
require_once('footer.php');


?>













