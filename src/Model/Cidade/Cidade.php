<?php 
	namespace Model\Cidade;
	use Library\AbstractModel;
	use Model\Estado\Estado;
	
	class Cidade extends AbstractModel{
		private $nome;
		private $estado;

		public function __construct(){
			$this->estado = new Estado();
		}

		public function setNome($nome){		
			$this->nome = $nome;	
		}

		public function getNome(){
			return $this->nome;
		}

		public function setEstado($estado){
			$this->estado = $estado;
		}

		public function getEstado(){
			return $this->estado;
		}

		public function limpaCampos(){
			$this->id = null;
			$this->nome = "";
			$this->estado->limpaCampos();
		}
	}
?>