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
			
			if($this->isPost()){
				$compraFormPai = new CompraFormPai();
				if($compraFormPai->getForm($post) == "add"){
					$compraForm = new CompraForm("add");
					$compraForm->setInputFilter($this->compra->getInputFilter());
					$compraForm->setData($post);
					if($compraForm->isValid()){

					}
				}else{
					$compraFormPag = new CompraFormPag();
					$compraFormPag->setInputFilter($this->compra->getInputFilter());
					$compraFormPag->setData($post);
				}
			}else{
				$compraForm = new CompraForm("add");
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