<?php
	namespace Model\Funcionario;
	use Util\Conexao;
	use Library\AbstractDao;
	
	class FuncionarioDao extends AbstractDao{

		public function __construct()
		{
			parent:: __construct();
		}

		public function gravar(Funcionario $funcionario)
		{
			$stmt = $this->con->getStmt("insert into funcionario(nome,rg,cpf,pis,endereco,numero,bairro,cep,cidade_id,fone,salario)values(:nome,:rg,:cpf,:pis,:endereco,:numero,:bairro,:cep,:cidade_id,:fone,:salario)");
			$stmt->bindValue(":nome",$funcionario->getNome(),\PDO::PARAM_STR);
			$stmt->bindValue(":rg",$funcionario->getRg(),empty($funcionario->getRg()) ? \PDO::PARAM_NULL : \PDO::PARAM_STR);
			$stmt->bindValue(":cpf",$funcionario->getCpf(),empty($funcionario->getCpf()) ? \PDO::PARAM_NULL : \PDO::PARAM_STR);
			$stmt->bindValue(":pis",$funcionario->getPis(),empty($funcionario->getPis()) ? \PDO::PARAM_NULL : \PDO::PARAM_STR);
			$stmt->bindValue(":endereco",$funcionario->getEndereco(),empty($funcionario->getEndereco()) ? \PDO::PARAM_NULL : \PDO::PARAM_STR);
			$stmt->bindValue(":numero",$funcionario->getNumero(),empty($funcionario->getNumero()) ? \PDO::PARAM_NULL : \PDO::PARAM_INT);
			$stmt->bindValue(":bairro",$funcionario->getBairro(),empty($funcionario->getBairro()) ? \PDO::PARAM_NULL : \PDO::PARAM_STR);
			$stmt->bindValue(":cep",$funcionario->getCep(),empty($funcionario->getCep()) ? \PDO::PARAM_NULL : \PDO::PARAM_STR);
			$stmt->bindValue(":cidade_id",$funcionario->getCidade()->getId(),\PDO::PARAM_INT);
			$stmt->bindValue(":fone",$funcionario->getFone(),empty($funcionario->getFone()) ? \PDO::PARAM_NULL : \PDO::PARAM_STR);
			$stmt->bindValue(":salario",$funcionario->getSalario(),empty($funcionario->getSalario()) ? \PDO::PARAM_NULL : \PDO::PARAM_STR);
			return $stmt->execute();
		}

		public function editar(Funcionario $funcionario)
		{
			$stmt = $this->con->getStmt("update funcionario set nome=:nome,rg=:rg,cpf=:cpf,pis=:pis,endereco=:endereco,numero=:numero,bairro=:bairro,cep=:cep,
				cidade_id=:cidade_id,fone=:fone,salario=:salario where id=:id");
			$stmt->bindValue(":id",$funcionario->getId(),\PDO::PARAM_INT);
			$stmt->bindValue(":nome",$funcionario->getNome(),\PDO::PARAM_STR);
			$stmt->bindValue(":rg",$funcionario->getRg(),empty($funcionario->getRg()) ? \PDO::PARAM_NULL : \PDO::PARAM_STR);
			$stmt->bindValue(":cpf",$funcionario->getCpf(),empty($funcionario->getCpf()) ? \PDO::PARAM_NULL : \PDO::PARAM_STR);
			$stmt->bindValue(":pis",$funcionario->getPis(),empty($funcionario->getPis()) ? \PDO::PARAM_NULL : \PDO::PARAM_STR);
			$stmt->bindValue(":endereco",$funcionario->getEndereco(),empty($funcionario->getEndereco()) ? \PDO::PARAM_NULL : \PDO::PARAM_STR);
			$stmt->bindValue(":numero",$funcionario->getNumero(),empty($funcionario->getNumero()) ? \PDO::PARAM_NULL : \PDO::PARAM_INT);
			$stmt->bindValue(":bairro",$funcionario->getBairro(),empty($funcionario->getBairro()) ? \PDO::PARAM_NULL : \PDO::PARAM_STR);
			$stmt->bindValue(":cep",$funcionario->getCep(),empty($funcionario->getCep()) ? \PDO::PARAM_NULL : \PDO::PARAM_STR);
			$stmt->bindValue(":cidade_id",$funcionario->getCidade()->getId(),\PDO::PARAM_INT);
			$stmt->bindValue(":fone",$funcionario->getFone(),empty($funcionario->getFone()) ? \PDO::PARAM_NULL : \PDO::PARAM_STR);
			$stmt->bindValue(":salario",$funcionario->getSalario(),empty($funcionario->getSalario()) ? \PDO::PARAM_NULL : \PDO::PARAM_STR);
			return $stmt->execute();
		}

		public function buscarPorCampo($campo,$pesquisa)
		{
			$funcionarios = array();
			$i = 0;
			if($campo == "id")
				$sql = "select id,nome,fone from funcionario where id=:pesquisa";
			else{
				$pesquisa = "%{$pesquisa}%";
				$sql = "select id,nome,fone from funcionario where $campo ilike :pesquisa limit 10";
			}
			$stmt = $this->con->getStmt($sql);
			$stmt->bindParam(":pesquisa",$pesquisa);

			if($stmt->execute()){
				while ($reg = $stmt->fetchObject()){
					$funcionarios[$i] = new Funcionario();
					$funcionarios[$i]->hidratar($reg);
					$i++;
				}
				return $funcionarios;
			}else{
				throw new \Exception("Erro ao buscar registro(s)!");			
			}
		}

		public function excluir($id)
		{
			return parent:: excluirRegistro($id,"funcionario");
		}

		public function bindFuncionario($id)
		{
			$funcionario = new Funcionario();
			$sql = "select funcionario.id,funcionario.nome,funcionario.rg,funcionario.cpf,funcionario.pis,funcionario.endereco,funcionario.numero,
				funcionario.bairro,funcionario.cep,funcionario.cidade_id,cidade.nome as cid_nome,estado.id as est_id,funcionario.fone,
				funcionario.salario from funcionario inner join cidade on (funcionario.cidade_id=cidade.id) inner join estado on 
				(cidade.estado_id=estado.id) where funcionario.id=:id";
			$stmt = $this->con->getStmt($sql);
			$stmt->bindParam(":id",$id,\PDO::PARAM_INT);

			if($stmt->execute()){
				if($reg = $stmt->fetchObject()){
					$funcionario->setId($reg->id);
					$funcionario->setNome($reg->nome);
					$funcionario->setRg($reg->rg);
					$funcionario->setCpf($reg->cpf);
					$funcionario->setPis($reg->pis);
					$funcionario->setEndereco($reg->endereco);
					$funcionario->setNumero($reg->numero);
					$funcionario->setBairro($reg->bairro);
					$funcionario->setCep($reg->cep);
					$funcionario->getCidade()->setId($reg->cidade_id);
					$funcionario->getCidade()->setNome($reg->cid_nome);
					$funcionario->getCidade()->getEstado()->setId($reg->est_id);
					$funcionario->setFone($reg->fone);
					$funcionario->setSalario($reg->salario);
				}
			}else{
				throw new \Exception("Erro ao buscar funcionario!");				
			}
			return $funcionario;
		}

		public function listarEstados()
		{
			$estados = array();
			$i = 0;
			$stmt = $this->con->getStmt("select id,uf from estado");
			if($stmt->execute()){
				while($reg = $stmt->fetchObject()){
					$estados[$i] = $reg;
					$i++;
				}
				return $estados;
			}else{
				throw new \Exception("Erro ao listar estados!");
			}						
		}

		public function listarCidades($id)
		{
			$array = array();
			$i=0;		
    		$stmt = $this->con->getStmt("select id,nome from cidade where estado_id=:id");
    		$stmt->bindParam(":id",$id,\PDO::PARAM_INT);
    		if($stmt->execute()){
    			while ($reg = $stmt->fetchObject()) {
    				$array[$i] = array('label'=>$reg->nome,'value'=>$reg->id);
    				$i++;
    			}
    		}else{
    			throw new \Exception("Erro ao listar cidades!");
    		}
    		return $array;
		}

		public function visualizaFuncionarioPorId($id)
		{
			$array = array();
			$sql = "select funcionario.id,funcionario.nome,funcionario.rg,funcionario.cpf,funcionario.pis,funcionario.endereco,funcionario.numero,
				funcionario.bairro,funcionario.cep,cidade.nome as cid_nome,estado.uf as est_uf,funcionario.fone,funcionario.salario 
				from funcionario inner join cidade on (funcionario.cidade_id=cidade.id) inner join estado on (cidade.estado_id=estado.id) 
				where funcionario.id=:id";
			$stmt = $this->con->getStmt($sql);
			$stmt->bindParam(":id",$id,\PDO::PARAM_INT);
    		if($stmt->execute()){
    			$reg = $stmt->fetchObject();
    			$array = array('id'=>$reg->id,'nome'=>$reg->nome,'rg'=>$reg->rg,'cpf'=>$reg->cpf,'pis'=>$reg->pis,'endereco'=>$reg->endereco,
    				'numero'=>$reg->numero,'bairro'=>$reg->bairro,'cep'=>$reg->cep,'cid_nome'=>$reg->cid_nome,'est_uf'=>$reg->est_uf,'fone'=>$reg->fone,
    				'salario'=>$reg->salario);
				return $array;
			}else{
				throw new \Exception("Erro ao buscar funcionario!");
			}
		}		
	}
?>