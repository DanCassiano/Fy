<?php	
	$perfilNome = "";
	$ativo = "checked=checked";

	if( !empty( $id )){
		$perfilNome = $perfil['perfil'];
		if( $perfil['bloqueado'] == "S")
			$ativo = "";
	}
?>
<div class="box box-primary">
	<div class="box-header with-border">
		<h3 class="box-title">Perfil</h3>
	</div>
	<!-- /.box-header -->
	<!-- form start -->
	<form role="form" action="<?=$baseURL?>site/perfil/salvar" id="formPerfil" method="post" >
		<input type="hidden" name="id" value="<?=$id?>">
		<div class="box-body">
			<div class="form-group">
				<label for="txtNomePerfil">Nome parar o perfil</label>
				<input type="text" class="form-control" id="txtNomePerfil" placeholder="ex: Contatos" name="perfil" value="<?=$perfilNome?>" required>
			</div>
			<div class="checkbox">
				<label><input type="checkbox"	<?php echo $ativo ?>  name="bloqueado" value="<?=$ativo == "" ? "S" : "N" ?>" class="check-toogle" >Ativo</label>
			</div>
		</div>
	<!-- /.box-body -->
	<div class="box-footer text-right">
		<button type="submit" class="btn btn-primary">Salvar</button>
	</div>
	</form>
</div>