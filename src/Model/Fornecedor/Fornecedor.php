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

		public function &getNomeFantasia()
		{
			return $this->nomeFantasia;
		}

		public function setRazaoSocial($razaoSocial)
		{
			$this->razaoSocial = $razaoSocial;
		}

		public function &getRazaoSocial(){
			return $this->razaoSocial;
		}

		public function setRgIe($rgIe)
		{
			$this->rgIe = $rgIe;
		}

		public function &getRgIe()
		{
			return $this->rgIe;
		}

		public function setCpfCnpj($cpfCnpj)
		{
			$this->cpfCnpj = $cpfCnpj;	
		}

		public function &getCpfCnpj()
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

		public function &getEndereco()
		{
			return $this->endereco;
		}

		public function setNumero($numero)
		{
			$this->numero = $numero;
		}

		public function &getNumero()
		{
			return $this->numero;
		}

		public function setBairro($bairro)
		{
			$this->bairro = $bairro;
		}

		public function &getBairro()
		{
			return $this->bairro;
		}

		public function setCep($cep)
		{
			$this->cep = $cep;
		}

		public function &getCep()
		{
			$this->cep = join("", explode(".",$this->cep));
			$this->cep = join("", explode("-",$this->cep));
			return $this->cep;
		}

		public function setCidade($cidade)
		{
			$this->cidade = $cidade;
		}

		public function &getCidade()
		{
			return $this->cidade;
		}

		public function setFone($fone)
		{
			$this->fone = $fone;
		}

		public function &getFone()
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

		public function &getFone2()
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

		public function &getEmail()
		{
			return $this->email;
		}

		public function setHomePage($homePage)
		{
			$this->homePage = $homePage;
		}

		public function &getHomePage()
		{
			return $this->homePage;
		}

		public function setObs($obs)
		{
			$this->obs = $obs;
		}

		function &getObs()
		{
			return $this->obs;
		}

		use \Library\Hydrator;

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