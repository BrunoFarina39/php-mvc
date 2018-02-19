<?php 
	namespace View\Compra;
	use Library\AbstractForm;
	use Library\InputFilter;
	use Util\MasterView;

	class CompraFormPag extends AbstractForm{
		private $acao;
		private $campos;
		private $produtos;
		function __construct(){
			$this->campos = new \stdClass();
			$this->campos->formaPag[0]['id']="1";
			$this->campos->formaPag[0]['value']="À vista";
			$this->campos->formaPag[1]['id']="2";
			$this->campos->formaPag[1]['value']="À prazo";
			$this->campos->valorTotal=0;
			for($i=1; $i < 13; $i++){
				$this->campos->parcelas[$i]['id']=$i;
				$this->campos->parcelas[$i]['value']=$i;
			}
		}

		public function setData($data)
		{
			$this->produtos = explode("/", $data['produtos']);
			foreach ($this->produtos as $key => $value) {
				$this->produtos[$key]= explode("-", $value);
			}
			$this->campos->valorTotal=$data["valor_total"];
		}

		function __destruct(){
			$masterView = new MasterView(MASTERVIEW::RENDER_ALL);
			include 'src/View/Layout/compra/pagamento.php';						
		}
	}

?>