<?php 
	$acao = 'novo';

	

	$email = "";
	$nome = "";
	$senha = "";
	if( !empty( $id )){
		$acao = "edit";
		$nome = $usuario[0]['nome'];
		$email = $usuario[0]['email'];
		$imagem =$usuario[0]['imagem'];
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
	<form role="form" action="<?=$baseURL?>/usuario/users/<?=$acao?>" method="post"> 
		<input type="hidden" name="id" value="<?=$id?>"></input>
		<div class="box-body">
			<div class="form-group ">
				<img src="../upload/usuario/<?=$imagem?>" class="thumbnail pull-left" width="128"  height="128" >
				<div class="clearfix"></div>
				<div id="fileuploaderUser" ></div>
			</div>
			<div class="form-group">
				<label for="inputNomeMenu">Nome</label>
				<input type="text" class="form-control" required id="inputNomeMenu" name="nome"  placeholder="ex: Joao da Silva" value="<?=$nome?>" >
			</div>
			<div class="form-group">
				<label for="inputLogin">E-mail</label>
				<input type="text" name="email" class="form-control" id="inputLogin" placeholder="ex: joao" required value="<?=$email?>" >
			</div>
			<div class="form-group">
				<label for="inputSenha">Senha</label>
				<input type="password" name="senha" class="form-control" id="inputSenha" required value="<?=$senha?>" required >
			</div>
			<div class="form-group">
				<label for="inputConfirmaSenha">Confirmar senha</label>
				<input type="password" name="confirmar" class="form-control" id="inputConfirmaSenha" required required>
			</div>
			
			<div class="checkbox">
				<label>
					<input type="checkbox" checked name='ativo'> Ativo
				</label>
			</div>
		</div>
		<!-- /.box-body -->
		<div class="box-footer">
			<a href="<?=$baseURL?>/usuario/users" class="btn btn-default">Cancelar</a>
			<button type="submit" class="btn btn-success pull-right">Salvar</button>
		</div>
		<!-- /.box-footer -->
	</form>
</div>