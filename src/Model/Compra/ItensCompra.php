<?php
	namespace Model\Compra;
	use Library\AbstractModel;
	use Model\Validation\ValidaCompra;
	use Model\Produto\Produto;

	class ItensCompra extends AbstractModel{
		
		private $produto;
		private $qtde;
		private $valorUnitario;
		private $desconto;
		private $valorTotal;
		
		public function __construct(){
			$this->produto = new Produto();
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
			$this->valorUnitario = join("", explode("R$",$this->valorUnitario));
			$this->valorUnitario = join("", explode(".",$this->valorUnitario));
			$this->valorUnitario = join("", explode(",",$this->valorUnitario));
			$moeda = substr($this->valorUnitario, 0,-2).".";
			$moeda .= substr($this->valorUnitario, -2,2);			
			$this->valorUnitario = $moeda;
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
			$this->valorTotal = join("", explode("R$",$this->valorTotal));
			$this->valorTotal = join("", explode(".",$this->valorTotal));
			$this->valorTotal = join("", explode(",",$this->valorTotal));
			$moeda = substr($this->valorTotal, 0,-2).".";
			$moeda .= substr($this->valorTotal, -2,2);			
			$this->valorTotal = $moeda;
			return $this->valorTotal;
		}

		use \Library\Hydrator;

		public function getInputFilter()
		{
			$validator = new ValidaCompra();
			return $validator->getInputCompra();
		}
	}
?>