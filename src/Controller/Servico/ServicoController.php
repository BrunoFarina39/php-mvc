<?php
	namespace Controller\Servico;
	use Library\AbstractController;
	use View\Servico\ServicoForm;
	use View\Servico\ServicoListaForm;
	use Model\Servico\Servico;
	use Model\Servico\ServicoDao;
	class ServicoController extends AbstractController{
		private $servico,$servicoDao;
		
		public function __construct()
		{
			$this->servico = new Servico();
			$this->servicoDao = new ServicoDao();
		}

		public function actionIndex()
		{
			$acao = "add";
			$servicoForm = new ServicoForm($acao);
		}

		public function actionAdd($post)
		{
			$acao = "add";
			$servicoForm = new ServicoForm($acao);
			$servicoForm->setInputFilter($this->servico->getInputFilter());
			if($this->isPost()){
				$servicoForm->setData($post);
				if($servicoForm->isValid()){
					$this->servico->hidratar($servicoForm->getData());
					$servicoForm->setAddStatus($this->servicoDao->gravar($this->servico));
				}
			}
		}

		public function actionEdit($id,$post,$campoPesq)
		{
			$acao = "edit";
			$servicoForm = new ServicoForm($acao);
			$servicoForm->setInputFilter($this->servico->getInputFilter());
			if($this->isPost()){
				$campoPesq = $post['campo_pesq'];
				$servicoForm->setData($post);
				if($servicoForm->isValid()){
					$this->servico->hidratar($servicoForm->getData());
					$servicoForm->setEditStatus($this->servicoDao->editar($this->servico));
				}
			}else{
				try{
					$servicos = $this->servicoDao->buscarPorCampo("id",$id);
					if(isset($servicos[0]))
						$this->servico = $servicos[0];
					$servicoForm->bind($this->servico);
				}catch(\Exception $e){
					$servicoForm->setMsgErro($e->getMessage());
				}
			}
			$servicoForm->setCamposHidden(array('campo_pesq'=>$campoPesq));	
		}

		public function actionDelete($id,$campoPesq)
		{
			$servicoListaForm = new ServicoListaForm();
			$servicoListaForm->setDeleteStatus($this->servicoDao->excluir($id));
			try{
				$servicos = $this->servicoDao->buscarPorCampo("descricao",$campoPesq);
			}catch(\Exception $e){
				$servicos = array();
			}
			$servicoListaForm->setData($servicos,$campoPesq);
		}

		public function actionList($post,$campoPesq)
		{
			$servicoListaForm = new ServicoListaForm();
			try{
				if($this->isPost()){
					$campoPesq = $post['campo_pesq'];
				}
				$servicos = $this->servicoDao->buscarPorCampo("descricao",$campoPesq);
			}catch(\Exception $e){
				$servicos = array();
				$servicoListaForm->setMsgErro($e->getMessage());
			}
			$servicoListaForm->setData($servicos,$campoPesq);
		}
	}
?>