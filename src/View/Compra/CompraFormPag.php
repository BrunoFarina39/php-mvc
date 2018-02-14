<?php 
	namespace View\Compra;
	use Library\AbstractForm;
	use Library\InputFilter;
	use Util\MasterView;

	class CompraFormPag extends AbstractForm{
		private $acao;
		private $campos;
		
		function __construct(){
			$this->campos = new \stdClass();
			$this->campos->formaPag[0]['id']="1";
			$this->campos->formaPag[0]['value']="À vista";
			$this->campos->formaPag[1]['id']="2";
			$this->campos->formaPag[1]['value']="À prazo";
		}

		function __destruct(){
			$masterView = new MasterView(MASTERVIEW::RENDER_ALL);
			include 'src/View/Layout/compra/pagamento.php';						
		}
	}

?>