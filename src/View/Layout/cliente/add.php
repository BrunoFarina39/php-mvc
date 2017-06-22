<h1>Cadastro de Cliente</h1>
<form class="form-horizontal" id="cliente_form" method="post" action="cliente/add" novalidate>
  <div class="form-group">
    <label for="id" class="col-sm-2 control-label">Código:</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="id" name="id" readonly value="<?php echo $this->campos->id ?>" />
    </div>
  </div>
  <div class="form-group">
    <label for="nome" class="col-sm-2 control-label">Nome:</label>
    <div class="col-sm-10">
      <input type="text"  class="form-control" id="nome" name="nome" required="required" maxlength="50" value="<?php echo $this->campos->nome ?>" />
      <span class="obrigatorio"><?php echo $this->inputFilter->getMessage("nome"); ?></span>
    </div>
  </div>
 <div class="form-group">
    <label for="rg_ie" class="col-sm-2 control-label">RG/IE:</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="rg_ie" name="rg_ie" maxlength="20" value="<?php echo $this->campos->rg_ie; ?>" />
    </div>
  </div>
  <div class="form-group">
    <label for="cpf_cnpj" class="col-sm-2 control-label">CPF/CNPJ:</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="cpf_cnpj" name="cpf_cnpj" value="<?php echo $this->campos->cpf_cnpj ?>" />
      <span class="obrigatorio"><?php echo $this->inputFilter->getMessage("cpf_cnpj"); ?><span> 
    </div>
  </div>
  <div class="form-group">
    <label for="endereco" class="col-sm-2 control-label">Endereço:</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="endereco" name="endereco" maxlength="50" value="<?php echo $this->campos->endereco; ?>" />
    </div>
  </div>
  <div class="form-group">
    <label for="numero" class="col-sm-2 control-label">Número:</label>
    <div class="col-sm-10">
      <input type="number" class="form-control number-long" id="numero" name="numero" value="<?php echo $this->campos->numero; ?>" />
    </div>
  </div>
  <div class="form-group">
    <label for="bairro" class="col-sm-2 control-label">Bairro:</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="bairro" name="bairro" maxlength="50" value="<?php echo $this->campos->bairro; ?>" />
    </div>
  </div>
  <div class="form-group">
    <label for="cep" class="col-sm-2 control-label">CEP:</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="cep" name="cep" value="<?php echo $this->campos->cep; ?>" />
    </div>
  </div>
  <div class="form-group">
    <label for="estado" class="col-sm-2 control-label">Estado:</label>
    <div class="col-sm-10">
     <select id="estado" name="estado">
       <?php 
          $i = 0;
          if(empty($this->campos->estado)){
            foreach ($this->estados as $value) {
              echo "<option value='".$value->id."'>".$value->uf."</option>";
            } 
          }else{
           foreach ($this->estados as $value) {
              if($this->campos->estado == $value->id)
                echo "<option value='".$value->id."' selected>".$value->uf."</option>";
              else
                echo "<option value='".$value->id."'>".$value->uf."</option>";
            } 
          }
        ?>
     </select>&nbsp;
     <span id="carregar_cidade"></span>
    </div>
  </div>
  <div class="form-group">
    <label for="cidade" class="col-sm-2 control-label">Cidade:</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="cidade" name="cidade" required="required" value="<?php echo $this->campos->cidade; ?>" />
      <input type="hidden" id="cidade_id" name="cidade_id" value="<?php echo $this->campos->cidade_id; ?>" />
       <span class="obrigatorio"><?php echo $this->inputFilter->getMessage("cidade"); ?></span>
    </div>
  </div>
  <div class="form-group">
    <label for="fone" class="col-sm-2 control-label">Fone:</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="fone" name="fone" value="<?php echo $this->campos->fone; ?>" />
    </div>
  </div>
  <div class="form-group">
    <label for="fone2" class="col-sm-2 control-label">Fone2:</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="fone2" name="fone2" value="<?php echo $this->campos->fone2; ?>" />
    </div>
  </div>
  <div class="form-group">
    <label for="obs" class="col-sm-2 control-label">Obs.:</label>
    <div class="col-sm-10">
      <textarea class="form-control" id="obs" name="obs" maxlength="100" ><?php echo $this->campos->obs; ?></textarea>
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
       <button type="submit" class="btn btn-default">Cadastrar</button>
       <a href="cliente/list" class="btn btn-default">Lista</a>
    </div>
  </div>
</form>