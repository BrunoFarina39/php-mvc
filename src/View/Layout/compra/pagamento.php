<h1>Concluir Compra</h1>
<form class="form-horizontal" id="compra_form" method="post" action="compra/pagamento">
  <div class="form-group">
    <label for="id" class="col-sm-2 control-label">Forma de pagamento:</label>
    <div class="col-sm-10">
      <select>
        <?php 
          foreach ($this->campos->formaPag as $value) {
            echo "<option value='".$value['id']."'>".$value['value']."</option>";
          }
        ?>
      </select>
    </div>
  </div>
</form>