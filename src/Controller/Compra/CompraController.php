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
	}
?>