<?php 
	namespace View\Compra;
	use Library\AbstractForm;
	use Library\InputFilter;
	use Util\MasterView;

	class CompraFormPag extends AbstractForm{
		private $acao;
		private $campos;
		private $formaPagPost;
		private $parcelasPost;
		private $produtos;
		function __construct(){
			$this->campos = new \stdClass();
			$this->campos->formaPag[0]['id']="1";
			$this->campos->formaPag[0]['value']="À vista";
			$this->campos->formaPag[1]['id']="2";
			$this->campos->formaPag[1]['value']="À prazo";
			$this->campos->valorTotal=0;
			for($i=1; $i < 13; $i++){
				$this->campos->parcelas[$i]['id']=$i;
				$this->campos->parcelas[$i]['value']=$i;
			}
			$this->campos->meioPag[0]['value']="Boleto";
			$this->campos->meioPag[1]['value']="Cartão";
			$this->campos->meioPag[2]['value']="Cheque";
			$this->campos->meioPag[3]['value']="Dinheiro";
			$this->campos->meioPag[4]['value']="Nota promissória";
			$this->campos->pagamento = array();
		}

		public function setData($post)
		{
			$this->campos->valorTotal=$post["valor_total"];
			$this->formaPagPost=$post['forma_pag'];
			$this->parcelasPost=$post["parcelas"];
			$this->produtos = explode("/", $post['produtos']);
			foreach ($this->produtos as $key => $value) {
				$this->produtos[$key]= explode("-", $value);
			}

			$data = new \DateTime();
			$valorParcela = round($this->campos->valorTotal/$this->parcelasPost,2);
			$resto = $this->campos->valorTotal - ($valorParcela * $this->parcelasPost);
			
			if($this->formaPagPost==1){
				for($i=1; $i <= $post["parcelas"];$i++){
					$this->campos->pagamento[$i]["parcelas"]=$i+1;
					$this->campos->pagamento[$i]["dataVenci"]=$data->format('d/m/Y');
					$this->campos->pagamento[$i]["valor"]=$valorParcela;
				}
			}else{
				for($i=1; $i <= $post["parcelas"];$i++){
					$data->modify('+1 month');
					$this->campos->pagamento[$i]["parcelas"]=$i+1;
					$this->campos->pagamento[$i]["dataVenci"]=$data->format('d/m/Y');
					$this->campos->pagamento[$i]["valor"]=$valorParcela;
					if($i==$this->parcelasPost)
						$this->campos->pagamento[$i]["valor"]=$valorParcela+$resto;
					else
						$this->campos->pagamento[$i]["valor"]=$valorParcela;
				}
			}
		}

		function __destruct(){
			$masterView = new MasterView(MASTERVIEW::RENDER_ALL);
			include 'src/View/Layout/compra/pagamento.php';						
		}
	}

?>