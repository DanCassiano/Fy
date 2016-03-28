<div class="row">
	<div class="col-xs-12">
		<div class="box box-solid">
			<div class="box-header">
				<h3 class="box-title">Fale conosco</h3>
				<div class="pull-right">
					<form action="<?=$baseURL?>usuario/users" id="formStatus">
						<select class="form-control" style="width:200px" name="status" id="selectStatus">
							<option value="1" <?=$status == 1 ? "selected=selected": "" ?> >Não lidos</option>
							<option value="0" <?=$status == 0 ? "selected=selected": "" ?>>Lidos</option>
						</select>
					</form>
				</div>
			</div>
			<!-- /.box-header -->
			<div class="box-body table-responsive">
			
				<table class="table table-hover table-condensed" style="width: 100%;">
					<tbody>
						<tr>
							<th>Remetente</th>
							<th>Asunto</th>
							<th>Data</th>
						</tr>
						<?php foreach ($faleconosco as $i => $fa ): ?>
							<tr>
								<td><?=$fa['email']?></td>
								<td>
									<a href="<?=$baseURL?>site/departamentos/edit?id=<?=$fa['id']?>" class="btn btn-link btn-xs">View</a>
									<a href="#edit" id='<?=$fa['id']?>' class="btn btn-link btn-xs"  >Marcar como lida</a>
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