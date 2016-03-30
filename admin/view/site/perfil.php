<div class="box">
	<div class="box-header with-border">
		<h3 class="box-title">Perfil</h3>
		<div class="pull-right">
			<a href="<?=$baseURL?>site/perfil/edit" class="btn btn-success">Novo</a>
		</div>
		<div class="pull-right" style="margin-right:5px;">
			<form  id="formStatus">
				<select class="form-control"  name="status" id="selectStatus" >
					<option value="1" <?=$status == 1 ? "selected=selected": "" ?> >Ativo</option>
					<option value="0" <?=$status == 0 ? "selected=selected": "" ?>>Inativo</option>
				</select>
			</form>
		</div>
	</div>
	<!-- /.box-header -->
	<div class="box-body">
		<table class="table table-bordered">
			<tbody>
				<tr>
					<th>Perfil</th>
					<th style="width: 100px"></th>
				</tr>
				<?php foreach( $perfis as $perfil ): ?>
					<tr>
						<td><?=$perfil['perfil']?></td>
						<td>
							<a href="<?=$baseURL?>site/perfil/edit?id=<?=$perfil['id']?>" class="btn btn-link btn-xs">Editar</a>
							<!-- <a href="#remover" id="<?=$perfil['id']?>" class="btn btn-link btn-xs">Remover</a> -->
						</td>
					</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
	</div>
	<!-- /.box-body -->
	<div class="box-footer clearfix"></div>
</div>