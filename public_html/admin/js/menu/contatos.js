;(function(window, $){

	var Contatos = function(){
		var c = this;
		$(function(){
			c.__bindModal();
			c.__bindForm();
		})
	}

	var contato = Contatos.prototype;

		contato.__bindModal = function(){

		$('#modalNovoContato').on('show.bs.modal', function (event) {
			var button = $(event.relatedTarget) // Button that triggered the modal
			var recipient = button.data('whatever') // Extract info from data-* attributes
			// If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
			// Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
			
			var modal = $(this)
				modal.find('.modal-title').text(recipient)

				modal.find('.modal-body input[name="id"]').val("");
				modal.find('.modal-body input[name="nome"]').val("");
				modal.find('.modal-body input[name="email"]').val("");
				if( button.data('dados') ){
					dados = button.data('dados');

					modal.find('.modal-body input[name="id"]').val(dados.id);
					modal.find('.modal-body input[name="nome"]').val(dados.nome);
					modal.find('.modal-body input[name="email"]').val(dados.contato);
				}
			});
		}

		contato.__bindForm = function(){
			$("#modalNovoContato").on('click',".btn-save-contato",function(){
				$("#formContato").submit();
			})

			$("#formContato").submit(function(e){
				e.preventDefault();
				$.post("site/departamentos/contatos/salvar", $(this).serialize(),function(dados){
					if(dados.status == 1)
						location.reload();
				},'json');
			})
		}

	window.Contato = new Contatos();

})(window, jQuery)