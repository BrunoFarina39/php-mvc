<?php 
	namespace View\Servico;
	use Library\AbstractForm;
	use Library\InputFilter;
	use Model\Servico\Servico;
	use Util\MasterView;
	
	class ServicoForm extends AbstractForm{
		private $acao;
		private $campos;

		public function __construct($acao)
		{
			parent::__construct();
			$this->acao = $acao;
			$this->inputFilter = new InputFilter();
			$this->campos = new \stdClass();
			$this->campos->id = null;
			$this->campos->descricao = "";
			$this->campos->preco = "";
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

		public function bind(Servico $servico)
		{
			$this->campos->id = $servico->getId();
			$this->campos->descricao = $servico->getDescricao();
			$this->campos->preco = $servico->getPreco();
		}

		public function limpaCampos()
		{
			$this->campos->id = null;
			$this->campos->descricao = "";
			$this->campos->preco = "";
		}

		function __destruct()
		{
			$this->campos->preco = $this->formataMoeda($this->campos->preco);
			$masterView = new MasterView(MASTERVIEW::RENDER_ALL);
			echo $this->msgSucesso;
			echo $this->msgErro;
			if($this->acao  == "add"){
				include 'src/View/Layout/servico/add.php';
			}else{
			 	include 'src/View/Layout/servico/edit.php';
			}			
		}
	}
?>