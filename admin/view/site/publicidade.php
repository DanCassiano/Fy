<div class="box">
	<div class="box-header with-border">
		<h3 class="box-title">Publicidades</h3>
		<div class="pull-right">

			<select id="selectPublicidade" name="selectPublicidade" class="form-control" >
				<?php foreach( $perfis as $perfil  ): ?>
					<option value="<?=$perfil['id']?>"><?=$perfil['perfil']?></option>
				<?php endforeach; ?>
			</select>
		</div>
		<div class="pull-right" style="margin-right:5px">
			<a href="<?=$baseURL?>admin/site/publicidade/edit" class="btn btn-success">Nova</a>
		</div>
	</div>
	<!-- /.box-header -->
	<div class="box-body">
		<table class="table table-bordered">
			<tbody>
				<tr>
					<th style="width: 10px"> <input type="checkbox"> </th>
					<th>Nome</th>
					<th>Data inicio</th>
					<th>Data fim</th>
					<th style="width: 190px"></th>
				</tr>
				<?php 
					if( !empty( $publicidades )) {
				 		
				 		foreach( $publicidades as $publ ) {
				 		?>
							<tr>
								<td> <input type="checkbox"> </td>
								<td><?=$publ['publicidade']?></td>
								<td><?=$publ['publicidade']?></td>
								<td><?=$publ['publicidade']?></td>
								<td>
									<a href="<?=$baseURL?>admin/site/publicidade/edit?id=<?=$publ['id']?>" class="btn btn-link btn-xs">Editar</a>
									<a href="<?=$baseURL?>admin/site/publicidade/edit?id=<?=$publ['id']?>" class="btn btn-link btn-xs">Remover</a>
									<a href="<?=$baseURL?>admin/site/publicidade/edit?id=<?=$publ['id']?>" class="btn btn-link btn-xs">Bloquear</a>
								</td>
							</tr>
						<?php 
						} 
					}?>
			</tbody>
		</table>
	</div>
	<!-- /.box-body -->
	<div class="box-footer clearfix">
          <!--     <ul class="pagination pagination-sm no-margin pull-right">
                <li><a href="#">«</a></li>
                <li><a href="#">1</a></li>
                <li><a href="#">2</a></li>
                <li><a href="#">3</a></li>
                <li><a href="#">»</a></li>
              </ul> -->
	</div>
</div>