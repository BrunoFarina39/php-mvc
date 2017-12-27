<?php 
	namespace Library;
	
	abstract class AbstractController{
		
		public function __construct()
		{

		}

		protected function isPost()
		{
  			if($_SERVER['REQUEST_METHOD'] == 'POST')
  				return true;
  			else
  				return false;
  		}
	}
?>