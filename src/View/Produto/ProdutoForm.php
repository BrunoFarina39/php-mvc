<?php 
	namespace View\Produto;
	use Library\AbstractForm;
	use Library\InputFilter;
	use Model\Produto\Produto;
	use Model\Marca\Marca;
	use Util\MasterView;
	
	class ProdutoForm extends AbstractForm{
		private $acao;
		private $campos;
		private $estados;
		
		public function __construct($acao)
		{
			parent::__construct();
			$this->acao = $acao;
			$this->inputFilter = new InputFilter();
			$this->campos = new \stdClass();
			$this->campos->id = null;
			$this->campos->cod_barra = "";
			$this->campos->descricao = "";
			$this->campos->marca = "";
			$this->campos->marca_id = null;
			$this->campos->preco_compra = 0;
			$this->campos->preco_venda = 0;
		}

		public function isValid()
		{
			return $this->inputFilter->isValid($this->campos);		 
		}

		public function setData($data)
		{
			$this->campos = (Object) $data;
			$this->campos->qtde_est=0;
		}
		
		public function getData()
		{
			$array = get_object_vars($this->campos);
			$array['marca'] = new Marca();
			$array['marca']->setId($this->campos->marca_id);
			$array['marca']->setNome($this->campos->marca);	
			return $array;
		}

		public function bind(Produto $produto)
		{
			$this->campos->id = $produto->getId();
			$this->campos->cod_barra = $produto->getCodBarra();
			$this->campos->descricao = $produto->getDescricao();
			$this->campos->marca_id = $produto->getMarca()->getId();
			$this->campos->marca =  $produto->getMarca()->getNome();
			$this->campos->preco_compra = $produto->getPrecoCompra();
			$this->campos->preco_venda = $produto->getPrecoVenda();
			$this->campos->qtde_est = $produto->getQtdeEst();
		}

		public function limpaCampos()
		{
			$this->campos->id = null;
			$this->campos->cod_barra = "";
			$this->campos->descricao = "";
			$this->campos->marca = "";
			$this->campos->marca_id = null;
			$this->campos->preco_compra = null;
			$this->campos->preco_venda = null;
		}

		function __destruct()
		{
			$this->campos->preco_compra = $this->formataMoeda($this->campos->preco_compra);
			$this->campos->preco_venda = $this->formataMoeda($this->campos->preco_venda);
			$masterView = new MasterView(MASTERVIEW::RENDER_ALL);
			echo $this->msgSucesso;
			echo $this->msgErro;
			if($this->acao  == "add"){
				include 'src/View/Layout/produto/add.php';
			}else{
			 	include 'src/View/Layout/produto/edit.php';
			}			
		}
	}
?>