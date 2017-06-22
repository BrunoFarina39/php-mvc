<?php 
	namespace View\Marca;
	use Library\AbstractForm;
	use Library\InputFilter;
	use Model\Marca\Marca;
	use Util\MasterView;
	class MarcaForm extends AbstractForm{
		private $acao;
		private $data;
		private $campos;
		
		function __construct($acao)
		{
			parent::__construct();
			$this->acao = $acao;
			$this->inputFilter = new InputFilter();
			$this->campos = new \stdClass();
			$this->campos->id = "";
			$this->campos->nome = "";
		}

		public function isValid()
		{
			return $this->inputFilter->isValid($this->campos);		 
		}

		public function setData($data)
		{
			$this->campos = (Object) $data;
		}
		
		public function getData()
		{
			$array = get_object_vars($this->campos);
			return $array;
		}


		public function bind(Marca $marca)
		{
			$this->campos->id = $marca->getId();
			$this->campos->nome = $marca->getNome();
		}

		public function limpaCampos()
		{
			$this->campos->id = "";
			$this->campos->nome = "";
		}

		function __destruct()
		{
			$masterView = new MasterView(MASTERVIEW::RENDER_ALL);
			echo $this->msgSucesso;
			echo $this->msgErro;
			if($this->acao  == "add"){
				include 'src/View/Layout/marca/add.php';
			}else{
			 	include 'src/View/Layout/marca/edit.php';
			}			
		}
	}

?>