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
			$this->entrada = join("", explode("R$",$this->entrada));
			$this->entrada = join("", explode(".",$this->entrada));
			$this->entrada = join("", explode(",",$this->entrada));
			$moeda = substr($this->entrada, 0,-2).".";
			$moeda .= substr($this->entrada, -2,2);			
			$this->entrada = $moeda;
			return $this->entrada;
		}

		public function setCarencia($carencia){
			$this->carencia = $carencia;
		}

		public function getCarencia(){
			return $this->carencia;
		}

		public function hidratar($data)
		{
			
			print_r($data);
			if(is_object($data)){
				$data = get_object_vars($data);
			}
			$this->id = (isset($data['id'])) ? $data['id'] : null;
			//$this->compra = (isset($data['compras'])) ? $data['compras'] : null;
			//$this->contasPagar = (isset($data['contas_pagar'])) ? $data['contas_pagar'] : null;
			$this->formaPag = (isset($data['formaPag'])) ? $data['formaPag'] : null;
			$this->nParcelas = (isset($data['parcelas'])) ? $data['parcelas'] : null;
			$this->intervalo = (isset($data['intervalo'])) ? $data['intervalo'] : null;
			$this->entrada = (isset($data['entrada'])) ? $data['entrada'] : null;
			$this->carecia = (isset($data['carencia'])) ? $data['carencia'] : null;
		}
	}
?>