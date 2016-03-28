;(function(window, $){
	'use strict'

	var Galeria = function(){
		var ga =this;
		$(function(){
			ga.__init();
		})
	}

	var galeria = Galeria.prototype;

		galeria.__init = function(){
			this.__upload();
			this.__select2();
			this.__handllerRemoveImagem();
			this.loadImagem($("#selectMenu").val());
		}

		galeria.__upload = function(){
			var ga = this,
				upload = $("#fileuploaderTopo").uploadFile({
							url:"uploads/galeria",
							fileName:"uploadFile",
							multiple:true,
							formData: {"name":"Ravi","age":31},
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
							"dragdropWidth":"100%",

							extraHTML:function()
							{
								var html = "<div class='box-upload'><br/>"+
												"<b>Local</b>:"+
												"<select class='form-control' id='local'>"+
													"<option value='t'>Topo</option>"+
													"<option value='g'>Galeria</option>"+
												"</select>"+
												"<button class='btn btn-success btn-enviar-upload'>Enviar</button>"+
											"</div>";
								return html;
							},
							autoSubmit:false,
							onSuccess: function(files,data,xhr,pd){
								ga.registraImagem( data[2],"galeria", $("#selectMenu").val(), $("#local").val() );
								$(".ajax-file-upload-statusbar").remove();
							}
						});

			$(".box-body").on('click',".btn-enviar-upload",function(){
				upload.startUpload();
			})
		}

		galeria.__select2 = function(){
			// $.fn.select2.defaults.set("theme", "classic");
			var ga = this;
			$("#selectMenu").select2({
				placeholder:"Selecione o Menu",
			})
			$("#selectMenu").change(function(){
				ga.loadImagem($(this).val());
			});
		}

		galeria.registraImagem = function( nome, dir, idMenu, local){
			var ga = this;

			$.post('site/menu/imagem',{"oper":"add",imagem:nome,"dir":dir, "idMenu": idMenu, "local": local},function(){
				ga.loadImagem(idMenu, local);
			});
		}

		galeria.loadImagem = function(idMenu, local ){
			var ga = this;
			local = local || 't'
			$.post('site/menu/imagem',{"oper":"todas", "idMenu": idMenu, "local": local},function(data){
				if( data ){
					var html = "<ul class='lista-imagens'>";
					$.each(data,function(i,v){
						html += "<li>"+
										"<span class='ordem'>" + (i+1) +  "</span>"+
										"<img src='../upload/" + v.dir + "/" + v.imagem + "'  class='img-thumbnail thumb-galeria ' alt='" + v.imagem + "' />"+
										"<div class=\"box-foot\">"+
											"<input class='check-imagem' type=\"checkbox\" value=\""+ v.id +"\" />Selecionar"+
										"</div>"+
								"</li>";
					});
					html += "<ul><div class='clearfix'></div>";

					$("#imagensTopo").html( html );
				}
			},'json');
		}

		galeria.__handllerRemoveImagem = function( ){
			$("#btnRemoverImagem").click(function(){

			});

			$("#imagensTopo")
				.on("click",".check-imagem",function(){
					console.log( $(".check-imagem:checked") );
					if($(".check-imagem:checked").length > 0)
						$("#btnRemoverImagem").prop("disabled",false);
					else
						$("#btnRemoverImagem").prop("disabled",true);

				});
		}

	window.galeria = new Galeria();
})(window,jQuery);