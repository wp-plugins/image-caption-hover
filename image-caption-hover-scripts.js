jQuery(document).ready(function($){
    // Uploading files

    var image_caption_hover_plugin;
     
    jQuery('#upload_image_button').live('click', function( event ){
     
        event.preventDefault();
     
        // If the media frame already exists, reopen it.
        if ( image_caption_hover_plugin ) {
          image_caption_hover_plugin.open();
          return;
        }
     
        // Create the media frame.
        image_caption_hover_plugin = wp.media.frames.image_caption_hover_plugin = wp.media({
          title: jQuery( this ).data( 'uploader_title' ),
          button: {
            text: jQuery( this ).data( 'uploader_button_text' ),
          },
          multiple: false  // Set to true to allow multiple files to be selected
        });
     
        // When an image is selected, run a callback.
        image_caption_hover_plugin.on( 'select', function() {
          // We set multiple to false so only get one image from the uploader
          attachment = image_caption_hover_plugin.state().get('selection').first().toJSON();

             jQuery('.image-url').val(attachment.url);
             jQuery('.image-title').val(attachment.title);
             jQuery('.alt-text').val(attachment.alt);
        });
     
        // Finally, open the modal
        image_caption_hover_plugin.open();
    });
 
});