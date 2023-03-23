<?php
  include("verification.php"); 
  if (isset($_POST["employe"]))
    $_SESSION["employe"] = $_POST["employe"];
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
    <title>SPA </title>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.0/examples/starter-template/">

    

    <!-- Bootstrap core CSS -->
<link href="assets/dist/css/bootstrap.min.css" rel="stylesheet">


  </head>
  <body>

    <?php
    $req2 = "SELECT nom,prenom,adresse,telephone,intitule FROM employe,travaille,profession WHERE employe.matricule = travaille.matricule AND travaille.id_profession = profession.id_profession AND travaille.id_refuge = ".$_SESSION["refuge"];
      $res2 = $cnx->query($req2);
      ?>

    <table class = "table table-dark table-striped table-hover">
      <thead>
        <tr><th>Nom</th><th>Prénom</th><th>Adresse</th><th>Telephone</th><th>Profession</th></tr> </br>
      </thead>
    <?php
      echo "Voici les employés qui travaillent dans le refuge ".$_SESSION["refuge"]." :";
      while ($ligne = $res2->fetch()){
        echo "<tr><td>".$ligne["nom"]."</td><td>".$ligne["prenom"]."</td><td>".$ligne["adresse"]."</td><td>".$ligne["telephone"]."</td><td>".$ligne["intitule"]."</td></tr>";
      }
    

    ?>
    </table>


  </body>
</html>