(function($){
$(document).ready(function(){
	$('.side-nav').addClass('collapsed');
	
	$('.button-collapse').sideNav({

		onOpen: function(el) {$('.side-nav').removeClass('collapsed');
			$('.material-tooltip').addClass('hidden'); 
		}, 
		 onClose: function(el) {$('.side-nav').addClass('collapsed');
			$('.material-tooltip').removeClass('hidden');   
		}
	}); 

	//confirmación de sincronziacón de concursos
	$('.syncconfirm').click(function(e){
		if(confirm('Esta seguro que desea syncronizar el concurso, borrara los datos cargados anteriormente')){

		}else{
			e.preventDefault();
		}
	});
	//confirmar entry por ajax
	$('.btn-confirm-entry').click(function(e){
		e.preventDefault();
		let a = $(e.currentTarget);
		let url = a.attr('href');
		$.get( url, function( data ) {
			a.parent().parent().find('td:nth-child(6)').text("Confirmada").addClass('confirmed');
			$.noty.closeAll();
			noty({
				text: "Muestra confirmada",
				type: 'success',
				layout: 'top',
				dismissQueue: true
			  });
			  
		  });
	}); 


});

})(jQuery)
