<?php 
	namespace Controller\Produto;
	use Library\AbstractController;
	use View\Produto\ProdutoForm;
	use View\Produto\ProdutoListaForm;
	use Model\Produto\Produto;
	use Model\Produto\ProdutoDao;
	class ProdutoController extends AbstractController{
		private $produto,$produtoDao;

		public function __construct()
		{
			$this->produto = new Produto();
			$this->produtoDao = new ProdutoDao();
		}

		public function actionIndex()
		{
			$acao = "add";
			$produtoForm = new ProdutoForm($acao);
		}

		public function actionAdd($post)
		{
			$acao = "add";
			$produtoForm = new ProdutoForm($acao);
			$produtoForm->setInputFilter($this->produto->getInputFilter());
			if($this->isPost()){
				$produtoForm->setData($post);
				if($produtoForm->isValid()){
					$this->produto->hidratar($produtoForm->getData());
					$produtoForm->setAddStatus($this->produtoDao->gravar($this->produto));
				}
			}
		}

		public function actionEdit($id,$post,$chavePesq,$campoPesq)
		{
			$acao = "edit";
			$produtoForm = new ProdutoForm($acao);
			$produtoForm->setInputFilter($this->produto->getInputFilter());
			if($this->isPost()){
				$chavePesq = $post['chave_pesq'];
				$campoPesq = $post['campo_pesq'];
				$produtoForm->setData($post);
				if($produtoForm->isValid()){
					$this->produto->hidratar($produtoForm->getData());
					$produtoForm->setEditStatus($this->produtoDao->editar($this->produto));
				}
			}else{
				try{
					$produtos = $this->produtoDao->buscaAvancada($id);
					if(isset($produtos[0]))
						$this->produto = $produtos[0];
					$produtoForm->bind($this->produto);
				}catch(\Exception $e){
					$produtoForm->setMsgErro($e->getMessage());
				}
			}
			$produtoForm->setCamposHidden(array('chave_pesq'=>$chavePesq,'campo_pesq'=>$campoPesq));
		}

		public function actionDelete($id,$chavePesq,$campoPesq)
		{
			$produtoLista = new ProdutoListaForm();
			$produtoLista->setDeleteStatus($this->produtoDao->excluir($id));
			try{
				$produtos = $this->produtoDao->buscarPorCampo($chavePesq,$campoPesq);
			}catch(Exception $e){
				$produtos = array();
			}
			$produtoLista->setData($produtos,$chavePesq,$campoPesq);
		}

		public function actionList($post,$chavePesq,$campoPesq)
		{
			$produtoLista = new ProdutoListaForm();
			try{
				if($this->isPost()){
					$chavePesq = $post['chave_pesq'];
					$campoPesq = $post['campo_pesq'];	
				}
				$produtos = $this->produtoDao->buscarPorCampo(empty($chavePesq) ? "descricao" : $chavePesq,$campoPesq);
			}catch(Exception $e){
				$produtos = array();
				$produtoLista->setMsgErro($e->getMessage());
			}
			$produtoLista->setData($produtos,$chavePesq,$campoPesq);
		}

		public function listarMarcas(){
			header('Content-Type: application/json; charset=utf-8');
			echo json_encode($this->produtoDao->listarMarcas());
		}

		public function visualizaProdutoPorId($id){
			header('Content-Type: application/json; charset=utf-8');
			echo json_encode($this->produtoDao->visualizaProdutoPorId($id));
		}
	}
?>