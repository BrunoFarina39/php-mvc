<?php 
	namespace Model\Produto;
	use Library\AbstractModel;
	use Model\Validation\ValidaProduto;
	use Model\Marca\Marca;
	class Produto extends AbstractModel{
		private $codBarra;
		private $descricao;
		private $marca;
		private $precoCompra;
		private $precoVenda;
		private $qtdEst;

		public function __construct()
		{
			parent::__construct();
			$this->marca = new Marca();
		}

		public function setCodBarra($codBarra)
		{
			$this->codBarra = $codBarra;
		}

		public function getCodBarra()
		{
			return $this->codBarra;
		}

		public function setDescricao($descricao)
		{	
			$this->descricao = $descricao;
		}

		public function getDescricao()
		{
			return $this->descricao;
		}

		public function setMarca($marca)
		{
			$this->marca = $marca;
		}

		public function getMarca()
		{
			return $this->marca;
		}

		public function setPrecoCompra($precoCompra)
		{
			$this->precoCompra = $precoCompra;
		}

		public function getPrecoCompra()
		{
			$this->precoCompra = join("", explode("R$",$this->precoCompra));
			$this->precoCompra = join("", explode(".",$this->precoCompra));
			$this->precoCompra = join("", explode(",",$this->precoCompra));
			$moeda = substr($this->precoCompra, 0,-2).".";
			$moeda .= substr($this->precoCompra, -2,2);			
			$this->precoCompra = $moeda;
			return $this->precoCompra;
		}

		public function setPrecoVenda($precoVenda)
		{
			$this->precoVenda = $precoVenda;
		}

		public function getPrecoVenda()
		{
			$this->precoVenda = join("", explode("R$",$this->precoVenda));
			$this->precoVenda = join("", explode(".",$this->precoVenda));
			$this->precoVenda = join("", explode(",",$this->precoVenda));
			$moeda = substr($this->precoVenda, 0,-2).".";
			$moeda .= substr($this->precoVenda, -2,2);
			$this->precoVenda = $moeda;
			return $this->precoVenda;
		}

		public function setQtdeEst($qtdEst)
		{
			$this->qtdEst = $qtdEst;
		}

		public function getQtdeEst()
		{
			return $this->qtdEst;
		}

		use \Library\Hydrator;

		public function getInputFilter()
		{
			$validator = new ValidaProduto();
			return $validator->getInputProduto();
		}

		public function limpaCampos()
		{
			$this->id = null;
			$this->codBarra = "";
			$this->descricao = "";
			$this->marca->limpaCampos();
			$this->precoCompra = "";
			$this->precoVenda = "";
			$this->qtdEst = null;
		}
	}
?>