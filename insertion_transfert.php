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
      $req_id = "SELECT id_animal FROM animal WHERE nom ='".$_SESSION["animal"]."'";
      $res_id = $cnx->query($req_id);
      $id = $res_id->fetch();

      $id_transfert = $_POST["id_transfert"];
      $date_depart = $_POST["date_depart"];
      $date_arrive = $_POST["date_arrive"];
      $id_destination = $_POST["id_destination"];
      $id_origine = $_POST["id_origine"];

      $req_insert = "INSERT INTO transfert VALUES(".(int)$id_transfert.",'".$date_depart."','".$date_arrive."',".(int)$id_destination.",".(int)$id_origine.",".$id["id_animal"].")";
      $cnx->exec($req_insert);

      $_SESSION["insert_transfert"] = "ok";
      header('location: animal.php');
    ?>


  </body>

</html>