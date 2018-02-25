<h1>Compras</h1>
<form class="form-horizontal" id="compra_form" method="post" action="compra/add">
  <div class="form-group">
    <label for="id" class="col-sm-2 control-label">Código:</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="id" name="id" value="<?php echo $this->campos->id ?>" />
    </div>
    <span id="carregar_fornecedor"></span>
  </div>
  <div class="form-group">
    <label for="fornecedor" class="col-sm-2 control-label">Fornecedor:</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="fornecedor" name="fornecedor" value="<?php echo $this->campos->fornecedor ?>" />
      <input type="hidden" id="fornecedor_id" name="fornecedor_id" value="<?php echo $this->campos->fornecedor_id; ?>" />
      <span class="obrigatorio"><?php echo $this->inputFilter->getMessage("fornecedor"); ?></span>
    </div>
    <span id="carregar_produto"></span>
  </div>
  <div class="form-group">
    <label for="produto" class="col-sm-2 control-label">Produto:</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="produto" name="produto" value="" />
      <input type="hidden" id="produto_id" name="produto_id" value="<?php echo $this->campos->produto_id; ?>" />
      <span class="obrigatorio"><?php echo $this->inputFilter->getMessage("produtos"); ?></span>
    </div>
    <span id="carregar_produto_preco"></span>
  </div>
   <div class="form-group">
    <label for="preco_compra" class="col-sm-2 control-label">Preço Compra:</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="preco_compra" name="preco_compra" disabled="true" />
    </div>
  </div>
  <div class="form-group">
    <label for="qtde" class="col-sm-2 control-label">Qtde.:</label>
    <div class="col-sm-10">
      <input type="number" class="form-control" id="qtde" name="qtde" value="<?php echo $this->campos->qtde ?>" />
    </div>
  </div>
  <div class="form-group">
    <label for="desconto" class="col-sm-2 control-label">Desconto:</label>
    <div class="col-sm-10">
      <input type="number" class="form-control" id="desconto" name="desconto" min="0" max="100" value="<?php echo $this->campos->desconto ?>" />
    </div>
  </div>
  <div class="form-group">
    <label for="id" class="col-sm-2 control-label"></label>
    <div class="col-sm-10">
       <button id="adicionar" name="adicionar" type="button" class="btn btn-default">Adicionar</button>
       <button type="button" class="btn btn-default">Orçamento</button>
       <button type="submit" id="avancar" name="avancar" class="btn btn-default">Avançar</button>
       <input type="hidden" id="valor_total" name="valor_total" value="<?php echo $this->campos->valor_total ?>"/>
       <label id="lvtotal" name="lvtotal"><?php echo $this->formataMoeda($this->campos->valor_total) ?></label>
    </div>
  </div>
  <table class="table table-striped" class="display" id="tabela_compra" width="100%">
  	<thead>
  		<th>Código</th>
  		<th>Descrição</th>
  		<th>Qtde.</th>
  		<th>Valor Unitário</th>
  		<th>Valor Desconto</th>
      <th>Excluir</th>
  		<th>Valor Total</th>
     
     </thead>
      <?php
        foreach ($this->produtos as $value) {
          echo "<tbody><tr><td>".$value[0]."</td><td>".$value[1]."</td><td>".$value[2]."</td><td>".$value[3].
          "</td><td>".$value[4]."</td><td><a onclick='excluirProd(this)' href='javascript:void(0)'><span class='glyphicon glyphicon-trash'></span></a></td><td>".$value[5]."</td></tbody>";
        }
      ?>
  </table>
  </table>
  <input type="hidden" id="produtos" name="produtos" value="<?php echo $this->campos->produtos ?>" />
  <input type="hidden" id="form" name="form" />
  <input type="hidden" id="finalizar" name="finalizar" />
</form>