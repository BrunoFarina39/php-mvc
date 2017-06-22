<?php 
	namespace View\Marca;
	use Library\AbstractForm;
	use Util\MasterView;
	class MarcaListaForm extends AbstractForm{
		private $marcas;
		
		public function __construct()
		{
			parent::__construct();
		}

		public function setData($marcas,$campoPesq)
		{
			$this->marcas = $marcas;
			$this->campoPesq = $campoPesq;

		}

		function __destruct(){
			$masterView = new MasterView(MASTERVIEW::RENDER_ALL);
			echo $this->msgSucesso;
			echo $this->msgErro;
			include 'src/View/Layout/marca/list.php';
		}
	} 
?>
