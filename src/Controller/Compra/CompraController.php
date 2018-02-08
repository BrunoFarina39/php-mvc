<?php 
	namespace Controller\Compra;
	use Library\AbstractController;
	use View\Compra\CompraForm;

	class CompraController extends AbstractController{

		function __construct(){

		}

		public function actionIndex()
		{
			$acao = "add";
			$compraForm = new CompraForm($acao);
		}

		public function listarFornecedores($id){
			header('Content-Type: application/json; charset=utf-8');
			echo json_encode("{nome:bruno}");
		}
	}
?>