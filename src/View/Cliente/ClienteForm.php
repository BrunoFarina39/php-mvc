<?php 
	namespace View\Cliente;
	use Library\AbstractForm;
	use Library\InputFilter;
	use Model\Cliente\Cliente;
	use Model\Cidade\Cidade;
	use Util\MasterView;
	class ClienteForm extends AbstractForm{
		private $acao;
		private $campos;
		private $estados;
		
		function __construct($acao)
		{
			parent::__construct();
			$this->acao = $acao;
			$this->inputFilter = new InputFilter();
			$this->campos = new \stdClass();
			$this->campos->id = null;
			$this->campos->nome = "";
			$this->campos->rg_ie = "";
			$this->campos->cpf_cnpj = "";
			$this->campos->endereco = "";
			$this->campos->numero = null;
			$this->campos->bairro = "";
			$this->campos->cep = "";
			$this->campos->cidade = "";
			$this->campos->cidade_id = null;
			$this->campos->fone = "";
			$this->campos->fone2 = "";
			$this->campos->obs = "";
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
			$array['cidade'] = new Cidade();
			$array['cidade']->getEstado()->setId($this->campos->estado);
			$array['cidade']->setId($this->campos->cidade_id);
			$array['cidade']->setNome($this->campos->cidade);
			return $array;
		}

		public function setEstados(Array $estados){
			$this->estados = $estados;
		}

		public function bind(Cliente $cliente)
		{
			$this->campos->id = $cliente->getId();
			$this->campos->nome = $cliente->getNome();
			$this->campos->rg_ie = $cliente->getRgIe();
			$this->campos->cpf_cnpj = $cliente->getCpfCnpj();
			$this->campos->endereco =  $cliente->getEndereco();
			$this->campos->numero = $cliente->getNumero();
			$this->campos->bairro = $cliente->getBairro();
			$this->campos->cep = $cliente->getCep();
			$this->campos->estado = $cliente->getCidade()->getEstado()->getId();
			$this->campos->cidade_id = $cliente->getCidade()->getId();
			$this->campos->cidade = $cliente->getCidade()->getNome();
			$this->campos->fone = $cliente->getFone();
			$this->campos->fone2 = $cliente->getFone2();
			$this->campos->obs = $cliente->getObs();
		}

		public function limpaCampos()
		{
			$this->campos->id = null;
			$this->campos->nome = "";
			$this->campos->rg_ie = "";
			$this->campos->cpf_cnpj = "";
			$this->campos->endereco = "";
			$this->campos->numero = null;
			$this->campos->bairro = "";
			$this->campos->cep = "";
			$this->campos->cidade = "";
			$this->campos->cidade_id = null;
			$this->campos->fone = "";
			$this->campos->fone2 = "";
			$this->campos->obs = "";
		}

		function __destruct()
		{
			$this->campos->cpf_cnpj = parent::formataCpfCnpj($this->campos->cpf_cnpj);
			$this->campos->cep = parent::formataCep($this->campos->cep);
			$this->campos->fone = parent::formataFone($this->campos->fone);
			$this->campos->fone2 = parent::formataFone($this->campos->fone2);
			$masterView = new MasterView(MASTERVIEW::RENDER_ALL);
			echo $this->msgSucesso;
			echo $this->msgErro;
			if($this->acao  == "add"){
				include 'src/View/Layout/cliente/add.php';
			}else{
			 	include 'src/View/Layout/cliente/edit.php';
			}		
		}
	}

?>