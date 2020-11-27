<?php

require_once('header.php');
require_once('sidebar.php');
require_once('functions_panier.php');
//require_once('paypal.php');

$erreur = false;
$action = (isset($_POST['action'])?$_POST['action']:(isset($_GET['action'])?$_GET['action']:null));
if($action!==null){
    if(!in_array($action,array('ajout','suppression','refresh')))

        $erreur=true;

        $l = (isset($_POST['l'])?$_POST['l']:(isset($_GET['l'])?$_GET['l']:null));
        $q = (isset($_POST['q'])?$_POST['q']:(isset($_GET['q'])?$_GET['q']:null));
        $p = (isset($_POST['p'])?$_POST['p']:(isset($_GET['p'])?$_GET['p']:null));

        $l = preg_replace('#\v#','',$l);
        $p = floatval($p);

        if(is_array($q)){

            $QteArticle= array();

            $i=0;

            foreach($q as $contenu){
                $QteArticle[$i++] = intval($contenu);

            }

        }else{
            $q= intval($q);
        }

        
    }

if(!$erreur){
    switch($action){
        case'ajout':
            ajouterArticle($l,$q,$p);

        break;

        case"suppression";

        supprimerArticle($l);

        break;

        case"refresh";

        for($i=0;$i<count($QteArticle);$i++){
            modifierQTeArticle($_SESSION['panier']['libelleProduit'][$i],round($QteArticle[$i]));
        }

        break;

        defaut:

        break;


    }
}
?>

<form method="post" action="">
    <table width="400">
        <tr>
            <br/>
         <td colspan="4"><h2>Votre panier</td></h2>
        </tr>
        <tr>
            <td>Libéllé produit</td>
            <td>Prix unitaire</td>
            <td>Quantité</td>
            <td>Action</td>
            
         </tr>
         <?php
            
         
        if(isset($_GET['deletepanier']) && $_GET['deletepanier'] == true){
            supprimerPanier();
        }

        if(creationPanier()){

        $nbProduits = count($_SESSION['panier']['libelleProduit']);

            if($nbProduits <= 0){

                echo '<br><h1> Panier vide... </h1>';
            }else{

                    for($i =0; $i<$nbProduits; $i++){

                        ?>

                    <tr>

                    <td><br/><?php echo $_SESSION['panier']['libelleProduit'][$i];?></td>
                    <td><br/><?php echo $_SESSION['panier']['prixProduit'][$i]."€";?></td>
                    <td><br/><input name="q[]" value="<?php echo $_SESSION['panier']['qteProduit'][$i]?>"size="5"/></td><br/>
                    <td><br/><a href="panier.php?action=suppression&amp;l=<?php echo rawurlencode($_SESSION['panier']['libelleProduit'][$i]);?>">supprimer</a></td><br/>
                   
                    </tr>
                    <?php }?>
                    <tr>

                   <td colspan="2"><br/>
                   <p>Total: <?php echo MontantGlobal()."€";?></p><br/>
                 
                   <?php if(isset($_SESSION['user_id']) AND !empty($_SESSION['user_id'])){ ?>
                    <a href="my_account.php">Payer la commande</a>
                    <?php
                }
                else{?> <h5 style="color:red;">vous devez etre connecter pour payer votre commande</h5>  
                <?php
                }
            ?>  
 
                    </td>
                     </tr>

                    <tr>
                        <td colspan="4" ><br/>
                        <input type="submit" value="rafraichir"/>
                        <input type= "hidden" name="action" value="refresh"/>
                        <a href ="?deletepanier=true">Supprimer le panier </a>
                    </td>
                  
                  
                    </tr>

                        <?php
                    
            }
             }
         ?>
</table>
</form>


<?php

echo'<br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>';
require_once('footer.php');


?>