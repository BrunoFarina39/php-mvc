<!DOCTYPE html>
<html>
<head>
	<base href="<?php echo "http://". $_SERVER["HTTP_HOST"] ?>">
  <meta charset="UTF-8">
  <meta name="viewport" content="width:device-width,initial-scale:1.0">
  <title>Sistema</title>
	<link rel="stylesheet" type="text/css" href="public/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="public/css/estilos.css">
  <link rel="stylesheet" type="text/css" href="public/css/jquery.dataTables.min.css">
	<link rel="stylesheet" type="text/css" href="public/css/jquery-ui.min.css">
  <script type="text/javascript" src="public/js/jquery-3.2.1.min.js"></script>
	<script type="text/javascript" src="public/js/datatables.min.js"></script>
  <script type="text/javascript" src="public/js/bootstrap.min.js"></script>
  <script type="text/javascript" src="public/js/jquery.validate.min.js"></script>
  <script type="text/javascript" src="public/js/jquery-ui.min.js"></script>
  <script type="text/javascript" src="public/js/jquery.priceformat.min.js"></script>
  <script type="text/javascript" src="public/js/jquery.maskedinput.js"></script>
  <script type="text/javascript" src="public/js/script.js"></script>
</head>
<body>
  <header>
  <nav class="navbar navbar-default">
    <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="home">Home</a>
      </div>

      <!-- Collect the nav links, forms, and other content for toggling -->
      <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
        <ul class="nav navbar-nav">
        
          <li class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Cadastro<span class="caret"></span></a>
            <ul class="dropdown-menu">
              <li><a href="usuario">Usuário</a></li>
              <li><a href="cliente">Cliente</a></li>
              <li><a href="fornecedor">Fornecedor</a></li>
              <li><a href="marca">Marca</a></li>
              <li role="separator" class="divider"></li>
              <li><a href="produto">Produto</a></li>
              <li><a href="servico">Serviço</a></li>
              <li><a href="funcionario">Funcionário</a></li>
            </ul>
          </li>
        </ul>
         <ul class="nav navbar-nav">      
          <li class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Movimentação<span class="caret"></span></a>
            <ul class="dropdown-menu">
              <li><a href="compra">Compra</a></li>
              <li><a href="venda">Venda</a></li>
              <li role="separator" class="divider"></li>
              <li><a href="caixa">Caixa</a></li>
            </ul>
          </li>
        </ul>
        <ul class="nav navbar-nav navbar-right">
          <li><a href="#">Link</a></li>
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Conta <span class="caret"></span></a>
            <ul class="dropdown-menu">
              <li><a href="#">Action</a></li>
              <li><a href="#">Another action</a></li>
              <li><a href="#">Something else here</a></li>
              <li role="separator" class="divider"></li>
              <li><a href="sair">Sair</a></li>
            </ul>
          </li>
        </ul>
      </div>
    </div>
  </nav>
  </header>
  <section>
    <div class="load"></div>