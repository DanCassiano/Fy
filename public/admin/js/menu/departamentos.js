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
		}

		dep.initTable = function(){
			$('#tableDepartamento').DataTable({
				
			});
		}
	window.departamentos = new Departamentos();
})(window,jQuery);