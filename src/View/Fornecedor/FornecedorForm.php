<?php 
	namespace View\Fornecedor;
	use Library\AbstractForm;
	use Library\InputFilter;
	use Model\Fornecedor\Fornecedor;
	use Util\MasterView;
	
	class FornecedorForm extends AbstractForm{
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
			$this->campos->nome_fantasia = "";
			$this->campos->razao_social = "";
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
			$this->campos->email = "";
			$this->campos->home_page = "";
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
			 return get_object_vars($this->campos);
		}

		public function setEstados(Array $estados){
			$this->estados = $estados;
		}

		public function bind(Fornecedor $fornecedor)
		{
			$this->campos->id = $fornecedor->getId();
			$this->campos->nome_fantasia = $fornecedor->getNomeFantasia();
			$this->campos->razao_social = $fornecedor->getRazaoSocial();
			$this->campos->rg_ie = $fornecedor->getRgIe();
			$this->campos->cpf_cnpj = $fornecedor->getCpfCnpj();
			$this->campos->endereco =  $fornecedor->getEndereco();
			$this->campos->numero = $fornecedor->getNumero();
			$this->campos->bairro = $fornecedor->getBairro();
			$this->campos->cep = $fornecedor->getCep();
			$this->campos->estado = $fornecedor->getCidade()->getEstado()->getId();
			$this->campos->cidade_id = $fornecedor->getCidade()->getId();
			$this->campos->cidade = $fornecedor->getCidade()->getNome();
			$this->campos->fone = $fornecedor->getFone();
			$this->campos->fone2 = $fornecedor->getFone2();
			$this->campos->email = $fornecedor->getEmail();
			$this->campos->home_page = $fornecedor->getHomePage();
			$this->campos->obs = $fornecedor->getObs();
		}

		public function limpaCampos()
		{
			$this->campos->id = null;
			$this->campos->nome_fantasia = "";
			$this->campos->razao_social = "";
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
			$this->campos->email = "";
			$this->campos->home_page = "";
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
				include 'src/View/Layout/fornecedor/add.php';
			}else{
			 	include 'src/View/Layout/fornecedor/edit.php';
			}			
		}
	}
?>