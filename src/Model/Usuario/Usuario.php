<?php
	namespace Model\Usuario;
	use Library\AbstractModel;
	use Model\Validation\ValidaUsuario;
	use Util\Conexao;
	
	class Usuario extends AbstractModel{	
		private $login;
		private $senha;
		private $nome;
		private $ultimoAcesso;
		private $nivelAcesso;
		private $validator;
		private $inputFilter;
		
		public function __construct()
		{
			
		}

		public function setLogin($login)
		{
			$this->login = $login;
		
		}

		public function getLogin()
		{
			return $this->login;
		}

		public function setSenha($senha)
		{
			if(strlen($senha) > 16)
				$this->senha = $senha;
			else
				$this->senha = md5($senha."enceladus");
		}

		public function getSenha()
		{
			return $this->senha;
		}

		public function setnome($nome)
		{
			$this->nome = $nome;
		}

		public function getNome()
		{
			return $this->nome;
		}

		public function setUltimoAcesso($ultimoAcesso)
		{
			$this->ultimoAcesso = $ultimoAcesso;
		}

		public function getUltimoAcesso()
		{
			return $this->ultimoAcesso;
		}

		public function setNivelAcesso($nivelAcesso)
		{
			$this->nivelAcesso = $nivelAcesso;

		}

		public function getNivelAcesso()
		{
			return $this->nivelAcesso;
		}

		use \Library\Hydrator;

		public function getInputFilter()
		{
			if($this->inputFilter === null){
            	$this->validator = new ValidaUsuario();
            	$this->inputFilter = $this->validator->getInputUsuario("usuario");
         	}
			return $this->inputFilter;
		}

		public function autenticar()
		{
			$usuarioDao = new UsuarioDao();
			try{
				if($usuarioDao->autenticarUsuario($this->login,$this->senha)){
					$_SESSION["usuario"] = $this->login;
					return true;
				}else{
					return false;
				}
			}catch(\Exception $e){
				echo $e->getMessage();
			}
			
		}

		public function limpaCampos()
		{
			$this->id = null;
			$this->login = "";
			$this->senha = "";
			$this->nome = "";
			$this->setUltimoAcesso = "";
			$this->nivelAcesso = "";
		} 
	}
?>