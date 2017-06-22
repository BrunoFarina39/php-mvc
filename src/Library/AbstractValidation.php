<?php 
	namespace Library;
	abstract class AbstractValidation{
		protected $inputFilter;
		
		function __construct(){
			$this->inputFilter = new InputFilter();
		}
	}
?>