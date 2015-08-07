<?php
/**
 * Plugin Name: Image Caption Hover
 * Plugin URI: http://webcodingplace.com/image-caption-hover-wordpress-plugin/
 * Description: A simple way to add responsive images in widgets and pages along with captions.
 * Version: 5.2
 * Author: Rameez
 * Author URI: http://webcodingplace.com/
 * License: GNU General Public License version 3.0
 * License URI: http://www.gnu.org/licenses/gpl-3.0.html
 * Text Domain: image-caption-hover
 */

/*
  Copyright (C) 2015  Rameez  rameez.iqbal@live.com
*/
require_once('widget.php');

require_once('plugin.class.php');

if( class_exists('Image_Caption_Hover')){
	
	$just_initialize = new Image_Caption_Hover;
}

?>