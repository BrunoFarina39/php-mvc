<table class="table table-striped" class="display" id="tabela_parcelas">
    <thead>
      <th>Parcela</th>
      <th>Vencimento</th>
      <th>Valor</th>
    </thead>
    <?php 
      foreach ($this->campos->pagamento as $value) {
        echo "<tbody><tr><td>".($value["parcelas"])."</td><td>".$value["dataVenci"]."</td><td>".$this->formataMoeda($value["valor"])."</td></tr></tbody>";
      }
    ?>
  </table>