<?php 

/**
 * new WordPress Widget format
 * Wordpress 2.8 and above
 * @see http://codex.wordpress.org/Widgets_API#Developing_Widgets
 */
class Image_Caption_Hover_Widget extends WP_Widget {

    /**
     * Constructor
     *
     * @return void
     **/
    function Image_Caption_Hover_Widget() {
        $widget_ops = array( 'classname' => 'wcp_caption', 'description' => 'Image with hover effects' );
        $this->WP_Widget( 'wcp_caption', 'Image Caption Hover', $widget_ops );
    }

    /**
     * Outputs the HTML for this widget.
     *
     * @param array  An array of standard parameters for widgets in this theme
     * @param array  An array of settings for this widget instance
     * @return void Echoes it's output
     **/
    function widget( $args, $instance ) {
        extract( $args, EXTR_SKIP );
        extract($instance);
?>

	<div class="wcp-caption-plugin" id="<?php echo $widget_id; ?>">
	    <div class="image-caption-box">  
	        <div class="caption <?php echo $imagestyle; ?>">  
		        <div style="text-align: <?php echo $wcp_caption_alignment; ?>; padding: 5px;"><?php echo $wcp_hover_caption; ?></div>
	        </div>  
	        <img class="wcp-caption-image" src="<?php echo $wcp_caption_image_url; ?>" title="<?php echo $image_title ?>" alt="<?php echo $image_alt; ?>"/>  
	    </div>
	</div>
<?php

    }

    /**
     * Deals with the settings when they are saved by the admin. Here is
     * where any validation should be dealt with.
     *
     * @param array  An array of new settings as submitted by the admin
     * @param array  An array of the previous settings
     * @return array The validated and (if necessary) amended settings
     **/
    function update( $new_instance, $old_instance ) {

        // update logic goes here
        $updated_instance = $new_instance;
        return $updated_instance;
    }

    /**
     * Displays the form for this widget on the Widgets page of the WP Admin area.
     *
     * @param array  An array of the current settings for this widget
     * @return void Echoes it's output
     **/
    function form( $instance ) {
        extract($instance);
?>
	<p>
		<p style="text-align:center;"><?php _e( 'Image', 'image-caption-hover' ); ?></p><hr />
		<label for="<?php echo $this->get_field_id('wcp_caption_image_url'); ?>"><?php _e( 'Paste URL or use from Media', 'image-caption-hover' ); ?></label>
	    <input 	type="text"
				class="image-url"
				name="<?php echo $this->get_field_name('wcp_caption_image_url'); ?>"
				id="<?php echo $this->get_field_id('wcp_caption_image_url'); ?>"
				value="<?php if (isset($wcp_caption_image_url)) echo esc_attr($wcp_caption_image_url); ?>"
		/>
	    <input id="media-upload" data-title="Image Caption Hover" data-btntext="Select it" class="button upload_image_button" type="button" value="<?php _e( 'Media', 'image-caption-hover' ); ?>" />
	</p>
	<p class="img-prev">
		<?php if (isset($wcp_caption_image_url)) { echo '<img src="'.$wcp_caption_image_url.'" style="max-width: 100%;">';} ?>
	</p>	
	<p>
		<label for="<?php echo $this->get_field_id('image_title'); ?>"><?php _e( 'Title', 'image-caption-hover' ); ?>:</label>
		<input type="text"
			class="image-title widefat"
			name="<?php echo $this->get_field_name('image_title'); ?>"
			id="<?php echo $this->get_field_id('image_title'); ?>"
			value="<?php if (isset($image_title)) echo esc_attr($image_title); ?>"
		/>
	</p>
	<p>
		<label for="<?php echo $this->get_field_id('image_alt'); ?>"><?php _e( 'Alt', 'image-caption-hover' ); ?>:</label>
		<input type="text"
			class="alt-text widefat"
			name="<?php echo $this->get_field_name('image_alt'); ?>"
			id="<?php echo $this->get_field_id('image_alt'); ?>"
			value="<?php if (isset($image_alt)) echo esc_attr($image_alt); ?>"
		/>
	</p>

	<p style="text-align:center;"><?php _e( 'Caption', 'image-caption-hover' ); ?></p><hr />
	<p>
		<label for="<?php echo $this->get_field_id('wcp_hover_caption'); ?>"><?php _e( 'You can also use HTML tags here', 'image-caption-hover' ); ?>:</label>
		<textarea
			class="widefat"
			name="<?php echo $this->get_field_name('wcp_hover_caption'); ?>"
			id="<?php echo $this->get_field_id('wcp_hover_caption'); ?>"
		><?php if (isset($wcp_hover_caption)) echo esc_attr($wcp_hover_caption); ?></textarea>
	</p>
	<p>
		<label for="<?php echo $this->get_field_id('wcp_caption_alignment'); ?>"><?php _e( 'Caption alignment', 'image-caption-hover' ); ?>: </label>
		<select class="widefat" name="<?php echo $this->get_field_name('wcp_caption_alignment'); ?>" id="<?php echo $this->get_field_id('wcp_caption_alignment'); ?>">
			<option value="auto"<?php if($wcp_caption_alignment == 'auto'){echo 'selected';} ?>><?php _e( 'Auto', 'image-caption-hover' ); ?></option>
			<option value="center" <?php if($wcp_caption_alignment == 'center'){echo 'selected';} ?>><?php _e( 'Center', 'image-caption-hover' ); ?></option>
			<option value="right" <?php if($wcp_caption_alignment == 'right'){echo 'selected';} ?>><?php _e( 'Right', 'image-caption-hover' ); ?></option>
			<option value="left"<?php if($wcp_caption_alignment == 'left'){echo 'selected';} ?>><?php _e( 'Left', 'image-caption-hover' ); ?></option>
			<option value="justify"<?php if($wcp_caption_alignment == 'justify'){echo 'selected';} ?>><?php _e( 'Justify', 'image-caption-hover' ); ?></option>
		</select>
	</p>

	<p style="text-align:center;"><?php _e( 'Hover styles', 'image-caption-hover' ); ?></p>
	<hr>

	<p>
		<label for="<?php echo $this->get_field_id('imagestyle'); ?>"><?php _e( 'Hover style', 'image-caption-hover' ); ?>: </label>
		<select class="widefat" name="<?php echo $this->get_field_name('imagestyle'); ?>">
			<option value="slide-top-to-bottom"<?php if($imagestyle == 'slide-top-to-bottom'){echo 'selected';} ?>><?php _e( 'Slide bottom to top', 'image-caption-hover' ); ?></option>
			<option value="slide-bottom-to-top" <?php if($imagestyle == 'slide-bottom-to-top'){echo 'selected';} ?>><?php _e( 'Slide top to bottom', 'image-caption-hover' ); ?></option>
			<option value="slide-left-to-right" <?php if($imagestyle == 'slide-left-to-right'){echo 'selected';} ?>><?php _e( 'Slide left to right', 'image-caption-hover' ); ?></option>
			<option value="slide-right-to-left" <?php if($imagestyle == 'slide-right-to-left'){echo 'selected';} ?>><?php _e( 'Slide right to left', 'image-caption-hover' ); ?></option>
		</select>
	</p>

<?php
    }
}
// End of Plugin Class

add_action( 'widgets_init', create_function( '', "register_widget( 'Image_Caption_Hover_Widget' );" ) );

add_action( 'admin_enqueue_scripts', 'enqueue_script_media_uploader' );
add_action( 'wp_head', 'wcp_caption_styles' );

/*
*	Script for Media uploader
 */
function enqueue_script_media_uploader($hook){
    if ( 'widgets.php' != $hook ) {
        return;
    }
    wp_enqueue_media();
    wp_enqueue_script( 'wcp_uploader', plugin_dir_url( __FILE__ ) . 'js/admin.js', array('jquery') );
}
function wcp_caption_styles(){
	wp_enqueue_style( 'wcp-caption-styles', plugin_dir_url( __FILE__ ) .'css/style.css' );
    wp_enqueue_script( 'wcp-caption-scripts', plugin_dir_url( __FILE__ ) . 'js/script.js', array('jquery') );
}
?>