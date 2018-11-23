<?php 
	namespace Model\ContasPagar;
	use Util\Conexao;
	use Library\AbstractDao;

	class ContasPagarDao extends AbstractDao{

		public function __construct(){
			parent::__construct();
		}

		public function gravar(ContasPagar $contasPagar){
			$retorno;
			$stmt = $this->con->getStmt("insert into contas_pagar(id_pedidocompra,id_fornecedor,data_inclusao,status)values
				(:id_pedidocompra,:id_fornecedor,:data_inclusao,:status)");
			$stmt->bindValue(":id_pedidocompra",$contasPagar->getCompra()->getId(),\PDO::PARAM_INT);
			$stmt->bindValue(":id_fornecedor",$contasPagar->getFornecedor()->getId(),\PDO::PARAM_INT);
			$stmt->bindValue(":data_inclusao",date("Y-m-d H:i:s"));
			$stmt->bindValue(":status","false");	
			$retorno = $stmt->execute();
			$this->con->getDbh()->commit();
			return $retorno;	
		}

	}

?>