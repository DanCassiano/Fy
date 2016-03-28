
<div class="box box-primary">
	<div class="box-header with-border">
		Imagens 
		<div class="box-tools" >
			<button class="btn btn-danger" id="btnRemoverImagem" disabled>Remover</button>
	
			<select class="form-control select2"  id="selectMenu" >
				<?php foreach ($paginas as $i => $pagina ): ?>
					<option value="<?=$pagina['id']?>"><?=$pagina['pagina']?></option>
				<?php endforeach ?>
			</select>
		</div>
	</div>
	<div class="box-body" style="min-height:220px">
		<div id="imagensTopo" class="upload text-center" >
			<h1>Sem imagens</h1>
		</div>
		<div id="fileuploaderTopo">Upload</div>
	</div>
	<div class="box-foot">
		
	</div>
</div>