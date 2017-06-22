<h1>Manutenção de Usuário</h1>
<form class="form-horizontal" id="usuario_form" method="post" action="usuario/edit" novalidate>
  <div class="form-group">
    <label for="id" class="col-sm-2 control-label">Código:</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="id" name="id" readonly value="<?php echo $this->campos->id; ?>" />
    </div>
  </div>
  <div class="form-group">
    <label for="login" class="col-sm-2 control-label">Login:</label>
    <div class="col-sm-10">
      <input type="text"  class="form-control" id="login" name="login" required="required" maxlength="30" value="<?php echo $this->campos->login; ?>" />
      <span class='obrigatorio'><?php echo $this->inputFilter->getMessage("login");?></span>
    </div>
  </div>
  <div class="form-group">
    <label for="nome" class="col-sm-2 control-label">Nome:</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="nome" name="nome" required="required" maxlength="50" value="<?php echo $this->campos->nome; ?>" />
      <span class='obrigatorio'><?php echo $this->inputFilter->getMessage("nome"); ?></span>
    </div>
  </div>
  <div class="form-group">
    <label for="nivel_acesso" class="col-sm-2 control-label">Nível de Acesso:</label>
    <div class="col-sm-10">
      <input type="number" class="form-control number" id="nivel_acesso" name="nivel_acesso" required="required" min="1" max="5"  value="<?php echo $this->campos->nivel_acesso ; ?>" /><span class='obrigatorio'><?php echo $this->inputFilter->getMessage("nivel_acesso"); ?></span>
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <button type="submit" class="btn btn-default">Salvar</button>
      <a class="btn btn-default" onclick="window.open('usuario/editPassword/<?php echo $this->campos->id ?>','Pagina','width=450, height=420, RESISABLE=NO, SCROLLBARS=NO')" target="_blank">Alterar Senha</a>
      <a href="usuario/list/<?php echo $this->chavePesq."/".$this->campoPesq ?>" class="btn btn-default">Voltar para pesquisa</a>;
    </div>
  </div>
  <input type="hidden" name="chave_pesq" value="<?php echo $this->chavePesq ?>" />
  <input type="hidden" name="campo_pesq" value="<?php echo $this->campoPesq ?>" />
</form>