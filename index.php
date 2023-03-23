
<!DOCTYPE html>
<html>
 
 <head>
 
<!-- En-tête du document Si avec l'UTF8 cela ne fonctionne pas mettez charset=ISO-8859-1 -->
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
 
  <!-- Balise meta  -->
  <meta name="title" content="Titre de la page" />
  <meta name="description" content="description de la page"/>
  <meta name="keywords" content="mots-clé1, mots-clé2, ..."/>
 
  <!-- Indexer et suivre 
  <meta name="robots" content="index,follow" /> -->
 
  <!--  Relier une feuille CSS externe  
  <link rel='stylesheet' href='votre-fichier.css' type='text/css' /> -->


  <!-- Incorporez du CSS dans la page  -->

      <!-- Bootstrap core CSS -->
  <link href="assets/dist/css/bootstrap.min.css" rel="stylesheet">
    
  <link href="css/signin.css" rel="stylesheet">
 
 <title> SPA </title>
 
 </head>
 
 
<?php
  include("navbar.php");
?>

 <body class="text-center">


<main class="form-signin">
  <h1> Bienvenue sur le site de la SPA </h1>

  <h3> Employé(e) à la SPA? Authentifier vous . </h3>

  <form action = "auth_employe.php" method = "post">
    <div class="form-floating mb-3">
      <input type="text" class="form-control" id="login" name="login" />
      <label for="login"> Login </label>
    </div>
    <div class="form-floating mb-3">
      <input type="password" class="form-control" id="mdp" name="mdp">
      <label for="mdp"> Mot de passe </label>
    </div>
    <br/>
    <input type="reset" name="reset" value="Effacer"/>
    <input type="submit" name="submit" value="valider">
  </form>
</main>
 
 </body>
</html>
