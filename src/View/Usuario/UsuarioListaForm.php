<?php 
	namespace View\Usuario;
	use Library\AbstractForm;
	use Util\MasterView;
	
	class UsuarioListaForm extends AbstractForm{
		private $usuarios,$checkedId,$checkedNome;
		
		public function __construct()
		{
			parent::__construct();
		}

		public function setData($usuarios,$chavePesq,$campoPesq)
		{
			$this->usuarios = $usuarios;
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

		private function formataDataHora($data)
		 {
  			if(!empty($data)){
  				$hora = substr($data, 11,8);
  				$data = substr($data,0,10);
  				$dataArray = explode("-",$data);
  				$data = $dataArray[2]."/".$dataArray[1]."/".$dataArray[0]." ".$hora;
  				return $data;
  			}else{
  				return $data;
  			} 	
  		}

		function __destruct(){
			$masterView = new MasterView(MASTERVIEW::RENDER_ALL);
			echo $this->msgSucesso;
			echo $this->msgErro;
			include 'src/View/Layout/usuario/list.php';
		}
	} 
?>
