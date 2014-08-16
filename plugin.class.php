<?php

class Image_Caption_Hover extends WP_Widget {

	function __construct() {
		$param = array(
			'name'			=>	'Image Caption Hover',
			'description' 	=> 	'Responsive Caption Images in Widgets.'
		);

		parent::__construct('image_caption_hover','',$param);

	}

	public function form($instance) {
		extract($instance);
	
	?>
	<p>
		<p style="text-align:center;">Image</p><hr />
		<label for="<?php echo $this->get_field_id('image_url'); ?>">Paste URL or Upload Image</label>
	    <input 	id="<?php echo $this->get_field_id('image_url'); ?>"
				type="text"
				class="image-url"
				name="<?php echo $this->get_field_name('image_url'); ?>"
				value="<?php if (isset($image_url)) echo esc_attr($image_url); ?>"
		/>
	    <input id="upload_image_button" class="button" type="button" value="Upload" />
	</p>
	<p>
		<label for="<?php echo $this->get_field_id('image_title'); ?>">Title:</label>
		<input type="text"
			class="image-title widefat"
			id="<?php echo $this->get_field_id('image_title'); ?>"
			name="<?php echo $this->get_field_name('image_title'); ?>"
			value="<?php if (isset($image_title)) echo esc_attr($image_title); ?>"
		/>
	</p>
	<p>
		<label for="<?php echo $this->get_field_id('image_alt'); ?>">Alt:</label>
		<input type="text"
			class="alt-text widefat"
			id="<?php echo $this->get_field_id('image_alt'); ?>"
			name="<?php echo $this->get_field_name('image_alt'); ?>"
			value="<?php if (isset($image_alt)) echo esc_attr($image_alt); ?>"
		/>
	</p>

	<p style="text-align:center;">Caption</p><hr />
	<p>
		<label for="<?php echo $this->get_field_id('caption_heading'); ?>">Heading:</label>
		<input type="text"
			class="widefat"
			id="<?php echo $this->get_field_id('caption_heading'); ?>"
			name="<?php echo $this->get_field_name('caption_heading'); ?>"
			value="<?php if (isset($caption_heading)) echo esc_attr($caption_heading); ?>"
		/>
	</p>
	<p>
		<label for="<?php echo $this->get_field_id('caption_desc'); ?>">Description:</label>
		<input type="text"
			class="widefat"
			id="<?php echo $this->get_field_id('caption_desc'); ?>"
			name="<?php echo $this->get_field_name('caption_desc'); ?>"
			value="<?php if (isset($caption_desc)) echo esc_attr($caption_desc); ?>"
		/>
	</p>

	<p>
		<label for="<?php echo $this->get_field_id('btn_text'); ?>">Button text:</label>
		<input type="text"
			class="widefat"
			id="<?php echo $this->get_field_id('btn_text'); ?>"
			name="<?php echo $this->get_field_name('btn_text'); ?>"
			value="<?php if (isset($btn_text)) echo esc_attr($btn_text); ?>"
		/>
	</p>

	<p>
		<label for="<?php echo $this->get_field_id('btn_link'); ?>">Button link:</label>
		<input type="text"
			class="widefat"
			id="<?php echo $this->get_field_id('btn_link'); ?>"
			name="<?php echo $this->get_field_name('btn_link'); ?>"
			value="<?php if (isset($btn_link)) echo esc_attr($btn_link); ?>"
		/>		
	</p>

	<p style="text-align:center;">Hover styles</p>

	<p>
		<label for="<?php echo $this->get_field_id('imagestyle'); ?>">Hover style: </label>
		<select class="widefat" id="<?php echo $this->get_field_id('imagestyle'); ?>" name="<?php echo $this->get_field_name('imagestyle'); ?>">
			<option value="effect-1"<?php if($imagestyle == 'effect-1'){echo 'selected';} ?>>Bottom to top</option>
			<option value="effect-2" <?php if($imagestyle == 'effect-2'){echo 'selected';} ?>>Top to bottom</option>
			<option value="effect-3" <?php if($imagestyle == 'effect-3'){echo 'selected';} ?>>Right to left (dark background)</option>
			<option value="effect-4"<?php if($imagestyle == 'effect-4'){echo 'selected';} ?>>Slide one by one</option>
		</select>
	</p>	
	<?php

	}

	public function widget($args, $instance) {
	
		extract($args);
		extract($instance);
	?>
	<style>
	<?php 
		include_once('image-caption-style.php');
	?>
	</style>	

		<div class="image-caption-hover">
		    <div class="image-caption-box">  
		        <img id="image-1" src="<?php echo $image_url; ?>" title="<?php echo $image_titlek ?>" alt="<?php echo $image_alt; ?>"/>  
		        <div class="caption <?php echo $imagestyle; ?>">  
			        <h3><?php echo $caption_heading; ?></h3>
			        <p><?php echo $caption_desc; ?></p>
			        <a href="<?php echo $btn_link; ?>" target="_blank"><?php echo $btn_text; ?></a>
		        </div>  
		    </div>
		</div>

	<?php
	}
	
}

add_action ('widgets_init', 'register_image_caption_hover');

function register_image_caption_hover(){
	register_widget('image_caption_hover');
}

function image_caption_hover_scripts() {
	wp_enqueue_media();
	wp_register_script( 'my_custom_script', plugin_dir_url( __FILE__ ) . 'image-caption-hover-scripts.js', array('jquery'));
	wp_enqueue_script('my_custom_script');
}

add_action( 'admin_enqueue_scripts', 'image_caption_hover_scripts' );

?>