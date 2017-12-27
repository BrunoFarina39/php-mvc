<?php 
	namespace Model\Marca;
	use Library\AbstractModel;
	use Model\Validation\ValidaMarca;
	
	class Marca extends AbstractModel{
		private $nome;
		
		public function __construct(){
			parent::__construct();
		}

		public function setNome($nome)
		{
			$this->nome = $nome;		
		}

		public function getNome()
		{
			return $this->nome;
		}

		use \Library\Hydrator;

		public function getInputFilter()
		{
			$validator = new ValidaMarca();
			return $validator->getInputMarca();
		}

		public function limpaCampos(){
			$this->id = null;
			$this->nome = "";
		}
	}
?>