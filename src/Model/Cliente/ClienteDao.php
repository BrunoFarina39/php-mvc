<?php 
	namespace Model\Cliente;
	use Util\Conexao;
	use Library\AbstractDao;
	class ClienteDao extends AbstractDao{
		
		public function __construct()
		{
			parent::__construct();
		}

		public function gravar(Cliente $cliente)
		{
			$stmt = $this->con->getStmt("insert into cliente(nome,rg_ie,cpf_cnpj,endereco,numero,bairro,cep,cidade_id,fone,fone2,obs)values(:nome,:rg_ie,
				:cpf_cnpj,:endereco,:numero,:bairro,:cep,:cidade_id,:fone,:fone2,:obs)");
			$stmt->bindParam(":nome",$cliente->getNome(),empty($cliente->getNome()) ? \PDO::PARAM_NULL : \PDO::PARAM_STR);
			$stmt->bindValue(":rg_ie",$cliente->getRgIe(),empty($cliente->getRgIe()) ? \PDO::PARAM_NULL : \PDO::PARAM_STR);
			$stmt->bindParam(":cpf_cnpj",$cliente->getCpfCnpj(),empty($cliente->getCpfCnpj()) ? \PDO::PARAM_NULL : \PDO::PARAM_STR);
			$stmt->bindParam(":endereco",$cliente->getEndereco(),empty($cliente->getEndereco()) ? \PDO::PARAM_NULL : \PDO::PARAM_STR);
			$stmt->bindParam(":numero",$cliente->getNumero(),empty($cliente->getNumero()) ? \PDO::PARAM_NULL : \PDO::PARAM_INT);
			$stmt->bindParam(":bairro",$cliente->getBairro(),empty($cliente->getBairro()) ? \PDO::PARAM_NULL : \PDO::PARAM_STR);
			$stmt->bindParam(":cep",$cliente->getCep(),empty($cliente->getCep()) ? \PDO::PARAM_NULL : \PDO::PARAM_STR);
			$stmt->bindParam(":cidade_id",$cliente->getCidade()->getId(),\PDO::PARAM_INT);
			$stmt->bindParam(":fone",$cliente->getFone(),empty($cliente->getFone()) ? \PDO::PARAM_NULL : \PDO::PARAM_STR);
			$stmt->bindParam(":fone2",$cliente->getFone2(),empty($cliente->getFone2()) ? \PDO::PARAM_NULL : \PDO::PARAM_STR);
			$stmt->bindParam(":obs",$cliente->getObs(),empty($cliente->getObs()) ? \PDO::PARAM_NULL : \PDO::PARAM_STR);
			return $stmt->execute();
		}

		public function editar(Cliente $cliente)
		{
			$stmt = $this->con->getStmt("update cliente set nome=:nome,rg_ie=:rg_ie,cpf_cnpj=:cpf_cnpj,endereco=:endereco,numero=:numero,bairro=:bairro,cep=:cep,
				cidade_id=:cidade_id,fone=:fone,fone2=:fone2,obs=:obs where id=:id");
			$stmt->bindParam(":id",$cliente->getId(),\PDO::PARAM_INT);
			$stmt->bindParam(":nome",$cliente->getNome(),empty($cliente->getNome()) ? \PDO::PARAM_NULL : \PDO::PARAM_STR);
			$stmt->bindValue(":rg_ie",$cliente->getRgIe(),empty($cliente->getRgIe()) ? \PDO::PARAM_NULL : \PDO::PARAM_STR);
			$stmt->bindParam(":cpf_cnpj",$cliente->getCpfCnpj(),empty($cliente->getCpfCnpj()) ? \PDO::PARAM_NULL : \PDO::PARAM_STR);
			$stmt->bindParam(":endereco",$cliente->getEndereco(),empty($cliente->getEndereco()) ? \PDO::PARAM_NULL : \PDO::PARAM_STR);
			$stmt->bindParam(":numero",$cliente->getNumero(),empty($cliente->getNumero()) ? \PDO::PARAM_NULL : \PDO::PARAM_INT);
			$stmt->bindParam(":bairro",$cliente->getBairro(),empty($cliente->getBairro()) ? \PDO::PARAM_NULL : \PDO::PARAM_STR);
			$stmt->bindParam(":cep",$cliente->getCep(),empty($cliente->getCep()) ? \PDO::PARAM_NULL : \PDO::PARAM_STR);
			$stmt->bindParam(":cidade_id",$cliente->getCidade()->getId(),\PDO::PARAM_INT);
			$stmt->bindParam(":fone",$cliente->getFone(),empty($cliente->getFone()) ? \PDO::PARAM_NULL : \PDO::PARAM_STR);
			$stmt->bindParam(":fone2",$cliente->getFone2(),empty($cliente->getFone2()) ? \PDO::PARAM_NULL : \PDO::PARAM_STR);
			$stmt->bindParam(":obs",$cliente->getObs(),empty($cliente->getObs()) ? \PDO::PARAM_NULL : \PDO::PARAM_STR);
			return $stmt->execute();
		}


		public function buscarPorCampo($campo,$pesquisa)
		{
			$clientes = array();
			$i = 0;
            if($campo =="id")
            	$sql = "select id,nome,cpf_cnpj from cliente where $campo=:pesquisa";
            else{
            	$pesquisa = "%{$pesquisa}%";
            	$sql = "select id,nome,cpf_cnpj from cliente where $campo ilike :pesquisa limit 10";
            }
         	$stmt = $this->con->getStmt($sql);
         	$stmt->bindParam(":pesquisa",$pesquisa);
			
			if($stmt->execute()){
				while($reg = $stmt->fetchObject()){
					$clientes[$i] = new Cliente();
					$clientes[$i]->hidratar($reg);
					$i++;
				}
			return $clientes;
			}else{
				throw new \Exception("Erro ao buscar registro(s)!");
			}
		}

		public function excluir($id)
		{
			return parent:: excluirRegistro($id,"cliente");
		}

		function listarEstados()
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

		public function buscaAvancada($id)
		{
			$clientes = array();
			$sql = "select cliente.id as cli_id,cliente.nome,cliente.rg_ie,cliente.cpf_cnpj,cliente.endereco,cliente.numero,cliente.bairro,cliente.cep,
				cidade.nome as cid_nome,cliente.cidade_id,estado.id as est_id,cliente.fone,cliente.fone2,cliente.obs from cliente inner join cidade 
				on (cliente.cidade_id=cidade.id) inner join estado on (cidade.estado_id = estado.id) where cliente.id=:id";
			$i = 0;
			$stmt = $this->con->getStmt($sql);
			$stmt->bindParam(":id",$id,\PDO::PARAM_INT);
		
			if($stmt->execute()){
				while($reg = $stmt->fetchObject()){
					$clientes[$i] = new Cliente();
					$clientes[$i]->setId($reg->cli_id);
					$clientes[$i]->setNome($reg->nome);
					$clientes[$i]->setRgIe($reg->rg_ie);
					$clientes[$i]->setCpfCnpj($reg->cpf_cnpj);
					$clientes[$i]->setEndereco($reg->endereco);
					$clientes[$i]->setNumero($reg->numero);
					$clientes[$i]->setBairro($reg->bairro);
					$clientes[$i]->setCep($reg->cep);
					$clientes[$i]->getCidade()->setId($reg->cidade_id);
					$clientes[$i]->getCidade()->setNome($reg->cid_nome);
					$clientes[$i]->getCidade()->getEstado()->setId($reg->est_id);
					$clientes[$i]->setFone($reg->fone);
					$clientes[$i]->setFone2($reg->fone2);
					$clientes[$i]->setObs($reg->obs);
					$i++;
				}
			}else{
				throw new \Exception("Erro ao buscar cliente!");
			}
			return $clientes;
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


		public function visualizaClientePorId($id)
		{
			$array = array();
			$sql = "select cliente.id,cliente.nome,cliente.rg_ie,cliente.cpf_cnpj,cliente.endereco,cliente.numero,cliente.bairro,cliente.cep,
            	cidade.nome as cid_nome,estado.uf as est_uf,cliente.fone,cliente.fone2,cliente.obs from cliente inner join cidade on (cliente.cidade_id=cidade.id) 
           	 	inner join estado on (cidade.estado_id = estado.id) where cliente.id=:id";
    		$stmt = $this->con->getStmt($sql);
   			$stmt->bindParam(":id",$id,\PDO::PARAM_INT);
    		if($stmt->execute()){
    			$reg = $stmt->fetchObject();
    			$array = array('id'=>$reg->id,'nome'=>$reg->nome,'rg_ie'=>$reg->rg_ie,'cpf_cnpj'=>$reg->cpf_cnpj,'endereco'=>$reg->endereco,
        			'numero'=>$reg->numero,'bairro'=>$reg->bairro,'cep'=>$reg->cep,'cid_nome'=>$reg->cid_nome,'est_uf'=>$reg->est_uf,
        			'fone'=>$reg->fone,'fone2'=>$reg->fone2,'obs'=>$reg->obs);
        		return $array;
    		}else{
    			throw new \Exception("Erro ao buscar cliente!");
    		}   		
		}
	}
?>