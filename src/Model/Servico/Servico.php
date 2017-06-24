<?php 
	namespace Model\Servico;
	use Library\AbstractModel;
	use Model\Validation\ValidaServico;
	class Servico extends AbstractModel{
		private $descricao;
		private $preco;
		
		public function __construct()
		{
			parent::__construct();
		}

		public function setDescricao($descricao)
		{
			$this->descricao = $descricao;
		}

		public function getDescricao()
		{
			return $this->descricao;
		}

		public function setPreco($preco)
		{
			$this->preco = $preco;
		}

		public function getPreco()
		{
			$this->preco = join("", explode("R$",$this->preco));
			$this->preco = join("", explode(".",$this->preco));
			$this->preco = join("", explode(",",$this->preco));
			$moeda = substr($this->preco, 0,-2).".";
			$moeda .= substr($this->preco, -2,2);			
			$this->preco = $moeda;
			return $this->preco;
		}

		use \Library\Hydrator;

		public function getInputFilter()
		{
			$validator = new ValidaServico();
			return $validator->getInputServico();
		}

		public function limpaCampos()
		{
			$this->id = null;
			$this->descricao = "";
			$this->preco = "";
		}
	}
?>