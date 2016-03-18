
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
	

})(window,jQuery);