!(function(){
	"use strict";
	var Departamentos = function(){
		var dep = this;
		$(function(){
			dep._init();
		});
	}

	var dep = Departamentos.prototype;
		dep._init = function(){
			this.initTable();
			this.changeStatus();
			this.checkBox();
		}

		dep.changeStatus = function(){
			$("#selectStatus").change(function(){
				$("#formStatus").submit();
			})
		}
		dep.initTable = function(){
			// $('#tableDepartamento').DataTable();
		}

		dep.checkBox = function(){
			$("input[type='checkbox']").click(function(){
				if( $(this).val() == 'S' )
					$(this).val('N')
				else
					$(this).val('S');
			})
		}
	window.departamentos = new Departamentos();
})(window,jQuery);