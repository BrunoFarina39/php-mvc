<?php 
	namespace Model\Validation;
	use Library\AbstractValidation;
	use Model\Funcionario\FuncionarioDao;
	class ValidaFuncionario extends AbstractValidation{

   	function __construct(){
   		parent::__construct();
   	}

      public function getInputFuncionario()
      {
         $validation = function($campos)
         {
            $retorno = true;
            foreach ($campos as $key => $value) {
               switch ($key) {
                  case 'nome':
                     if(empty($value)){
                        $this->inputFilter->setMessage($key,"Campo nome obrigatório");
                        $retorno = false;
                     }
                     break;            
                  case 'cpf':                                
                     $value = join("", explode(".",$value));
                     $value = join("", explode("-",$value));
                     $value = join("", explode("/",$value));
                     if(strlen($value) == 11 || strlen($value) == 14 || strlen($value) != 0){
                         if($this->validaCpf($value)){
                           
                           if(empty($campos->id)){
                              if(!$retorno = $this->cpfFuncionarioAdd($value)){
                                  $this->inputFilter->setMessage($key,"Esta inscrição já existe");
                              }
                           }else{
                              if(!$retorno = $this->cpfFuncionarioEdit($value,$campos->id)){
                                 $this->inputFilter->setMessage($key,"Esta inscrição já existe");
                                 }
                              }                          
                           }else{
                              $this->inputFilter->setMessage($key,"CPF inválido");
                              $retorno = false;
                           }
                        }
                     break;
                  case 'cidade_id':
                     if(empty($value)){
                        $this->inputFilter->setMessage("cidade","Campo cidade obrigatório");
                        $retorno = false;
                     }
                     break;
               }
            }
            return $retorno;
         };
         $this->inputFilter->setValidation($validation);
         return $this->inputFilter;
      }

		public function validaCpf($cpf)
      {
         $soma = 0;
      
         $cpf = join("", explode(".",$cpf));
         $cpf = join("", explode("-",$cpf));

         if (strlen($cpf) <> 11)
            return false;
      
         if ($cpf == '00000000000' || 
         $cpf == '11111111111' || 
         $cpf == '22222222222' || 
         $cpf == '33333333333' || 
         $cpf == '44444444444' || 
         $cpf == '55555555555' || 
         $cpf == '66666666666' || 
         $cpf == '77777777777' || 
         $cpf == '88888888888' || 
         $cpf == '99999999999'){
            return false;
         }

         // Verifica 1º digito      
         for ($i = 0; $i < 9; $i++) {         
            $soma += (($i+1) * $cpf[$i]);
         }

         $d1 = ($soma % 11);
      
         if ($d1 == 10) {
         $d1 = 0;
         }
      
         $soma = 0;
      
         // Verifica 2º digito
         for ($i = 9, $j = 0; $i > 0; $i--, $j++) {
            $soma += ($i * $cpf[$j]);
         }
      
         $d2 = ($soma % 11);
      
         if ($d2 == 10) {
         $d2 = 0;
         }      
      
         if ($d1 == $cpf[9] && $d2 == $cpf[10]) {
            return true;
         }
         else {
            return false;
         }
      }

      private function cpfFuncionarioAdd($value)
      {
         $funcionarioDao = new FuncionarioDao();
		 return !$funcionarioDao->existeRegistro("funcionario","cpf",$value);   
      }

      private function cpfFuncionarioEdit($value,$id)
      {
         $funcionarioDao = new FuncionarioDao();
         $reg = $funcionarioDao->buscaRegistro("funcionario","id",$id);
         
         if($value != $reg->cpf && $funcionarioDao->existeRegistro("funcionario","cpf",$value)){
			   return false;
      	}else{
      		return true;
      	}     
		}
   }
?>