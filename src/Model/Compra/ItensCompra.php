<?php
	namespace Model\Compra;
	use Library\AbstractModel;
	use Model\Validation\ValidaCompra;

	class ItensCompra extends AbstractModel{
		
		private $produto;
		private $qtde;
		private $valorUnitario;
		private $desconto;
		private $valorTotal;
		
		public function __construct(){
	
		}

		public function setId($id){
			$this->id = $id;
		}

		public function getId(){
			return $this->id;
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

		public function setValorUnitario($valorUnitario){
			$this->valorUnitario = $valorUnitario;
		}

		public function getValorUnitario(){
			return $this->valorUnitario;
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

		public function hidrator(Object $itens){
			$this->setProduto($itens->produto);
			$this->setQtde($itens->qtde);
			$this->setValorUnitario($itens->valorUnitario);
			$this->setDesconto($itens->desconto);
			$this->setValorTotal($itens->valorTotal);
		}

		public function getInputFilter()
		{
			$validator = new ValidaCompra();
			return $validator->getInputCompra();
		}
	}
?>