<?php 
	namespace Library;
	
	class InputFilter{		
		private $validation;
		private $data;
		private $msg;

		public function __construct(){
			
		}

		public function setValidation($validation){
			$this->validacao = $validation;
		}

		public function isValid($post){
			$val = &$this->validacao;
			return $val($post);
		}

		public function setMessage(String $index,String $valor){
			$this->msg[$index] = $valor;
		}

		public function getMessage($index){
			return (isset($this->msg[$index])) ? $this->msg[$index] : null;
		}

		public function setData(String $index,$valor){
			$this->data[$index] = $valor;
		}

		public function getData($index){
			return (isset($this->data[$index])) ? $this->data[$index] : null;
		}
	}
?>