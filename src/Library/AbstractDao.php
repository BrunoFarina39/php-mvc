<?php 
	namespace Library;
	use Util\Conexao;
	abstract class AbstractDao{
		protected $con;
		
		public function __construct()
		{
			$this->con = Conexao::Singleton();
		}

		public function buscaRegistro($tabela,$campo,$pesquisa)  //99820-1329 arildo
		{
			$i=0;
            $usuarios = array();
            $sql = "select * from $tabela where $campo=:pesquisa";
         	$stmt = $this->con->getStmt($sql);
         	$stmt->bindParam(":pesquisa",$pesquisa);
			if($stmt->execute()){
				return $stmt->fetchObject();	
			}else{
				echo "Erro ao buscar registros, entre em contato com o suporte.";
			}
		}

		public function existeRegistro($tabela,$campo,$valor)
		{
			$i=0;
            $usuario = null;
            $sql = "select * from $tabela where $campo=:valor limit 1";
         	$stmt = $this->con->getStmt($sql);
         	$stmt->bindParam(":valor",$valor);
			if($stmt->execute()){
				if($reg=$stmt->fetchObject()){
					return true;
				}else{
					return false;
				}
			}else{
				echo "Erro na validação duplicidade de registros, entre em contato com o suporte.";
			}
		}

		public function excluirRegistro($id,$tabela){
			$sql = "delete from ".$tabela." where id=:id";
			$stmt = $this->con->getStmt($sql);
			$stmt->bindParam(":id",$id);
			return $stmt->execute();	
		}
	} 
?>