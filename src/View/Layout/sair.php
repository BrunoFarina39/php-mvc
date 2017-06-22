<?php 
	//inicia sessao
	session_start();
	//apaga tudo 
	unset($_SESSION["usuario"]);
	//enviar para o index
	header("Location: ".dirname(dirname($_SERVER["SCRIPT_NAME"])));