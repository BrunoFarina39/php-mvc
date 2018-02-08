<?php 
	namespace Controller\Usuario;
	use Library\AbstractController;
	use View\Usuario\UsuarioForm;
	use View\Usuario\UsuarioListaForm;
	use View\Usuario\AlteraSenhaForm;
	use Model\Usuario\Usuario;
	use Model\Usuario\UsuarioDao;
	
	class UsuarioController extends AbstractController{
		private $usuario,$usuarioDao;
		
		public function __construct()
		{
			$this->usuario = new Usuario();
			$this->usuarioDao = new UsuarioDao();
		}

		public function actionIndex()
		{
			$acao = "add";
			$usuarioForm = new UsuarioForm($acao);
		}

		public function actionAdd($post)
		{		
			$acao = "add";
			$usuarioForm = new UsuarioForm($acao);
			$usuarioForm->setInputFilter($this->usuario->getInputFilter());	
			if($this->isPost()){
				$usuarioForm->setData($post);
				if($usuarioForm->isValid()){
					$this->usuario->hidratar($usuarioForm->getData());	
					$usuarioForm->setAddStatus($this->usuarioDao->gravar($this->usuario));					
				}
			}
		}

		public function actionEdit($id,$post,$chavePesq,$campoPesq)
		{
			$acao = "edit";
			$usuarioForm = new UsuarioForm($acao);
			$usuarioForm->setInputFilter($this->usuario->getInputFilter());
			if($this->isPost()){
				$chavePesq = $post['chave_pesq'];
				$campoPesq = $post['campo_pesq'];
			    $usuarioForm->setData($post);				
				if($usuarioForm->isValid()){		
					$this->usuario->hidratar($usuarioForm->getData());
					$usuarioForm->setEditStatus($this->usuarioDao->editar($this->usuario));											
				}
			}else{
				try{
					$usuarios = $this->usuarioDao->buscarPorCampo("id",$id);
					if(isset($usuarios[0]))
						$this->usuario = $usuarios[0];
					$usuarioForm->bind($this->usuario);
				}catch(\Exception $e){
					$usuarioForm->setMsgErro($e->getMessage());
				}
			}
			$usuarioForm->setCamposHidden(array('chave_pesq'=>$chavePesq,'campo_pesq'=>$campoPesq));
		}

		public function actionDelete($id,$chavePesq,$campoPesq)
		{
			$usuarioLista = new UsuarioListaForm();
			$usuarioLista->setDeleteStatus($this->usuarioDao->excluir($id));
			try{
				$usuarios = $this->usuarioDao->buscarPorCampo($chavePesq,$campoPesq);
			}catch(\Exception $e){
				$usuarios = array();
			}
			$usuarioLista->setData($usuarios,$chavePesq,$campoPesq);
		}

		public function actionList($post,$chavePesq,$campoPesq)
		{
			$usuarioLista = new UsuarioListaForm();
			try{
				if($this->isPost()){
					$chavePesq = $post['chave_pesq'];
					$campoPesq = $post['campo_pesq'];		
				}
				$usuarios = $this->usuarioDao->buscarPorCampo(empty($chavePesq) ? "nome" : $chavePesq,$campoPesq);				
			}catch(\Exception $e){
				$usuarios = array();
				$usuarioLista->setMsgErro($e->getMessage());
			}
			$usuarioLista->setData($usuarios,$chavePesq,$campoPesq);		
		}

		public function actionEditPassword($post,$id)
		{
			$alteraSenhaForm = new AlteraSenhaForm();
			$alteraSenhaForm->setInputFilter($this->usuario->getInputFilter());
			if($this->isPost()){
				$alteraSenhaForm->setData($post);
				if($alteraSenhaForm->isValid()){
					$this->usuario->setId($alteraSenhaForm->getId());
					$this->usuario->setSenha($this->usuario->getInputFilter()->getData("nova_senha"));
					$alteraSenhaForm->setEditStatus($this->usuarioDao->editarSenha($this->usuario));
				}		
			}else{
				$alteraSenhaForm->setId($id);
			}
		}
	}
?>