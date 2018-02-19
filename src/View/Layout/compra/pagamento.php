<h1>Concluir Compra</h1>
<form class="form-horizontal" id="compra_form" method="post" action="compra/pagamento">
  <div class="form-group">
    <label for="forma_pag" class="col-sm-2 control-label">Forma de pagamento:</label>
    <div class="col-sm-10">
      <select id="forma_pag" name="forma_Pag">
        <?php 
          foreach ($this->campos->formaPag as $value) {
            echo "<option value='".$value['id']."'>".$value['value']."</option>";
          }
        ?>
      </select>
    </div>
  </div>
  <div class="form-group">
    <label for="parcelas" class="col-sm-2 control-label">Número de Parcelas:</label>
    <div class="col-sm-10">
      <select id="parcelas" name="parcelas" disabled="true">
        <?php 
          foreach ($this->campos->parcelas as $value) {
            echo "<option value='".$value['id']."'>".$value['value']."</option>";
          }
        ?>
      </select>
    </div>
  </div>
  <table class="table table-striped" class="display" id="tabela_parcelas">
    <thead>
      <th>Parcela</th>
      <th>Vencimento</th>
      <th>Valor</th>
    </thead>
    <tbody>
      <tr>
        <td>1</td>
        <td>11/11/2018</td>
        <td><?php echo $this->formataMoeda($this->campos->valorTotal) ?></td>
      </tr>
    </tbody>
  </table>
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
        foreach ($this->produtos as $value) {
          echo "<tbody><tr><td>".$value[0]."</td><td>".$value[1]."</td><td>".$value[2]."</td><td>".$value[3].
          "</td><td>".$value[4]."</td><td>".$value[5]."</td></tbody>";
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