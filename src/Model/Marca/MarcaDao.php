<?php 
	namespace Model\Marca;
	use Util\Conexao;
	use Library\AbstractDao;
	class MarcaDao extends AbstractDao{

		public function __construct()
		{
			parent::__construct();
		}

		public function gravar(Marca $marca)
		{
			$stmt = $this->con->getStmt("insert into marca(nome)values(:nome)");
			$stmt->bindParam(":nome",$marca->getNome(),\PDO::PARAM_STR);
			return $stmt->execute();
		}

		public function editar(Marca $marca)
		{
			$stmt = $this->con->getStmt("update marca set nome=:nome where id=:id");
			$stmt->bindParam(":id",$marca->getId(),\PDO::PARAM_INT);
			$stmt->bindParam(":nome",$marca->getNome(),\PDO::PARAM_STR);
			return $stmt->execute();
		}


		public function buscarPorCampo($campo,$pesquisa){
			$marcas = array();
			$i = 0;
            if($campo =="id")
            	$sql = "select * from marca where $campo=:pesquisa";
            else{
            	$pesquisa = "%{$pesquisa}%";
            	$sql = "select * from marca where $campo ilike :pesquisa limit 10";
            }
         	$stmt = $this->con->getStmt($sql);
         	$stmt->bindParam(":pesquisa",$pesquisa);

			if($stmt->execute()){
				while($reg = $stmt->fetchObject()){
					$marcas[$i] = new Marca();
					$marcas[$i]->hidratar($reg);
					$i++;
				}
			return $marcas;
			}else{
				throw new \Exception("Erro ao buscar registro(s)!");
			}
		}

		public function excluir($id)
		{
			return parent:: excluirRegistro($id,"marca");
		}

		public function visualizaMarcaPorId($id)
		{
			$array = array();
			$sql = "select * from marca where id=:id";
    		$stmt = $this->con->getStmt($sql);
   			$stmt->bindParam(":id",$id,\PDO::PARAM_INT);
    		if($stmt->execute()){
    			$reg = $stmt->fetchObject();
    			$array = array('id'=>$reg->id,'nome'=>$reg->nome);
        		return $array;
    		}else{
    			throw new \Exception("Erro ao buscar marca!");
    		}   		
		}
	}

?>