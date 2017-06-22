<?php 
	namespace Model\Cidade;
	use Library\AbstractModel;
	use Model\Estado\Estado;
	class Cidade extends AbstractModel{
		private $nome;
		private $estado;

		function __construct(){
			$this->estado = new Estado();
		}

		function setNome($nome){
			if(!empty($nome))
				$this->nome = $nome;
			else
				return "campo cidade em branco";
		}

		function getNome(){
			return $this->nome;
		}

		function setEstado($estado){
			$this->estado = $estado;
		}

		function getEstado(){
			return $this->estado;
		}

		function limpaCampos(){
			$this->id = null;
			$this->nome = "";
			$this->estado->limpaCampos();
		}
	}
?>