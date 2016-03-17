<div class="row">
	<div class="col-xs-12">
		<div class="box box-solid">
			<div class="box-header">
				<h3 class="box-title">Menus</h3>
				<div class="box-tools">
					<select>
						<option>Publicados</option>
						<option>Não publicados</option>
					</select>
					<a href="<?=$baseURL?>/site/menu/novo" class="btn btn-success">Novo</a>
				</div>
			</div>
			<!-- /.box-header -->
			<div class="box-body table-responsive">
			<?php $paginas = $db->fetchAll('SELECT * FROM paginas'); ?>
				<table class="table table-hover table-condensed">
					<tbody>
						<tr>
							<th>Menu</th>
							<th>Data</th>
							<th>Status</th>
							<th></th>
						</tr>
						<?php foreach ($paginas as $i => $pagina ): ?>
							<tr>
								<td><?=$pagina['pagina']?></td>
								<td><?=$pagina['data-criacao']?></td>
								<td>
									<?php if( $pagina['publicado'] == 0 ){ ?>
										<span class="label label-warning">Não publicado</span>
									<?php }elseif ( $pagina['publicado'] == 1 ) {?>
										<span class="label label-success">publicado</span>
									<?php } ?>
								</td>
								<td>
									<a href="<?=$baseURL?>/site/menu/edit?id=<?=$pagina['id']?>" class="btn btn-link btn-xs">Editar</a>
									<a href="<?=$baseURL?>/site/menu/del?id=<?=$pagina['id']?>" class="btn btn-link btn-xs">Remover</a>
								</td>
							</tr>
						<?php endforeach ?>
					</tbody>
				</table>
			</div>
			<!-- /.box-body -->
			<div class="box-footer clearfix">
              <ul class="pagination pagination-sm no-margin pull-right">
                <li><a href="#">«</a></li>
                <li><a href="#">1</a></li>
                <li><a href="#">2</a></li>
                <li><a href="#">3</a></li>
                <li><a href="#">»</a></li>
              </ul>
            </div>
		</div>
		<!-- /.box -->
	</div>
</div>