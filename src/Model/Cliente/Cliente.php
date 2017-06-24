<?php 
	namespace Model\Cliente;
	use Library\AbstractModel;
	use Model\Validation\ValidaCliente;
	use Model\Cidade\Cidade;
	class Cliente extends AbstractModel{
		private $nome;
		private $rgIe;
		private $cpfCnpj;
		private $endereco;
		private $numero;
		private $bairro;
		private $cep;
		private $cidade;
		private $fone;
		private $fone2;
		private $obs;

		function __construct()
		{
			$this->cidade = new Cidade();
		} 

		function setNome($nome)
		{
			$this->nome = $nome;
		}

		function getNome()
		{
			return $this->nome;
		}

		function setRgIe($rgIe)
		{
			$this->rgIe = $rgIe;
		}

		function getRgIe()
		{
			return $this->rgIe;
		}

		function setCpfCnpj($cpfCnpj)
		{
			$this->cpfCnpj = $cpfCnpj;	
		}

		function getCpfCnpj()
		{
			$this->cpfCnpj = join("", explode(".",$this->cpfCnpj));
		   	$this->cpfCnpj = join("", explode("-",$this->cpfCnpj));
		   	$this->cpfCnpj = join("", explode("/",$this->cpfCnpj));
			return $this->cpfCnpj;
		}

		function setEndereco($endereco)
		{
			$this->endereco = $endereco;
		}

		function getEndereco()
		{
			return $this->endereco;
		}

		function setNumero($numero)
		{
			$this->numero = $numero;
		}

		function getNumero()
		{
			return $this->numero;
		}

		function setBairro($bairro)
		{
			$this->bairro = $bairro;
		}

		function getBairro()
		{
			return $this->bairro;
		}

		function setCep($cep)
		{
			$this->cep = $cep;
		}

		function getCep()
		{
			$this->cep = join("", explode(".",$this->cep));
			$this->cep = join("", explode("-",$this->cep));
			return $this->cep;
		}

		function setCidade($cidade)
		{
			$this->cidade = $cidade;
		}

		function getCidade()
		{
			return $this->cidade;
		}

		function setFone($fone)
		{
			$this->fone = $fone;
		}

		function getFone()
		{
			$this->fone = join("", explode("(",$this->fone));
			$this->fone = join("", explode(")",$this->fone));
			$this->fone = join("", explode("-",$this->fone));
			return $this->fone;
		}

		function setFone2($fone2)
		{
			$this->fone2 = $fone2;
		}

		function getFone2()
		{
			$this->fone2 = join("", explode("(",$this->fone2));
			$this->fone2 = join("", explode(")",$this->fone2));
			$this->fone2 = join("", explode("-",$this->fone2));
			return $this->fone2;
		}

		function setObs($obs)
		{
			$this->obs = $obs;
		}

		function getObs()
		{
			return $this->obs;
		}

		use \Library\Hydrator;

		public function getInputFilter()
		{
			$validator = new ValidaCliente();
			return $validator->getInputCliente();
		}

		function limpaCampos()
		{
			$this->id = null;
			$this->nome = "";
			$this->rgIe = "";
			$this->cpfCnpj = "";
			$this->endereco = "";
			$this->numero = null;
			$this->bairro = "";
			$this->cep = "";
			$this->cidade->limpaCampos();
			$this->fone = "";
			$this->fone2 = "";
			$this->obs = "";
		}
	}
?>