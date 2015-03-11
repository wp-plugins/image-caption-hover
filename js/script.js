jQuery(document).ready(function($) {
	
	setTimeout(function() {
		$('.wcp-caption-image').each(function() {
			var current_width = $(this).width();
			var current_height = $(this).height();
			var current_wraper = '#' + $(this).closest('.wcp-caption-plugin').attr('id');
			$(current_wraper).find('.image-caption-box, .caption').css({
				'width': current_width,
				'height': current_height
			});
		});	
	}, 500);


	$('.image-flip-up, .image-flip-down, .rotate-image-down, .tilt-image, .image-flip-right, .image-flip-left').closest('.image-caption-box').css('overflow', 'visible');
});
