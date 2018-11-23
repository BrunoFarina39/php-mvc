<?php 
	namespace Model\CotasPagar;
	use Model\Compra;
	use Model\Fornecedor;
	use Library\AbstractModel;

	class ContasPagar extends AbstractModel{
		
		private $id;
		private $compra;
		private $fornecedor;
		private $dataInclusao;
		private $status;
		
		public function __construct(){
			$this->compra = new Compra();
			$this->fornecedor = new Fornecedor();
		}

		public function setId($id){
			$this->id = $id;
		}

		public function getId(){
			return $this->id;
		}

		public function setCompra($compra){
			$this->compra= $compra;
		}

		public function getCompra(){
			return $this->compra;
		}

		public function setFornecedor($fornecedor){
			$this->fornecedor = $fornecedor;
		}

		public function getFornecedor(){
			return $this->fornecedor;
		}

		public function setDataInclusao($dataInclusao){
			$this->dataInclusao = $dataInclusao;
		}

		public function getDataInclusao(){
			return $this->dataInclusao;
		}

		public function setStatus($status){
			$this->status = $status;
		}

		public function getStatus(){
			return $this->status;
		}

		public function hidrator(Object $itens){
			$this->set($itens->produto);
			$this->setQtde($itens->qtde);
			$this->setValorUnitario($itens->valorUnitario);
			$this->setDesconto($itens->desconto);
			$this->setValorTotal($itens->valorTotal);
		}
	}
?>