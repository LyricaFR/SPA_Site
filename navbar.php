<?php
  /*include("verification.php"); */
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.79.0">
    <title>Starter Template · Bootstrap v5.0</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.0/examples/starter-template/">

    

    <!-- Bootstrap core CSS -->
<link href="assets/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>

    
    <!-- Custom styles for this template -->
    <link href="css/starter-template.css" rel="stylesheet">
  </head>
  <body>
    
<nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top">
  <?php
    if ((isset($_SESSION["login"])) && (isset($_SESSION["mdp"]))){
  ?>
  <div class="container-fluid">
    <a class="navbar-brand" href="acceuil_shortcut.php">Acceuil</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

  <?php
    } else {
  ?>

   <div class="container-fluid">
    <a class="navbar-brand" href="index.php">Acceuil</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

  <?php
    }
  ?>

    <div class="collapse navbar-collapse" id="navbarsExampleDefault">
      <ul class="navbar-nav me-auto mb-2 mb-md-0">

        <?php
         if (isset($_SESSION["refuge"])){
        ?>

        <li class="nav-item">
          <a class="nav-link" href="refuge.php"> > Refuge <?php echo $_SESSION["refuge"]; ?></a>
        </li>

        <?php
            } if (isset($_SESSION["consulter"])){
              if ($_SESSION["consulter"] == "lst_animaux"){
        ?>

        <li class="nav-item">
          <a class="nav-link" href="acceuil_employe.php" > > Animaux</a>
        </li>

        <?php
             } if ($_SESSION["consulter"] == "lst_employe"){
        ?>

        <li class="nav-item">
          <a class="nav-link" href="acceuil_employe.php" > > Employés</a>
        </li>

        <?php
            }
          } if (isset($_SESSION["employe"])){
         ?>

        <li class="nav-item">
          <a class="nav-link" href="employe.php" > > Employé</a>
        </li>

        <?php
            } if (isset($_SESSION["animaux"])){
        ?>

        <li class="nav-item">
          <a class="nav-link" href="animaux.php" > > Animaux</a>
        </li>

        <?php
              } if (isset($_SESSION["animal"])){
        ?>

        <li class="nav-item">
          <a class="nav-link" href="animal.php" > > <?php echo $_SESSION["animal"]; ?></a>
        </li>

        <?php
          }
        ?>

      </ul>

      <?php 
      if (isset($_SESSION["ok"])){
        if ($_SESSION["ok"] == true){
      ?>

      <ul class="nav justify-content-end">
        <li class="nav-item">
          <a class="nav-link" href="deconnection.php">Deconnexion</a>
        </li>
      </ul>
      <?php
        }
      }
      ?>
    </div>
  </div>
</nav>


    <script src="../assets/dist/js/bootstrap.bundle.min.js"></script>

      
  </body>
</html>
