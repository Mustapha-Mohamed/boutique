<!DOCTYPE html>

<?php

session_start();

try
{

$bd = new PDO('mysql:host=localhost; dbname=boutique-en-ligne', 'root', '');
$bd->setAttribute(PDO::ATTR_CASE, PDO::CASE_LOWER);
$bd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

}
catch(Exception $e){
    die('une erreur est survenue');
}

?>

<html lang="fr">
<head>
    <meta charset="utf-8">
    <title>eCommerce - Ma boutique en ligne </title>
    <link rel="icon" type="image/jpg" href="images/ecommerce.jpg">
    <link rel="stylesheet" href="index.css"/>
<link href="css/bootstrap.css" rel='stylesheet' type='text/css' />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700,800' rel='stylesheet' type='text/css'>
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<script src="js/jquery.min.js"></script>
<!--<script src="js/jquery.easydropdown.js"></script>-->
<!--start slider -->
<link rel="stylesheet" href="css/fwslider.css" media="all">
<script src="js/jquery-ui.min.js"></script>
<script src="js/fwslider.js"></script>
<!--end slider -->
<script type="text/javascript">
   $(document).ready(function() {
            $(".dropdown img.flag").addClass("flagvisibility");

            $(".dropdown dt a").click(function() {
                $(".dropdown dd ul").toggle();
            });
                        
            $(".dropdown dd ul li a").click(function() {
                var text = $(this).html();
                $(".dropdown dt a span").html(text);
                $(".dropdown dd ul").hide();
                $("#result").html("Selected value is: " + getSelectedValue("sample"));
            });
                        
            function getSelectedValue(id) {
                return $("#" + id).find("dt a span.value").html();
            }

            $(document).bind('click', function(e) {
                var $clicked = $(e.target);
                if (! $clicked.parents().hasClass("dropdown"))
                    $(".dropdown dd ul").hide();
            });


            $("#flagSwitcher").click(function() {
                $(".dropdown img.flag").toggleClass("flagvisibility");
            });
        });
     </script>
</head>
<body>
<div class="header">
		<div class="container">
			<div class="row">
			  <div class="col-md-12">
				 <div class="header-left">
					 <div class="logo">
						<a href="index.php"><img src="images/logo.png" alt=""/></a>
					 </div>
					 <div class="menu">
						  <a class="toggleMenu" href="#"><img src="images/nav.png" alt="" /></a>
						    <ul class="nav" id="nav">

        <li><a href ="index.php">Accueil</a> </li>
        <li><a href ="boutique.php">boutique</a> </li>
        <li><a href ="panier.php">panier</a> </li>
        <?php if(!isset($_SESSION['user_id'])){?>
        <li><a href ="register.php">S'inscrire</a> </li>
        <li><a href ="connect.php">Se connecter</a> </li>
        </ul>
        <?php
        
        }else { ?>
        <li><a href ="my_account.php">Mon compte</a> </li>
        <?php }?>
        <li><a href ="conditions_generale_de_vente.php">conditions générales de Ventes</a> </li>
        </ul>
        </div>
        </div>
        </div>
        </div>
        </div>
        </div>


      

                 
				
						  
</header>
</html>
</body>