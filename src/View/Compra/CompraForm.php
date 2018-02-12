<?php 
	namespace View\Compra;
	use Library\AbstractForm;
	use Library\InputFilter;
	use Util\MasterView;

	class CompraForm extends AbstractForm{
		private $acao;
		private $campos;
		function __construct($acao){
			parent::__construct();
			$this->acao = $acao;
			$this->campos = new \stdClass();
			$this->campos->id = null;
			$this->campos->fornecedor = "";
			$this->campos->fornecedor_id = null;
			$this->campos->produto = "";
			$this->campos->produto_id = null;
			$this->campos->preco_compra = null;
			$this->campos->preco_sem_mascara = null;
			$this->campos->qtde = 1;
			$this->campos->desconto = 0;
		}

		function __destruct(){
			$masterView = new MasterView(MASTERVIEW::RENDER_ALL);
			if($this->acao  == "add"){
				include 'src/View/Layout/compra/add.php';
			}else{
				include 'src/View/Layout/compra/edit.php';
			}							
		}
	}

?>