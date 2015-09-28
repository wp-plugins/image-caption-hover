function responsiveWidgets(){
	jQuery('.image-caption-box').css('width', '100%');
	jQuery('.wcp-caption-image').each(function() {
		var current_width = jQuery(this).width();
		var current_height = jQuery(this).height();
		var current_wraper = jQuery(this).closest('.wcp-caption-plugin');
		current_wraper.find('.image-caption-box, .caption').css({
			'width': current_width,
			'height': current_height
		});
	});
}

var resizeTimer;

jQuery(window).on('resize',function() {
    responsiveWidgets();
});

jQuery(window).load(function($) {
		jQuery(window).trigger('resize');

	jQuery('.image-flip-up, .image-flip-down, .rotate-image-down, .tilt-image, .image-flip-right, .image-flip-left').closest('.image-caption-box').css('overflow', 'visible');
});