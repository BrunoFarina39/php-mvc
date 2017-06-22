<?php 
	namespace Model\Produto;
	use Util\Conexao;
	use Library\AbstractDao;
	class ProdutoDao extends AbstractDao{

		public function __construct()
		{
			parent::__construct();
		}

		public function gravar(Produto $produto)
		{
			$stmt = $this->con->getStmt("insert into produto(cod_barra,descricao,marca_id,preco_compra,preco_venda,qtde_est)values(:cod_barra,:descricao,
				:marca_id,:preco_compra,:preco_venda,:qtde_est)");
			$stmt->bindParam(":cod_barra",$produto->getCodBarra(),empty($produto->getCodBarra()) ? \PDO::PARAM_NULL : \PDO::PARAM_STR);
			$stmt->bindParam(":descricao",$produto->getDescricao(),\PDO::PARAM_STR);
			$stmt->bindParam(":marca_id",$produto->getMarca()->getId(),\PDO::PARAM_INT);
			$stmt->bindParam(":preco_compra",$produto->getPrecoCompra(),\PDO::PARAM_STR);
			$stmt->bindParam(":preco_venda",$produto->getPrecoVenda(),\PDO::PARAM_STR);
			$stmt->bindParam(":qtde_est",$produto->getQtdeEst(),\PDO::PARAM_INT);
			return $stmt->execute();
		}

		public function editar(Produto $produto)
		{
			$stmt = $this->con->getStmt("update produto set cod_barra=:cod_barra,descricao=:descricao,marca_id=:marca_id,preco_compra=:preco_compra,
				preco_venda=:preco_venda where id=:id");
			$stmt->bindParam(":id",$produto->getId(),\PDO::PARAM_INT);
			$stmt->bindParam(":cod_barra",$produto->getCodBarra(),empty($produto->getCodBarra()) ? \PDO::PARAM_NULL : \PDO::PARAM_STR);
			$stmt->bindParam(":descricao",$produto->getDescricao(),\PDO::PARAM_STR);
			$stmt->bindParam(":marca_id",$produto->getMarca()->getId(),\PDO::PARAM_INT);
			$stmt->bindParam(":preco_compra",$produto->getPrecoCompra(),\PDO::PARAM_STR);
			$stmt->bindParam(":preco_venda",$produto->getPrecoVenda(),\PDO::PARAM_STR);
			return $stmt->execute();
		}


		public function buscarPorcampo($campo,$pesquisa)
		{
			$produtos = array();
			$i = 0;
			if($campo =="id")
            	$sql = "select id,descricao from produto where $campo=:pesquisa";
            else{
            	$pesquisa = "%{$pesquisa}%";
            	$sql = "select id,descricao from produto where $campo ilike :pesquisa limit 10";
            }
			$stmt = $this->con->getStmt($sql);
			$stmt->bindParam(":pesquisa",$pesquisa);
			if($stmt->execute()){
				while($reg = $stmt->fetchObject()){
					$produtos[$i] = new Produto();
					$produtos[$i]->hidratar($reg);
					$i++;
				}
				return $produtos;
			}else{
				var_dump($stmt->errorInfo());
				throw new \Exception("Erro ao listar registros!");
			}
		}

		public function excluir($id)
		{
			return parent:: excluirRegistro($id,"produto");
		}

		public function buscaAvancada($id)
		{
			$produtos = array();
			$sql = "select produto.id,produto.cod_barra,produto.descricao,produto.marca_id,marca.nome,produto.preco_compra,produto.preco_venda,
				produto.qtde_est from produto inner join marca on (produto.marca_id=marca.id) where produto.id=:id";
			$i = 0;
			$stmt = $this->con->getStmt($sql);
			$stmt->bindParam(":id",$id,\PDO::PARAM_INT);
		
			if($stmt->execute()){
				while($reg = $stmt->fetchObject()){
					$produtos[$i] = new Produto();
					$produtos[$i]->setId($reg->id);
					$produtos[$i]->setCodBarra($reg->cod_barra);
					$produtos[$i]->setDescricao($reg->descricao);
					$produtos[$i]->getMarca()->setId($reg->marca_id);
					$produtos[$i]->getMarca()->setNome($reg->nome);
					$produtos[$i]->setPrecoCompra($reg->preco_compra);
					$produtos[$i]->setPrecoVenda($reg->preco_venda);
					$produtos[$i]->setQtdeEst($reg->qtde_est);
					$i++;
				}
			}else{
				throw new \Exception("Erro ao buscar produto!");
			}
			return $produtos;
		}

		public function listarMarcas()
		{
			$array = array();
			$i=0;		
    		$stmt = $this->con->getStmt("select id,nome from marca");
    		if($stmt->execute()){
    			while ($reg = $stmt->fetchObject()) {
    				$array[$i] = array('label'=>$reg->nome,'value'=>$reg->id);
    				$i++;
    			}
    		}else{
    			throw new \Exception("Erro ao listar marcas!");
    		}
    		return $array;
		}

		public function visualizaProdutoPorId($id)
		{
			$array = array();
			$sql = "select produto.id,produto.cod_barra,produto.descricao,marca.nome as marca_nome,produto.preco_compra,produto.preco_venda,
			produto.qtde_est from produto inner join marca on(produto.marca_id = marca.id) where produto.id=:id";
    		$stmt = $this->con->getStmt($sql);
   			$stmt->bindParam(":id",$id,\PDO::PARAM_INT);
    		if($stmt->execute()){
    			$reg = $stmt->fetchObject();
    			$array = array('id'=>$reg->id,'cod_barra'=>$reg->cod_barra,'descricao'=>$reg->descricao,'marca'=>$reg->marca_nome,
    				'preco_compra'=>$reg->preco_compra,'preco_venda'=>$reg->preco_venda,'qtde_est'=>$reg->qtde_est);
        		return $array;
    		}else{
    			throw new \Exception("Erro ao buscar produto!");
    		}   		
		}
	}
?>