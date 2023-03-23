<?php
  include("verification.php"); 
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
    <title>SPA</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.0/examples/starter-template/">

    

    <!-- Bootstrap core CSS -->
<link href="assets/dist/css/bootstrap.min.css" rel="stylesheet">

 </head>
  <body>

    <?php
      $matricule = (int)$_POST["matricule"];
      $nom = $_POST["nom"];
      $prenom = $_POST["prenom"];
      $adresse = $_POST["adresse"];
      $telephone = $_POST["telephone"];
      $secu = $_POST["secu"];
      $id_profession = (int)$_POST["profession"];
      $refuge = (int)$_POST["refuge"];

      $nom_low = strtolower($nom);
      $prenom_low = strtolower($prenom);
      $login = $prenom_low[0].$nom_low;
      $mdp = $nom_low.$prenom_low[0];

      $req = "INSERT INTO employe VALUES(".$matricule.",'".$nom."','".$prenom."','".$adresse."','".$telephone."','".$secu."','".$login."','".$mdp."')";
    
      $cnx->exec($req);

      $req2 = "INSERT INTO travaille VALUES(".$id_profession.",".$refuge.",".$matricule.")";
      $cnx->exec($req2);

      $_SESSION["insert"] = "ok";


      header("location: acceuil_employe.php");
    ?>

  </body>
</html>