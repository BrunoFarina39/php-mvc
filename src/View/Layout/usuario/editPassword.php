<div id="content_senha">
  <h2>Alterar Senha</h2>
  <form class="form-horizontal" id="altera_senha" method="post" action="usuario/editPassword" novalidate>
     <div class="form-group">
      <label for="senha_atual" class="col-sm-2 control-label">Digite a senha atual:</label>
      <div class="col-sm-10">
        <input type="password" class="form-control senha" id="senha_atual" name="senha_atual" required="required" value="<?php echo $this->campos->senha_atual; ?>" />
        <span class='obrigatorio'><?php echo $this->inputFilter->getMessage("senha_atual"); ?></span>
      </div>
    </div>
    <div class="form-group">
      <label for="senha" class="col-sm-2 control-label">Digite a nova senha:</label>
      <div class="col-sm-10">
        <input type="password" class="form-control senha" id="senha" name="senha" required="required" maxlength="20" minlength="8" value="<?php echo $this->campos->senha; ?>" /><span class='obrigatorio'><?php echo $this->inputFilter->getMessage("senha"); ?></span>
      </div>
    </div>
    <div class="form-group">
      <label for="conf_senha" class="col-sm-2 control-label">Confirme a nova senha:</label>
      <div class="col-sm-10">
        <input type="password"  class="form-control senha" id="conf_senha" name="conf_senha" required="required" maxlength="20" minlength="8" value="<?php echo $this->campos->conf_senha; ?>" />
        <span class='obrigatorio'><?php echo $this->inputFilter->getMessage("conf_senha"); ?></span>
      </div>
    </div>
    <div class="form-group">
      <div class="col-sm-offset-2 col-sm-10">
        <button type="submit" class="btn btn-default">Salvar</button>
      </div>
    </div>
    <input type="hidden" id="id" name="id" value="<?php echo $this->campos->id ?>" />
  </form>
</div>
  