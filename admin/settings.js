jQuery(document).ready(function($) {
	$('.wcp-save').click(function() {
		jQuery('.nm-loading').show();
		jQuery('.nm-saved').hide();
				
		var who_can_edit = $('.who_can_edit').val();
		$.post(ajaxurl, {action: 'save_ich_settings', role: who_can_edit }, function(resp) {
			jQuery('.nm-loading').hide();
			jQuery('.nm-saved').show();
		});
	});
});