<h1>Lista de Serviços</h1>
<form class="form-inline pesquisa" method="post" id="lista_servico_form" action="servico/list">
 	<label>Pesquisar:</label>
<div class="form-group">
	<input type="text" class="form-control" name="campo_pesq" id="campo_pesq" value="<?php echo $this->campoPesq ?>" >
</div>
<button type="submit" class="btn btn-default">Pesquisar</button>
</form>
<br />
<div id="dialog">
	<div id="load-visualize"></div>
	<table class="table table-striped">	
	</table>
</div>
<table class="table table-striped" class="display" id="tabela_servico" width="100%">
	<thead>
		<tr>
			<th>Código</th>
			<th>Descricao</th>
			<th>Preço</th>
			<th>Alterar</th>
			<th>Excluir</th>
		</tr>
	</thead>
	<tbody>
	<?php 
		foreach ($this->servicos as $reg){
			echo "<tr>
				<td>".$reg->getId()."</td>
				<td>".$reg->getDescricao()."</td>
				<td>".$this->formataMoeda($reg->getPreco())."</td>
				<td><a href=\"servico/edit/".$reg->getId()."/".$this->campoPesq."\"><span class='glyphicon glyphicon-pencil'></span></a></td>
				<td><a href=\"javascript:excluir('servico/delete/".$reg->getId()."/".$this->campoPesq."')\" ><span class='glyphicon glyphicon-trash'></span></a></td>
			</tr>";	
		}
	?>
	</tbody>
</table>
<a href="servico/add" class="btn btn-default">Voltar para o cadastro</a>