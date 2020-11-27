<?php

require_once('header.php');
require_once('sidebar.php');

?>

<?php
try
{

$bd = new PDO('mysql:host=localhost; dbname=boutique-en-ligne', 'root', '');
$bd->setAttribute(PDO::ATTR_CASE, PDO::CASE_LOWER);
$bd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

}
catch(Exception $e){
    die('une erreur est survenue');
}

for($i=0; $i<count($_SESSION['panier']['libelleProduit']);$i++){
    $product = $_SESSION['panier']['libelleProduit'][$i];
    $quantity = $_SESSION['panier']['qteProduit'][$i];
    $insert = $bd->query("INSERT INTO products_transactions Values('','$product','$quantity','$transaction_id')");
   
}



?>

<?php
require_once('functions_panier.php');

?>