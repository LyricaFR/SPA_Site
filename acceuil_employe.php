<?php
  include("verification.php"); 

  if (isset($_SESSION["refuge"]))
    unset($_SESSION["refuge"]);

  if (isset($_SESSION["employe"]))
    unset($_SESSION["employe"]);

  if (isset($_SESSION["animaux"]))
    unset($_SESSION["animaux"]);

  if (isset($_SESSION["animal"]))
    unset($_SESSION["animal"]);

  if (isset($_POST["consulter"]))
    $_SESSION["consulter"] = $_POST["consulter"];

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

  </head>
  <body>
    <?php
      include("navbar.php");

      $req = "SELECT * FROM refuge";
      $res = $cnx->query($req);  
    ?>

    <div class="text-center">

    <h1> Bienvenue <?php echo $_SESSION["nom"]." ".$_SESSION["prenom"]."."; ?></h1>

    <p> Que souhaitez vous consulter? </p>

    <form action="acceuil_employe.php" method ="post">
      <button type="submit" class="btn btn-danger" name="consulter" value = "refuge">Chercher un refuge</button>
      <button type="submit" class="btn btn-warning" name="consulter" value = "lst_animaux">Liste des animaux</button>
      <button type="submit" class="btn btn-info" name="consulter" value = "lst_employe">Liste des employés</button>
    </form>

    <?php
      if (isset($_SESSION["consulter"])){
        if ($_SESSION["consulter"] == "refuge"){
    ?>

  </br>
    <form action = "refuge.php" method ="post">
      <label for = "refuge"> Consulter les informations pour le refuge : </label>
      <select id = "refuge" name ="refuge">
        <?php
          while ($ligne = $res->fetch()){
            echo "<option value = ".$ligne["id_refuge"]."> ".$ligne["nom"]." </option>";
          }  
        ?>  
      </select>
      <input type = "submit" name = "submit_refuge" value = "Voir" />
    </form>

    <?php
      } 
      echo "</div>";
      if ($_SESSION["consulter"] == "lst_animaux"){
          $req_anim = "SELECT * FROM animal ORDER BY id_animal";
          $res_anim = $cnx->query($req_anim);
    ?>

          <table class = "table table-dark table-striped table-hover">
            <thead>
              <tr><th>Id</th><th>Nom</th><th>Sexe</th><th>Signe Distinct</th><th>Âge</th><th>Deces</th><th>Fourrière d'origine</th><th>Espèce</th><th>Refuge</th><th>Date d'inscription</th><th>Id. Particulier</th><th>Date adoption</th></tr> </br>
            </thead>
          <?php
            while ($ligne = $res_anim->fetch()){
              echo "<tr><td>".$ligne["id_animal"]."</td><td><form action='animal.php' method='post'><button type='submit' name='animal' value='".$ligne["nom"]."' class ='btn-link'>".$ligne["nom"]."</form></td><td>".$ligne["sexe"]."</td><td>".$ligne["signe_distinct"]."</td><td>".$ligne["age"]."</td><td>".$ligne["date_deces"]."</td><td>".$ligne["fourriere"]."</td><td>".$ligne["espece"]."</td><td>".$ligne["id_refuge"]."</td><td>".$ligne["date_inscription"]."</td><td>".$ligne["id_particulier"]."</td><td>".$ligne["date_adoption"]."</td></tr>";
            }

      ?>
          </table> </br>
    <?php
      if (isset($_SESSION["insert"])){
        echo "<p>Insertion réussie.</p>";
        unset($_SESSION["insert"]);
      }
      if (!isset($_POST["ajout_animal"])){
    ?>
          <form action="acceuil_employe.php" method ="post">
            <button type="submit" class="btn btn-primary" name="ajout_animal" value = "submit">Ajouter un pensionnaire</button>
          </form>

    <?php
      } else {
    ?>
      <form action="insertion_animal.php" method="post">
        <div class="row">
          <div class="col-md-1">
            <label for="id_animal" class="form-label">Id</label>
            <input type="text" class="form-control" id="id_animal" name="id_animal">
          </div>
          <div class="col-md-2">
            <label for="nom" class="form-label">Nom</label>
            <input type="text" class="form-control" id="nom" name="nom">
          </div>
          <div class="col-md-1">
            <label for="sexe" class="form-label">Sexe</label>
            <select class="form-select" id="sexe" name="sexe">
              <option selected>--</option>
              <option value="M">M</option>
              <option value="F">F</option>
            </select>
          </div>
          <div class="col-md-3">
            <label for="signe_distinct" class="form-label">Signe Distinctif</label>
            <input type="text" class="form-control" placeholder="(Laisser blanc si aucun signe distinct)" id="signe_distinct" name="signe_distinct">
          </div>
          <div class="col-md-1">
            <label for="age" class="form-label">Âge</label>
            <input type="number" min="0" max="99" class="form-control" placeholder="--" id="age" name="age">
          </div>
          <div class="col-md-3">
            <label for="date_deces" class="form-label">Date décès (Laisser blanc si pas décédé)</label>
            <input type="date" class="form-control" id="date_deces" name="date_deces">
          </div>
          <div class="col-md-1">
            <label for="fourriere" class="form-label">Fourrière d'origine</label>
            <input type="number" min="1" max="12" class="form-control" id="fourriere" name="fourriere">
          </div>
          <div class="col-md-2">
            <label for="espece" class="form-label">Espèce</label>
            <input type="text" class="form-control" id="espece" name="espece">
          </div>
          <div class="col-md-2">
            <label for="refuge" class="form-label">Refuge</label>
            <select class="form-select" id="refuge" name="refuge">
              <option selected>--</option>
              <option value="1">Refuge 1</option>
              <option value="2">Refuge 2</option>
              <option value="3">Refuge 3</option>
              <option value="4">Refuge 4</option>
              <option value="5">Refuge 5</option>
            </select>
          </div>
          <div class="col-md-3">
            <label for="date_inscription" class="form-label">Date d'inscription</label>
            <input type="date" class="form-control" id="date_inscription" name="date_inscription">
          </div>
          <div class="col-md-2">
            <label for="id_particulier" class="form-label">Id Particulier (Laisser blanc si non adopté)</label>
            <input type="text" class="form-control" id="id_particulier" name="id_particulier">
          </div>
          <div class="col-md-3">
            <label for="date_adoption" class="form-label">Date d'adoption (Laisser blanc si non adopté)</label>
            <input type="date" class="form-control" id="date_adoption" name="date_adoption">
          </div>
        </div> </br>
        <div class="col-12">
          <button type="submit" class="btn btn-primary" name="submit" value="submit">Ajouter</button>
        </div>
      </form>

    <?php
      }

      } if ($_SESSION["consulter"] == "lst_employe"){
          $req_employe = "SELECT employe.matricule,nom,prenom,adresse,telephone,intitule,travaille.id_refuge FROM employe,travaille,profession WHERE employe.matricule = travaille.matricule AND travaille.id_profession = profession.id_profession ORDER BY matricule";
          $res_employe = $cnx->query($req_employe);

          $req_profession = "SELECT id_profession,intitule FROM profession";
          $res_profession = $cnx->query($req_profession);
    ?>

        <table class = "table table-dark table-striped table-hover">
          <thead>
            <tr><th>Matricule</th><th>Nom</th><th>Prénom</th><th>Adresse</th><th>Telephone</th><th>Profession</th><th>Refuge</th></tr> </br>
          </thead>
        <?php
          while ($ligne = $res_employe->fetch()){
            echo "<tr><td>".$ligne["matricule"]."</td><td>".$ligne["nom"]."</td><td>".$ligne["prenom"]."</td><td>".$ligne["adresse"]."</td><td>".$ligne["telephone"]."</td><td>".$ligne["intitule"]."</td><td>".$ligne["id_refuge"]."</td></tr>";
          }
          echo "</table>";
    ?>



    <?php
      if (isset($_SESSION["insert"])){
        echo "<p>Insertion réussie.</p>";
        unset($_SESSION["insert"]);
      }
      if (!isset($_POST["ajout_employe"])){
    ?>
          <form action="acceuil_employe.php" method ="post">
            <button type="submit" class="btn btn-primary" name="ajout_employe" value = "submit">Ajouter un employé(e)</button>
          </form>

    <?php
      } else {
    ?>

     <form action="insertion_employe.php" method="post">
        <div class="row">
          <div class="col-md-1">
            <label for="matricule" class="form-label">Matricule</label>
            <input type="text" class="form-control" id="matricule" name="matricule">
          </div>
          <div class="col-md-2">
            <label for="nom" class="form-label">Nom</label>
            <input type="text" class="form-control" id="nom" name="nom">
          </div>
          <div class="col-md-2">
            <label for="prenom" class="form-label">Prénom</label>
            <input type="text" class="form-control" id="prenom" name="prenom">
          </div>
          <div class="col-md-3">
            <label for="adresse" class="form-label">Adresse</label>
            <input type="text" class="form-control" placeholder="5 Rue de la Crèche 75001 Paris" id="adresse" name="adresse">
          </div>
          <div class="col-md-2">
            <label for="telephone" class="form-label">Télèphone</label>
            <input type="text" maxlength="10" class="form-control" id="telephone" name="telephone">
          </div>
          <div class="col-md-2">
            <label for="secu" class="form-label">N° Sécurité Social</label>
            <input type="text" maxlength="13" class="form-control" id="secu" name="secu">
          </div>
          <div class="col-md-2">
            <label for="profession" class="form-label">Profession</label>
            <select class="form-select" id="profession" name="profession">
              <option selected>--</option>
              <?php
                while ($ligne_profession = $res_profession->fetch())
                  echo "<option value=".$ligne_profession["id_profession"].">".$ligne_profession["intitule"]."</option>";
              ?>
            </select>
          </div>
          <div class="col-md-2">
            <label for="refuge" class="form-label">Refuge</label>
            <select class="form-select" id="refuge" name="refuge">
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
    }
  }
    ?>

    </br>
  </body>

</html>
