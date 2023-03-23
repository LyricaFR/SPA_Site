<?php
	session_start();
	include("connexion.inc.php");

	$req = "SELECT login,mdp FROM employe";
	$res = $cnx->query($req); 

	while($ligne = $res->fetch()){
		if ($ligne["login"] == $_SESSION["login"] && $ligne["mdp"] == $_SESSION["mdp"]){
			$ok = true; break;
		}
		$ok = false;
	}

	if ($ok == false){
		header('location: index.php');
	}
?>
