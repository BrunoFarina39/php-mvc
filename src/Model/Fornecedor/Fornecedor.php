<?php 
	namespace Model\Fornecedor;
	use Library\AbstractModel;
	use Model\Validation\ValidaFornecedor;
	use Model\Cidade\Cidade;
	
	class Fornecedor extends AbstractModel{
		private $nomeFantasia;
		private $razaoSocial;
		private $rgIe;
		private $cpfCnpj;
		private $endereco;
		private $numero;
		private $bairro;
		private $cep;
		private $cidade;
		private $fone;
		private $fone2;
		private $email;
		private $homePage;
		private $obs;
		private $inputFilter;

		public function __construct()
		{
			$this->cidade = new Cidade();
		} 

		public function setNomeFantasia($nomeFantasia)
		{
			$this->nomeFantasia = $nomeFantasia;
		}

		public function getNomeFantasia()
		{
			return $this->nomeFantasia;
		}

		public function setRazaoSocial($razaoSocial)
		{
			$this->razaoSocial = $razaoSocial;
		}

		public function getRazaoSocial(){
			return $this->razaoSocial;
		}

		public function setRgIe($rgIe)
		{
			$this->rgIe = $rgIe;
		}

		public function getRgIe()
		{
			return $this->rgIe;
		}

		public function setCpfCnpj($cpfCnpj)
		{
			$this->cpfCnpj = $cpfCnpj;	
		}

		public function getCpfCnpj()
		{
			$this->cpfCnpj = join("", explode(".",$this->cpfCnpj));
		   	$this->cpfCnpj = join("", explode("-",$this->cpfCnpj));
		   	$this->cpfCnpj = join("", explode("/",$this->cpfCnpj));
			return $this->cpfCnpj;
		}

		public function setEndereco($endereco)
		{
			$this->endereco = $endereco;
		}

		public function getEndereco()
		{
			return $this->endereco;
		}

		public function setNumero($numero)
		{
			$this->numero = $numero;
		}

		public function getNumero()
		{
			return $this->numero;
		}

		public function setBairro($bairro)
		{
			$this->bairro = $bairro;
		}

		public function getBairro()
		{
			return $this->bairro;
		}

		public function setCep($cep)
		{
			$this->cep = $cep;
		}

		public function getCep()
		{
			$this->cep = join("", explode(".",$this->cep));
			$this->cep = join("", explode("-",$this->cep));
			return $this->cep;
		}

		public function setCidade($cidade)
		{
			$this->cidade = $cidade;
		}

		public function getCidade()
		{
			return $this->cidade;
		}

		public function setFone($fone)
		{
			$this->fone = $fone;
		}

		public function getFone()
		{
			$this->fone = join("", explode("(",$this->fone));
			$this->fone = join("", explode(")",$this->fone));
			$this->fone = join("", explode("-",$this->fone));
			return $this->fone;
		}

		public function setFone2($fone2)
		{
			$this->fone2 = $fone2;
		}

		public function getFone2()
		{
			$this->fone2 = join("", explode("(",$this->fone2));
			$this->fone2 = join("", explode(")",$this->fone2));
			$this->fone2 = join("", explode("-",$this->fone2));
			return $this->fone2;
		}

		public function setEmail($email)
		{
			$this->email = $email;
		}

		public function getEmail()
		{
			return $this->email;
		}

		public function setHomePage($homePage)
		{
			$this->homePage = $homePage;
		}

		public function getHomePage()
		{
			return $this->homePage;
		}

		public function setObs($obs)
		{
			$this->obs = $obs;
		}

		function getObs()
		{
			return $this->obs;
		}

		public function hidratar($data)
		{
			if(is_object($data)){
				$data = get_object_vars($data);
			}
			
			$this->id = (isset($data['id'])) ? $data['id'] : null;
			$this->nomeFantasia = (isset($data['nome_fantasia'])) ? $data['nome_fantasia'] : null;
			$this->razaoSocial = (isset($data['razao_social'])) ? $data['razao_social'] : null;
			$this->rgIe = (isset($data['rg_ie'])) ? $data['rg_ie'] : null;
			$this->cpfCnpj = (isset($data['cpf_cnpj'])) ? $data['cpf_cnpj'] : null;
			$this->endereco = (isset($data['endereco'])) ? $data['endereco'] : null;
			$this->numero = (isset($data['numero'])) ? $data['numero'] : null;
			$this->bairro = (isset($data['bairro'])) ? $data['bairro'] : null;
			$this->cep = (isset($data['cep'])) ? $data['cep'] : null;
			$this->cidade->setId((isset($data['cidade_id'])) ? $data['cidade_id'] : null);
			$this->cidade->setNome((isset($data['cidade'])) ? $data['cidade'] : null);
			$this->fone = (isset($data['fone'])) ? $data['fone'] : null;
			$this->fone2 = (isset($data['fone2'])) ? $data['fone2'] : null;
			$this->email = (isset($data['email'])) ? $data['email'] : null;
			$this->homePage = (isset($data['home_page'])) ? $data['home_page'] : null;
			$this->obs = (isset($data['obs'])) ? $data['obs'] : null;
		}

		public function getInputFilter()
		{
			$validator = new ValidaFornecedor();
			return $validator->getInputFornecedor();
		}

		public function limpaCampos()
		{
			$this->id = null;
			$this->nomeFantasia = "";
			$this->razaoSocial = "";
			$this->rgIe = "";
			$this->cpfCnpj = "";
			$this->endereco = "";
			$this->numero = null;
			$this->bairro = "";
			$this->cep = "";
			$this->cidade->limpaCampos();
			$this->fone = "";
			$this->fone2 = "";
			$this->email = "";
			$this->homePage = "";
			$this->obs = "";
		}
	}
?>