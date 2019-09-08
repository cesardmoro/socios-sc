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

});

})(jQuery)