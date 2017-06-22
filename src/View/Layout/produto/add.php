<h1>Cadastro de Produto</h1>
<form class="form-horizontal" id="produto_form" method="post" action="produto\add" novalidate>
  <div class="form-group">
    <label for="id" class="col-sm-2 control-label">Código:</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="id" name="id" readonly value="<?php echo $this->campos->id; ?>" />
    </div>
  </div>
  <div class="form-group">
    <label for="cod_barra" class="col-sm-2 control-label">Código de Barra:</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="cod_barra" name="cod_barra" value="<?php echo $this->campos->cod_barra; ?>" />
    </div>
  </div>
  <div class="form-group">
    <label for="descricao" class="col-sm-2 control-label">Descrição:</label>
    <div class="col-sm-10">
      <input type="text"  class="form-control" id="descricao" name="descricao" required="required" maxlength="50" value="<?php echo $this->campos->descricao; ?>" /><span class="obrigatorio"><?php echo $this->inputFilter->getMessage("descricao"); ?></span>
    </div>
  </div>
  <div class="form-group">
    <label for="marca" class="col-sm-2 control-label">Marca:</label>
    <div class="col-sm-10">
      <input type="text"  class="form-control" id="marca" name="marca" required="required" value="<?php echo $this->campos->marca; ?>" />
      <input type="hidden" id="marca_id" name="marca_id" value="<?php echo $this->campos->marca_id; ?>" />
       <span id="carregar_marca"></span><span class="obrigatorio"><?php echo $this->inputFilter->getMessage("marca"); ?></span>
    </div>
  </div>
   <div class="form-group">
    <label for="preco_compra" class="col-sm-2 control-label">Preço Compra:</label>
    <div class="col-sm-10">
      <input type="text"  class="form-control" id="preco_compra" name="preco_compra" required="required" value="<?php echo $this->campos->preco_compra; ?>" /> <span class="obrigatorio"><?php echo $this->inputFilter->getMessage("preco_compra") ?></span>
    </div>
  </div>
   <div class="form-group">
    <label for="preco_venda" class="col-sm-2 control-label">Preço Venda:</label>
    <div class="col-sm-10">
      <input type="text"  class="form-control" id="preco_venda" name="preco_venda" required="required" value="<?php echo $this->campos->preco_venda; ?>" />
      <span class="obrigatorio"><?php echo $this->inputFilter->getMessage("preco_venda"); ?></span>
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
       <button type="submit" class="btn btn-default">Cadastrar</button>
       <a href="produto/list" class="btn btn-default">Lista</a>
    </div>
  </div>
</form>