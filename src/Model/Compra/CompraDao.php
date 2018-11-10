<?php 
	namespace Model\Compra;
	use Util\Conexao;
	use Library\AbstractDao;

	class CompraDao extends AbstractDao{
		
		public function __construct(){
			parent::__construct();
		}

		public function gravar(Compra $compra){
			$stmt = $this->con->getStmt("insert into pedido_compra(id_fornecedor,data_inclusao,valor_pedido,status)values(:id_fornecedor,:data_inclusao,:valor_pedido,:status)");
			$stmt->bindValue(":id_fornecedor",$compra->getFornecedor()->getId(),\PDO::PARAM_INT);
			$stmt->bindValue(":data_inclusao",date("Y-m-d H:i:s"));
			$stmt->bindValue(":valor_pedido",$compra->getValorTotal(),\PDO::PARAM_INT);
			$stmt->bindValue(":status","FECHADO",\PDO::PARAM_STR);
			return $stmt->execute();
				
		
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