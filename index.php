<?php
/**
 * Plugin Name: Image Caption Hover
 * Plugin URI: http://webcodingplace.com/image-caption-hover/
 * Description: A simple way to add responsive images in widgets with caption.
 * Version: 1.2.0
 * Author: Rameez
 * Author URI: http://webcodingplace.com/
 * License: GPLv2 or later
 * License URI: http://www.gnu.org/licenses/gpl-2.0.html
 */

require_once('plugin.class.php');

	if( class_exists('Image_Caption_Hover')){
		
		$image_widget_caption = new Image_Caption_Hover;
	}

?>