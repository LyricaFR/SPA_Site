<?php
  include("verification.php"); 

  if (isset($_POST["refuge"]))
    $_SESSION["refuge"] = $_POST["refuge"];

  if (isset($_SESSION["employe"]))
    unset($_SESSION["employe"]);

  if (isset($_SESSION["animaux"]))
    unset($_SESSION["animaux"]);

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

    

    <!-- Bootstrap core CSS -->
<link href="assets/dist/css/bootstrap.min.css" rel="stylesheet">


  </head>
  <body>

    <?php
      $req = "SELECT * FROM refuge WHERE id_refuge = ".$_SESSION["refuge"];
      $res = $cnx->query($req);

      $ligne = $res->fetch();
    ?>

  <div class="container">
    <table class="table">
      <theader>
        <th>Nom</th><th>Adresse</th><th>Téléphone</th><th>Capacité</th>
      </theader>

      <tr>
        <?php
          echo '<td>'.$ligne["nom"].'</td>';
          echo '<td>'.$ligne["adresse"].'</td>';
          echo '<td>'.$ligne["telephone"].'</td>';
          echo '<td>'.$ligne["capacite"].'</td>';
        ?>
      </tr>
    </table>
  </div>

  </br>
  <div class = "container">
    <p> À quelles informations voulez vous accéder? </p> 



      <form action = "employe.php" method ="post">
         <button class="btn btn-primary" type="submit" name ="employe" value ="employe">Employés</button>
      </form>
      </br>
      <form action = "animaux.php" method ="post">
          <button class="btn btn-primary" type="submit" name ="animaux" value ="animaux">Animaux</button>
      </form>
  </div>

  </body>
</html>