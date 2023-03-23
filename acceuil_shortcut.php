<?php
session_start();

if (isset($_SESSION["consulter"]))
	unset($_SESSION["consulter"]);

if (isset($_SESSION["refuge"]))
	unset($_SESSION["refuge"]);

if (isset($_SESSION["employe"]))
	unset($_SESSION["employe"]);

if (isset($_SESSION["animaux"]))
	unset($_SESSION["animaux"]);

if (isset($_SESSION["animal"]))
	unset($_SESSION["animal"]);

header('location: acceuil_employe.php');
?>