<?php 
	namespace Model\Compra;
	use Util\Conexao;
	use Library\AbstractDao;

	class CompraDao extends AbstractDao{
		
		public function __construct(){
			parent::__construct();
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