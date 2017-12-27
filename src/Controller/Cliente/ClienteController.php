<?php 
	namespace Controller\Cliente;
	use Library\AbstractController;
	use View\Cliente\ClienteForm;
	use View\Cliente\ClienteListaForm;
	use Model\Cliente\Cliente;
	use Model\Cliente\ClienteDao;
	
	class ClienteController extends AbstractController{
		private $cliente,$clienteDao;
		
		public function __construct()
		{
			$this->cliente = new Cliente();
			$this->clienteDao = new ClienteDao();
		}

		public function actionIndex()
		{
			$acao = "add";
			$clienteForm = new ClienteForm($acao);
			$clienteForm->setEstados($this->clienteDao->listarEstados());
		}

		public function actionAdd($post)
		{
			$acao = "add";
			$clienteForm = new ClienteForm($acao);
			$clienteForm->setEstados($this->clienteDao->listarEstados());
			$clienteForm->setInputFilter($this->cliente->getInputFilter());
			if($this->isPost()){
				$clienteForm->setData($post);
				if($clienteForm->isValid()){
					$this->cliente->hidratar($clienteForm->getData());
					$clienteForm->setAddStatus($this->clienteDao->gravar($this->cliente));
				}
			}
			
		}

		public function actionEdit($id,$post,$chavePesq,$campoPesq)
		{
			$acao = "edit";
			$clienteForm = new ClienteForm($this->cliente,$acao);
			$clienteForm->setEstados($this->clienteDao->listarEstados());
			$clienteForm->setInputFilter($this->cliente->getInputFilter());
			if($this->isPost()){
				$chavePesq = $post['chave_pesq'];
				$campoPesq = $post['campo_pesq'];
			    $clienteForm->setData($post);				
				if($clienteForm->isValid()){		
					$this->cliente->hidratar($clienteForm->getData());
					$clienteForm->setEditStatus($this->clienteDao->editar($this->cliente));											
				}
			}else{
				try{
					$this->cliente = $this->clienteDao->bindCliente($id);
					$clienteForm->bind($this->cliente);
				}catch(\Exception $e){
					$clienteForm->setMsgErro($e->getMessage());
				}
			}
			$clienteForm->setCamposHidden(array('chave_pesq'=>$chavePesq,'campo_pesq'=>$campoPesq));			
		}

		public function actionDelete($id,$chavePesq,$campoPesq)
		{
			$clienteLista = new ClienteListaForm();
			$clienteLista->setDeleteStatus($this->clienteDao->excluir($id));
			try{
				$clientes = $this->clienteDao->buscarPorCampo($chavePesq,$campoPesq);
			}catch(\Exception $e){
				$clientes = array();
			}
			$clienteLista->setData($clientes,$chavePesq,$campoPesq);
		}

		public function actionList($post,$chavePesq,$campoPesq)
		{
			$clienteLista = new ClienteListaForm();
			try{
				if($this->isPost()){
					$chavePesq = $post['chave_pesq'];
					$campoPesq = $post['campo_pesq'];			
				}
				$clientes = $this->clienteDao->buscarPorCampo(empty($chavePesq) ? "nome" : $chavePesq,$campoPesq);				
			}catch(\Exception $e){
				$clientes = array();
				$clienteLista->setMsgErro($e->getMessage());
			}
			$clienteLista->setData($clientes,$chavePesq,$campoPesq);
		}

		public function listarCidades($id){
			header('Content-Type: application/json; charset=utf-8');
			echo json_encode($this->clienteDao->listarCidades($id));
		}

		public function visualizaClientePorId($id){
			header('Content-Type: application/json; charset=utf-8');
			echo json_encode($this->clienteDao->visualizaClientePorId($id));
		}
	}
?>