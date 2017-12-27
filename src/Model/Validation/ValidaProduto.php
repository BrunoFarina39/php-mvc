<?php 
	namespace Model\Validation;
	use Library\AbstractValidation;
	use Model\Produto\ProdutoDao;
	
	class ValidaProduto extends AbstractValidation{

		public function __construct()
		{
			parent::__construct();
		}

		public function getInputProduto()
		{
			$validation = function($campos)
			{
				$retorno = true;
				foreach ($campos as $key => $value) {
					switch ($key) {
						case 'descricao':
							if(empty($value)){
								$this->inputFilter->setMessage($key,"Campo descrição obrigatório");
								$retorno = false;
							}else if(empty($campos->id)){
								if(!$retorno = $this->produtoAdd($value))
									$this->inputFilter->setMessage($key,"Este registro já existe");
							}else{
								if(!$retorno = $this->produtoEdit($value,$campos->id))
									$this->inputFilter->setMessage($key,"Este registro já existe");
							}

							break;
						case 'marca_id':
							if(empty($value)){
								$this->inputFilter->setMessage("marca","Campo marca obrigatório");
								$retorno = false;
							}
							break;	
						case 'preco_compra':
							if(empty($value)){
								$this->inputFilter->setMessage($key,"Campo preço compra obrigatório");
								$retorno = false;
							}
							break;	
						case 'preco_venda':
							if(empty($value)){
								$this->inputFilter->setMessage($key,"Campo preço venda obrigatório");
								$retorno = false;
							}
							break;	
					}
				}
				return $retorno;
			};
			$this->inputFilter->setValidation($validation);
        	return $this->inputFilter;
		}
		
		private function produtoAdd($value)
		{
			$produtoDao = new ProdutoDao();
			return !$produtoDao->existeRegistro("produto","descricao",$value);
		}

		private function produtoEdit($value,$id)
		{
			$produtoDao = new ProdutoDao();
			$reg = $produtoDao->buscaRegistro("produto","id",$id);

			if($value != $reg->descricao && $produtoDao->existeRegistro("produto","descricao",$value)){
				return false;
			}else{
				return true;
			}
		}
	} 
?>