<?php 
	namespace Controller\Compra;
	use Library\AbstractController;
	use View\Compra\CompraFormPai;
	use View\Compra\CompraForm;
	use View\Compra\compraFormPag;
	use Model\Compra\Compra;
	use Model\Compra\CompraDao;
	use View\Compra\Instancia;
	class CompraController extends AbstractController{

		private $compra;
		private $compraDao;
		
		function __construct(){
			$this->compra = new Compra();
			$this->compraDao = new CompraDao();
		}

		public function actionIndex()
		{
			$compraForm = new CompraForm();
			$compraForm->render();
		}

		public function ActionAdd($post){
			$this->compraForm = new CompraForm();
			$this->compraForm->setInputFilter($this->compra->getInputFilter());
			$this->compraForm->setData($post);
			if($this->isPost()){
				if($this->compraForm->isValid()){
					$compraFormPag = new CompraFormPag();
					$compraFormPag->setData($post);
					$compraFormPag->renderPagamento();
				}else{
					$this->compraForm->render();
				}
			}else{
				$this->compraForm = new CompraForm();
				$this->compraForm->render();
			}
			
		}

		public function ActionAddPag($post){
			if($this->isPost()){
				$compraFormPag = new CompraFormPag();
				$compraFormPag->setData($post);
				if($post['finalizar']){
					$compraFormPag->renderConclusao(true);
				}else{
					$compraFormPag->renderPagamento();
				}
			}else{
				$this->compraForm = new CompraForm();
				$this->compraForm->render();
			}
		}

		public function getTabela($post){
			$compraFormPag = new CompraFormPag();
			$compraFormPag->renderTabela($post);
		}

		public function listarFornecedores(){
			header('Content-Type: application/json; charset=utf-8');
			echo json_encode($this->compraDao->listarFornecedores());
		}

		public function listarProdutos(){
			header('Content-Type: application/json; charset=utf-8');
			echo json_encode($this->compraDao->listarProdutos());
		}

		public function buscaPrecoCompra($id){
			echo json_encode($this->compraDao->buscaPrecoCompra($id));
		}
	}
?>