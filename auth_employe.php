<?php
	include("connexion.inc.php");
	session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<title>Authentification</title>
	<style type="text/css">
		body {
			background-color:#ffd;
			font-family:Verdana,Helvetica,Arial,sans-serif;
		}
	</style>
</head>

<body>
	<?php
	$login = $_POST["login"];
	$mdp = $_POST["mdp"];
	$ok = false;

	$req = "SELECT * FROM employe";
	$res = $cnx->query($req); 

	while ($ligne = $res->fetch()){
		if ($ligne["login"] == $login && $ligne["mdp"] == $mdp){
			$ok = true;
			break;
		}
	}

	if ($ok == true){
		$_SESSION["login"] = $login;
		$_SESSION["mdp"] = $mdp;
		$_SESSION["nom"] = $ligne["nom"];
		$_SESSION["prenom"] = $ligne["prenom"];
		$_SESSION["ok"] = true;
		header('location: acceuil_employe.php');
	}
	else{
		session_destroy();
		header('location: index.php');
	}

	?>
</body>
</html>
