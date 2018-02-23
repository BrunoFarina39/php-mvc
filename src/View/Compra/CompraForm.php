<?php 
	namespace View\Compra;
	//use Library\AbstractForm;
	use Library\InputFilter;
	use Util\MasterView;

	class CompraForm extends CompraFormPai{
		private $acao;
		private $campos;
		private $produtos;
		function __construct($acao){
			parent::__construct();
			$this->acao = $acao;
			$this->inputFilter = new InputFilter();
			$this->campos = new \stdClass();
			$this->campos->id = null;
			$this->campos->fornecedor = "";
			$this->campos->fornecedor_id = null;
			$this->campos->produto = "";
			$this->campos->produto_id = null;
			$this->campos->qtde = 1;
			$this->campos->desconto = 0;
			$this->campos->produtos="";
			$this->campos->valor_total=0;
			$this->produtos = array();
		}

		public function isValid()
		{
			return $this->inputFilter->isValid($this->campos);		 
		}

		public function setData($data)
		{
			$this->campos = (Object) $data;
			$this->produtos = explode("/", $data['produtos']);
			foreach ($this->produtos as $key => $value) {
				$this->produtos[$key]= explode("-", $value);
			}
		}

		function __destruct(){
			$masterView = new MasterView(MASTERVIEW::RENDER_ALL);
			if($this->acao  == "add"){
				include 'src/View/Layout/compra/add.php';
			}else{
				include 'src/View/Layout/compra/edit.php';
			}							
		}
	}

?>