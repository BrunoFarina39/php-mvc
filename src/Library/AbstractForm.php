<?php 
	namespace Library;
	class AbstractForm{
		protected $msgSucesso,$msgErro,$chavePesq,$campoPesq,$inputFilter;
		public function __construct()
		{
			$this->msgSucesso = "";
			$this->msgErro = "";	
		}

		public function setInputFilter(InputFilter $inputFilter)
    	{
      		$this->inputFilter = $inputFilter;
   	 	}

		public function setMsgSucesso($msgSucesso)
		{
			$this->msgSucesso = "<div class='alert alert-success'>$msgSucesso</div>";
		}


		public function setMsgErro($msgErro)
		{
			$this->msgErro = "<div class='alert alert-danger'>$msgErro</div>";
		}

		public function setAddStatus($status)
		{
			if($status){
				$this->msgSucesso = "<div class='alert alert-success'>Registro salvo com sucesso!</div>";
				$this->limpaCampos();
			}
			else{
				$this->msgErro = "<div class='alert alert-danger'>Não foi possivel salvar registro!</div>";	
			}
		}

		public function setEditStatus($status)
		{
			if($status)
				$this->msgSucesso = "<div class='alert alert-success'>Registro alterado com sucesso!</div>";
			else
				$this->msgErro = "<div class='alert alert-danger'>Não foi possivel alterar registro!</div>";	
		}

		public function setDeleteStatus($status)
		{
			if($status)
				$this->msgSucesso = "<div class='alert alert-success'>Registro excluído com sucesso!</div>";
			else
				$this->msgErro = "<div class='alert alert-danger'>Não foi possivel excluir o registro!</div>";	
		}

		public function setCamposHidden(Array $array)
		{
			foreach ($array as $key => $value) {
				switch ($key) {
					case 'chave_pesq':
						$this->chavePesq = $value;
						break;
					
					case 'campo_pesq':
						$this->campoPesq = $value;
						break;
				}
			}
		}

		function formataCpfCnpj($insc)
		{	   	
		   	$insc = join("", explode(".",$insc));
		   	$insc = join("", explode("-",$insc));
		   	$insc = join("", explode("/",$insc));
		   	$tamanho = strlen($insc);
		   	if($tamanho == 11){
		     	$part = substr($insc,0,3).".";
		      	$part .= substr($insc,3,3).".";
		      	$part .= substr($insc,6,3)."-";
		      	$part .= substr($insc,9,2);
		      	return $part;
		    }else if($tamanho == 14){
		      	$part = substr($insc,0,2).".";
		      	$part .= substr($insc,2,3).".";
		      	$part .= substr($insc,5,3)."/";
		      	$part .= substr($insc,8,4)."-";
		      	$part .= substr($insc,12,2);
		      	return $part;
		    }else{
		      	return $insc;
		    }
  		}
  
  		function formataCep($cep)
  		{
  			$cep = $this->remCaracEspecial($cep);
  			$tamanho = strlen($cep);
  			if($tamanho == 8){
  				$part = substr($cep,0,2).".";
  				$part .= substr($cep,2,3)."-";
  				$part .= substr($cep,5,3);
  				return $part;
  			}else{
  				return $cep;
  			}
  		}

  		function formataFone($fone)
  		{
			$fone = $this->remCaracEspecial($fone);
			$tamanho = strlen($fone);
			 if($tamanho == 10){
				$part = substr($fone,0,0)."(";
			    $part .= substr($fone,0,2).")";
			    $part .= substr($fone,2,4)."-";
			    $part .= substr($fone,6,4);
			    return $part;
			}else if($tamanho == 11){
			    $part = substr($fone,0,0)."(";
			    $part .= substr($fone,0,2).")";
			    $part .= substr($fone,2,5)."-";
			    $part .= substr($fone,7,4);
			    return $part;
			}else{
			    return $fone;
			}
		}

		function formataMoeda($valor)
		{
			if(empty($valor))
				return "";
			$valor = join("", explode("R$",$valor));
			$valor = join("", explode(".",$valor));
			$valor = join("", explode(",",$valor));
			$moeda = substr($valor, 0,-2).",";
			$moeda .= substr($valor, -2,2);
			$array= explode(",", $moeda);
			switch (strlen($array[0])) {
				case 4:
					$part = substr($moeda, 0,1).".";
					$part .= substr($moeda, 1); 
					break;
				case 5:
					$part = substr($moeda, 0,2).".";
					$part .= substr($moeda, 2);
					break;
				case 6:
					$part = substr($moeda, 0,3).".";
					$part .= substr($moeda, 3);
					break;
				default : $part = $moeda;							
			}
			return "R$".$part;
		}

		function remCaracEspecial($str)
		{
		    $str = join("", explode(".",$str));
		    $str = join("", explode(",",$str));
		    $str = join("", explode("-",$str));
		    $str = join("", explode("/",$str));
		    $str = join("", explode("(",$str));
		    $str = join("", explode(")",$str));
		    $str = join("", explode("R$",$str));
		    return $str;
 	 	}

		public function limpaCampos()
		{

		}
	}
?>