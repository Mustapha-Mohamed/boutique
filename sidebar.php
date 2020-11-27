<div class="sidebar">
<h3>Derniers Articles</h3>

<?php




$select = $bd->prepare("SELECT * FROM products ORDER BY id DESC LIMIT 0,2"); 
$select->execute();
while($s=$select->fetch(PDO::FETCH_OBJ)){

    $lenght=30;
    $description = $s->description;
    $new_description=substr($description,0,$lenght)."...";
    $description_finale=wordwrap($new_description,25,'<br/>',false);


?>

<div style ="text-align:center;">
<img height ="50" width ="50" src="admin/imgs/<?php echo $s->title; ?>.jpg"/>
<h2><?php echo $s->title;?></h2><br/>
<h5><?php echo $description_finale;?></h5><br/>
<h4><?php echo $s->price;?>€</h4><br/></div>
<br/><br/>



<?php


}


?>


</div>
</div>