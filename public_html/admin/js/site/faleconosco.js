$(function(){
	$("#selectStatus").change(function(){
		$("#formStatus").submit();
	});

	$(".btn-lida").click(function(e){
		e.preventDefault();
		$.post("site/faleconosco/lida",{ id: $(this).prop('id') },function(dados){ 
			if( dados.status == 1)
				location.reload();
		},'json')
	});

	$(".btn-nao-lida").click(function(e){
		e.preventDefault();
		$.post("site/faleconosco/naolida",{ id: $(this).prop('id') },function(dados){ 
			if( dados.status == 1)
				location.reload();
		},'json')
	});

});

