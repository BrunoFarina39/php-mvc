<?php 
	namespace Model\Compra;
	use Library\AbstractModel;
	use Model\Fornecedor\Fornecedor;

	class Compra extends AbstractModel{
		private $fornecedor;
		private $produto;
		private $qtde;
		private $desconto;

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
	}

?>