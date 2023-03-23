<?php
  include("verification.php"); 

  if (isset($_POST["animal"]))
    $_SESSION["animal"] = $_POST["animal"];

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
      $req = "SELECT * FROM animal WHERE nom = '".$_SESSION["animal"]."'";
      $res = $cnx->query($req);

      $ligne = $res->fetch();

      $req_depl = "SELECT * FROM transfert WHERE id_animal = ".$ligne["id_animal"]." ORDER BY date_depart";
      $res_depl = $cnx->query($req_depl);

      $ligne_depl = $res_depl->fetch()

    ?>

    <div class="container">
      <h1> <?php echo $ligne["nom"]; ?> </h1>
      <table class ="table">
        <theader>
          <th>Nom</th><th>Sexe</th><th>Signe Distinct</th><th>Âge</th><th>Décès</th><th>Fourrière d'origine</th><th>Espèce</th><th>Refuge</th><th>Date d'inscription</th><th>Id Particulier</th><th>Date d'adoption</th>
      </theader>

      <tr>
      <?php
        echo '<td>'.$ligne["nom"].'</td>';
        echo '<td>'.$ligne["sexe"].'</td>';
        echo '<td>'.$ligne["signe_distinct"].'</td>';
        echo '<td>'.$ligne["age"].'</td>';
        echo '<td>'.$ligne["date_deces"].'</td>';
        echo '<td>'.$ligne["fourriere"].'</td>';
        echo '<td>'.$ligne["espece"].'</td>';
        echo '<td>'.$ligne["id_refuge"].'</td>';
        echo '<td>'.$ligne["date_inscription"].'</td>';
        echo '<td>'.$ligne["id_particulier"].'</td>';
        echo '<td>'.$ligne["date_adoption"].'</td>';
      ?>
      </tr>
    </table>
  </div>

  <div class="container">
    <h3> Particulier </h3>
  <?php
    if ($ligne["id_particulier"] != ""){
      $req_particulier = "SELECT * FROM particulier WHERE id_particulier = '".$ligne["id_particulier"]."'";
      $res_particulier = $cnx->query($req_particulier);
      $particulier = $res_particulier->fetch();
  ?>
    <table class ="table">
      <theader>
        <th>Nom</th><th>Prénom</th><th>Téléphone</th><th>Adresse</th>
      </theader>

      <tr>
        <?php echo "<td>".$particulier["nom"]."</td><td>".$particulier["prenom"]."</td><td>".$particulier["telephone"]."</td><td>".$particulier["adresse"]."</td>"; ?>
      </tr>
    </table>

  <?php
    } else{
      echo "<p>".$_SESSION["animal"]." n'as pas encore été adopté(e).";
    }
  ?>
  </div>

  <div class="container">
    <h3> Transferts </h3>
    <?php 
      if ($ligne_depl["id_transfert"] != ""){
    ?>
      <table class ="table">
        <theader>
          <th>Id transfert</th><th>Date de départ</th><th>Date d'arrivé</th><th>Destination</th><th>Origine</th>
      </theader>

        <?php
          do{
            echo '<tr><td>'.$ligne_depl["id_transfert"].'</td><td>'.$ligne_depl["date_depart"].'</td><td>'.$ligne_depl["date_arrive"].'</td><td> Refuge '.$ligne_depl["id_destination"].'</td><td> Refuge '.$ligne_depl["id_origin"]."</td></tr>";

          } while ($ligne_depl = $res_depl->fetch());
        ?>
    </table>

    <?php
      } else {
        echo "<p>".$_SESSION["animal"]." n'as jamais été transféré(e).";
      }
    ?>
  </div>

  <div class="container">

  <?php 
    if (!isset($_POST["ajout_ancien_deplacement"])){
  ?>

    <form action="animal.php" method ="post">
        <button type="submit" class="btn btn-primary" name="ajout_ancien_deplacement" value = "submit">Ajouter un ancien déplacement</button>
    </form>

    <?php
    if (isset($_SESSION["insert_transfert"])){
      echo "<p>Insertion réussie</p>";
      unset($_SESSION["insert_transfert"]);
    }

    } else {
    ?>

    <form action = "insertion_transfert.php" method="post">
      <div class="row">
        <div class="col-md-1">
          <label for="id_transfert" class="form-label">Id transfert</label>
          <input type="number" class="form-control" id="id_transfert" name="id_transfert">
        </div>
        <div class="col-md-2">
          <label for="date_depart" class="form-label">Date de départ</label>
          <input type="date" class="form-control" id="date_depart" name="date_depart">
        </div>
        <div class="col-md-2">
          <label for="date_arrive" class="form-label">Date d'arrivé</label>
          <input type="date" class="form-control" id="date_arrive" name="date_arrive">
        </div>
        <div class="col-md-2">
          <label for="id_destination" class="form-label">Destination</label>
          <select class="form-select" id="id_destination" name="id_destination">
            <option selected>--</option>
            <option value="1">Refuge 1</option>
            <option value="2">Refuge 2</option>
            <option value="3">Refuge 3</option>
            <option value="4">Refuge 4</option>
            <option value="5">Refuge 5</option>
          </select>
        </div>
        <div class="col-md-2">
          <label for="id_origine" class="form-label">Origine</label>
          <select class="form-select" id="id_origine" name="id_origine">
            <option selected>--</option>
            <option value="1">Refuge 1</option>
            <option value="2">Refuge 2</option>
            <option value="3">Refuge 3</option>
            <option value="4">Refuge 4</option>
            <option value="5">Refuge 5</option>
          </select>
        </div>
      </div> </br>
      <div class="col-12">
        <button type="submit" class="btn btn-primary" name="submit" value="submit">Ajouter</button>
      </div>
    </form>

  <?php
    }
  ?>

  </div>


  <div class="container">
    <h3> Soin </h3>
    <?php

      $req_soin = "SELECT * FROM soin NATURAL JOIN type_soin NATURAL JOIN employe WHERE id_animal = '".$ligne["id_animal"]."' ORDER BY date_soin";
      $res_soin = $cnx->query($req_soin);
      $soin = $res_soin->fetch();

      if ($soin["id_soin"] != ""){

    ?>
      <table class ="table">
        <theader>
          <th>Id Soin</th><th>Date</th><th>Type de soin</th><th>Soigneur</th>
        </theader>

          <?php
            do{
              echo "<tr><td>".$soin["id_soin"]."</td><td>".$soin["date_soin"]."</td><td>".$soin["intitule"]."</td><td>".$soin["nom"]." ".$soin["prenom"]."</td></tr>"; 
            } while ($soin = $res_soin->fetch());
          ?>

      </table>

    <?php
      } else{
        echo "<p>".$_SESSION["animal"]." n'as pas encore reçue de soin.";
      }
    ?>
  </div>

  <?php
    if (!isset($_POST["ajout_soin"])){
  ?>

  <div class="container">
    <form action="animal.php" method ="post">
        <button type="submit" class="btn btn-primary" name="ajout_soin" value = "submit">Ajouter un soin</button>
    </form>

  <?php
    if (isset($_SESSION["insert_soin"])){
      echo "<p> Insertion réussie </p>";
      unset($_SESSION["insert_soin"]);
    }
  ?>

  </div>

    <?php
      } else {

        $req_type_soin = "SELECT id_type,intitule FROM type_soin";
        $res_type_soin = $cnx->query($req_type_soin);

        $req_soigneur = "SELECT matricule,nom,prenom FROM employe NATURAL JOIN travaille WHERE (id_profession = 2 OR id_profession = 4) AND id_refuge = ".$ligne["id_refuge"];
        $res_soigneur = $cnx->query($req_soigneur);

    ?>
    <div class="container">
      <form action="insertion_soin.php" method="post">
        <div class="row">
          <div class="col-md-1">
            <label for="id_soin" class="form-label">Id Soin</label>
            <input type="number" min="0" class="form-control" id="id_soin" name="id_soin">
          </div>
          <div class="col-md-2">
            <label for="date_soin" class="form-label">Date</label>
            <input type="date" class="form-control" id="date_soin" name="date_soin">
          </div>
          <div class="col-md-2">
            <label for="type_soin" class="form-label">Type de soin</label>
            <select class="form-select" id="type_soin" name="type_soin">
              <option selected>--</option>
            <?php
              while ($type_soin = $res_type_soin->fetch()){
                echo "<option value=".$type_soin["id_type"]."> ".$type_soin["intitule"]. "</option>";
              }
            ?>
            </select>
          </div>
          <div class="col-md-3">
            <label for="soigneur" class="form-label">Soigneur</label>
            <select class="form-select" id="soigneur" name="soigneur">
              <option selected>--</option>
            <?php
              while ($soigneur = $res_soigneur->fetch()){
                echo "<option value=".$soigneur["matricule"]."> ".$soigneur["nom"]." ".$soigneur["prenom"]."</option>";
              }
            ?>
            </select>
          </div>
        </div> </br>
        <div class="col-12">
          <button type="submit" class="btn btn-primary" name="submit_soin" value="submit">Ajouter</button>
        </div>
      </form>

    </div>

    <?php
      }
    ?>

  </body>

</html>