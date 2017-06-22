<?php 
	namespace Library;
	trait Hydrator{
		public function hidratar($data)
		{
			if(is_object($data))
				$data = get_object_vars($data);
			foreach ($data as $key => $value) {	
				$setter =join(explode("_",$key));
				if(method_exists($this,'set'.$setter)){
					$this->{'set'.ucfirst($setter)}($data[$key]);
				}
			}
		}
	}  
?>