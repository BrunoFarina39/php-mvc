<?php 
	namespace View\Usuario;
  	use Library\AbstractForm;
  	use Library\InputFilter;
  	use Model\Usuario\Usuario;
  	use Util\MasterView;
  
	class AlteraSenhaForm extends AbstractForm{
    	private $status;
    	private $data;
    	private $campos;
    
    	public function __construct()
    	{
      		$this->campos = new \stdClass();
      		$this->campos->id = "";
      		$this->campos->senha_atual = "";
      		$this->campos->senha = "";
      		$this->campos->conf_senha = "";    
    	}

    	public function isValid()
    	{
      		return $this->inputFilter->isValid($this->campos);
    	}
    
    	public function setData($data)
    	{
       		$this->campos = (Object) $data;
    	}

    	public function setId($id)
    	{
      		$this->campos->id = $id;
    	}

    	public function getId()
    	{
       		return $this->campos->id;
    	}

    	public function setStatus($status)
    	{
      		$this->status = $status;
    	}

    	public function setEditStatus($status){
      		if($status){
        		$this->msgSucesso = "<div class='alert alert-success'>Senha alterada com sucesso!</div>";
        		$this->limpaCampos();
      		}
      		else{
        		$this->msgErro = "<div class='alert alert-danger'>Não foi possivel alterar a senha!</div>"; 
      		}
    	}

    	public function limpaCampos()
    	{
      		$this->campos->senha_atual = "";
      		$this->campos->senha = "";
      		$this->campos->conf_senha = "";        
    	}

    	function __destruct()
    	{
      		$masterView = new MasterView(MASTERVIEW::RENDER_JSCSS);
      		echo $this->msgSucesso;
      		echo $this->msgErro;
      		include 'src/View/Layout/usuario/editPassword.php';
    	}
  	}
?>