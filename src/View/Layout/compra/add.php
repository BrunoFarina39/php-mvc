<h1>Compras</h1>
<form class="form-horizontal" id="compra_form" method="post" action="compra/add" novalidate>
  <div class="form-group">
    <label for="id" class="col-sm-2 control-label">Código:</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="id" name="id" value="<?php echo $this->campos->id ?>" />
    </div>
  </div>
  <div class="form-group">
    <label for="fornecedor" class="col-sm-2 control-label">Fornecedor:</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="fornecedor" name="fornecedor" value="<?php echo $this->campos->fornecedor ?>" />
    </div>
  </div>
  <div class="form-group">
    <label for="produto" class="col-sm-2 control-label">Produto:</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="produto" name="produto" value="<?php echo $this->campos->produto ?>" />
    </div>
  </div>
  <div class="form-group">
    <label for="qtde" class="col-sm-2 control-label">Qtde.:</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="qtde" name="qtde" value="<?php echo $this->campos->qtde ?>" />
    </div>
  </div>
  <div class="form-group">
    <label for="desconto" class="col-sm-2 control-label">Desconto:</label>
    <div class="col-sm-10">
      <input type="number" class="form-control" id="desconto" name="desconto" value="<?php echo $this->campos->desconto ?>" />
    </div>
  </div>
  <div class="form-group">
    <label for="id" class="col-sm-2 control-label"></label>
    <div class="col-sm-10">
       <button onclick="inserirProdutos()" type="button" class="btn btn-default">Adicionar</button>
    </div>
  </div>
  <table class="table table-striped" class="display" id="tabela_compra" width="100%">
  	<thead>
  		<th>Código</th>
  		<th>Descrição</th>
  		<th>Qtde.</th>
  		<th>Valor Unitário</th>
  		<th>Valor Desconto</th>
  		<th>Valor Total</th>
  	</tbody>
  </table>
  <button type="button" class="btn btn-default">Orçamento</button>
  <button type="button" class="btn btn-default">Avançar</button>
</form>