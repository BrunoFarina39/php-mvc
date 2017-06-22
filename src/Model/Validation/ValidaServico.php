<?php 
	namespace Model\Validation;
	use Library\AbstractValidation;
	use Model\Servico\ServicoDao;
	class ValidaServico extends AbstractValidation{

		public function __construct()
		{
			parent::__construct();
		}

		public function getInputServico()
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
								if(!$retorno = $this->servicoAdd($value))
									$this->inputFilter->setMessage($key,"Este registro já existe");
							}else{
								if(!$retorno = $this->servicoEdit($value,$campos->id))
									$this->inputFilter->setMessage($key,"Este registro já existe");
							}
							break;
						
						case 'preco':
							if(empty($value)){
								$this->inputFilter->setMessage($key,"Campo preço obrigatório");
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
		
		private function servicoAdd($value)
		{
			$servicoDao = new ServicoDao();
			return !$servicoDao->existeRegistro("servico","descricao",$value);
		}

		private function servicoEdit($value,$id)
		{
			$servicoDao = new ServicoDao();
			$reg = $servicoDao->buscaRegistro("servico","id",$id);

			if($value != $reg->descricao && $servicoDao->existeRegistro("servico","descricao",$value)){
				return false;
			}else{
				return true;
			}
		}
	}

?>