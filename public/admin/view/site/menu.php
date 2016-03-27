<div class="row">
	<div class="col-xs-12">
		<div class="box box-solid">
			<div class="box-header">
				<h3 class="box-title">Menus</h3>
				<div class="pull-right">
					<form action="site/menu" id="formStatus">
						<select class="form-control" style="width:200px" name="status" id="selectStatus">
							<option value="1" <?=$status == 1 ? "selected=selected": "" ?> >Publicados</option>
							<option value="0" <?=$status == 0 ? "selected=selected": "" ?>>Não publicados</option>
						</select>
					</form>
				</div>
				<div class="pull-right" style="margin-right:5px;">
					<a href="<?=$baseURL?>site/menu/novo" class="btn btn-success">Novo</a>
				</div>
			</div>
			<!-- /.box-header -->
			<div class="box-body table-responsive">
			
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
								<td><?=$pagina['data_criacao']?></td>
								<td>
									<?php if( $pagina['publicado'] == 0 ){ ?>
										<span class="label label-warning">Não publicado</span>
									<?php }elseif ( $pagina['publicado'] == 1 ) {?>
										<span class="label label-success">publicado</span>
									<?php } ?>
								</td>
								<td>
									<a href="<?=$baseURL?>site/menu/edit?id=<?=$pagina['id']?>" class="btn btn-link btn-xs">Editar</a>
									<a href="#edit" id='<?=$pagina['id']?>' class="btn btn-link btn-xs"  >Remover</a>
								</td>
							</tr>
						<?php endforeach ?>
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
		<!-- /.box -->
	</div>
</div>