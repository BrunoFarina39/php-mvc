<?php 
	namespace View\Home;
	use Util\MasterView;
	class Home{

		public function __construct()
		{
			$masterView = new MasterView(MASTERVIEW::RENDER_ALL);
			include 'src/View/Layout/home/home.html';
		}
	}
?>