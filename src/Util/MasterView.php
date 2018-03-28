<?php 
	namespace Util;
	
	class MasterView{
		CONST RENDER_ALL = 0;
		CONST RENDER_JSCSS = 1;
		
		public function __construct(int $value)
		{
			if($value == 0)
				include "src/View/Layout/master/header.php";
			else
				include "src/View/Layout/master/scriptCss.html";
		}

		public function renderScriptCss()
		{
			include "src/View/Layout/master/scriptCss.php";
		}

		function __destruct()
		{
			include "src/View/Layout/master/footer.html";
		}
	} 
?>