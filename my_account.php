<?php

require_once('header.php');
require_once('sidebar.php');
?>
<h1>Mon Compte</h1>
<?php
$user_id=$_SESSION['user_id'];
$select = $bd->query("SELECT * FROM users WHERE id = '$user_id'");


while($s = $select->fetch(PDO::FETCH_OBJ)){
    ?>
    <h5>Pseudo : <?php echo $s->username; ?></h5>
    <h5>email : <?php echo $s->email; ?></h5>
    <h5>pays : <?php echo $s->pays; ?></h5>
    <h5>ville : <?php echo $s->ville; ?></h5>
    <h5>adresse : <?php echo $s->adresse; ?></h5>
    <h5>nom : <?php echo $s->nom; ?></h5>
    <h5>prenom : <?php echo $s->prenom; ?></h5>
    <h5>telephone : <?php echo $s->telephone; ?></h5>
    <?php

}

?>

<h2> Mes transactions: </h2>

<?php

$nbProduits = count($_SESSION['panier']['libelleProduit']);

    if($nbProduits <= 0){

        echo '<br><h5> Aucune transaction </h5>';
    }else{

            for($i =0; $i<$nbProduits; $i++){

                ?>
<td><br/><h5><?php echo $_SESSION['panier']['libelleProduit'][$i];?></h5></td>
<td><br/><h5><?php echo $_SESSION['panier']['prixProduit'][$i]."€";?></h5></td>
                  

<?php
}}
?>

<?php if(isset($_SESSION['user_id']) AND !empty($_SESSION['user_id'])){ ?>
                    <a href="cb.php">Payer la commande</a>
                    <?php
                }
                else{?> <h5 style="color:red;">vous devez etre connecter pour payer votre commande</h5>  
                <?php
                }
            ?>  

<br/><br/><br/><br/>


<a href="disconnect.php">se déconnecter</a>
<?php

echo'<br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>';
require_once('footer.php');

?>