<?php 
	namespace Controller\Fornecedor;
	use Library\AbstractController;
	use View\Fornecedor\FornecedorForm;
	use View\Fornecedor\FornecedorListaForm;
	use Model\Fornecedor\Fornecedor;
	use Model\Fornecedor\FornecedorDao;
	
	class FornecedorController extends AbstractController{
		private $fornecedor,$fornecedorDao;
		
		function __construct()
		{
			$this->fornecedor = new Fornecedor();
			$this->fornecedorDao = new FornecedorDao();
		}

		public function actionIndex()
		{
			$acao = "add";
			$fornecedorForm = new FornecedorForm($acao);
			$fornecedorForm->setEstados($this->fornecedorDao->listarEstados());
		}

		public function actionAdd($post)
		{
			$acao = "add";
			$fornecedorForm = new FornecedorForm($acao);
			$fornecedorForm->setEstados($this->fornecedorDao->listarEstados());
			$fornecedorForm->setInputFilter($this->fornecedor->getInputFilter());
			if($this->isPost()){
				$fornecedorForm->setData($post);
				if($fornecedorForm->isValid()){
					$this->fornecedor->hidratar($fornecedorForm->getData());
					$fornecedorForm->setAddStatus($this->fornecedorDao->gravar($this->fornecedor));
				}
			}
			
		}

		public function actionEdit($id,$post,$chavePesq,$campoPesq)
		{
			$acao = "edit";
			$fornecedorForm = new FornecedorForm($this->fornecedor,$acao);
			$fornecedorForm->setEstados($this->fornecedorDao->listarEstados());
			$fornecedorForm->setInputFilter($this->fornecedor->getInputFilter());
			if($this->isPost()){
				$chavePesq = $post['chave_pesq'];
				$campoPesq = $post['campo_pesq'];
			    $fornecedorForm->setData($post);				
				if($fornecedorForm->isValid()){		
					$this->fornecedor->hidratar($fornecedorForm->getData());
					$fornecedorForm->setEditStatus($this->fornecedorDao->editar($this->fornecedor));											
				}
			}else{
				try{
					$this->fornecedor = $this->fornecedorDao->bindFornecedor($id);
					$fornecedorForm->bind($this->fornecedor);
				}catch(\Exception $e){
					$fornecedorForm->setMsgErro($e->getMessage());
				}
			}	
			$fornecedorForm->setCamposHidden(array('chave_pesq'=>$chavePesq,'campo_pesq'=>$campoPesq));		
		}

		public function actionDelete($id,$chavePesq,$campoPesq)
		{
			$fornecedorLista = new FornecedorListaForm();
			$fornecedorLista->setDeleteStatus($this->fornecedorDao->excluir($id));
			try{
				$fornecedores = $this->fornecedorDao->buscarPorCampo($chavePesq,$campoPesq);
			}catch(\Exception $e){
				$fornecedores = array();
			}
			$fornecedorLista->setData($fornecedores,$chavePesq,$campoPesq);
		}

		public function actionList($post,$chavePesq,$campoPesq)
		{
	
			$fornecedorLista = new FornecedorListaForm();
			try{
				if($this->isPost()){
					$chavePesq = $post['chave_pesq'];
					$campoPesq = $post['campo_pesq'];			
				}
				$fornecedores = $this->fornecedorDao->buscarPorCampo(empty($chavePesq) ? "nome_fantasia" : $chavePesq,$campoPesq);				
			}catch(\Exception $e){
				$fornecedores = array();
				$fornecedorLista->setMsgErro($e->getMessage());
			}
			$fornecedorLista->setData($fornecedores,$chavePesq,$campoPesq);
		}

		public function listarCidades($id){
			header('Content-Type: application/json; charset=utf-8');
			echo json_encode($this->fornecedorDao->listarCidades($id));
		}

		public function visualizaFornecedorPorId($id){
			header('Content-Type: application/json; charset=utf-8');
			echo json_encode($this->fornecedorDao->visualizaFornecedorPorId($id));
		}
	}
?>