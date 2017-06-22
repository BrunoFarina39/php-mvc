<?php 
	date_default_timezone_set('America/Sao_Paulo');
	use Model\Usuario\Usuario;
	$msg="";
	if(($_SERVER['REQUEST_METHOD'] == "POST")){
		if($_POST['login'] == "" || $_POST['senha'] == ""){
			$msg = "<div class='alert alert-danger'>Login ou sennha não pode ser em branco</div>";
		}else{
			$usuario = new Usuario();
			$usuario->setLogin($_POST['login']);
			$usuario->setSenha($_POST['senha']);
			if($usuario->autenticar()){
				header("Location:home");
			}else{
				$msg="<div class='alert alert-danger'>Login ou senha inválido(s)</div>";
			}
		}
	}
	
?>
<!DOCTYPE html>
<html>
<head>
	<base href="<?php echo "http://". $_SERVER["HTTP_HOST"].$_SERVER["SCRIPT_NAME"]; ?>">
	<meta charset="UTF-8">
	<meta name="viewport" content="width:device-width,initial-scale:1.0">
	<title>Autenticação no Sistema</title>
	<link rel="stylesheet" type="text/css" href="public/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="public/css/estilos.css">
</head>
<body>
	<form id="form_autenticacao" method="post">
		<?php echo $msg; ?>
		<ul>
			<li><h1>Login no Sistema</h1></li>
		</ul>
		<hr/>
		<ul>
			<li><label>Usuário:</label></li>
			<li><input type="text" name="login" class="form-control" /></li>
		</ul>
		<ul>
			<li><label>Senha:</label><label></li>
			<li><input type="password" name="senha" class="form-control" /></li>
		</ul>
		<ul>
			<li><div><input type="submit" value="Entrar" name="" class="btn btn-primary" /></div></li>
		</ul>
	</form>
</body>
</html>