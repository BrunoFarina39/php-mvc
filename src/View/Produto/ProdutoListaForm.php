<?php 
	namespace View\Produto;
	use Library\AbstractForm;
	use Util\MasterView;
	
	class ProdutoListaForm extends AbstractForm{
		private $produtos,$checkedId,$checkedDescricao;
		
		public function __construct()
		{
			parent::__construct();
		}

		public function setData($produtos,$chavePesq,$campoPesq)
		{
			$this->produtos = $produtos;
			$this->chavePesq = $chavePesq;
			$this->campoPesq = $campoPesq;

			switch ($chavePesq) {
				case 'id':
					$this->checkedId = "checked";
					$this->checkedDescricao = "";
					break;
				
				case 'descricao':
					$this->checkedId = "";
					$this->checkedDescricao = "checked";
					break;
				default :
					$this->checkedId = "";
					$this->checkedDescricao = "checked";
					$this->chavePesq = "descricao";
			}
		}

		function __destruct(){
			$masterView = new MasterView(MASTERVIEW::RENDER_ALL);
			echo $this->msgSucesso;
			echo $this->msgErro;
			include 'src/View/Layout/produto/list.php';
		}
	} 
?>
