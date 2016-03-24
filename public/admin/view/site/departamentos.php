<div class="row">
	<div class="col-xs-12">
		<div class="box box-solid">
			<div class="box-header">
				<h3 class="box-title">Departamentos</h3>
				<div class="pull-right">
					<form action="<?=$baseURL?>site/departamentos" id="formStatus">
						<select class="form-control" style="width:200px" name="status" id="selectStatus">
							<option value="1" <?=$status == 1 ? "selected=selected": "" ?> >Ativos</option>
							<option value="0" <?=$status == 0 ? "selected=selected": "" ?>>Inativos</option>
						</select>
					</form>
				</div>
				<div class="pull-right" style="margin-right:5px;">
					<a href="<?=$baseURL?>site/departamentos/novo" class="btn btn-success">Novo</a>
				</div>
			</div>
			<!-- /.box-header -->
			<div class="box-body table-responsive">
			
				<table class="table table-hover table-condensed" id="tableDepartamento" style="width: 100%;">
					<tbody>
						<tr>
							<th>Departamento</th>
							<th style="width:20%;max-width:200px">Ações</th>
						</tr>
						<?php foreach ($departamentos as $i => $dep ): ?>
							<tr>
								<td><?=$dep['departamento']?></td>
								<td>
									<a href="<?=$baseURL?>site/departamentos/edit?id=<?=$dep['id']?>" class="btn btn-link btn-xs">Editar</a>
									<a href="#edit" id='<?=$dep['id']?>' class="btn btn-link btn-xs"  >Remover</a>
									<a href="#edit" id='<?=$dep['id']?>' class="btn btn-link btn-xs"  >Contatos</a>
								</td>
							</tr>
						<?php endforeach ?>
					</tbody>
				</table>
			</div>
			<!-- /.box-body -->
			<div class="box-footer clearfix"></div>
		</div>
		<!-- /.box -->
	</div>
</div>