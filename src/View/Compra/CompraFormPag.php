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
			$this->campos->formaPag = 1;
			$this->campos->parcelas = 1;
			$this->campos->meioPag = 4;
			$this->campos->carencia = 0;
			$this->campos->entrada = $this->formataMoeda(0);
			$this->campos->produtos = "";
			
			$this->formaPag[0]['id'] = "1";
			$this->formaPag[0]['value'] = "À vista";
			$this->formaPag[1]['id'] = "2";
			$this->formaPag[1]['value'] = "À prazo";
			
		
			$this->parcelas['id'] = 1;
			$this->parcelas['value'] = 1;
			
			$this->meioPag[0]['id'] = 1;
			$this->meioPag[0]['value'] = "Boleto";
			
			$this->meioPag[1]['id'] = 2;
			$this->meioPag[1]['value'] = "Cartão";
			
			$this->meioPag[2]['id'] = 3;
			$this->meioPag[2]['value'] = "Cheque";
			
			$this->meioPag[3]['id']=4;	
			$this->meioPag[3]['value'] = "Dinheiro";
			
			$this->meioPag[4]['id']=5;
			$this->meioPag[4]['value'] = "Nota promissória";
		}

		public function setData($post)
		{
			$this->campos->valorTotal = $post["valor_total"];
			$this->campos->fornecedor_id = $post["fornecedor_id"];
			$this->campos->produtos = $post['produtos'];
			$this->produtos = json_decode($post["produtos"], true);

			if(!isset($post['form'])){
				$this->campos->formaPag = $post['forma_pag'];
				$this->campos->parcelas = $post["parcelas"];
				$this->campos->meioPag = $post["meio_pag"];
				$this->campos->carencia = $post["carencia"];
				$this->campos->entrada = $post["entrada"];				
			}
		}

		public function isValid()
		{
			return $this->inputFilter->isValid($this->campos);		 
		}


		public function renderPagamento(){
			$masterView = new MasterView(MASTERVIEW::RENDER_ALL);
			include 'src/View/Layout/compra/pagamento.php';		
		}

		public function renderTabela($post){
			$formaPag = $post['forma_pag'];
			$entrada = $post['entrada'];
			$parcelas = $post['parcelas'];
			$meioPag = $post['meio_pag'];
			$carencia = $post['carencia'];
			$valorTotal = $post['valor_total'];
			$valorTotal2=0;
			$entradaFormatada = $this->formataMoedaBD($entrada);
			$data = new \DateTime();

			if($valorTotal >= $entradaFormatada){
				$valorTotal2 = $valorTotal- $entradaFormatada;
			}else{
				$valorTotal2 = $valorTotal;
				echo "<script>alert('Valor de entrada maior do que o valor total')</script>";
			}
	
			$valorParcela = round($valorTotal2 / $parcelas,2);
			$resto = $valorTotal2 - ($valorParcela * $parcelas);

			$i=0;
			while($i < $carencia){
				$data->modify('+1 day');
				$i++;
			}

			if($formaPag==1){
				$this->campos->pagamento[1]["parcelas"] = 1;
				$this->campos->pagamento[1]["dataVenci"] = $data->format('d/m/Y');
				$this->campos->pagamento[1]["valor"] = $valorParcela;
			}else{
				for($i=1; $i <= $parcelas;$i++){
					if($i != 1){
						$data->modify('+1 month');
					}
						
					$this->campos->pagamento[$i]["parcelas"] = $i;
					$this->campos->pagamento[$i]["dataVenci"] = $data->format('d/m/Y');
					$this->campos->pagamento[$i]["valor"] = $valorParcela;
					if($i == $parcelas)
						$this->campos->pagamento[$i]["valor"] = $valorParcela+$resto;
					else
						$this->campos->pagamento[$i]["valor"] = $valorParcela;
				}
			}
			include 'src/View/Layout/compra/tabela.php';		
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