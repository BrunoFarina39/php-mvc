<?php 
	namespace Controller\Compra;
	use Library\AbstractController;
	use View\Compra\CompraFormPai;
	use View\Compra\CompraForm;
	use View\Compra\compraFormPag;
	use Model\Compra\Compra;
	use Model\Compra\CompraDao;
	use Model\ContasPagar\ContasPagar;
	use Model\ContasPagar\ContasPagarDao;
	use Model\FormaPag\FormaPag;
	use Model\FormaPag\FormaPagDao;
	use View\Compra\Instancia;
	class CompraController extends AbstractController{

		private $compra;
		private $contasPagar;
		private $compraDao;
		
		function __construct(){
			$this->compra = new Compra();
			$this->compraDao = new CompraDao();
			$this->contasPagar = new ContasPagar();
			$this->contasPagarDao = new ContasPagarDao();
			$this->formaPag = new FormaPag();
			$this->formaPagDao = new FormaPagDao();
		}

		public function actionIndex()
		{
			$compraForm = new CompraForm();
			$compraForm->render();
		}

		public function ActionAdd($post){	
			$this->compraForm = new CompraForm();
			$this->compraForm->setInputFilter($this->compra->getInputFilter());
			$this->compraForm->setData($post);
			if($this->isPost()){
				if($this->compraForm->isValid()){
					print_r($post);
					$compraFormPag = new CompraFormPag();
					$compraFormPag->setData($post);
					$compraFormPag->renderPagamento();
				}else{
					$this->compraForm->render();
				}
			}else{
				$this->compraForm = new CompraForm();
				$this->compraForm->render();
			}
			
		}

		public function ActionAddPag($post){
			//print_r($post);
			if($this->isPost()){
				$compraFormPag = new CompraFormPag();
				$compraFormPag->setData($post);
				$this->compra->hidratar($compraFormPag->getData());
				$this->compraDao->gravar($this->compra);
				$this->contasPagar->getCompra()->setId($this->compra->getId());
				$this->contasPagar->getFornecedor()->setId($this->compra->getFornecedor()->getId());	
				$this->contasPagarDao->gravar($this->contasPagar);
				$this->formaPag->hidratar($compraFormPag->getData());
				$this->formaPag->getCompra()->setId($this->compra->getId());
				$this->formaPag->getContasPagar()->setId($this->contasPagar->getId());
				$compraFormPag->renderConclusao($this->formaPagDao->gravar($this->formaPag));	
			}else{
				$this->compraForm = new CompraForm();
				$this->compraForm->render();
			}
			print_r($post);
			
		}

		public function getTabela($post){
			$compraFormPag = new CompraFormPag();
			$compraFormPag->renderTabela($post);
		}

		public function listarFornecedores(){
			header('Content-Type: application/json; charset=utf-8');
			echo json_encode($this->compraDao->listarFornecedores());
		}

		public function listarProdutos(){
			header('Content-Type: application/json; charset=utf-8');
			echo json_encode($this->compraDao->listarProdutos());
		}

		public function buscaPrecoCompra($id){
			echo json_encode($this->compraDao->buscaPrecoCompra($id));
		}
	}
?>