<?php

require_once('header.php');

?>


<?php

$articles = $bd->query("SELECT title, description FROM products ORDER BY id DESC");
if(isset($_GET['q']) AND !empty($_GET['q'])){

    $q=htmlspecialchars($_GET['q']);
    $q = trim($q); //pour supprimer les espaces dans la requête de l'internaute
    $q_array= explode(' ',$q);
    //var_dump($q_array);
    $articles = $bd->query("SELECT title, description FROM products WHERE title LIKE '%$q%' ORDER BY id DESC ");
    //var_dump($bd);
    //var_dump($articles);
    //var_dump($q);
    
}else{


    
}



?>

<form method="GET">
<input  type ="search" name="q" placeholder="Recherche..." id="search" > 
<input type ="submit"  name="a" value="valider">

</form>







<?php
if(isset($_GET['q']) AND !empty($_GET['q'])){?>
<?php if($articles->rowCount() > 0){?>
<?php?>
<ul>
<?php while($s=$articles->fetch(PDO::FETCH_OBJ)){
    ?>
  <h2> <li><?php echo $s->title?></li></h2>
   <img height ="160" width ="160" src="admin/imgs/<?php echo $s->title; ?>.jpg"/>
   
   <h4><li><?php echo $s->description?></li></h4>
 
<?php } ?>

</ul>

<?php

}else{ ?> aucun resultat


<?php
}
}
?>


<?php
    
    echo'<br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>';
require_once('footer.php');

?>


