<?php 
	
 ?>
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
					<a href="<?=$baseURL?>site/menu/edit" class="btn btn-success">Novo</a>
				</div>
				<div class="pull-right" style="margin-right:5px;">
					<button class="btn btn-default btn-up" disabled title="Subir menu" > <i class="glyphicon glyphicon-arrow-up"></i> </button>
					<button class="btn btn-default btn-down" disabled title="Descer menu"> <i class="glyphicon glyphicon-arrow-down"></i> </button>
				</div>
			</div>
			<!-- /.box-header -->
			<div class="box-body table-responsive">
			
				<table class="table table-hover table-bordered">
					<tbody>
						<tr>
							<th style="width:20px; "><input type="checkbox" class="toggle-check" ></th>
							<th style="width:20px;">#</th>
							<th>Menu</th>
							<th style="width:150px;">Data</th>
							<th style="width:80px; ">Status</th>
							<th style="width:200px; "></th>
						</tr>
						<?php foreach ($paginas->listaMenus( $status, 0 ) as $i => $pagina ): ?>
							<tr>
								<td><input type="checkbox" class='check-menu' data-ordem="<?=$pagina['ordem']?>" data-id="<?=$pagina['id']?>"></td>
								<td>
									<?php if( $pagina['qtd_filho'] > 0 ){ ?>
										<span class="glyphicon glyphicon-option-vertical"></span>
									<?php } ?>
								</td>
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
									<a href="#remover" id='<?=$pagina['id']?>' data-menu="<?=$pagina['pagina']?>" data-toggle="modal" data-target="#modalMenu" data-whatever="Remover menu " class="btn btn-link btn-xs"  >Remover</a>
									<?php if( $status == 1){ ?>
										<a href="#despublicar" id='<?=$pagina['id']?>' data-menu="<?=$pagina['pagina']?>" data-toggle="modal" data-target="#modalMenu" data-whatever="Despublicar menu " class="btn btn-danger btn-xs"  >Despublicar</a>
									<?php }else{ ?>
										<a href="#publicar" id='<?=$pagina['id']?>' data-menu="<?=$pagina['pagina']?>" data-toggle="modal" data-target="#modalMenu" data-whatever="Publicar menu " class="btn btn-success btn-xs"  >Publicar</a>									
									<?php } ?>
								</td>
							</tr>
								
							<?php if( $pagina['qtd_filho'] > 0){ 

									foreach( $paginas->listaMenus( $status, $pagina['id'] ) as $pgFilho ){ ?>
										<tr>
											<td><input type="checkbox" class='check-menu' data-ordem="<?=$pgFilho['ordem']?>" data-id="<?=$pgFilho['id']?>"></td>
											<td colspan="2">
												<span class="glyphicon glyphicon-option-vertical"></span><span class="glyphicon glyphicon-option-horizontal"></span>&nbsp;&nbsp;<?=$pgFilho['pagina']?>
											</td>
											<td><?=$pgFilho['data_criacao']?></td>
											<td>
												<?php if( $pgFilho['publicado'] == 0 ){ ?>
													<span class="label label-warning">Não publicado</span>
												<?php }elseif ( $pgFilho['publicado'] == 1 ) {?>
													<span class="label label-success">publicado</span>
												<?php } ?>
											</td>
											<td>
												<a href="<?=$baseURL?>site/menu/edit?id=<?=$pgFilho['id']?>" class="btn btn-link btn-xs">Editar</a>
												<a href="#remover" id='<?=$pgFilho['id']?>' data-menu="<?=$pgFilho['pagina']?>" data-toggle="modal" data-target="#modalMenu" data-whatever="Remover menu " class="btn btn-link btn-xs"  >Remover</a>
												<?php if( $status == 1){ ?>
													<a href="#despublicar" id='<?=$pgFilho['id']?>' data-menu="<?=$pgFilho['pagina']?>" data-toggle="modal" data-target="#modalMenu" data-whatever="Despublicar menu " class="btn btn-danger btn-xs"  >Despublicar</a>
												<?php }else{ ?>
													<a href="#publicar" id='<?=$pgFilho['id']?>' data-menu="<?=$pgFilho['pagina']?>" data-toggle="modal" data-target="#modalMenu" data-whatever="Publicar menu " class="btn btn-success btn-xs"  >Publicar</a>									
												<?php } ?>
											</td>
										</tr>
									<?php } 
								}
							endforeach ?>
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

<div class="modal fade" tabindex="-1" role="dialog" id="modalMenu">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Contato</h4>
			</div>
			<div class="modal-body">
				<p id="msg"></p>
				<input type="hidden" id="idMenuRemover">
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-link" data-dismiss="modal">Cancelar</button>
				<button type="button" class="btn btn-primary btn-bloquear-menu" >Despublicar</button>
				<button type="button" class="btn btn-primary btn-desbloquear-menu" >Publicar</button>
				<button type="button" class="btn btn-primary btn-op-remover" >Remover</button>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->