jQuery(function( $ ) {
	'use strict';
	$('.restcolor').on('click', function (e) {
		e.preventDefault();
		let data = $(this).attr('data-id');

       	$.ajax({
           type: "post",
           url: admin_ajax_action.ajaxurl,
           data: {
			   action: 'c_reset_colors',
			   data: data
           },
           success: function (response) {
               location.reload();
           }
       	}); 
    });
});