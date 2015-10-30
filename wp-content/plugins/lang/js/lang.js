jQuery(document).ready(function($) {
	$('.menu-item-object-language').click(function(e){
			console.log($(this));
			e.preventDefault();

			$.post(
				myAjax.ajaxurl,
				{
						'action': 'set_language',
						'data':   $(this).attr('id')
				},
				function(response){
						console.log('The server responded: ' + response);
				}
			);

	});
});
