<?php 
	require 'autoloader.php';
	session_start();
  	if(!isset($_SESSION["usuario"])){
		include 'login.php';
		exit;
	}
     use Util\Rota;
     $rota = new Rota(@$_GET['param']);
?>   
