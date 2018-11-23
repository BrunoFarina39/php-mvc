<?php 
	namespace Model\Compra;
	use Library\AbstractModel;
	use Model\Fornecedor\Fornecedor;
	use Model\Validation\ValidaCompra;

	class Compra extends AbstractModel{
		private $fornecedor;
		private $dataInclusao;
		private $dataBaixa;
		private $valorTotal;
		private $status;
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

		public function setDataInclusao($dataInclusao){
			$this->dataInclusao = $dataInclusao;
		}

		public function getDataInclusao(){
			return $this->dataInclusao;
		}

		public function setDataBaixa($dataBaixa){
			$this->dataBaixa = $dataBaixa;
		}

		public function getDataBaixa(){
			return $this->dataBaixa;
		}


		public function setValorTotal($valorTotal){
			$this->valorTotal = $valorTotal;
		}

		public function getValorTotal(){
			return $this->valorTotal;
		}

		public function setStatus($status){
			$this->status = $status;
		}

		public function getStatus(){
			return $this->status;
		}

		public function setItensCompra($itensCompra){
			$this->itensCompra = $itensCompra;
		}

		public function getItensCompra(){
			return $this->itensCompra;
		}

		public function hidratar($data)
		{
			
			if(is_object($data)){
				$data = get_object_vars($data);
			}
			$this->id = (isset($data['id'])) ? $data['id'] : null;
			$this->fornecedor->setId((isset($data['fornecedor_id'])) ? $data['fornecedor_id'] : null);
			$this->dataInclusao = (isset($data['dataInclusao'])) ? $data['dataInclusao'] : null;
			$this->valorTotal = (isset($data['valorTotal'])) ? $data['valorTotal'] : null;
			$this->status = (isset($data['status'])) ? $data['status'] : null;
			
			foreach ($data['produtos'] as $key => $value) {
				$this->itensCompra[$key] = new ItensCompra();
				$this->itensCompra[$key]->getProduto()->setId($value['id']);
				$this->itensCompra[$key]->getProduto()->setDescricao($value['produto']);
				$this->itensCompra[$key]->setQtde($value['qtde']);
				$this->itensCompra[$key]->setValorUnitario($value['preco_compra']);
				$this->itensCompra[$key]->setDesconto($value['desconto']);
				$this->itensCompra[$key]->setValorTotal($value['valor_total']);
			}
		}

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