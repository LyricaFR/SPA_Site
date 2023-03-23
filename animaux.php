<?php
  include("verification.php"); 

  if (isset($_POST["animaux"]))
    $_SESSION["animaux"] = $_POST["animaux"];

  if (isset($_SESSION["animal"]))
    unset($_SESSION["animal"]);

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

    <style>
    .btn-link {
    border: none;
    outline: none;
    background: none;
    cursor: pointer;
    color: #0000EE;
    padding: 0;
    text-decoration: underline;
    font-family: inherit;
    font-size: inherit;
    }
  </style>

    <!-- Bootstrap core CSS -->
<link href="assets/dist/css/bootstrap.min.css" rel="stylesheet">


  </head>
  <body>

    <?php
    $req2 = "SELECT id_animal,nom,sexe,signe_distinct,age,date_deces,fourriere,espece,id_refuge,date_inscription,id_particulier,date_adoption FROM animal WHERE id_refuge = ".$_SESSION["refuge"]." ORDER BY id_animal";
        $res2 = $cnx->query($req2);
    ?>

    <table class = "table table-dark table-striped table-hover">
      <thead>
        <tr><th>Id</th><th>Nom</th><th>Sexe</th><th>Signe Distinct</th><th>Âge</th><th>Deces</th><th>Fourrière d'origine</th><th>Espèce</th><th>Refuge</th><th>Date d'inscription</th><th>Id. Particulier</th><th>Date adoption</th></tr> </br>
      </thead>
    <?php
      echo "Voici les animaux abrités dans le refuge ".$_SESSION["refuge"]." :";
      while ($ligne = $res2->fetch()){
        echo "<tr><td>".$ligne["id_animal"]."</td><td><form action='animal.php' method='post'><button type='submit' name='animal' value='".$ligne["nom"]."' class ='btn-link'>".$ligne["nom"]."</form></td><td>".$ligne["sexe"]."</td><td>".$ligne["signe_distinct"]."</td><td>".$ligne["age"]."</td><td>".$ligne["date_deces"]."</td><td>".$ligne["fourriere"]."</td><td>".$ligne["espece"]."</td><td>".$ligne["id_refuge"]."</td><td>".$ligne["date_inscription"]."</td><td>".$ligne["id_particulier"]."</td><td>".$ligne["date_adoption"]."</td></tr>";
      }

    ?>
    </table>




  </body>
</html>