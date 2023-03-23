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

    $req_id = "SELECT id_animal FROM animal WHERE nom = '".$_SESSION["animal"]."'";
    $res_id = $cnx->query($req_id);
    $id = $res_id->fetch();

    $req_insert_soin = "INSERT INTO soin VALUES(".(int)$_POST["id_soin"].",'".$_POST["date_soin"]."',".(int)$_POST["type_soin"].",".$id["id_animal"].",".$_POST["soigneur"].")";
    $cnx->exec($req_insert_soin);

    $_SESSION["insert_soin"] = "ok";
    header('location: animal.php');
  ?>

  </body>

</html>