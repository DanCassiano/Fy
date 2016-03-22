<div class="row">
	<div class="col-xs-12">
		<div class="box box-solid">
			<div class="box-header">
				<h3 class="box-title">Usuarios</h3>
				<div class="pull-right">
					<form action="<?=$baseURL?>usuario/users" id="formStatus">
						<select class="form-control" style="width:200px" name="status" id="selectStatus">
							<option value="1" <?=$status == 1 ? "selected=selected": "" ?> >Ativos</option>
							<option value="0" <?=$status == 0 ? "selected=selected": "" ?>>Inativos</option>
						</select>
					</form>
				</div>
				<div class="pull-right" style="margin-right:5px;">
					<a href="<?=$baseURL?>/usuario/users/novo" class="btn btn-success">Novo</a>
				</div>
			</div>
			<!-- /.box-header -->
			<div class="box-body table-responsive">
			
				<table class="table table-hover table-condensed">
					<tbody>
						<tr>
							<th>Nome</th>
							<th>Email</th>
							<th></th>
						</tr>
						<?php foreach ($usuarios as $i => $user ): ?>
							<tr>
								<td><?=$user['nome']?></td>
								<td><?=$user['email']?></td>
								<td>
									<a href="<?=$baseURL?>usuario/users/edit?id=<?=$user['id']?>" class="btn btn-link btn-xs">Editar</a>
									<a href="#edit" id='<?=$user['id']?>' class="btn btn-link btn-xs"  >Remover</a>
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