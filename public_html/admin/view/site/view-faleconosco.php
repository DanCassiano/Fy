<div class="box box-primary">
	<div class="box-header with-border">
		<h3 class="box-title">Visualizar</h3>
			<div class="pull-right">
				<button type="button" class="btn btn-default btn-sm" data-toggle="tooltip" title="Imprimir">
					<i class="fa fa-print"></i>
				</button>
			</div>			
	</div>
	<!-- /.box-header -->
	<div class="box-body no-padding">
		<div class="mailbox-read-info">
			<h3><?php echo $contato['asunto'] ?></h3>
			<h5>de: <?php echo $contato['email'] ?>
				<span class="mailbox-read-time pull-right"><?php echo $contato['data_criacao'] ?></span></h5>
		</div>
		<div class="mailbox-read-message"><?php echo $contato['msg'] ?></div>
		<!-- /.mailbox-read-message -->
	</div>
	<!-- /.box-body -->
	<div class="box-footer"></div>
	<!-- /.box-footer -->
</div>