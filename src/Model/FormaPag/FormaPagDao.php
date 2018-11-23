<?php 
	namespace Model\FormaPag;
	use Util\Conexao;
	use Library\AbstractDao;

	class FormaPagDao extends AbstractDao{

		public function __construct(){
			parent::__construct();
		}

		public function gravar(FormaPag $formaPag){
			$retorno;
			$stmt = $this->con->getStmt("insert into forma_pagmt(id_pedidocompra,id_contaspagar,f_pagamento,n_parcelas,intervalo,entrada,carencia)values
				(:id_pedidocompra,:id_contaspagar,:f_pagamento,:n_parcelas,:intervalo,:entrada,:carencia)");
			$stmt->bindValue(":id_pedidocompra",$formaPag->getCompra()->getId(),\PDO::PARAM_INT);
			$stmt->bindValue(":id_contaspagar",$formaPag->getContasPagar()->getId(),\PDO::PARAM_INT);
			$stmt->bindValue(":f_pagamento",$formaPag->getFormaPag());
			$stmt->bindValue(":n_parcelas",$formaPag->getNParcelas());
			$stmt->bindValue(":intervalo",$formaPag->getIntervalo());	
			$stmt->bindValue(":entrada",$formaPag->getEntrada());
			$stmt->bindValue(":carencia",$formaPag->getCarencia());
			$retorno = $stmt->execute();
			print_r($stmt->errorInfo());
			$this->con->getDbh()->commit();
			return $retorno;	
		}

	}

?>