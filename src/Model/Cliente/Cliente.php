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

		public function setObs($obs)
		{
			$this->obs = $obs;
		}

		public function getObs()
		{
			return $this->obs;
		}

		public function hidratar($data)
		{
			
			if(is_object($data)){
				$data = get_object_vars($data);
			}
			
			$this->id = (isset($data['id'])) ? $data['id'] : null;
			$this->nome = (isset($data['nome'])) ? $data['nome'] : null;
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
			$this->obs = (isset($data['obs'])) ? $data['obs'] : null;
		}

		public function getInputFilter()
		{
			$validator = new ValidaCliente();
			return $validator->getInputCliente();
		}

		public function limpaCampos()
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