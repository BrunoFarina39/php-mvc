<?php 
	namespace Model\Estado;
	use Library\AbstractModel;
	
	class Estado extends AbstractModel{
		private $nome;
		private $uf;

		public function __construct()
		{
			
		}

		public function setNome($nome)
		{
			$this->nome = $nome;
		}

		public function getNome()
		{
			return $this->nome;
		}

		public function setUf($uf)
		{
			$this->uf = $uf;
		}

		public function getUf()
		{
			return $this->uf;
		}

		public function limpaCampos(){
			$this->id = null;
			$this->nome = "";
			$this->uf = "";
		}
	}
?>