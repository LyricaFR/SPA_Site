<?php
  include("verification.php"); 
  include("connexion.inc.php");
  include("navbar.php");
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.79.0">
    <title>SPA Acceuil</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.0/examples/starter-template/">

    

    <!-- Bootstrap core CSS -->
<link href="assets/dist/css/bootstrap.min.css" rel="stylesheet">

 </head>
  <body>
  	<?php
  	$id_animal = $_POST["id_animal"];
  	$nom = $_POST["nom"];
  	$sexe = $_POST["sexe"];
  	$signe_distinct = $_POST["signe_distinct"];
  	$age = $_POST["age"];
  	$date_deces = $_POST["date_deces"];
  	$fourriere = $_POST["fourriere"];
  	$espece = $_POST["espece"];
  	$refuge = $_POST["refuge"];
  	$date_inscription = $_POST["date_inscription"];
  	$id_particulier = $_POST["id_particulier"];
  	$date_adoption = $_POST["date_adoption"];

    if (empty($_POST["signe_distinct"]) or empty($_POST["date_deces"]) or empty($_POST["id_particulier"]) or empty($_POST["date_adoption"])){
      $signe_distinct = NULL;
      $date_deces = NULL;
      $id_particulier = NULL;
      $date_adoption = NULL;
    }

  	$req = "INSERT INTO animal VALUES(".(int)$id_animal.",'".$nom."','".$sexe."','".$signe_distinct."',".(int)$age.",'".$date_deces."','".$fourriere."','".$espece."',".(int)$refuge.",'".$date_inscription."',".(int)$id_particulier.",'".$date_adoption."')";

  	$cnx->exec($req); 

  	$_SESSION["insert"] = "ok";

  	header("location: acceuil_employe.php");
  	?>

  </body>
</html>