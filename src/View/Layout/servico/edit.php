<h1>Manutenção de Serviço</h1>
<form class="form-horizontal" id="servico_form" method="post" action="servico/edit" novalidate>
  <div class="form-group">
    <label for="id" class="col-sm-2 control-label">Código:</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="id" name="id" readonly value="<?php echo $this->campos->id; ?>" />
    </div>
  </div>
  <div class="form-group">
    <label for="descricao" class="col-sm-2 control-label">Descrição:</label>
    <div class="col-sm-10">
      <input type="text"  class="form-control" id="descricao" name="descricao" required="required" maxlength="50" value="<?php echo $this->campos->descricao; ?>" />
      <span class="obrigatorio"><?php echo $this->inputFilter->getMessage("descricao"); ?></span>
    </div>
  </div>
  <div class="form-group">
    <label for="preco" class="col-sm-2 control-label">Preço:</label>
    <div class="col-sm-10">
      <input type="text"  class="form-control" id="preco" name="preco" required="required" value="<?php echo $this->campos->preco; ?>" />
      <span class="obrigatorio"><?php echo $this->inputFilter->getMessage("preco"); ?></span>
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
       <button type="submit" class="btn btn-default">Salvar</button>
       <a href="servico/list/<?php echo $this->campoPesq ?>" class="btn btn-default">Voltar para pesquisa</a>
    </div>
  </div>
  <input type="hidden" name="campo_pesq" value="<?php echo $this->campoPesq ?>" />
</form>