<?php

function creationPanier(){

    try
{

$bd = new PDO('mysql:host=localhost; dbname=boutique-en-ligne', 'root', '');
$bd->setAttribute(PDO::ATTR_CASE, PDO::CASE_LOWER);
$bd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

}
catch(Exception $e){
    die('une erreur est survenue');
}


if(!isset($_SESSION['panier'])){

    $_SESSION['panier']=array();
    $_SESSION['panier']['libelleProduit']=array();
    $_SESSION['panier']['qteProduit']=array();
    $_SESSION['panier']['prixProduit']=array();
    $_SESSION['panier']['verrou']=false;
   // $select =$bd->query("SELECT tva FROM products");
   // $tva = $select->fetch(PDO::FETCH_OBJ);
    //$_SESSION['panier']['tva']= $tva;

}

return true;

}

function ajouterArticle($libelleProduit,$qteProduit,$prixProduit){
    if(creationPanier()&& !isVerouille())
    {
        $positionProduit = array_search($libelleProduit,$_SESSION['panier']['libelleProduit']);
        if($positionProduit !== false){

            $_SESSION['panier']['qteProduit'][$positionProduit]+= $qteProduit;

        }else{

            array_push($_SESSION['panier']['libelleProduit'],$libelleProduit);
            array_push($_SESSION['panier']['qteProduit'],$qteProduit);
            array_push($_SESSION['panier']['prixProduit'],$prixProduit);
        }


    }else{

        echo 'Erreur, veuillez me contacter';
    }
}

function modifierQTeArticle($libelleProduit,$qteProduit){
         //si le panier existe
    if(creationPanier() && !isVerouille()){
       // si la quantité est positive on modifie sinon on supprime l'article
        if($qteProduit>0){
            //recherche du produit dans le panier
            $positionProduit = array_search($libelleProduit, $_SESSION['panier']['libelleProduit']);

            if($positionProduit!==false){
                $_SESSION['panier']['qteProduit'][$positionProduit] = $qteProduit;
            }
        }else{

            supprimerArticle($libelleProduit);
        }
    }else{

        echo'Erreur, veuillez me contacter';
    }
}

function supprimerArticle($libelleProduit){

    if(creationPanier() &&!isVerouille()){

        $tmp=array();
        $tmp['libelleProduit']= array();
        $tmp['qteProduit']= array();
        $tmp['prixProduit']= array();
        $tmp['verrou']= $_SESSION['panier']['verrou'];

        for($i=0; $i <count($_SESSION['panier']['libelleProduit']); $i++){

            if($_SESSION['panier']['libelleProduit'][$i] !==$libelleProduit){

                array_push($tmp['libelleProduit'],$_SESSION['panier']['libelleProduit'][$i]);
                array_push($tmp['qteProduit'],$_SESSION['panier']['qteProduit'][$i]);
                array_push($tmp['prixProduit'],$_SESSION['panier']['prixProduit'][$i]);

            }
        }

        $_SESSION['panier'] = $tmp;
        unset($tmp);

    }else{

        echo'Erreur, veuillez me conatcter';
    }


}


function montantGlobal(){

    $total = 0;
    for($i=0; $i<count($_SESSION['panier']['libelleProduit']); $i++){
        $total +=$_SESSION['panier']['qteProduit'][$i]*$_SESSION['panier']['prixProduit'][$i];


    }

    return $total;
}



function montantGlobalTVA(){

    $total = 0;
    for($i; $i<count($_SESSION['panier']['libelleProduit']); $i++){
        $total +=$_SESSION['panier']['qteProduit'][$i]*$_SESSION['panier']['prixProduit'];


    }

    return $total +$total*$_SESSION['panier']['tva']/100;
}




function supprimerPanier(){
        unset($_SESSION['panier']);
    }





function isVerouille(){
    if(isset($_SESSION['panier']) && $_SESSION['panier']['verrou']){

        return true;

    }else{

        return false;
    }
}




function compterArticles(){

    if(isset($_SESSION['panier'])){

        return count($_SESSION['panier']['libelleProduit']);
    }else{

        return 0;
    }
}


?>