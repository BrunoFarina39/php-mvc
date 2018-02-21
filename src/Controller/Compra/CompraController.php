<?php 
	namespace Controller\Compra;
	use Library\AbstractController;
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
				if($post["finalizar"]!=true){
					$compraFormPag = new compraFormPag();
					$compraFormPag->setData($post);
				}else{
					$compraForm = new CompraForm("add");
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