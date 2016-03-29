<?php 
	
	
	$nome = "";
	$link = "";
	$status = 1;
	$acao = "novo";
	$conteudo = "";
	$idConteudo = "";
	if( !empty( $id )){
		$pagina = $db->fetchAll('SELECT 
									paginas.id, 
									pagina, 
									link, 
									publicado, 
									conteudo.conteudo, 
									conteudo.id as id_conteudo,
									id_pai,
									tipo
								FROM paginas 
								LEFT JOIN conteudo ON conteudo.id_pagina = paginas.id 
								WHERE paginas.id = '. $id);

		$id = $pagina[0]['id'];
		$nome = $pagina[0]['pagina'];
		$link = $pagina[0]['link'];
		$status = $pagina[0]['publicado'];
		$conteudo = $pagina[0]['conteudo'];
		$idConteudo = $pagina[0]['id_conteudo'];
		$acao = "edit";
	}

	$menus = $db->fetchAll('SELECT paginas.id, pagina, id_pai FROM paginas ');
	$tipos = $db->fetchAll('SELECT * FROM tipo_paginas ');
?>
<form role="form" action="<?=$baseURL?>site/menu/<?=$acao?>" method="post"> 

	<div class="box box-primary">
		<div class="box-header with-border">
			<?php if( !empty( $id )){ ?>
				<h3 class="box-title">Editar</h3>
			<?php }else { ?>
				<h3 class="box-title">Adicionar</h3>
			<?php } ?>

			<div class="pull-right" >
				<select name="id_pai" class="form-control">
					<option >--</option>
					<?php foreach( $menus as $m ){ 

						$selected = "";
						if( $pagina[0]['id'] == $m['id_pai'] )
							$selected = "selected='selected'";
					?>
					<option value="<?=$m['id']?>" <?=$selected?> ><?=$m['pagina']?></option>
					<?php } ?>
				</select>
			</div>
			<div class="pull-right" style="margin-top:5px; margin-right:5px;">
				<label for="exampleInputPassword1">Pertence: </label>
			</div>
			<div class="pull-right" style="margin-right: 5px;" required>
				<select name="tipo" class="form-control">
					<option ></option>
					<?php foreach( $tipos as $t ){ 

						$selected = "";
						if( $pagina[0]['tipo'] == $t['tipo'] )
							$selected = "selected='selected'";
					?>
					<option value="<?=$t['id']?>" <?=$selected?> ><?=$t['nome']?></option>
					<?php } ?>
				</select>
			</div>
			<div class="pull-right" style="margin-top:5px; margin-right:5px;">
				<label>Tipo de conteudo:</label>
			</div>
		</div>
		<!-- /.box-header -->
		<!-- form start -->
		<input type="hidden" name="id" value="<?=$id?>"></input>
		<input type="hidden" name="idConteudo" value="<?=$idConteudo?>"></input>
		<div class="box-body">
			<div class="form-group">
				<label for="inputNomeMenu">Menu</label>
				<input type="text" class="form-control" id="inputNomeMenu" name="nome"  placeholder="ex: Home" value="<?=$nome?>" >
			</div>
			<div class="form-group">
				<label for="exampleInputPassword1">Link</label>
				<input type="text" name="link" class="form-control" id="exampleInputPassword1" placeholder="home" value="<?=$link?>" >
			</div>
			<div class="form-group">
				<label for="exampleInputPassword1">Status</label>
				<select name="status" class="form-control">
					<option value="1" <?php  $status == 1 ? "selected='selected'" : "" ?> >Publicado</option>
					<option value="0" <?php  $status == 0 ? "selected='selected'" : "" ?>>Não Publicado</option>
				</select>
			</div>
			<div class="textarea">
				<textarea id='txtConteudo' cols="10" rows="10" style="width:100%" name="conteudo"><?=$conteudo?></textarea>
			</div>
		</div>
		<!-- /.box-body -->
		<div class="box-footer">
			<a href="<?=$baseURL?>/site/menu" class="btn btn-default">Cancelar</a>
			<button type="submit" class="btn btn-success pull-right">Salvar</button>
		</div>
		<!-- /.box-footer -->
	</div>
</form>