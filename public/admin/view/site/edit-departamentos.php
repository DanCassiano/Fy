<?php 
	$acao = 'novo';
	$contato = "";
	
	if( !empty( $id )){
		$acao = "edit";		
	}
?>
<div class="box box-primary">
	<div class="box-header with-border">
		<?php if( !empty( $id )){ ?>
			<h3 class="box-title">Editar</h3>
		<?php }else { ?>
			<h3 class="box-title">Adicionar</h3>
		<?php } ?>
	</div>
	<!-- /.box-header -->
	<!-- form start -->
	<form role="form" action="<?=$baseURL?>site/departamentos/<?=$acao?>" method="post"> 
		<input type="hidden" name="id" value="<?=$id?>"></input>
		<div class="box-body">
			<div class="form-group">
				<label for="inputContato">Contato</label>
				<input type="text" class="form-control" required id="inputContato" name="contato"  placeholder="ex: Contato" value="<?=$contato?>" >
			</div>
			<div class="checkbox">
				<label>
					<input type="checkbox" checked name='ativo'> Ativo
				</label>
			</div>
		</div>
		<!-- /.box-body -->
		<div class="box-footer">
			<a href="<?=$baseURL?>site/departamentos" class="btn btn-default">Cancelar</a>
			<button type="submit" class="btn btn-success pull-right">Salvar</button>
		</div>
		<!-- /.box-footer -->
	</form>
</div>