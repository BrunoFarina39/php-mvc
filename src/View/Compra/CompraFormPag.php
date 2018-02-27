<?php 
	namespace View\Compra;
	use Library\AbstractForm;
	use Library\InputFilter;
	use Util\MasterView;

	class CompraFormPag extends AbstractForm{
		private $campos;
		private $formaPag;
		private $parcelas;
		private $meioPag;
		private $produtos;
		
		function __construct(){
			$this->campos = new \stdClass();
			
			$this->campos->formaPag=1;
			$this->campos->parcelas=1;
			$this->campos->meioPag=4;
			$this->campos->carencia=0;
			$this->campos->entrada=$this->formataMoeda(0);
			
			$this->formaPag[0]['id']="1";
			$this->formaPag[0]['value']="À vista";
			$this->formaPag[1]['id']="2";
			$this->formaPag[1]['value']="À prazo";
			
			for($i=1; $i < 13; $i++){
				$this->parcelas[$i]['id']=$i;
				$this->parcelas[$i]['value']=$i;
			}
			
			$this->meioPag[0]['id']=1;
			$this->meioPag[0]['value']="Boleto";
			
			$this->meioPag[1]['id']=2;
			$this->meioPag[1]['value']="Cartão";
			
			$this->meioPag[2]['id']=3;
			$this->meioPag[2]['value']="Cheque";
			
			$this->meioPag[3]['id']=4;	
			$this->meioPag[3]['value']="Dinheiro";
			
			$this->meioPag[4]['id']=5;
			$this->meioPag[4]['value']="Nota promissória";
		}

		public function setData($post)
		{
			
			$valorTotal = 0;
			$valorParcela=0;
			$entradaFormatada;
			$this->campos->valorTotal=$post["valor_total"];
			$this->campos->pagamento = array();
			$data = new \DateTime();

			$this->campos->fornecedor_id=$post["fornecedor_id"];
			$this->campos->produtos = $post['produtos'];
			$this->produtos = explode("/", $post['produtos']);
			
			foreach ($this->produtos as $key => $value) {
				$this->produtos[$key]= explode("-", $value);
			}

			if(!isset($post['form'])){
				$this->campos->formaPag=$post['forma_pag'];
				$this->campos->parcelas=$post["parcelas"];
				$this->campos->meioPag=$post["meio_pag"];
				$this->campos->carencia=$post["carencia"];
				$this->campos->entrada=$post["entrada"];
				
				$i=0;
				while($i < $post["carencia"]){
					$data->modify('+1 day');
					$i++;
				}
			}
			
			$entradaFormatada = $this->formataMoedaBD($this->campos->entrada);
			if($this->campos->valorTotal >= $entradaFormatada){
				$valorTotal = $this->campos->valorTotal - $entradaFormatada;
			}else{
				$valorTotal = $this->campos->valorTotal;
				echo "<script>alert('Valor de entrada maior do que o valor total')</script>";
			}
	
			$valorParcela = round($valorTotal / $this->campos->parcelas,2);
			$resto = $valorTotal - ($valorParcela * $this->campos->parcelas);

			if($this->campos->formaPag==1){
				for($i=1; $i <= $this->campos->parcelas;$i++){
					$this->campos->pagamento[$i]["parcelas"]=$i+1;
					$this->campos->pagamento[$i]["dataVenci"]=$data->format('d/m/Y');
					$this->campos->pagamento[$i]["valor"]=$valorParcela;
				}
			}else{
				for($i=1; $i <= $post["parcelas"];$i++){
					if($i != 1){
						$data->modify('+1 month');
					}
						
					$this->campos->pagamento[$i]["parcelas"]=$i+1;
					$this->campos->pagamento[$i]["dataVenci"]=$data->format('d/m/Y');
					$this->campos->pagamento[$i]["valor"]=$valorParcela;
					if($i==$this->campos->parcelas)
						$this->campos->pagamento[$i]["valor"]=$valorParcela+$resto;
					else
						$this->campos->pagamento[$i]["valor"]=$valorParcela;
				}
			}
		}

		public function isValid($post)
		{
			$this->campos->fornecedor_id=$post["fornecedor_id"];
			$this->campos->produtos = $post['produtos'];
			return $this->inputFilter->isValid($this->campos);		 
		}


		public function renderPagamento(){
			$masterView = new MasterView(MASTERVIEW::RENDER_ALL);
			include 'src/View/Layout/compra/pagamento.php';		
		}

		public function renderConclusao($status)
		{
			$masterView = new MasterView(MASTERVIEW::RENDER_ALL);
			if($status){
				include 'src/View/Layout/compra/sucesso.php';	
			}
			else{
				include 'src/View/Layout/compra/falha.php';	
			}
		}

		function __destruct(){
						
		}
	}

?>