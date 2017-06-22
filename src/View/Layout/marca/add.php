<h1>Cadastro de Marca</h1>
<form class="form-horizontal" id="marca_form" method="post" action="marca/add" novalidate>
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
       <button type="submit" class="btn btn-default">Cadastrar</button>
       <a href="marca/list" class="btn btn-default">Lista</a>
    </div>
  </div>
</form>