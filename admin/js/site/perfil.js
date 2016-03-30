$(function(){
	$("#selectStatus").change(function(){
		$("#formStatus").submit();
	});


	// $("#formPerfil").submit(function(e){

		// if( $().val())
	// });

	$(".check-toogle").click(function(){
		if( $(this).prop("checked") == true )
			$(this).val('N')
		else
			$(this).val('S');
	})
})