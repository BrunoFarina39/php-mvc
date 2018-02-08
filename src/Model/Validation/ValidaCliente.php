<?php 
	namespace Model\Validation;
	use Library\AbstractValidation;
	use Model\Cliente\ClienteDao;
	
	class ValidaCliente extends AbstractValidation{

   		public function __construct()
   		{
   			parent::__construct();
  	 	}

	    public function getInputCliente()
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
	                 	case 'cpf_cnpj':                                
	                     	$value = join("", explode(".",$value));
	                     	$value = join("", explode("-",$value));
	                     	$value = join("", explode("/",$value));
	                     	if(strlen($value) != 0){
	                        	if($this->validaInsc($value)){
	                           
	                           		if(empty($campos->id)){
	                              		if(!$retorno = $this->cpfCnpjClienteAdd($value)){
	                                  	$this->inputFilter->setMessage($key,"Esta inscrição já existe");
	                             		}
	                           		}else{
	                              	if(!$retorno = $this->cpfCnpjClienteEdit($value,$campos->id)){
	                                	$this->inputFilter->setMessage($key,"Esta inscrição já existe");
	                                	}
	                              	}                          
	                           }else{
	                            	$this->inputFilter->setMessage($key,"CPF/CNPJ inválido");
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

    	public function validaInsc($insc)
     	{
        	if(strlen($insc) == 11)
				return $this->validaCpf($insc);
			else
				return $this->validaCnpj($insc);
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

      	public function validaCnpj($cnpj)
      	{
                
        	$cnpj = join("", explode(".",$cnpj));
        	$cnpj = join("", explode("-",$cnpj));
        	$cnpj = join("", explode("/",$cnpj));

         	if (strlen($cnpj) <> 14)
            	return false; 

         	$soma = 0;
      
	        $soma += ($cnpj[0] * 5);
	        $soma += ($cnpj[1] * 4);
	        $soma += ($cnpj[2] * 3);
	        $soma += ($cnpj[3] * 2);
	        $soma += ($cnpj[4] * 9); 
	        $soma += ($cnpj[5] * 8);
	        $soma += ($cnpj[6] * 7);
	        $soma += ($cnpj[7] * 6);
	        $soma += ($cnpj[8] * 5);
	        $soma += ($cnpj[9] * 4);
	        $soma += ($cnpj[10] * 3);
	        $soma += ($cnpj[11] * 2); 

        	$d1 = $soma % 11; 
        	$d1 = $d1 < 2 ? 0 : 11 - $d1; 

         	$soma = 0;
         	$soma += ($cnpj[0] * 6); 
         	$soma += ($cnpj[1] * 5);
         	$soma += ($cnpj[2] * 4);
         	$soma += ($cnpj[3] * 3);
         	$soma += ($cnpj[4] * 2);
         	$soma += ($cnpj[5] * 9);
         	$soma += ($cnpj[6] * 8);
         	$soma += ($cnpj[7] * 7);
         	$soma += ($cnpj[8] * 6);
         	$soma += ($cnpj[9] * 5);
         	$soma += ($cnpj[10] * 4);
         	$soma += ($cnpj[11] * 3);
         	$soma += ($cnpj[12] * 2); 
      
      
         	$d2 = $soma % 11; 
         	$d2 = $d2 < 2 ? 0 : 11 - $d2; 
      
        	if ($cnpj[12] == $d1 && $cnpj[13] == $d2) {
            	return true;
         	}
         	else {
            	return false;
        	}
      	}

      	private function cpfCnpjClienteAdd($value)
      	{
        	$clienteDao = new ClienteDao();
		 	return !$clienteDao->existeRegistro("cliente","cpf_cnpj",$value);   
      	}

      	private function cpfCnpjClienteEdit($value,$id)
      	{
         	$clienteDao = new ClienteDao();
         	$reg = $clienteDao->buscaRegistro("cliente","id",$id);
         
        	if($value != $reg->cpf_cnpj && $clienteDao->existeRegistro("cliente","cpf_cnpj",$value)){
			   return false;
      		}else{
      			return true;
      		}	     
		}
   }
?>