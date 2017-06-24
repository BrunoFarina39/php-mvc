<?php 
	namespace Library;
	class AbstractModel{
		protected $id;

		public function __construct(){
		
		}

		public function setId($id){
			$this->id = $id;
		}

		public function getId(){
			return $this->id;
		}

	}
?>