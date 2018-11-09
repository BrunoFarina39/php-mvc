<?php 
	namespace Model\Compra;
	use Library\AbstractModel;
	use Model\Fornecedor\Fornecedor;
	use Model\Validation\ValidaCompra;

	class Compra extends AbstractModel{
		private $fornecedor;
		private $valorTotal;
		private $itensCompra;

		public function __construct(){
			$this->fornecedor = new Fornecedor();
			//$this->itensCompra = new array();
		}

		public function setId($id){
			$this->id = $id;
		}

		public function getId(){
			return $this->id;
		}

		public function setFornecedor($fornecedor){
			$this->fornecedor = $fornecedor;
		}

		public function getFornecedor(){
			return $this->fornecedor;
		}

		public function setValorTotal($valorTotal){
			$this->valorTotal = $valorTotal;
		}

		public function getValorTotal(){
			return $this->valorTotal;
		}

		public function setItensCompra($itensCompra){
			$this->itensCompra = $itensCompra;
		}

		public function getItensCompra(){
			return $this->itensCompra;
		}

		use \Library\Hydrator;

		public function getInputFilter()
		{
			$validator = new ValidaCompra();
			return $validator->getInputCompra();
		}

		public function limpaCampos(){
			$this->id = null;
			$this->fornecedor;
			$this->produto;
			$this->qtde;
			$this->desconto;
			$this->valorTotal;
		}
	}

?>