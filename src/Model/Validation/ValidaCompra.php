<?php
	namespace Model\Validation;
	use Library\AbstractValidation;
	use Model\Compra\CompraDao;

	class ValidaCompra extends AbstractValidation{

		public function __construct(){
			parent::__construct();
		}

		public function getInputCompra(){
			$validation = function($campos){
				$retorno = true;
				if(empty($campos->id_fornecedor)){
					$this->inputFilter->setMessage("fornecedor","Campo fornecedor obrigatório");
               		$retorno = false;
				}

				if(empty($campos->produtos)){
					$this->inputFilter->setMessage("produtos","Por favor adicione pelo menos um produto");
               		$retorno = false;
				}
				return $retorno;
			};
			$this->inputFilter->setValidation($validation);
        	return $this->inputFilter;
		}
	}
?>