<?php 
	namespace View\Compra;
	use Library\AbstractForm;


	class CompraFormPai extends AbstractForm{

		function __construct(){
			parent::__construct();
		}

		public function getForm($post){
			if($post["form"] == "add" && $post["fornecedor"] == "" || $post["produtos"] == ""){
				return "add";
			}else{
				return "pag";
			} 			
		}

		public function isValid()
		{
			return $this->inputFilter->isValid($this->campos);		 
		}
	}
?>