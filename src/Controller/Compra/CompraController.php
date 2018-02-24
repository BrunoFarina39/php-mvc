<?php 
	namespace Controller\Compra;
	use Library\AbstractController;
	use View\Compra\CompraFormPai;
	use View\Compra\CompraForm;
	use View\Compra\compraFormPag;
	use Model\Compra\Compra;
	use Model\Compra\CompraDao;

	class CompraController extends AbstractController{

		function __construct(){
			$this->compra = new Compra();
			$this->compraDao = new CompraDao();
		}

		public function actionIndex()
		{
			$acao = "add";
			$compraForm = new CompraForm($acao);
		}

		public function ActionAdd($post){
			$this->compraFormPag = new CompraFormPag();
			$this->compraFormPag->setInputFilter($this->compra->getInputFilter());
			$this->compraFormPag->setData($post);
			if($this->compraFormPag->isValid()){
				if($post['finalizar']){
					$this->compraFormPag->renderConclusao(true);
				}else{
					$this->compraFormPag->renderPagamento();
				}
			}else{
				$compraForm = new CompraForm("add");
				$compraForm->setInputFilter($this->compra->getInputFilter());
				$compraForm->setData($post);
				$compraForm->isValid();
			}
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