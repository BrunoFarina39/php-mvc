<?php 
	namespace View\Servico;
	use Library\AbstractForm;
	use Util\MasterView;
	
	class ServicoListaForm extends AbstractForm{
		private $servicos;
		
		public function __construct()
		{
			parent::__construct();
		}

		public function setData($servicos,$campoPesq)
		{
			$this->servicos = $servicos;
			$this->campoPesq = $campoPesq;
		}

		function __destruct(){
			$masterView = new MasterView(MASTERVIEW::RENDER_ALL);
			echo $this->msgSucesso;
			echo $this->msgErro;
			include 'src/View/Layout/servico/list.php';
		}
	} 
?>
