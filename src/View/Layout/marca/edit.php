<h1>Manutenção de Marca</h1>
<form class="form-horizontal" id="marca_form" method="post" action="marca/edit" novalidate>
  <div class="form-group">
    <label for="id" class="col-sm-2 control-label">Código:</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="id" name="id" readonly value="<?php echo $this->campos->id; ?>" />
    </div>
  </div>
  <div class="form-group">
    <label for="nome" class="col-sm-2 control-label">Nome:</label>
    <div class="col-sm-10">
      <input type="text"  class="form-control" id="nome" name="nome" required="required" maxlength="50" value="<?php echo $this->campos->nome; ?>" />
      <span class="obrigatorio"><?php echo $this->inputFilter->getMessage("nome"); ?></span>
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
       <button type="submit" class="btn btn-default">Salvar</button>
       <a href="marca/list/<?php echo $this->campoPesq ?>" class="btn btn-default">Voltar para pesquisa</a>
    </div>
  </div>
  <input type="hidden" name="campo_pesq" value="<?php echo $this->campoPesq ?>" />
</form>