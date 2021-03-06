<h1>Concluir Compra</h1>
<form class="form-horizontal" id="compra_form_pag" method="post" action="compra/add/pag">
  <input type="hidden" id="produtos" name="produtos" value='<?php echo $this->produtosStr ?>'/>
  <input type="hidden" id="valor_total" name="valor_total" value="<?php echo $this->campos->valorTotal ?>"/>
  <input type="hidden" id="fornecedor_id" name="fornecedor_id" value="<?php echo $this->campos->fornecedor_id ?>"/>
   <input type="hidden" id="fornecedor_id" name="fornecedor" value="<?php echo $this->campos->fornecedor ?>"/>
  <div class="form-group">
    <label for="forma_pag" class="col-sm-2 control-label">Forma de pagamento:</label>
    <div class="col-sm-10">
      <select id="forma_pag" name="forma_pag">
        <?php 
          foreach ($this->formaPag as $value) {
            if($this->campos->formaPag == $value['id']){
              echo "<option value='".$value['id']."' selected >".$value['value']."</option>";
            }else{
              echo "<option value='".$value['id']."'>".$value['value']."</option>";
            }
          }
        ?>
      </select>
    </div>
  </div>
  <div class="form-group">
    <label for="entrada" class="col-sm-2 control-label">Entrada:</label>
    <div class="col-sm-10">
      <input type="text" id="entrada" name="entrada" value="<?php echo $this->campos->entrada ?>" readonly />
    </div>
  </div>
  <div class="form-group">
    <label for="parcelas" class="col-sm-2 control-label">Número de Parcelas:</label>
    <div class="col-sm-10">
      <select id="parcelas" name="parcelas">
        <?php 
          echo "<option value='".$this->parcelas['id']."' selected >".$this->parcelas['value']."</option>";   
        ?>
      </select>
    </div>
  </div>
   <div class="form-group">
    <label for="meio_pag" class="col-sm-2 control-label">Meio de Pagamento:</label>
    <div class="col-sm-10">
      <select id="meio_pag" name="meio_pag">
        <?php 
          foreach ($this->meioPag as $value) {
            if($this->campos->meioPag == $value["id"]){
              echo "<option value='".$value['id']."' selected>".$value['value']."</option>";
            }else{
              echo "<option value='".$value['id']."'>".$value['value']."</option>";
            }
          }
        ?>
      </select>
    </div>
  </div>
  <div class="form-group">
    <label for="carencia" class="col-sm-2 control-label">Carência(Dias):</label>
    <div class="col-sm-10">
      <input type="text" id="carencia" name="carencia" readonly="true" value="<?php echo $this->campos->carencia ?>" min="0" />
    </div>
  </div>
  <div id="div_tabela">
    
  </div>
  <input type="submit" id="concluir" name="concluir" value="Concluir" />
  <table class="table table-striped" class="display" id="tabela_compra">
    <thead>
      <th>Código</th>
      <th>Descrição</th>
      <th>Qtde.</th>
      <th>Valor Unitário</th>
      <th>Valor Desconto</th>
      <th>Valor Total</th>
     </thead>
      <?php
       foreach ($this->campos->produtos as $value) {
          echo "<tbody><tr><td>".$value["id"]."</td><td>".$value["produto"]."</td><td>".$value["qtde"]."</td><td>".$value["preco_compra"].
          "</td><td>".$value["desconto"]."</td><td>".$value["valor_total"]."</td></tbody>";
        }
      ?>
  </table>
  <div class="form-group">
    <label for="valor_total" class="col-sm-2 control-label">Valor Total:</label>
    <div class="col-sm-10">
     <label id="valor_total" name="valor_total"><?php echo $this->formataMoeda($this->campos->valorTotal) ?></label>
    </div>
  </div>
</form>