<?php 
	namespace Controller\Home;
	use View\Home\Home;
	
	class HomeController{

		public function __construct()
		{
			$view = new Home();
		}
	}
?>