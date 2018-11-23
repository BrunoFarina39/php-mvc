<?php 
	namespace Model\FormaPag;
	use Model\Compra\Compra;
	use Model\ContasPagar\ContasPagar;
	use Library\AbstractModel;

	class FormaPag extends AbstractModel{

		private $compra;
		private $contasPagar;
		private $formaPag;
		private $nParcelas;
		private $intervalo;
		private $entrada;
		private $carencia;

		public function __construct(){
			$this->compra = new Compra();
			$this->contasPagar = new ContasPagar();
		}

		public function setId($id){
			$this->id = $id;
		}

		public function getId(){
			return $this->id;
		}

		public function setCompra($compra){
			$this->compra = $compra;
		}

		public function getCompra(){
			return $this->compra;
		}

		public function setContasPagar($contasPagar){
			$this->contasPagar = $contasPagar;
		}

		public function getContasPagar(){
			return $this->contasPagar;
		}

		public function setFormaPag($formaPag){
			$this->formaPag = $formaPag;
		}

		public function getFormaPag(){
			return $this->formaPag;
		}

		public function setNParcelas($nParcelas){
			$this->nParcelas = $nParcelas;
		}

		public function getNParcelas(){
			return $this->nParcelas;
		}

		public function setIntervalo($intervalo){
			$this->intervalo= $intervalo;
		}

		public function getIntervalo(){
			return $this->intervalo;
		}

		public function setEntrada($entrada){
			$this->entrada = $entrada;
		}

		public function getEntrada(){
			return $this->entrada;
		}

		public function setCarencia($carencia){
			$this->carencia = $carencia;
		}

		public function getCarencia(){
			return $this->carencia;
		}
	}
?>