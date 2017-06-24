<?php
	namespace Util;
	use Controller\Home\HomeController;
	use Controller\Usuario\UsuarioController;
	use Controller\Cliente\ClienteController;
	use Controller\Fornecedor\FornecedorController;
	use Controller\Marca\MarcaController;
	use Controller\Produto\ProdutoController;
	use Controller\Servico\ServicoController;
	use Controller\Funcionario\FuncionarioController;
	class Rota{
		public function __construct($param)
		{
			if(isset($param)){
				$param = $_GET["param"];
				$ultimo = substr($_GET["param"],-1,1);
				
				if($ultimo == "/")
					$param = substr_replace($param,"",-1, 1);
			
				$param = explode("/",$param);

				if(!isset($param[1]))
					$param[1]="index";

				$pagina = $param[0];

				if($pagina == "sair"){
					unset($_SESSION["usuario"]);
					//enviar para o index
					header("Location: ".dirname(dirname($_SERVER["SCRIPT_NAME"])));
				}

				$rota = "src/Controller/$param[0]/".$pagina."Controller.php";

				if(file_exists($rota)){
					include $rota;
					switch ($pagina) {
						case 'usuario':$this->usuario($param);break;
						case 'cliente':$this->cliente($param);break;
						case 'fornecedor':$this->fornecedor($param);break;
						case 'marca':$this->marca($param);break;
						case 'produto':$this->produto($param);break;
						case 'servico':$this->servico($param);break;
						case 'funcionario':$this->funcionario($param);break;
						case 'home': $home = new HomeController();
					}
				}else{
					echo "erro";
				}
			}else{
				$home = new HomeController();
			}
		}
		private function usuario($param)
		{
			switch ($param[1]){
				case 'index':
					$usuarioController = new UsuarioController();
					$usuarioController->ActionIndex();break;
				case 'add':
					$usuarioController = new UsuarioController();
					$usuarioController->actionAdd($_POST);
					break;
				case 'edit':
					$usuarioController = new UsuarioController();
					$usuarioController->actionEdit(@$param[2],$_POST,@$param[3],@$param[4]);
					break;
				case 'delete':
					$usuarioController = new UsuarioController();
					$usuarioController->actionDelete(@$param[2],@$param[3],@$param[4]);break;	

				case 'list':
					$usuarioController = new UsuarioController();
					$usuarioController->actionList($_POST,@$param[2],@$param[3]);break;
				case 'editPassword':
					$usuarioController = new UsuarioController();
					$usuarioController->actionEditPassword($_POST,@$param[2]);break;
			}
		}
		
		private function cliente($param)
		{
			switch ($param[1]){	
				case 'index':
					$clienteController = new ClienteController();
					$clienteController->actionIndex();break;
				case 'add':
					$clienteController = new ClienteController();
					$clienteController->actionAdd($_POST);break;
				case 'edit':
					$clienteController = new ClienteController();
					$clienteController->actionEdit(@$param[2],$_POST,@$param[3],@$param[4]);break;
				case 'delete':
					$clienteController = new ClienteController();
					$clienteController->actionDelete(@$param[2],@$param[3],@$param[4]);break;	
				case 'list':
					$clienteController = new ClienteController();
					$clienteController->actionList($_POST,@$param[2],@$param[3]);break;
				case 'listarCidades':
					$clienteController = new ClienteController();
					$clienteController->listarCidades(@$param[2]);break;
				case 'visualizaClientePorId':
					$clienteController = new ClienteController();
					$clienteController->visualizaClientePorId(@$param[2]);break;	
			}	
		}
	
		private function fornecedor($param)
		{
			switch ($param[1]){
				case 'index':
					$fornecedorController = new FornecedorController();
					$fornecedorController->actionIndex();break;
				case 'add':
					$fornecedorController = new FornecedorController();
					$fornecedorController->actionAdd($_POST);break;
				case 'edit':
					$fornecedorController = new FornecedorController();
					$fornecedorController->actionEdit(@$param[2],$_POST,@$param[3],@$param[4]);break;
				case 'delete':
					$fornecedorController = new FornecedorController();
					$fornecedorController->actionDelete(@$param[2],@$param[3],@$param[4]);break;	
				case 'list':
					$fornecedorController = new FornecedorController();
					$fornecedorController->actionList($_POST,@$param[2],@$param[3]);break;
				case 'listaCidades':
					$fornecedorController = new FornecedorController();
					$fornecedorController->listaCidades(@$param[2]);break;
				case 'visualizaFornecedorPorId':
					$fornecedorController = new FornecedorController();
					$fornecedorController->visualizaFornecedorPorId(@$param[2]);break;	
				}
		}

		private function marca($param)
		{
			switch ($param[1]){
				case 'index':
					$marcaController = new MarcaController();
					$marcaController->actionIndex();break;
				case 'add':
					$marcaController = new MarcaController();
					$marcaController->actionAdd($_POST);break;
				case 'edit':
					$marcaController = new MarcaController();
					$marcaController->actionEdit(@$param[2],$_POST,@$param[3]);break;
				case 'delete':
					$marcaController = new MarcaController();
					$marcaController->actionDelete(@$param[2],@$param[3]);break;	
				case 'list':
					$marcaController = new MarcaController();
					$marcaController->actionList($_POST,@$param[2]);break;
			}
		}
		
		private function produto($param)
		{
			switch ($param[1]){
				case 'index':
					$produtoController = new ProdutoController();
					$produtoController->actionIndex();break;
				case 'add':
					$produtoController = new ProdutoController();
					$produtoController->actionAdd($_POST);break;
				case 'edit':
					$produtoController = new ProdutoController();
					$produtoController->actionEdit(@$param[2],$_POST,@$param[3],@$param[4]);break;
				case 'delete':
					$produtoController = new ProdutoController();
					$produtoController->actionDelete(@$param[2],@$param[3],@$param[4]);break;	
				case 'list':
					$produtoController = new ProdutoController();
					$produtoController->actionList($_POST,@$param[2],@$param[3]);break;
				case 'listarMarcas':
					$produtoController = new ProdutoController();
					$produtoController->listarMarcas($_POST,@$param[2],@$param[3]);break;
				case 'visualizaProdutoPorId':
					$produtoController = new ProdutoController();
					$produtoController->visualizaProdutoPorId(@$param[2]);break;
			}
		}

		private function servico($param)
		{
			switch ($param[1]){
				case 'index':
					$servicoController = new ServicoController();
					$servicoController->actionIndex();break;
				case 'add':
					$servicoController = new ServicoController();
					$servicoController->actionAdd($_POST);break;
				case 'edit':
					$servicoController = new ServicoController();
					$servicoController->actionEdit(@$param[2],$_POST,@$param[3]);break;
				case 'delete':
					$servicoController = new ServicoController();
					$servicoController->actionDelete(@$param[2],@$param[3]);break;	
				case 'list':
					$servicoController = new ServicoController();
					$servicoController->actionList($_POST,@$param[2]);break;
			}
		}

		private function funcionario($param)
		{
			switch ($param[1]){	
				case 'index':
					$funcionarioController = new FuncionarioController();
					$funcionarioController->actionIndex();break;
				case 'add':
					$funcionarioController = new FuncionarioController();
					$funcionarioController->actionAdd($_POST);break;
				case 'edit':
					$funcionarioController = new FuncionarioController();
					$funcionarioController->actionEdit(@$param[2],$_POST,@$param[3],@$param[4]);break;
				case 'delete':
					$funcionarioController = new FuncionarioController();
					$funcionarioController->actionDelete(@$param[2],@$param[3],@$param[4]);break;	
				case 'list':
					$funcionarioController = new FuncionarioController();
					$funcionarioController->actionList($_POST,@$param[2],@$param[3]);break;
				case 'listarCidades':
					$funcionarioController = new FuncionarioController();
					$funcionarioController->listarCidades(@$param[2]);break;
				case 'visualizaFuncionarioPorId':
					$funcionarioController = new FuncionarioController();
					$funcionarioController->visualizaFuncionarioPorId(@$param[2]);break;	
			}	
		}
	}	
?>