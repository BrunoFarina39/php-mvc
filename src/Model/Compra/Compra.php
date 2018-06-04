<?php 
	namespace Model\Compra;
	use Library\AbstractModel;
	use Model\Fornecedor\Fornecedor;
	use Model\Validation\ValidaCompra;

	class Compra extends AbstractModel{
		private $fornecedor;
		private $produto;
		private $preco_compra;
		private $qtde;
		private $desconto;
		private $valorTotal;

		public function __construct(){
			$fornecedor = new Fornecedor();
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

		public function setProduto($produto){
			$this->produto = $produto;
		}

		public function getProduto(){
			return $this->produto;
		}

		public function setPrecoCompra($preco_compra){
			$this->preco_compra = $preco_compra;
		}

		public function getPrecoCompra(){
			return $this->preco_compra;
		}

		public function setQtde($qtde){
			$this->qtde = $qtde;
		}

		public function getQtde(){
			return $this->qtde;
		}

		public function setDesconto($desconto){
			$this->desconto = $desconto;
		}

		public function getDesconto(){
			return $this->desconto;
		}

		public function setValorTotal($valorTotal){
			$this->valorTotal = $valorTotal;
		}

		public function getValorTotal(){
			return $this->valorTotal;
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