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
	<input type="hidden" name="id" value="<?=$id?>"></input>
	<input type="hidden" name="idConteudo" value="<?=$idConteudo?>"></input>
	<div class="nav-tabs-custom">
		<ul class="nav nav-tabs">
			<li class="active"><a href="#tabmenu" data-toggle="tab"> <i class="fa fa-clone"></i> Menu</a></li>
			<li><a href="#tabtopo" data-toggle="tab"><i class="fa fa-file-image-o"></i> Imagens topo</a></li>
			<li><a href="#tabfoto" data-toggle="tab"><i class="fa fa-image"></i> Imagens conteudo</a></li>
			
		</ul>
		<div class="tab-content">
			<div class="tab-pane active" id="tabmenu">
				<div class="row">
					<div class="col-xs-6">
						<div class="form-group">
							<label for="inputNomeMenu">Menu</label>
							<input type="text" class="form-control" id="inputNomeMenu" name="nome"  placeholder="ex: Home" value="<?=$nome?>" >
						</div>
					</div>
					<div class="col-xs-6">
						<div class="form-group">
							<label for="exampleInputPassword1">Link</label>
							<input type="text" name="link" class="form-control" id="exampleInputPassword1" placeholder="home" value="<?=$link?>" >
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-xs-4">
						<div class="form-group">
							<label for="exampleInputPassword1">Status</label>
							<select name="status" class="form-control">
								<option value="1" <?php  $status == 1 ? "selected='selected'" : "" ?> >Publicado</option>
								<option value="0" <?php  $status == 0 ? "selected='selected'" : "" ?>>Não Publicado</option>
							</select>
						</div>
					</div>
					<div class="col-xs-4">
						<div class="form-group">
							<label>Tipo de conteudo:</label>
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
					</div>
					<div class="col-xs-4">
						<div class="form-group" >
							<label for="exampleInputPassword1">Pertence: </label>
							<select name="id_pai" class="form-control">
								<option >--</option>
								<?php foreach( $menus as $m ){
									$selected = "";
									if( $pagina[0]['id'] == $m['id_pai'] )
										$selected = "selected='selected'";
								?>
								<option value="<?=$m['tipo']?>" <?=$selected?> ><?=$m['pagina']?></option>
								<?php } ?>
							</select>
						</div>
					</div>
				</div>
				<div class="textarea">
					<textarea id='txtConteudo' cols="10" rows="10" style="width:100%" name="conteudo"><?=$conteudo?></textarea>
				</div>
			</div>
		<div class="tab-pane" id="tabtopo">
			<div id="imagensTopo" class="upload text-center" >
			</div>
			<div id="fileuploaderTopo"> <button class="btn btn-primary btn-upload" >Upload</button> </div>
		</div>
		<!-- /.tab-pane -->
		<div class="tab-pane" id="tabfoto">
		</div>	
		</div>
		<div class="box-footer">
			<a href="<?=$baseURL?>/site/menu" class="btn btn-default">Cancelar</a>
			<button type="submit" class="btn btn-success pull-right">Salvar</button>
		</div>
	</div>
</form>