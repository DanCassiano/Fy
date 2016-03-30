<div class="box">
	<div class="box-header with-border">
		<h3 class="box-title">Contatos do departamento <strong><?=$departamento?></strong></h3>
		<div class="pull-right" style="margin-right:5px;">
					<a href="#<?=$idDep?>" class="btn btn-success" data-toggle="modal" data-target="#modalNovoContato" data-whatever="Adicionar novo Contato.">Add</a>
				</div>
	</div>
	<!-- /.box-header -->
	<div class="box-body">
		<table class="table table-bordered">
			<tbody>
				<tr>
					<!-- <th style="width: 10px">#</th> -->
					<th>Contatos</th>
					<th>Nome</th>
					<th style="width: 180px"></th>
				</tr>
				<?php foreach ($contatos as $key => $cont): ?>
					<tr>
						<td><?=$cont['nome']?></td>
						<td><?=$cont['contato']?></td>
						<td>
							<a href="#remover" class="btn btn-link" data-toggle="modal" data-target="#modalNovoContato" data-whatever="Editar contato." data-dados="<?php echo htmlentities( json_encode( $cont) ) ?>" >Editar</a>
							<a href="#remover" class="btn btn-link">Remover</a>
						</td>
					</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
	</div>
	<!-- /.box-body -->
	<div class="box-footer clearfix">
	<!-- 		<ul class="pagination pagination-sm no-margin pull-right">
				<li><a href="#">«</a></li>
				<li><a href="#">1</a></li>
				<li><a href="#">2</a></li>
				<li><a href="#">3</a></li>
				<li><a href="#">»</a></li>
			</ul> -->
		</div>
	</div>


<div class="modal fade" tabindex="-1" role="dialog" id="modalNovoContato">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Contato</h4>
			</div>
			<div class="modal-body">
				<form id="formContato" >
					<input type="hidden" class="form-control" id="recipient-id" name="id">
					<input type="hidden" class="form-control" id="recipient-idDep" name="idDep" value="<?php echo $idDep ?>">
					<div class="form-group">
						<label for="recipient-name" class="control-label">Nome:</label>
						<input type="text" class="form-control" id="recipient-nome" name="nome" required="required" pattern="/[a-zA-Z]/" >
					</div>
					<div class="form-group">
						<label for="message-text" class="control-label">Email</label>
						<input type="email" class="form-control" id="recipient-email" name="email" required="required">
					</div>
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-link" data-dismiss="modal">Cancelar</button>
				<button type="button" class="btn btn-primary btn-save-contato"  >Salvar</button>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->