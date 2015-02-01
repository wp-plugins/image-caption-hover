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
	        <img class="wcp-caption-image" src="<?php echo $wcp_caption_image_url; ?>" title="<?php echo $image_title ?>" alt="<?php echo $image_alt; ?>"/>  
	        <div class="caption <?php echo $imagestyle; ?>">  
		        <h3><?php echo $caption_heading; ?></h3>
		        <p><?php echo $caption_desc; ?></p>
		        <a href="<?php echo $btn_link; ?>" title="<?php echo $image_title ?>" target="<?php echo $wcp_newtab = $instance['wcp_newtab'] ? '_blank' : '_self'; ?>"><?php echo $btn_text; ?></a>
	        </div>  
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
			value="<?php if (isset($image_title)) echo esc_attr($image_title); ?>"
		/>
	</p>
	<p>
		<label for="<?php echo $this->get_field_id('image_alt'); ?>"><?php _e( 'Alt', 'image-caption-hover' ); ?>:</label>
		<input type="text"
			class="alt-text widefat"
			name="<?php echo $this->get_field_name('image_alt'); ?>"
			value="<?php if (isset($image_alt)) echo esc_attr($image_alt); ?>"
		/>
	</p>

	<p style="text-align:center;"><?php _e( 'Caption', 'image-caption-hover' ); ?></p><hr />
	<p>
		<label for="<?php echo $this->get_field_id('caption_heading'); ?>"><?php _e( 'Heading', 'image-caption-hover' ); ?>:</label>
		<input type="text"
			class="widefat"
			name="<?php echo $this->get_field_name('caption_heading'); ?>"
			value="<?php if (isset($caption_heading)) echo esc_attr($caption_heading); ?>"
		/>
	</p>
	<p>
		<label for="<?php echo $this->get_field_id('caption_desc'); ?>"><?php _e( 'Description', 'image-caption-hover' ); ?>:</label>
		<input type="text"
			class="widefat"
			name="<?php echo $this->get_field_name('caption_desc'); ?>"
			value="<?php if (isset($caption_desc)) echo esc_attr($caption_desc); ?>"
		/>
	</p>

	<p>
		<label for="<?php echo $this->get_field_id('btn_text'); ?>"><?php _e( 'Button text', 'image-caption-hover' ); ?>:</label>
		<input type="text"
			class="widefat"
			name="<?php echo $this->get_field_name('btn_text'); ?>"
			value="<?php if (isset($btn_text)) echo esc_attr($btn_text); ?>"
		/>
	</p>

	<p>
		<label for="<?php echo $this->get_field_id('btn_link'); ?>"><?php _e( 'Button link', 'image-caption-hover' ); ?>:</label>
		<input type="text"
			class="widefat"
			name="<?php echo $this->get_field_name('btn_link'); ?>"
			value="<?php if (isset($btn_link)) echo esc_attr($btn_link); ?>"
		/>		
	</p>

	<p>
	    <input class="checkbox" type="checkbox" <?php checked($instance['wcp_newtab'], 'on'); ?> id="<?php echo $this->get_field_id('wcp_newtab'); ?>" name="<?php echo $this->get_field_name('wcp_newtab'); ?>" /> 
	    <label for="<?php echo $this->get_field_id('wcp_newtab'); ?>"><?php _e( 'Open link in new tab', 'image-caption-hover' ); ?></label>
	</p>

	<p style="text-align:center;"><?php _e( 'Hover styles', 'image-caption-hover' ); ?></p>

	<p>
		<label for="<?php echo $this->get_field_id('imagestyle'); ?>"><?php _e( 'Hover style', 'image-caption-hover' ); ?>: </label>
		<select class="widefat" name="<?php echo $this->get_field_name('imagestyle'); ?>">
			<option value="effect-1"<?php if($imagestyle == 'effect-1'){echo 'selected';} ?>><?php _e( 'Bottom to top', 'image-caption-hover' ); ?></option>
			<option value="effect-2" <?php if($imagestyle == 'effect-2'){echo 'selected';} ?>><?php _e( 'Top to bottom', 'image-caption-hover' ); ?></option>
			<option value="effect-3" <?php if($imagestyle == 'effect-3'){echo 'selected';} ?>><?php _e( 'Right to left (dark background)', 'image-caption-hover' ); ?></option>
			<option value="effect-4"<?php if($imagestyle == 'effect-4'){echo 'selected';} ?>><?php _e( 'Slide one by one', 'image-caption-hover' ); ?></option>
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