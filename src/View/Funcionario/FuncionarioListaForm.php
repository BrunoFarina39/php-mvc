<?php 
	namespace View\Funcionario;
	use Library\AbstractForm;
	use Util\MasterView;
	class FuncionarioListaForm extends AbstractForm{
		private $funcionarios,$checkedId,$checkedNome;
		
		public function __construct()
		{
			parent::__construct();
		}

		public function setData($funcionarios,$chavePesq,$campoPesq)
		{
			$this->funcionarios = $funcionarios;
			$this->chavePesq = $chavePesq;
			$this->campoPesq = $campoPesq;

			switch ($chavePesq) {
				case 'id':
					$this->checkedId = "checked";
					$this->checkedNome = "";
					break;
				
				case 'nome':
					$this->checkedId = "";
					$this->checkedNome = "checked";
					break;
				default :
					$this->checkedId = "";
					$this->checkedNome = "checked";
					$this->chavePesq = "nome";
			}
		}

		function __destruct(){
			$masterView = new MasterView(MASTERVIEW::RENDER_ALL);
			echo $this->msgSucesso;
			echo $this->msgErro;
			include 'src/View/Layout/funcionario/list.php';
		}
	} 
?>
