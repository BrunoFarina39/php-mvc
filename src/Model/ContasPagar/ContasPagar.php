<?php 
	namespace Model\ContasPagar;
	use Model\Compra\Compra;
	use Model\Fornecedor\Fornecedor;
	use Library\AbstractModel;

	class ContasPagar extends AbstractModel{
		
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
	}
?>