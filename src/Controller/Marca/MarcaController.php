<?php 
	namespace Controller\Marca;
	use Library\AbstractController;
	use View\Marca\MarcaForm;
	use View\Marca\MarcaListaForm;
	use Model\Marca\Marca;
	use Model\Marca\MarcaDao;
	class MarcaController extends AbstractController{
		private $marca,$marcaDao;

		public function __construct()
		{
			$this->marca = new Marca();
			$this->marcaDao = new MarcaDao();
		}

		public function actionIndex()
		{
			$acao = "add";
			$marcaForm = new MarcaForm($acao);
		}

		public function actionAdd($post)
		{
			$acao = "add";
			$marcaForm = new MarcaForm($acao);
			$marcaForm->setInputFilter($this->marca->getInputFilter());
			if($this->isPost()){
				$marcaForm->setData($post);
				if($marcaForm->isValid()){
					$this->marca->hidratar($marcaForm->getData());
					$marcaForm->setAddStatus($this->marcaDao->gravar($this->marca));
				}
			}
		}

		public function actionEdit($id,$post,$campoPesq)
		{
			$acao = "edit";
			$marcaForm = new MarcaForm($this->marca,$acao);
			$marcaForm->setInputFilter($this->marca->getInputFilter());
			if($this->isPost()){
				$campoPesq = $post['campo_pesq'];
			    $marcaForm->setData($post);				
				if($marcaForm->isValid()){		
					$this->marca->hidratar($marcaForm->getData());
					$marcaForm->setEditStatus($this->marcaDao->editar($this->marca));											
				}
			}else{
				try{
					$marcas = $this->marcaDao->buscarPorCampo("id",$id);
					if(isset($marcas[0]))
						$this->marca = $marcas[0];
					$marcaForm->bind($this->marca);
				}catch(\Exception $e){
					$marcaForm->setMsgErro($e->getMessage());
				}
			}
			$marcaForm->setCamposHidden(array('campo_pesq'=>$campoPesq));			
		}

		public function actionDelete($id,$campoPesq)
		{
			$marcaLista = new MarcaListaForm();
			$marcaLista->setDeleteStatus($this->marcaDao->excluir($id));
			try{
				$marcas = $this->marcaDao->buscarPorCampo("nome",$campoPesq);
			}catch(\Exception $e){
				$marcas = array();
			}
			$marcaLista->setData($marcas,$campoPesq);
		}

		public function actionList($post,$campoPesq)
		{
			$marcaListaForm = new MarcaListaForm();
			try{
				if($this->isPost()){
					$campoPesq = $post['campo_pesq'];	
				}
				$marcas = $this->marcaDao->buscarPorCampo("nome",$campoPesq);
			}catch(Exception $e){
				$marcas = array();
				$marcaListaForm->getMsgErro($e->getMessage);
			}
			$marcaListaForm->setData($marcas,$campoPesq);
		}
	}
?>