function responsiveWidgets(){
	jQuery('.wcp-caption-image').each(function() {
		jQuery('.image-caption-box').css('width', '100%');
		var current_width = jQuery(this).width();
		var current_height = jQuery(this).height();
		var current_wraper = '#' + jQuery(this).closest('.wcp-caption-plugin').attr('id');
		jQuery(current_wraper).find('.image-caption-box, .caption').css({
			'width': current_width,
			'height': current_height
		});

		jQuery(current_wraper).find('.centered-text').css({
	        'position' : 'absolute',
	        'left' : '50%',
	        'top' : '50%',
	        'margin-left' : -jQuery('.centered-text').outerWidth()/2,
	        'margin-top' : -jQuery('.centered-text').outerHeight()/2,
	        'width' : current_width
	    });
	});
}

var resizeTimer;

jQuery(window).on('resize',function() {
    clearTimeout(resizeTimer);
    resizeTimer = setTimeout(responsiveWidgets, 100);
});

jQuery(document).ready(function($) {

	jQuery(window).trigger('resize');

	$('.image-flip-up, .image-flip-down, .rotate-image-down, .tilt-image, .image-flip-right, .image-flip-left').closest('.image-caption-box').css('overflow', 'visible');
});