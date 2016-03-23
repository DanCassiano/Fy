;(function(window, $){
	var User = function(){
		var u = this;
		$(function(){
			u.__init();
		});
	}

	var user = User.prototype;

		user.__init = function(){

			var init = this;

			$("#selectStatus").change(function(){
				$("#formStatus").submit();
			});

			$('input').iCheck({
				checkboxClass: 'icheckbox_square',
				radioClass: 'iradio_square',
				increaseArea: '20%' // optional
			});

			$("#fileuploaderUser").uploadFile({
				url:"uploads/usuario",
				fileName:"uploadFile",
				multiple:false,
				maxFileCount:1,
				dragDrop:false,
				dynamicFormData: function()
				{
					var data ={ id: $("input[name='id']").val() }
					return data;
				},
				dragDropStr: "<span><b>Drag Drop</b></span>",
				abortStr:"Abortar upload",
				cancelStr:"Cancelar",
				doneStr:"Enviado",
				multiDragErrorStr: "Arraste e solte os arquivos para realizar um upload",
				extErrorStr:"Erro, extensão não aceita",
				sizeErrorStr:"Tamanho superior ao suportado",
				uploadErrorStr:"Upload não aceito.",
				uploadStr:"Upload",
				"returnType":'json',
				"allowedTypes":"jpg,png,gif",
				onSuccess: function(files,data,xhr,pd){
					
					init.setImagem( $("input[name='id']").val(), data[2] );
					$(".ajax-file-upload-statusbar").remove();
				}
			});
		}

		user.setImagem = function(id, imagem ){
			$.post('usuario/users/imagem',{ id: id, imagem:imagem },function(dados){
				if( dados )
					location.reload();
			})
		}

	window.user = new User();
})(window, jQuery);