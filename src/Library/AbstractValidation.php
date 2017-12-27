<?php 
	namespace Library;
	
	abstract class AbstractValidation{
		protected $inputFilter;
		
		public function __construct(){
			$this->inputFilter = new InputFilter();
		}
	}
?>