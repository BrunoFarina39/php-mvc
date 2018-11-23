<?php 
	namespace Model\Compra;
	use Util\Conexao;
	use Library\AbstractDao;

	class CompraDao extends AbstractDao{
		
		public function __construct(){
			parent::__construct();
		}

		public function gravar(Compra $compra){
			$idCompra;
			$this->con->getDbh()->beginTransaction();
			$stmt = $this->con->getStmt("insert into pedido_compra(id_fornecedor,data_inclusao,valor_pedido,status)values(:id_fornecedor,:data_inclusao,:valor_pedido,:status)");
			$stmt->bindValue(":id_fornecedor",$compra->getFornecedor()->getId(),\PDO::PARAM_INT);
			$stmt->bindValue(":data_inclusao",$compra->getDataInclusao());
			$stmt->bindValue(":valor_pedido",$compra->getValorTotal());
			$stmt->bindValue(":status",$compra->getStatus());
			
			$stmt->execute();
			$compra->setId($this->con->getDbh()->lastInsertId()); 
			foreach ($compra->getItensCompra() as $key => $value) {
				$stmt = $this->con->getStmt("insert into itens_compra(quantidade,valor_unitario,valor_total,bonificacao,id_pedidocompra,id_produto) 
					values(:quantidade,:valor_unitario,:valor_total,:bonificacao,:id_pedidocompra,:id_produto)");
					$stmt->bindValue(":quantidade",$value->getQtde(),\PDO::PARAM_INT);
					$stmt->bindValue(":valor_unitario",$value->getValorUnitario());	
					$stmt->bindValue(":valor_total",$value->getValorTotal());
					$stmt->bindValue(":bonificacao","false");	
					$stmt->bindValue(":id_pedidocompra",$compra->getId(),\PDO::PARAM_INT);
					$stmt->bindValue(":id_produto",$value->getProduto()->getId(),\PDO::PARAM_INT);	
					$stmt->execute();
			}
		} 

		public function listarFornecedores(){
			$array = Array();
			$i = 0;
			$stmt = $this->con->getStmt("select id,nome_fantasia from fornecedor");

			if($stmt->execute()){
				while($reg = $stmt->fetchObject()){
					$array[$i] = array('label'=>$reg->nome_fantasia,'value'=>$reg->id);
					$i++;
				}
			}else{
				throw new \Exception("Erro ao listar Fornecedores!");
			}
			return $array;
		}

		public function listarProdutos(){
			$array = Array();
			$i = 0;
			$stmt = $this->con->getStmt("select id,descricao from produto");

			if($stmt->execute()){
				while($reg = $stmt->fetchObject()){
					$array[$i] = array('label'=>$reg->descricao,'value'=>$reg->id);
					$i++;
				}
			}else{
				throw new \Exception("Erro ao listar Produtos!");
			}
			return $array;
		}

		public function buscaPrecoCompra($id){
			$stmt = $this->con->getStmt("select preco_compra from produto where id=:id");
			$stmt->bindParam(":id",$id,\PDO::PARAM_INT);
			if($stmt->execute()){
				$reg=$stmt->fetchObject();
				return array('preco'=> $reg->preco_compra);
			}else{
				throw new \Exception("Erro ao listar Preco Compra de Produtos!");
			}
		}
	}

?>