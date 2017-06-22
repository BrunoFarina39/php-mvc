<h1>Lista de Usuários</h1>
<form class="form-inline pesquisa" method="post" id="lista_usuario_form" action="usuario/list">
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
&nbsp;&nbsp;&nbsp;
<button type="submit" class="btn btn-default">Pesquisar</button>
</form>
<br />
<table class="table table-striped" class="display" id="tabela_usuario" width="100%">
	<thead>
		<tr>
			<th>Código</th>
			<th>Login</th>
			<th>Nome</th>
			<th>Último Acesso</th>
			<th>Nível Acesso</th>
			<th>Alterar</th>
			<th>Excluir</th>
		</tr>
	</thead>
	<tbody>
	<?php 
		foreach ($this->usuarios as $reg){
			echo "<tr>
				<td>".$reg->getId()."</td>
				<td>".$reg->getLogin()."</td>
				<td>".$reg->getNome()."</td>
				<td>".$this->formataDataHora($reg->getUltimoAcesso())."</td>
				<td>".$reg->getNivelAcesso()."</td>
				<td><a href=\"usuario/edit/".$reg->getId()."/".$this->chavePesq."/".$this->campoPesq."\"><span class='glyphicon glyphicon-pencil'></span></a></td>
				<td><a href=\"javascript:excluir('usuario/delete/".$reg->getId()."/".$this->chavePesq."/".$this->campoPesq."')\" ><span class='glyphicon glyphicon-trash'></span></a></td>
			</tr>";	
		}
	?>
	</tbody>
</table>
<a href="usuario/add" class="btn btn-default">Voltar para o cadastro</a>