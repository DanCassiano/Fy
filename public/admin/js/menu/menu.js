
;(function(window,$){

	$("#selectStatus").change(function(){
		console.log(this)
		$("#formStatus").submit();
	});	

	$("body").on("click","a[href='#edit']",function(e){
		e.preventDefault();
		var f = confirm("Excluir menu");
		alert(f)
	})

	
	$('#txtConteudo').wysihtml5();


	$('#modalMenu').on('show.bs.modal', function (event) {
		var button = $(event.relatedTarget) // Button that triggered the modal
		var recipient = button.data('whatever') // Extract info from data-* attributes
	
		
		var modal = $(this);
			modal.find('.modal-title').text(recipient + " ?");
			$('#msg').html( recipient + "<strong>" + button.data("menu") + "</strong> ?" );
			$('#idMenuRemover').val( button.prop("id") );

			if( button.attr("href") == "#despublicar" ){
				$(".btn-bloquear-menu").show();
				$(".btn-desbloquear-menu").hide();
				$(".btn-op-remover").hide();
			}
			else{
				if( button.attr("href") == "#remover" ){
					$(".btn-bloquear-menu").hide();
					$(".btn-desbloquear-menu").hide();
					$(".btn-op-remover").show();
				}
				else{
					$(".btn-desbloquear-menu").show();
					$(".btn-bloquear-menu").hide();
					$(".btn-op-remover").hide();
				}
			}
			
	});


	$(".btn-desbloquear-menu").click(function(){
		$.post("site/menu/desbloquear", { idMenu: $('#idMenuRemover').val() },function(dados){
			if( dados.status == 1)
				location.reload();
		},'json')
	});

	$(".btn-bloquear-menu").click(function(){
		$.post("site/menu/bloquear", { idMenu: $('#idMenuRemover').val() },function(dados){
			if( dados.status == 1)
				location.reload();
		},'json')
	});
	$(".btn-op-remover").click(function(){
		$.post("site/menu/remover", { idMenu: $('#idMenuRemover').val() },function(dados){
			if( dados.status == 1)
				location.reload();
		},'json')
	});

	$(".btn-op-menu").click(function(){
		// $.post("",{ })
		// $('#idMenuRemover').val( button.prop("id") );
	});

	var btnUp  = $(".btn-up"),
		btnDown = $(".btn-down");
	$(".check-menu").click(function(){
		var ordem = $(this).data("ordem"),
			idMenu = $(this).data("id"),
			qtdMenus = $(".check-menu").length,
			qtdAtivos = $(".check-menu:checked").length;
			
			
			if( qtdAtivos == 1){
				// primeiro
				if( ordem == 1 ){
					btnUp.prop('disabled',true);
					btnDown.prop("disabled",false);
				}else{
					// ultimo
					if( ordem == qtdMenus){
						btnUp.prop('disabled',false);
						btnDown.prop("disabled",true);
					}
					else{
						btnUp.prop('disabled',false);
						btnDown.prop("disabled",false);	
					}
				}
			}
			else{
				btnUp.prop('disabled',true);
				btnDown.prop("disabled",true);	
			}
	});


	$(".toggle-check").click(function(){
		$(".check-menu").prop("checked",  $(this).prop("checked") );
	});

	$("body").on('click', '.btn-down' ,function(){
		$.post("site/menu/descer",{ idMenu: $(".check-menu:checked").data('id') }, function(dados){ 
			if( dados.status == 1)
				location.reload();
		})
	});
	
	$("body").on('click','.btn-up',function(){
		$.post("site/menu/subir",{ idMenu: $(".check-menu:checked").data('id') }, function(dados){ 
			if( dados.status == 1)
				location.reload();
		})
	});

})(window,jQuery);