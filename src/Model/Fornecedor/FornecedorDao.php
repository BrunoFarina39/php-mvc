<?php 
	namespace Model\Fornecedor;
	use Util\Conexao;
	use Library\AbstractDao;
	class FornecedorDao extends AbstractDao{
		
		public function __construct()
		{
			parent::__construct();
		}

		public function gravar(Fornecedor $fornecedor)
		{
			$stmt = $this->con->getStmt("insert into fornecedor(nome_fantasia,razao_social,rg_ie,cpf_cnpj,endereco,numero,bairro,cep,cidade_id,fone,
				fone2,email,home_page,obs)values(:nome_fantasia,:razao_social,:rg_ie,:cpf_cnpj,:endereco,:numero,:bairro,:cep,:cidade_id,
				:fone,:fone2,:email,:home_page,:obs)");
			$stmt->bindParam(":nome_fantasia",$fornecedor->getNomeFantasia(),empty($fornecedor->getNomeFantasia()) ? \PDO::PARAM_NULL : \PDO::PARAM_STR);
			$stmt->bindParam(":razao_social",$fornecedor->getRazaoSocial(),empty($fornecedor->getRazaoSocial()) ? \PDO::PARAM_NULL : \PDO::PARAM_STR);
			$stmt->bindValue(":rg_ie",$fornecedor->getRgIe(),empty($fornecedor->getRgIe()) ? \PDO::PARAM_NULL : \PDO::PARAM_STR);
			$stmt->bindParam(":cpf_cnpj",$fornecedor->getCpfCnpj(),empty($fornecedor->getCpfCnpj()) ? \PDO::PARAM_NULL : \PDO::PARAM_STR);
			$stmt->bindParam(":endereco",$fornecedor->getEndereco(),empty($fornecedor->getEndereco()) ? \PDO::PARAM_NULL : \PDO::PARAM_STR);
			$stmt->bindParam(":numero",$fornecedor->getNumero(),empty($fornecedor->getNumero()) ? \PDO::PARAM_NULL : \PDO::PARAM_INT);
			$stmt->bindParam(":bairro",$fornecedor->getBairro(),empty($fornecedor->getBairro()) ? \PDO::PARAM_NULL : \PDO::PARAM_STR);
			$stmt->bindParam(":cep",$fornecedor->getCep(),empty($fornecedor->getCep()) ? \PDO::PARAM_NULL : \PDO::PARAM_STR);
			$stmt->bindParam(":cidade_id",$fornecedor->getCidade()->getId(),\PDO::PARAM_INT);
			$stmt->bindParam(":fone",$fornecedor->getFone(),empty($fornecedor->getFone()) ? \PDO::PARAM_NULL : \PDO::PARAM_STR);
			$stmt->bindParam(":fone2",$fornecedor->getFone2(),empty($fornecedor->getFone2()) ? \PDO::PARAM_NULL : \PDO::PARAM_STR);
			$stmt->bindParam(":email",$fornecedor->getEmail(),empty($fornecedor->getEmail()) ? \PDO::PARAM_NULL : \PDO::PARAM_STR);
			$stmt->bindParam(":home_page",$fornecedor->getHomePage(),empty($fornecedor->getHomePage()) ? \PDO::PARAM_NULL : \PDO::PARAM_STR);
			$stmt->bindParam(":obs",$fornecedor->getObs(),empty($fornecedor->getObs()) ? \PDO::PARAM_NULL : \PDO::PARAM_STR);
			return $stmt->execute();
		}

		public function editar(Fornecedor $fornecedor)
		{
			$stmt = $this->con->getStmt("update fornecedor set nome_fantasia=:nome_fantasia,razao_social=:razao_social,rg_ie=:rg_ie,cpf_cnpj=:cpf_cnpj,
				endereco=:endereco,numero=:numero,bairro=:bairro,cep=:cep,cidade_id=:cidade_id,fone=:fone,fone2=:fone2,email=:email,
				home_page=:home_page,obs=:obs where id=:id");
			$stmt->bindParam(":id",$fornecedor->getId(),\PDO::PARAM_INT);
			$stmt->bindParam(":nome_fantasia",$fornecedor->getNomeFantasia(),empty($fornecedor->getNomeFantasia()) ? \PDO::PARAM_NULL : \PDO::PARAM_STR);
			$stmt->bindParam(":razao_social",$fornecedor->getRazaoSocial(),empty($fornecedor->getRazaoSocial()) ? \PDO::PARAM_NULL : \PDO::PARAM_STR);
			$stmt->bindValue(":rg_ie",$fornecedor->getRgIe(),empty($fornecedor->getRgIe()) ? \PDO::PARAM_NULL : \PDO::PARAM_STR);
			$stmt->bindParam(":cpf_cnpj",$fornecedor->getCpfCnpj(),empty($fornecedor->getCpfCnpj()) ? \PDO::PARAM_NULL : \PDO::PARAM_STR);
			$stmt->bindParam(":endereco",$fornecedor->getEndereco(),empty($fornecedor->getEndereco()) ? \PDO::PARAM_NULL : \PDO::PARAM_STR);
			$stmt->bindParam(":numero",$fornecedor->getNumero(),empty($fornecedor->getNumero()) ? \PDO::PARAM_NULL : \PDO::PARAM_INT);
			$stmt->bindParam(":bairro",$fornecedor->getBairro(),empty($fornecedor->getBairro()) ? \PDO::PARAM_NULL : \PDO::PARAM_STR);
			$stmt->bindParam(":cep",$fornecedor->getCep(),empty($fornecedor->getCep()) ? \PDO::PARAM_NULL : \PDO::PARAM_STR);
			$stmt->bindParam(":cidade_id",$fornecedor->getCidade()->getId(),\PDO::PARAM_INT);
			$stmt->bindParam(":fone",$fornecedor->getFone(),empty($fornecedor->getFone()) ? \PDO::PARAM_NULL : \PDO::PARAM_STR);
			$stmt->bindParam(":fone2",$fornecedor->getFone2(),empty($fornecedor->getFone2()) ? \PDO::PARAM_NULL : \PDO::PARAM_STR);
			$stmt->bindParam(":email",$fornecedor->getEmail(),empty($fornecedor->getEmail()) ? \PDO::PARAM_NULL : \PDO::PARAM_STR);
			$stmt->bindParam(":home_page",$fornecedor->getHomePage(),empty($fornecedor->getHomePage()) ? \PDO::PARAM_NULL : \PDO::PARAM_STR);
			$stmt->bindParam(":obs",$fornecedor->getObs(),empty($fornecedor->getObs()) ? \PDO::PARAM_NULL : \PDO::PARAM_STR);
			return $stmt->execute();
		}

		public function buscarPorCampo($campo,$pesquisa)
		{
			$fornecedores = array();
			$i = 0;
            if($campo =="id")
            	$sql = "select id,nome_fantasia,cpf_cnpj from fornecedor where $campo=:pesquisa";
            else{
            	$pesquisa = "%{$pesquisa}%";
            	$sql = "select id,nome_fantasia,cpf_cnpj from fornecedor where $campo ilike :pesquisa limit 10";
            }
         	$stmt = $this->con->getStmt($sql);
         	$stmt->bindParam(":pesquisa",$pesquisa);
			
			if($stmt->execute()){
				while($reg = $stmt->fetchObject()){
					$fornecedores[$i] = new Fornecedor();
					$fornecedores[$i]->hidratar($reg);
					$i++;
				}
			return $fornecedores;
			}else{
				throw new \Exception("Erro ao buscar registro(s)!");
			}
		}

		public function excluir($id)
		{
			return parent:: excluirRegistro($id,"fornecedor");
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

		public function buscaAvancada($id)
		{
			$fornecedores = array();
			$sql = "select fornecedor.id as cli_id,fornecedor.nome_fantasia,fornecedor.razao_social,fornecedor.rg_ie,fornecedor.cpf_cnpj,fornecedor.endereco,
				fornecedor.numero,fornecedor.bairro,fornecedor.cep,cidade.nome as cid_nome,fornecedor.cidade_id,estado.id as est_id,fornecedor.fone,
				fornecedor.fone2,fornecedor.email,fornecedor.home_page,fornecedor.obs from fornecedor inner join cidade on (fornecedor.cidade_id=cidade.id) 
				inner join estado on (cidade.estado_id = estado.id) where fornecedor.id=:id";
			$i = 0;
			$stmt = $this->con->getStmt($sql);
			$stmt->bindParam(":id",$id,\PDO::PARAM_INT);
		
			if($stmt->execute()){
				while($reg = $stmt->fetchObject()){
					$fornecedores[$i] = new Fornecedor();
					$fornecedores[$i]->setId($reg->cli_id);
					$fornecedores[$i]->setNomeFantasia($reg->nome_fantasia);
					$fornecedores[$i]->setRazaoSocial($reg->razao_social);
					$fornecedores[$i]->setRgIe($reg->rg_ie);
					$fornecedores[$i]->setCpfCnpj($reg->cpf_cnpj);
					$fornecedores[$i]->setEndereco($reg->endereco);
					$fornecedores[$i]->setNumero($reg->numero);
					$fornecedores[$i]->setBairro($reg->bairro);
					$fornecedores[$i]->setCep($reg->cep);
					$fornecedores[$i]->getCidade()->setId($reg->cidade_id);
					$fornecedores[$i]->getCidade()->setNome($reg->cid_nome);
					$fornecedores[$i]->getCidade()->getEstado()->setId($reg->est_id);
					$fornecedores[$i]->setFone($reg->fone);
					$fornecedores[$i]->setFone2($reg->fone2);
					$fornecedores[$i]->setEmail($reg->email);
					$fornecedores[$i]->setHomePage($reg->home_page);
					$fornecedores[$i]->setObs($reg->obs);
					$i++;
				}
			}else{
				throw new \Exception("Erro ao buscar fornecedor!");
			}
			return $fornecedores;
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


		public function visualizaFornecedorPorId($id)
		{
			$array = array();
			$sql = "select fornecedor.id,fornecedor.nome_fantasia,fornecedor.razao_social,fornecedor.rg_ie,fornecedor.cpf_cnpj,fornecedor.endereco,
				fornecedor.numero,fornecedor.bairro,fornecedor.cep,cidade.nome as cid_nome,estado.uf as est_uf,fornecedor.fone,fornecedor.fone2,
            	fornecedor.email,fornecedor.home_page,fornecedor.obs from fornecedor inner join cidade on (fornecedor.cidade_id=cidade.id) 
            	inner join estado on (cidade.estado_id = estado.id) where fornecedor.id=:id";
    		$stmt = $this->con->getStmt($sql);
   			$stmt->bindParam(":id",$id,\PDO::PARAM_INT);
    		if($stmt->execute()){
    			$reg = $stmt->fetchObject();
    			$array = array('id'=>$reg->id,'nome_fantasia'=>$reg->nome_fantasia,'razao_social'=>$reg->razao_social,'rg_ie'=>$reg->rg_ie,
    				'cpf_cnpj'=>$reg->cpf_cnpj,'endereco'=>$reg->endereco,'numero'=>$reg->numero,'bairro'=>$reg->bairro,'cep'=>$reg->cep,
        			'cid_nome'=>$reg->cid_nome,'est_uf'=>$reg->est_uf,'fone'=>$reg->fone,'fone2'=>$reg->fone2,'email'=>$reg->email,
        			'home_page'=>$reg->home_page,'obs'=>$reg->obs);
        		return $array;
    		}else{
    			throw new \Exception("Erro ao buscar fornecedor!");
    		}   		
		}
	}
?>