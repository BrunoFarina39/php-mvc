<?php 
	namespace Model\Validation;
	use Library\AbstractValidation;
   use Model\Usuario\UsuarioDao;
   use Model\Fornecedor\FornecedorDao;
   use Model\Marca\MarcaDao;


   class ValidaUsuario extends AbstractValidation{

      function __construct(){
         parent::__construct();
      }

      public function getInputUsuario(){

            $validation=function($campos)
            {
               $retorno = true;        
               foreach ($campos as $key => $value){
                  switch ($key) {
                     case 'login':
                        if(empty($value)){
                           $this->inputFilter->setMessage($key,"Campo login obrigatório");
                           $retorno = false;
                        }else if(empty($campos->id)){
                           if(!$retorno = $this->loginAdd($value)){
                              $this->inputFilter->setMessage($key,"Este login já existe");
                           }
                        }else{
                           if(!$retorno = $this->loginEdit($value,$campos->id)){
                              $this->inputFilter->setMessage($key,"Este login já existe");
                           }
                        }                          
                        break;
                     case 'senha':
                        if(empty($value)){
                              $this->inputFilter->setMessage($key,"Campo senha obrigatório");
                              $retorno = false;
                           }else  if(strlen($value) < 8){
                              $this->inputFilter->setMessage($key,"Senha não pode ter menos que 8 caracteres");
                              $retorno = false;
                           }else if($value != $campos->conf_senha){
                              $this->inputFilter->setMessage($key,"As senhas não são iguais");
                              $this->inputFilter->setMessage("conf_senha","As senhas não são iguais");
                              $retorno = false;
                           }else{
                              $this->inputFilter->setData("nova_senha",$value);
                        };
                        break;
                     case 'senha_atual':
                        $this->inputFilter->setData("usuario_dao",new UsuarioDao());
                        $senhaAtual = $this->inputFilter->getData("usuario_dao")->buscarSenha($campos->id);
                        if(empty($value)){
                              $this->inputFilter->setMessage($key,"Campo senha atual obrigatório");
                              $retorno = false;
                           }else if(md5($value."enceladus") != $senhaAtual){
                              $this->inputFilter->setMessage($key,"Senha atual esta errada");
                              $retorno = false;
                        };
                        break;         
                     case 'conf_senha':
                        if(empty($value)){
                           $this->inputFilter->setMessage($key,"Campo confirme a senha obrigatório");
                        $retorno = false;
                        };
                        break;
                     case 'nome':
                        if(empty($value)){
                           $this->inputFilter->setMessage($key,"Campo nome obrigatório");
                           $retorno = false;
                        };
                        break;   
                     case 'nivel_acesso':
                        if(empty($value)){
                           $this->inputFilter->setMessage($key,"Campo nível acesso obrigatório");
                           $retorno = false;
                        }
                     }
               }
               return $retorno;     
            };
            $this->inputFilter->setValidation($validation);
            return $this->inputFilter;
         }

      public function loginAdd($value)
      {
         $usuarioDao = new UsuarioDao();
         return !$usuarioDao->existeRegistro("usuario","login",$value); 
      }

      public function loginEdit($value,$id)
      {
         $usuarioDao = new UsuarioDao();
         $reg = $usuarioDao->buscaRegistro("usuario","id",$id);
         if($value != $reg->login && $usuarioDao->existeRegistro("usuario","login",$value)){
            return false;
         }else{
            return true;
         }
      }
   }
?>