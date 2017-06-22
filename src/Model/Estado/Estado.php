<?php 
	namespace Model\Estado;
	use Library\AbstractModel;
	class Estado extends AbstractModel{
		private $nome;
		private $uf;

		function setNome($nome)
		{
			$this->nome = $nome;
		}

		function getNome()
		{
			return $this->nome;
		}

		function setUf($uf)
		{
			$this->uf = $uf;
		}

		function getUf()
		{
			return $this->uf;
		}

		function limpaCampos(){
			$this->id = null;
			$this->nome = "";
			$this->uf = "";
		}
	}
?>