<?php 
  namespace Util;	
	function alerta($msg){
		echo "<script>alert('$msg');</script>";
	}

	function redireciona($caminho){
		echo "<script>window.location='".$caminho."'</script>";
	}

	function volta_pag_anterior(){
		echo "<script>history.back();</script>";
	}

	function removeCaracEspecial($texto){
  		return str_replace("R$","",str_replace(",",".",str_replace("/","",str_replace(")","",str_replace("(","",str_replace("-","",str_replace(".","",$texto)))))));
  }

  function isPost(){
  	if($_SERVER['REQUEST_METHOD'] == 'POST')
  		return true;
  	else
  		return false;
  }

  function formataDataHora($data){
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
  
  
  

  
?>