<?php 
	namespace Model\Funcionario;
	use Library\AbstractModel;
	use Model\Validation\ValidaFuncionario;
	use Model\Cidade\Cidade;

	class Funcionario extends AbstractModel{
		private $nome;
		private $rg;
		private $cpf;
		private $pis;
		private $endereco;
		private $numero;
		private $bairro;
		private $cep;
		private $cidade;
		private $fone;
		private $salario;

		public function __construct()
		{
			$this->cidade = new Cidade();
		}

		public function setNome($nome)
		{
			$this->nome = $nome;
		}

		public function getNome()
		{
			return $this->nome;
		}

		public function setRg($rg)
		{
			$this->rg = $rg;
		}

		public function getRg()
		{
			return $this->rg;
		}

		public function setCpf($cpf)
		{
			$this->cpf = $cpf;
		}

		public function getCpf()
		{
			$this->cpf = join("", explode(".",$this->cpf));
		   	$this->cpf = join("", explode("-",$this->cpf));
		   	$this->cpf = join("", explode("/",$this->cpf));
			return $this->cpf;
		}

		public function setPis($pis)
		{
			$this->pis = $pis;
		}

		public function getPis()
		{
			return $this->pis;
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

		public function setSalario($salario)
		{
			$this->salario = $salario;
		}

		public function getSalario()
		{
			//if(!empty($this->salario)){
				$this->salario = join("", explode("R$",$this->salario));
				$this->salario = join("", explode(".",$this->salario));
				$this->salario = join("", explode(",",$this->salario));
				$moeda = substr($this->salario, 0,-2).".";
				$moeda .= substr($this->salario, -2,2);
				$this->salario = $moeda;
			//}
			return $this->salario;
		}

		use \Library\Hydrator;

		public function getInputFilter()
		{
			$validator = new ValidaFuncionario();
			return $validator->getInputFuncionario();
		}

		public function limpaCampos()
		{
			$this->id = null;
			$this->nome = "";
			$this->rg = "";
			$this->cpf = "";
			$this->pis = "";
			$this->endereco = "";
			$this->numero = null;
			$this->bairro = "";
			$this->cep = "";
			$this->cidade->limpaCampos();
			$this->fone = "";
			$this->salario = "";
		}
	}
?>