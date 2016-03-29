<div class="row">
	<div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
		<?=$conteudo ?>
		<!-- Contact Form - Enter your email address on line 19 of the mail/contact_me.php file to make this form work. -->
		<!-- WARNING: Some web hosts do not allow emails to be sent through forms to common mail hosts like Gmail or Yahoo. It's recommended that you use a private domain email address! -->
		<!-- NOTE: To use the contact form, your site must be on a live web host with PHP! The form will not work locally! -->
		<form name="sentMessage" id="contactForm" novalidate>
			<div class="row control-group">
				<div class="form-group col-xs-12 floating-label-form-group controls">
					<label>Nome</label>
					<input type="text" class="form-control" placeholder="Nome" id="nome" name="nome" required data-validation-required-message="Entre com seu nome">
					<p class="help-block text-danger"></p>
				</div>
			</div>
			<div class="row control-group">
				<div class="form-group col-xs-12 floating-label-form-group controls">
					<label>Email</label>
					<input type="email" class="form-control" placeholder="E-mail" id="email" required data-validation-required-message="Entre com o seu e-mail.">
					<p class="help-block text-danger"></p>
				</div>
			</div>
			<div class="row control-group">
				<div class="form-group col-xs-12 floating-label-form-group controls">
					<label>Asunto</label>
					<input type="tel" class="form-control" placeholder="Asunto: contato" id="asunto" required data-validation-required-message="Entre com um asunto do contato!">
					<p class="help-block text-danger"></p>
				</div>
			</div>
			<div class="row control-group">
				<div class="form-group col-xs-12 floating-label-form-group controls">
					<label>Mensagem</label>
					<textarea rows="5" class="form-control" placeholder="Mensagem" id="message" required data-validation-required-message="Entre com sua mensagem"></textarea>
					<p class="help-block text-danger"></p>
				</div>
			</div>
			<br>
			<div id="success"></div>
			<div class="row">
				<div class="form-group col-xs-12">
					<button type="submit" class="btn btn-default">Send</button>
				</div>
			</div>
		</form>
	</div>
</div>

