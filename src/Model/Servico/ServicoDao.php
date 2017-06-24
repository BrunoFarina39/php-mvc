<?php 
	namespace Model\Servico;
	use Util\Conexao;
	use Library\AbstractDao;
	class ServicoDao extends AbstractDao{

		public function __construct()
		{
			parent::__construct();
		}

		public function gravar(Servico $servico)
		{
			$stmt = $this->con->getStmt("insert into servico(descricao,preco)values(:descricao,:preco)");
			$stmt->bindValue(":descricao",$servico->getDescricao(),\PDO::PARAM_STR);
			$stmt->bindValue(":preco",$servico->getPreco(),\PDO::PARAM_STR);
			return $stmt->execute();
		}

		public function editar(Servico $servico)
		{
			$stmt = $this->con->getStmt("update servico set descricao=:descricao,preco=:preco where id=:id");
			$stmt->bindValue(":id",$servico->getId(),\PDO::PARAM_INT);
			$stmt->bindValue(":descricao",$servico->getDescricao(),\PDO::PARAM_STR);
			$stmt->bindValue(":preco",$servico->getPreco(),\PDO::PARAM_STR);
			return $stmt->execute();
		}


		public function buscarPorcampo($campo,$pesquisa){
			$servicos = array();
			$i = 0;
			if($campo =="id")
            	$sql = "select * from servico where $campo=:pesquisa";
            else{
            	$pesquisa = "%{$pesquisa}%";
            	$sql = "select * from servico where $campo ilike :pesquisa limit 10";
            }
			$stmt = $this->con->getStmt($sql);
			$stmt->bindParam(":pesquisa",$pesquisa);
			if($stmt->execute()){
				while($reg = $stmt->fetchObject()){
					$servicos[$i] = new Servico();
					$servicos[$i]->hidratar($reg);
					$i++;
				}
				return $servicos;
			}else{
				throw new \Exception("Erro ao listar registros!");
			}
		}

		public function excluir($id)
		{
			return parent:: excluirRegistro($id,"servico");
		}
	}
?>