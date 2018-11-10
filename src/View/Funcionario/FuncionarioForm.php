<?php 
	namespace View\Funcionario;
	use Library\AbstractForm;
	use Library\InputFilter;
	use Model\Funcionario\Funcionario;
	use Util\MasterView;
	
	class FuncionarioForm extends AbstractForm{
		private $acao;
		private $campos;
		private $estados;
		
		public function __construct($acao)
		{
			parent::__construct();
			$this->acao = $acao;
			$this->inputFilter = new InputFilter();
			$this->campos = new \stdClass();
			$this->campos->id = null;
			$this->campos->nome = "";
			$this->campos->rg = "";
			$this->campos->cpf = "";
			$this->campos->pis = "";
			$this->campos->endereco = "";
			$this->campos->numero = null;
			$this->campos->bairro = "";
			$this->campos->cep = "";
			$this->campos->cidade = "";
			$this->campos->cidade_id = null;
			$this->campos->fone = "";
			$this->campos->salario = "";
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
			return get_object_vars($this->campos);
		}

		public function setEstados(Array $estados){
			$this->estados = $estados;
		}

		public function bind(Funcionario $funcionario)
		{
			$this->campos->id = $funcionario->getId();
			$this->campos->nome = $funcionario->getNome();
			$this->campos->rg = $funcionario->getRg();
			$this->campos->cpf = $funcionario->getCpf();
			$this->campos->pis = $funcionario->getPis();
			$this->campos->endereco =  $funcionario->getEndereco();
			$this->campos->numero = $funcionario->getNumero();
			$this->campos->bairro = $funcionario->getBairro();
			$this->campos->cep = $funcionario->getCep();
			$this->campos->estado = $funcionario->getCidade()->getEstado()->getId();
			$this->campos->cidade_id = $funcionario->getCidade()->getId();
			$this->campos->cidade = $funcionario->getCidade()->getNome();
			$this->campos->fone = $funcionario->getFone();
			$this->campos->salario = $funcionario->getSalario();
		}

		public function limpaCampos()
		{
			$this->campos->id = null;
			$this->campos->nome = "";
			$this->campos->rg = "";
			$this->campos->cpf = "";
			$this->campos->pis = "";
			$this->campos->endereco = "";
			$this->campos->numero = null;
			$this->campos->bairro = "";
			$this->campos->cep = "";
			$this->campos->cidade = "";
			$this->campos->cidade_id = null;
			$this->campos->fone = "";
			$this->campos->salario = "";
		}

		function __destruct()
		{
			$this->campos->cpf = parent::formataCpfCnpj($this->campos->cpf);
			$this->campos->cep = parent::formataCep($this->campos->cep);
			$this->campos->fone = parent::formataFone($this->campos->fone);
			$this->campos->salario = $this->formataMoeda($this->campos->salario);
			$masterView = new MasterView(MASTERVIEW::RENDER_ALL);
			echo $this->msgSucesso;
			echo $this->msgErro;
			if($this->acao  == "add"){
				include 'src/View/Layout/funcionario/add.php';
			}else{
			 	include 'src/View/Layout/funcionario/edit.php';
			}		
		}
	}
?>