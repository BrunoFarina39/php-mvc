<?php 
	namespace View\Cliente;
	use Library\AbstractForm;
	use Util\MasterView;
	
	class ClienteListaForm extends AbstractForm{
		private $clientes,$checkedId,$checkedNome,$checkedCpfCnpj;
		
		public function __construct()
		{
			parent::__construct();
		}

		public function setData($clientes,$chavePesq,$campoPesq)
		{
			$this->clientes = $clientes;
			$this->chavePesq = $chavePesq;
			$this->campoPesq = $campoPesq;

			switch ($chavePesq) {
				case 'id':
					$this->checkedId = "checked";
					$this->checkedNome = "";
					$this->checkedCpfCnpj = "";
					break;
				
				case 'nome':
					$this->checkedId = "";
					$this->checkedNome = "checked";
					$this->checkedCpfCnpj = "";
					break;
				case 'cpf_cnpj':
					$this->checkedId = "";
					$this->checkedNome = "";
					$this->checkedCpfCnpj = "checked";
					break;
				default :
					$this->checkedId = "";
					$this->checkedNome = "checked";
					$this->chavePesq = "nome";
					$this->checkedCpfCnpj = "";	
			}
		}

		function __destruct(){
			$masterView = new MasterView(MASTERVIEW::RENDER_ALL);
			echo $this->msgSucesso;
			echo $this->msgErro;
			include 'src/View/Layout/cliente/list.php';
		}
	} 
?>
