<?php 
	namespace View\Usuario;
	use Library\AbstractForm;
	use Library\InputFilter;
	use Model\Usuario\Usuario;
	use Util\MasterView;
	class UsuarioForm extends AbstractForm{
		private $acao;
		private $campos;
		public function __construct($acao)
		{
			parent::__construct();
			$this->acao = $acao;
			$this->inputFilter = new InputFilter();	
			$this->campos = new \stdClass();
			$this->campos->id = null;
			$this->campos->login = "";
			$this->campos->senha = "";
			$this->campos->conf_senha= "";
			$this->campos->nome = "";
			$this->campos->nivel_acesso= 1;
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

		public function bind(Usuario $usuario)
		{
			$this->campos->id = $usuario->getId();
			$this->campos->login = $usuario->getLogin();
			$this->campos->nome = $usuario->getNome();
			$this->campos->nivel_acesso = $usuario->getNivelAcesso();
		}

		public function limpaCampos()
		{
			$this->campos->id = null;
			$this->campos->login = "";
			$this->campos->senha = "";
			$this->campos->conf_senha= "";
			$this->campos->nome = "";
			$this->campos->nivel_acesso= 1;
		}

		function __destruct()
		{
			$masterView = new MasterView(MASTERVIEW::RENDER_ALL);
			echo $this->msgSucesso;
			echo $this->msgErro;
			if($this->acao  == "add"){
				include 'src/View/Layout/usuario/add.php';
			}else{
			 	include 'src/View/Layout/usuario/edit.php';
			}		
		}
	}
?>