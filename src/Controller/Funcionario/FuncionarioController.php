<?php 
	namespace Controller\Funcionario;
	use Library\AbstractController;
	use View\Funcionario\FuncionarioForm;
	use View\Funcionario\FuncionarioListaForm;
	use Model\Funcionario\Funcionario;
	use Model\Funcionario\FuncionarioDao;
	class FuncionarioController extends AbstractController{
		private $funcionario,$funcionarioDao;

		public function __construct()
		{
			$this->funcionario = new Funcionario();
			$this->funcionarioDao = new FuncionarioDao();
		}

		public function actionIndex()
		{
			$acao = "add";
			$funcionarioForm = new FuncionarioForm($acao);
			$funcionarioForm->setEstados($this->funcionarioDao->listarEstados());
		}

		public function actionAdd($post)
		{
			$acao = "add";
			$funcionarioForm = new FuncionarioForm($acao);
			$funcionarioForm->setEstados($this->funcionarioDao->listarEstados());
			$funcionarioForm->setInputFilter($this->funcionario->getInputFilter());
			if($this->isPost()){
				$funcionarioForm->setData($post);
				if($funcionarioForm->isValid()){
					$this->funcionario->hidratar($funcionarioForm->getData());
					$funcionarioForm->setAddStatus($this->funcionarioDao->gravar($this->funcionario));
				}
			}
		}

		public function actionEdit($id,$post,$chavePesq,$campoPesq)
		{
			$acao = "edit";
			$funcionarioForm = new FuncionarioForm($acao);
			$funcionarioForm->setEstados($this->funcionarioDao->listarEstados());
			$funcionarioForm->setInputFilter($this->funcionario->getInputFilter());
			if($this->isPost()){
				$chavePesq = $post['chave_pesq'];
				$campoPesq = $post['campo_pesq'];
				$funcionarioForm->setData($post);
				if($funcionarioForm->isValid()){
					$this->funcionario->hidratar($funcionarioForm->getData());
					$funcionarioForm->setEditStatus($this->funcionarioDao->editar($this->funcionario));
				}
			}else{
				try{
					$this->funcionario = $this->funcionarioDao->bindFuncionario($id);
					$funcionarioForm->bind($this->funcionario);
				}catch(\Exception $e){
					$funcionarioForm->setMsgErro($e->getMessage());
				}
			}
			$funcionarioForm->setCamposHidden(array('chave_pesq'=>$chavePesq,'campo_pesq'=>$campoPesq));
		}

		public function actionDelete($id,$chavePesq,$campoPesq)
		{
			$funcionarioLista = new FuncionarioListaForm();
			$funcionarioLista->setDeleteStatus($this->funcionarioDao->excluir($id));
			try{
				$funcionarios = $this->funcionarioDao->buscarPorCampo($chavePesq,$campoPesq);
			}catch(\Exception $e){
				$funcionarios = array();
			}
			$funcionarioLista->setData($funcionarios,$chavePesq,$campoPesq);
		}

		public function actionList($post,$chavePesq,$campoPesq)
		{
			$funcionarioLista = new FuncionarioListaForm();
			try{
				if($this->isPost()){
					$chavePesq = $post['chave_pesq'];
					$campoPesq = $post['campo_pesq'];			
				}
				$funcionarios = $this->funcionarioDao->buscarPorCampo(empty($chavePesq) ? "nome" : $chavePesq,$campoPesq);				
			}catch(\Exception $e){
				$funcionarios = array();
				$funcionarioLista->setMsgErro($e->getMessage());
			}
			$funcionarioLista->setData($funcionarios,$chavePesq,$campoPesq);
		}

		public function listarCidades($id){
			header('Content-Type: application/json; charset=utf-8');
			echo json_encode($this->funcionarioDao->listarCidades($id));
		}

		public function visualizaFuncionarioPorId($id){
			header('Content-Type: application/json; charset=utf-8');
			echo json_encode($this->funcionarioDao->visualizaFuncionarioPorId($id));
		}
	}

?>