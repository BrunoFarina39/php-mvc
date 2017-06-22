<?php 
	namespace Model\Validation;
	use Library\AbstractValidation;
   use Model\Marca\MarcaDao;
	class ValidaMarca extends AbstractValidation{

		function __construct(){
			parent::__construct();
		}

		public function getInputMarca(){
         $validation = function($campos)
         {
            $retorno = true;
            if(empty($campos->nome)){
               $this->inputFilter->setMessage("nome","Campo nome obrigatório");
               $retorno = false;
            }      
            
            if(empty($campos->id)){
               if(!$this->marcaAdd($campos->nome)){
                  $this->inputFilter->setMessage("nome","Esta inscrição já existe");
                  $retorno = false;
               }
            }else{
               if(!$this->marcaEdit($campos->nome,$campos->id)){
                  $this->inputFilter->setMessage("nome","Esta inscrição já existe");
                  $retorno = false;
               }
            }
            return $retorno;
         };
         $this->inputFilter->setValidation($validation);
         return $this->inputFilter;
      }

      public function marcaAdd($value)
   	{
     		$marcaDao = new MarcaDao();
      	return !$marcaDao->existeRegistro("marca","nome",$value);
   	}

   	public function marcaEdit($value,$id)
   	{
      	$marcaDao = new MarcaDao();
      	$reg = $marcaDao->buscaRegistro("marca","id",$id);
      	if($value != $reg->nome && $marcaDao->existeRegistro("marca","nome",$value)){
         	return false;
      	}else{
         	return true;
      	}
   	}
	}
?>