<?php

session_start();



?>

<h1>Bienvenue, <?php echo $_SESSION['username'];?></h1><br/>
<link rel="icon" type="image/jpg" href="images/ecommerce.jpg">
 <link rel="stylesheet" href="index.css"/>
<a href="?action=add">Ajoutez un produit</a>
<a href="?action=modifyanddelete">modifier / supprimer un produit</a><br/><br/>

<a href="?action=add_category">Ajoutez une catégorie</a>
<a href="?action=modifyanddelete_category">modifier /supprimer une catégorie</a><br/><br/>

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

if(isset($_SESSION['username'])){
if(isset($_GET['action'])){
if($_GET['action']=='add'){

if(isset($_POST['submit'])){

    $stock=$_POST['stock'];
    $title=$_POST['title'];
    $description=$_POST['description'];
    $price=$_POST['price'];
    $img = $_FILES['img']['name'];
    $img_tmp = $_FILES['img']['tmp_name'];
    if(!empty($img_tmp)){
       
        
                 
        $image = explode('.', $img);
        $image_ext = end($image);
        if(in_array(strtolower($image_ext),array('png','jpg','jpeg'))===false){
            echo'veuillez rentrer une image ayant pour extension : png, jpg ou jpeg';
        }
        else{
            $image_size = getimagesize($img_tmp);
            //print_r($image_size);
            
            if($image_size['mime']=='image/jpeg'){

                $image_src = imagecreatefromjpeg($img_tmp);

            }else if($image_size['mime']=='image/png'){
            
                $image_src = imagecreatefrompng($img_tmp);
            }else{
                $image_src = false;
                echo'Veuillez rentrer une image valide';
            }
            
            $image_finale= $image_src;
            
            if($image_src!==false){
                $image_width=200;
                
                if($image_size[0]==$image_width){
                    
                    //$image_finale= $image_src;

                }
                
            }else{
                $new_width[0]=$image_width;
                $new_height[1] = 200;
                $image_finale = imagecreatetruecolor($new_width[0],$new_height[1]);
                imagecopyresampled($image_finale,$image_src,0,0,0,0,$new_width[0],$new_height[1],$image_size[0],$image_size[1]);
            }
            //var_dump($image_finale);
            imagejpeg($image_finale,'imgs/'.$title.'.jpg');
            }
        
    
        
        }else{

        echo'Veuillez rentrer une image';
   
  
}
    if($title&&$description&&$price&&$stock){
        $category=$_POST['category'];
        $insert = $bd->prepare("INSERT INTO products (title, description, price, stock, category) VALUES('$title','$description','$price','$stock','$category')"); 
        //var_dump($insert);
        //var_dump($bd);
        $insert->execute();

    }else {
    echo'veuillez remplir tout les champs';
}
}


?>
<form action="" method="post" enctype="multipart/form-data">
    <h3>Titre du produit :</h3><input type="text" name="title"/>
    <h3>description du produit :</h3><textarea type="text" name="description"> </textarea>
    <h3>Prix :</h3><input type="text" name="price"/><br/><br/>
    <h3>Image: </h3>
    <input type="file" name="img"/><br/><br/>
    <h3> categorie : </h3> <select name="category">
    <?php $select=$bd->query("SELECT * FROM category");

    while($s=$select->fetch(PDO::FETCH_OBJ)){
    ?>
    <option><?php echo $s->name; ?></option>
    <?php
}
?>

</select><br/><br/>
<h3>Stock:</h3><input type="text" name="stock"/><br/><br/>
<input type="submit" name="submit">
</form>
<?php

}else if($_GET{'action'}=='modifyanddelete'){

    
    $select = $bd->prepare("SELECT * FROM products"); 
    $select->execute();
    while($s=$select->fetch(PDO::FETCH_OBJ)){
        echo $s->title;
        ?>
        <a href="?action=modify&amp;id=<?php echo $s->id;?>">modifier</a>
        <a href="?action=delete&amp;id=<?php echo $s->id;?>">supprimer</a><br/><br/>
        <?php
    }

}else if($_GET{'action'}=='modify'){

 
    $id=$_GET['id'];
    $select = $bd->prepare ("SELECT * FROM products WHERE id=$id");
    $select->execute();

    $data = $select->fetch(PDO::FETCH_OBJ);

?>

<form action="" method="post">
    <h3>Titre du produit :</h3><input value="<?php echo $data->title;?>" type="text" name="title"/>
    <h3>description du produit :</h3><textarea type="text" name="description"><?php echo $data->description;?> </textarea>
    <h3>Prix :</h3><input value="<?php echo $data->price;?>" type="text" name="price"/><br/><br/>
    <h3>Stock:</h3><input type="text" value="<?php echo $data->stock;?>" name="stock"/><br/><br/>
    <input type="submit" name="submit">
</form>

<?php

if(isset($_POST['submit'])){

    $stock=$_POST['stock'];
    $title=$_POST['title'];
    $description=$_POST['description'];
    $price=$_POST['price'];

    $update= $bd->prepare("UPDATE products SET title='$title',description='$description',price='$price',stock='$stock' WHERE id=$id");
    $update->execute();

    header('Location: admin.php?action=modifyanddelete');


}

}else if($_GET{'action'}=='delete'){

    $id=$_GET['id'];
    $delete = $bd->prepare("DELETE FROM products WHERE id=$id"); 
    //var_dump($delete);
    $delete->execute();

    

}else if($_GET['action']=='add_category'){

if(isset($_POST['submit'])){

    $name = $_POST['name'];

    if($name){

       
        $insert = $bd->prepare("INSERT INTO category (name) VALUES('$name')"); 
        $insert->execute();
        //var_dump($insert);

    }else{

        echo'Veuillez remplir tous les champs';
    }


}


 ?>
<form action="" method="post">
 <h3>titre de la categorie: </h3><input type="text" name="name"/><br/><br/>
<input type="submit" name="submit" value="Ajouter"/>
</form>



<?php


}else if($_GET['action']=='modifyanddelete_category'){

      
    $select = $bd->prepare("SELECT * FROM category"); 
    $select->execute();
    while($s=$select->fetch(PDO::FETCH_OBJ)){
        echo $s->name;
        ?>
        <a href="?action=modify_category&amp;id=<?php echo $s->id;?>">modifier</a>
        <a href="?action=delete_category&amp;id=<?php echo $s->id;?>">supprimer</a><br/><br/>
        <?php
    }
    
    
}else if($_GET['action']=='modify_category'){


    $id=$_GET['id'];
    $select = $bd->prepare ("SELECT * FROM category WHERE id=$id");
    $select->execute();

    $data = $select->fetch(PDO::FETCH_OBJ);

?>

<form action="" method="post">
    <h3>Titre de la catégorie :</h3><input value="<?php echo $data->name;?>" type="text" name="name"/>
    <input type="submit" name="submit">
</form>

<?php

if(isset($_POST['submit'])){

    $name = $_POST['name'];

    $select = $bd->query("SELECT name FROM category WHERE id='$id'");
    //var_dump($bd);
    //var_dump($select);
   
    $result = $select->fetch(PDO::FETCH_OBJ);
    $update = $bd->prepare("UPDATE category SET name='$name' WHERE id=$id");
    $update->execute(); //var_dump($update);
    $id = $_GET['id'];
    $update = $bd->query("UPDATE products SET category='$name' WHERE category ='$result->name'");
    //var_dump($update);


    header('Location: admin.php?action=modifyanddelete_category');
}


}else if($_GET['action']=='delete_category'){

    $id=$_GET['id'];
    $delete = $bd->prepare("DELETE FROM category WHERE id=$id"); 
    //var_dump($delete);
    $delete->execute();
    header('Location: admin.php?action=modifyanddelete_category');

}else{

       
    die('une erreur s\'est produite.');

}

}else{



}


}else{
    hader('location: ../index.php');

}

?>



