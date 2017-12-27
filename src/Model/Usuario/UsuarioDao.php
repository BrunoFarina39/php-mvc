<?php 
	namespace Model\Usuario;
	use Util\Conexao;
	use Library\AbstractDao;
	
	class UsuarioDao extends AbstractDao{

		public function __construct()
		{
			parent::__construct();

		}

		public function gravar(Usuario $usuario)
		{
			$stmt = $this->con->getStmt("insert into usuario (login,senha,nome,nivel_acesso)values(:login,:senha,:nome,:nivel_acesso)");
			$stmt->bindValue(":login",$usuario->getLogin(),\PDO::PARAM_STR);
			$stmt->bindValue(":senha",$usuario->getSenha(),\PDO::PARAM_STR);
			$stmt->bindValue(":nome",$usuario->getNome(),\PDO::PARAM_STR);
			$stmt->bindValue(":nivel_acesso",$usuario->getNivelAcesso(),\PDO::PARAM_INT);	
			return $stmt->execute();
		}	
		
		public function editar(Usuario $usuario)
		{
			$stmt = $this->con->getStmt("update usuario set login=:login,nome=:nome,nivel_acesso=:nivel_acesso where id=:id");
			$stmt->bindValue(":id",$usuario->getId(),\PDO::PARAM_INT);
			$stmt->bindValue(":login",$usuario->getLogin(),\PDO::PARAM_STR);
			$stmt->bindValue(":nome",$usuario->getNome(),\PDO::PARAM_STR);
			$stmt->bindValue(":nivel_acesso",$usuario->getNivelAcesso(),\PDO::PARAM_INT);
			return $stmt->execute();
		}

		public function editarSenha(Usuario $usuario)
		{
			$stmt = $this->con->getStmt("update usuario set senha=:senha where id=:id");
			$stmt->bindValue(":id",$usuario->getId(),\PDO::PARAM_INT);
			$stmt->bindValue(":senha",$usuario->getSenha(),\PDO::PARAM_STR);
			$a = $stmt->execute();
			return $stmt->execute();
		}

		public function buscarPorCampo($campo,$pesquisa)
		{
			$usuarios = array();
			$i = 0;
            if(is_numeric($pesquisa))
            	$sql = "select * from usuario where $campo=:pesquisa";
            else{
            	$pesquisa = "%{$pesquisa}%";
            	$sql = "select * from usuario where $campo ilike :pesquisa order by id";
            }
         	$stmt = $this->con->getStmt($sql);
         	$stmt->bindParam(":pesquisa",$pesquisa);
			
			if($stmt->execute()){
				while($reg = $stmt->fetchObject()){
					$usuarios[$i] = new Usuario();
					$usuarios[$i]->hidratar($reg);
					$i++;
				}
			return $usuarios;
			}else{
				throw new \Exception("Erro ao buscar registro(s)!");
			}
		}

		public function excluir($id)
		{
			return parent:: excluirRegistro($id,"usuario");
		}

		public function autenticarUsuario($login,$senha)
		{
			$i=0;
            $usuario = null;
            $sql = "select * from usuario where login=:login and senha=:senha limit 1";
         	$stmt = $this->con->getStmt($sql);
         	$stmt->bindParam(":login",$login);
         	$stmt->bindParam(":senha",$senha);
			if($stmt->execute()){
				if($reg=$stmt->fetchObject()){
					$this->setUltimoAcesso($reg->id);
					return true;
				}else{
					return false;
				}
			}else{
				throw new \Exception("Erro na validação de autenticação de usuário, por favor conate o suporte, pedimos desculpas pelo transtorno.");
			}
		}

		private function setUltimoAcesso($id)
		{
			$stmt = $this->con->getStmt("update usuario set ultimo_acesso=:ultimo_acesso where id=:id");
			$stmt->bindParam(":ultimo_acesso",date('Y-m-d H:i:s'));
			$stmt->bindParam(":id",$id);
			$stmt->execute();
		}

		public function buscarSenha($id)
		{
			try{
				$usuarios = $this->buscarPorCampo("id",$id);
				return $usuarios[0]->getSenha();
			}catch(\Exception $e){
				echo $e->getMessage();
			}
		}
	}
?>