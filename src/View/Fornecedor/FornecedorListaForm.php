<?php 
	namespace View\Fornecedor;
	use Library\AbstractForm;
	use Util\MasterView;
	class FornecedorListaForm extends AbstractForm{
		private $fornecedores,$checkedId,$checkedNomeFantasia,$checkedCpfCnpj;
		
		public function __construct()
		{
			parent::__construct();
		}

		public function setData($fornecedores,$chavePesq,$campoPesq)
		{
			$this->fornecedores = $fornecedores;
			$this->chavePesq = $chavePesq;
			$this->campoPesq = $campoPesq;

			switch ($chavePesq) {
				case 'id':
					$this->checkedId = "checked";
					$this->checkedNomeFantasia = "";
					$this->checkedCpfCnpj = "";
					break;
				
				case 'nome_fantasia':
					$this->checkedId = "";
					$this->checkedNomeFantasia = "checked";
					$this->checkedCpfCnpj = "";
					break;
				case 'cpf_cnpj':
					$this->checkedId = "";
					$this->checkedNomeFantasia = "";
					$this->checkedCpfCnpj = "checked";
					break;
				default :
					$this->checkedId = "";
					$this->checkedNomeFantasia = "checked";
					$this->chavePesq = "nome_fantasia";
					$this->checkedCpfCnpj = "";	
			}
		}

		function __destruct(){
			$masterView = new MasterView(MASTERVIEW::RENDER_ALL);
			echo $this->msgSucesso;
			echo $this->msgErro;
			include 'src/View/Layout/fornecedor/list.php';
		}
	} 
?>
