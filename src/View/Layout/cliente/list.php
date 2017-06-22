<h1>Lista de Clientes</h1>
<form class="form-inline pesquisa" method="post" id="lista_cliente_form" action="cliente/list">
 	<label>Pesquisar:</label>
<div class="form-group">
	<input type="text" class="form-control" name="campo_pesq" id="campo_pesq" value="<?php echo $this->campoPesq ?>" >
</div>
&nbsp;&nbsp;&nbsp;
<label class="radio-inline">
  	<input type="radio" name="chave_pesq" id="id" value="id" <?php echo $this->checkedId ?>> Código	
</label>
<label class="radio-inline">
	<input type="radio" name="chave_pesq" id="nome" value="nome" <?php echo $this->checkedNome ?>>Nome
</label>
<label class="radio-inline">
	<input type="radio" name="chave_pesq" id="cpf_cnpj" value="cpf_cnpj" <?php echo $this->checkedCpfCnpj ?>>CPF/CNPJ
</label>
&nbsp;&nbsp;&nbsp;
<button type="submit" class="btn btn-default">Pesquisar</button>
</form>
<br />
<div id="dialog">
	<div id="load-visualize"></div>
	<table class="table table-striped">	
	</table>
</div>
<table class="table table-striped" class="display" id="tabela_cliente" width="100%">
	<thead>
		<tr>
			<th>Código</th>
			<th>Nome</th>
			<th>CPF/CNPJ</th>
			<th>Vizualizar</th>
			<th>Alterar</th>
			<th>Excluir</th>
		</tr>
	</thead>
	<tbody>
	<?php 
		foreach ($this->clientes as $reg){
			echo "<tr>
				<td>".$reg->getId()."</td>
				<td>".$reg->getNome()."</td>
				<td>".$this->formataCpfCnpj($reg->getCpfCnpj())."</td>
				<td><a href=\"javascript:void(0)\" onclick=\"visualizaDadosCliente(".$reg->getId().")\"><span class='glyphicon glyphicon-list'></span></a></td>
				<td><a href=\"cliente/edit/".$reg->getId()."/".$this->chavePesq."/".$this->campoPesq."\"><span class='glyphicon glyphicon-pencil'></span></a></td>
				<td><a href=\"javascript:excluir('cliente/delete/".$reg->getId()."/".$this->chavePesq."/".$this->campoPesq."')\" ><span class='glyphicon glyphicon-trash'></span></a></td>
			</tr>";	
		}
	?>
	</tbody>
</table>
<a href="cliente/add" class="btn btn-default">Voltar para o cadastro</a>