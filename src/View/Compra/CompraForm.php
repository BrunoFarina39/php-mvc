<?php 
	namespace View\Compra;
	use Library\AbstractForm;
	use Library\InputFilter;
	use Util\MasterView;

	class CompraForm extends AbstractForm{
		private $acao;
		private $campos;
		private $produtos;
		
		function __construct(){
			parent::__construct();
			$this->inputFilter = new InputFilter();
			$this->campos = new \stdClass();
			$this->campos->id = null;
			$this->fornecedor = "";
			$this->campos->fornecedor_id = null;
			$this->produto_id = null;
			$this->qtde = 1;
			$this->desconto = 0;
			$this->campos->valor_total = 0;
			$this->campos->produtos = array();
		}

		public function isValid()
		{
			return $this->inputFilter->isValid($this->campos);		 
		}

		public function setData($data)
		{
			$this->campos->id = $data['id'];
			$this->campos->fornecedor_id = $data['fornecedor_id'];
			$this->campos->produtos = json_decode($data["produtos"], true);
			$this->campos->valor_total = $data['valor_total'];
		}

		public function getData()
		{
			$array = ['id'=>$this->campos->id,'fornecedor_id'=>$this->campos->fornecedor_id,'produtos'=>$this->campos->produtos];;
			return $array;
		}

		public function render(){
			$masterView = new MasterView(MASTERVIEW::RENDER_ALL);
			include 'src/View/Layout/compra/add.php';		
		}

		function __destruct(){
								
		}
	}

?>