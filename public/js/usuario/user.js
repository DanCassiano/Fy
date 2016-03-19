;(function(window, $){
	var User = function(){
		var u = this;
		$(function(){
			u.__init();
		});
	}

	var user = User.prototype;

		user.__init = function(){
			$("#selectStatus").change(function(){
				$("#formStatus").submit();
			});

			  $('input').iCheck({
				checkboxClass: 'icheckbox_square',
				radioClass: 'iradio_square',
				increaseArea: '20%' // optional
				});
		}

	window.user = new User();
})(window, jQuery);