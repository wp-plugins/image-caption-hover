<?php
/**
* Plugin Main Class
*/
class Image_Caption_Hover
{
	
	function __construct()
	{
		add_action( 'admin_menu', array( $this, 'ich_admin_options' ) );
		add_action( 'admin_enqueue_scripts', array( $this, 'admin_options_page_scripts' ) );
		add_action('wp_ajax_wcp_save_image_caption_hovers', array($this, 'save_settings'));
		add_action( 'wp_enqueue_scripts', array($this, 'adding_front_scripts') );
		add_shortcode( 'image-caption-hover', array( $this, 'render_all_shortcodes' ) );
		add_action( 'plugins_loaded', array($this, 'wcp_load_plugin_textdomain' ) );
	}

	function adding_front_scripts(){
		wp_register_style( 'image-caption-hover-css', plugins_url( 'css/style.css' , __FILE__ ));
	}

	function admin_options_page_scripts($slug){
		if ($slug == 'toplevel_page_ich_admin') {
			wp_enqueue_style( 'image-caption-hover-css', plugins_url( 'css/style.css' , __FILE__ ));
			wp_enqueue_script( 'image-caption-hover-js', plugins_url( 'js/script.js' , __FILE__ ), array('jquery') );
			wp_enqueue_media();
			wp_enqueue_style( 'wp-color-picker' );
			wp_enqueue_script( 'ich-admin-js', plugins_url( 'admin/script.js' , __FILE__ ), array('jquery', 'jquery-ui-accordion', 'wp-color-picker') );
			wp_enqueue_style( 'ich-admin-css', plugins_url( 'admin/style.css' , __FILE__ ));
			wp_localize_script( 'ich-admin-js', 'wcpAjax', array( 'url' => admin_url( 'admin-ajax.php' ), 'path' => plugin_dir_url( __FILE__ )));
		}
	}

	function wcp_load_plugin_textdomain(){
		load_plugin_textdomain( 'image-caption-hover', FALSE, basename( dirname( __FILE__ ) ) . '/languages/' );
	}

	function save_settings(){
		if (isset($_REQUEST)) {
			update_option( 'wcp_ich_plugin', $_REQUEST );
		}

		die(0);
	}

	function ich_admin_options(){
		add_menu_page( 'Image Caption Hover', 'Image Caption Hover', 'manage_options', 'ich_admin', array($this, 'render_menu_page'), 'dashicons-format-gallery' );
	}

	function render_menu_page(){
		$allCaptions = get_option('wcp_ich_plugin');
		?>
			<div class="wrap" id="photo-book">
				<h2><?php _e( 'Image Caption Hover Settings', 'image-caption-hover' ); ?> <a title="<?php _e( 'Need Help', 'image-caption-hover' ); ?>?" target="_blank" href="http://webcodingplace.com/image-caption-hover-wordpress-plugin/"><span class="dashicons dashicons-editor-help"></span></a></h2>

				<div id="accordion">
				<?php if (isset($allCaptions['widgets'])) { ?>
				
					<?php foreach ($allCaptions['widgets'] as $key => $data) { ?>
			  		<h3 class="tab-head"><?php echo ($data['refname'] != '') ? $data['refname'] : 'Image Caption Hover' ; ?></h3>
			  		<div class="tab-content">
			  			<h3><?php _e( 'Image', 'image-caption-hover' ); ?></h3>
			  			<table class="form-table">
			  				<tr>
			  					<td><?php _e( 'Paste URL or use from Media', 'image-caption-hover' ); ?>
			  					<td>
			  						<input type="text" class="imageurl" value="<?php echo $data['imageurl']; ?>">
			  						<button class="button-secondary upload_image_button"
			  							data-title="<?php _e( 'Select Image', 'image-caption-hover' ); ?>"
			  							data-btntext="<?php _e( 'Select', 'image-caption-hover' ); ?>"><?php _e( 'Media', 'image-caption-hover' ); ?></button>
			  					</td>
			  					<td>
			  						<p class="description"><?php _e( 'Use media to upload image', 'image-caption-hover' ); ?>.</p>
			  					</td>
			  				</tr>
			  				<tr>
			  					<td><?php _e( 'Title', 'image-caption-hover' ); ?></td>
			  					<td>
			  						<input type="text" class="imagetitle widefat" value="<?php echo $data['imagetitle']; ?>">
			  					</td>
			  					<td>
			  						<p class="description"><?php _e( 'It will be used as title attribute of image tag', 'image-caption-hover' ); ?>.</p>
			  					</td>
			  				</tr>
			  				<tr>
			  					<td><?php _e( 'Alternate Text', 'image-caption-hover' ); ?></td>
			  					<td>
			  						<input type="text" class="imagealt widefat" value="<?php echo $data['imagealt']; ?>">
			  					</td>
			  					<td>
			  						<p class="description"><?php _e( 'It will be used as alt attribute of image tag', 'image-caption-hover' ); ?>.</p>
			  					</td>
			  				</tr>
			  				<tr>
			  					<td><?php _e( 'iLightBox Shortcode', 'image-caption-hover' ); ?></td>
			  					<td>
			  						<input type="text" class="wcpilight widefat" value="<?php echo stripslashes($data['wcpilight']); ?>">
			  					</td>
			  					<td>
			  						<p class="description"><?php _e( 'Eg: [ilightbox id="7"]', 'image-caption-hover' ); ?>.</p>
			  					</td>
			  				</tr>
			  			</table>
				  		<h3><?php _e( 'Caption', 'image-caption-hover' ); ?></h3>
						<table class="form-table">
							<tr>
								<td><?php _e( 'Caption Text (HTML tags can be used)', 'image-caption-hover' ); ?></td>
								<td><textarea class="captiontext widefat"><?php echo stripslashes($data['captiontext']); ?></textarea></td>
								<td><?php _e( 'Caption Alignment', 'image-caption-hover' ); ?></td>
								<td>
									<select class="captionalignment widefat">
										<option value="auto" <?php selected( $data['captionalignment'], 'auto' ); ?>><?php _e( 'Auto', 'image-caption-hover' ); ?></option>
										<option value="center" <?php selected( $data['captionalignment'], 'center' ); ?>><?php _e( 'Center', 'image-caption-hover' ); ?></option>
										<option value="right" <?php selected( $data['captionalignment'], 'right' ); ?>><?php _e( 'Right', 'image-caption-hover' ); ?></option>
										<option value="left" <?php selected( $data['captionalignment'], 'left' ); ?>><?php _e( 'Left', 'image-caption-hover' ); ?></option>
										<option value="justify" <?php selected( $data['captionalignment'], 'justify' ); ?>><?php _e( 'Justify', 'image-caption-hover' ); ?></option>
									</select>
								</td>
							</tr>
							<tr>
								<td><?php _e( 'Caption Background Color', 'image-caption-hover' ); ?></td>
								<td class="insert-picker-bg"><input class="captionbg colorpicker" type="text" value="<?php echo $data['captionbg']; ?>"></td>
								<td><?php _e( 'Caption Text Color', 'image-caption-hover' ); ?></td>
								<td class="insert-picker-color"><input class="captioncolor colorpicker" type="text" value="<?php echo $data['captioncolor']; ?>"></td>
							</tr>
							<tr>
								<td><?php _e( 'Background Opacity', 'image-caption-hover' ); ?></td>
								<td><input class="captionopacity widefat" type="number" min="0" max="1" step="0.1" value="<?php echo $data['captionopacity']; ?>"></td>
								<td><?php _e( 'Title (for your reference)', 'image-caption-hover' ); ?></td>
								<td><input class="refname widefat" type="text" value="<?php echo $data['refname']; ?>"></td>
							</tr>
						</table>
						<h3><?php _e( 'Hover', 'image-caption-hover' ); ?></h3>
						<table class="form-table">
							<tr>
								<td><?php _e( 'Hover Style', 'image-caption-hover' ); ?></td>
								<td>
									<select class="hoverstyle">
										<option value="slide-left-to-right" <?php if($data['hoverstyle'] == 'slide-left-to-right'){echo 'selected';} ?>><?php _e( 'Slide left to right', 'image-caption-hover' ); ?></option>
										<option value="slide-right-to-left" <?php if($data['hoverstyle'] == 'slide-right-to-left'){echo 'selected';} ?>><?php _e( 'Slide right to left', 'image-caption-hover' ); ?></option>
										<option value="slide-top-to-bottom" <?php if($data['hoverstyle'] == 'slide-top-to-bottom'){echo 'selected';} ?>><?php _e( 'Slide bottom to top', 'image-caption-hover' ); ?></option>
										<option value="slide-bottom-to-top" <?php if($data['hoverstyle'] == 'slide-bottom-to-top'){echo 'selected';} ?>><?php _e( 'Slide top to bottom', 'image-caption-hover' ); ?></option>
										<option value="image-flip-up" <?php if($data['hoverstyle'] == 'image-flip-up'){echo 'selected';} ?>><?php _e( 'Image flip up', 'image-caption-hover' ); ?></option>
										<option value="image-flip-down" <?php if($data['hoverstyle'] == 'image-flip-down'){echo 'selected';} ?>><?php _e( 'Image flip down', 'image-caption-hover' ); ?></option>
										<option value="image-flip-right" <?php if($data['hoverstyle'] == 'image-flip-right'){echo 'selected';} ?>><?php _e( 'Image flip right', 'image-caption-hover' ); ?></option>
										<option value="image-flip-left" <?php if($data['hoverstyle'] == 'image-flip-left'){echo 'selected';} ?>><?php _e( 'Image flip left', 'image-caption-hover' ); ?></option>
										<option value="rotate-image-down" <?php if($data['hoverstyle'] == 'rotate-image-down'){echo 'selected';} ?>><?php _e( 'Rotate image down', 'image-caption-hover' ); ?></option>
										<option value="image-turn-around" <?php if($data['hoverstyle'] == 'image-turn-around'){echo 'selected';} ?>><?php _e( 'Image turn around', 'image-caption-hover' ); ?></option>
										<option value="zoom-and-pan" <?php if($data['hoverstyle'] == 'zoom-and-pan'){echo 'selected';} ?>><?php _e( 'Zoom in', 'image-caption-hover' ); ?></option>
										<option value="tilt-image" <?php if($data['hoverstyle'] == 'tilt-image'){echo 'selected';} ?>><?php _e( 'Image tilt', 'image-caption-hover' ); ?></option>
										<option value="morph" <?php if($data['hoverstyle'] == 'morph'){echo 'selected';} ?>><?php _e( 'Morph', 'image-caption-hover' ); ?></option>
										<option value="move-image-right" <?php if($data['hoverstyle'] == 'move-image-right'){echo 'selected';} ?>><?php _e( 'Move image right', 'image-caption-hover' ); ?></option>
										<option value="move-image-left" <?php if($data['hoverstyle'] == 'move-image-left'){echo 'selected';} ?>><?php _e( 'Move image left', 'image-caption-hover' ); ?></option>
										<option value="move-image-top" <?php if($data['hoverstyle'] == 'move-image-top'){echo 'selected';} ?>><?php _e( 'Move image top', 'image-caption-hover' ); ?></option>
										<option value="move-image-bottom" <?php if($data['hoverstyle'] == 'move-image-bottom'){echo 'selected';} ?>><?php _e( 'Move image bottom', 'image-caption-hover' ); ?></option>
										<option value="image-squeez-right" <?php if($data['hoverstyle'] == 'image-squeez-right'){echo 'selected';} ?>><?php _e( 'Image squeez right', 'image-caption-hover' ); ?></option>
										<option value="image-squeez-left" <?php if($data['hoverstyle'] == 'image-squeez-left'){echo 'selected';} ?>><?php _e( 'Image squeez left', 'image-caption-hover' ); ?></option>
										<option value="image-squeez-top" <?php if($data['hoverstyle'] == 'image-squeez-top'){echo 'selected';} ?>><?php _e( 'Image squeez top', 'image-caption-hover' ); ?></option>
										<option value="image-squeez-bottom" <?php if($data['hoverstyle'] == 'image-squeez-bottom'){echo 'selected';} ?>><?php _e( 'Image squeez bottom', 'image-caption-hover' ); ?></option>
									</select>									
								</td>
								<td>
									<p class="description"><?php _e( 'Choose hover style', 'image-caption-hover' ); ?></p>
								</td>
							</tr>
						</table>
						<h3><?php _e( 'Preview', 'image-caption-hover' ); ?></h3>
						<p class="text-center"><button class="button-secondary update-preview"><?php _e( 'Refresh Preview', 'image-caption-hover' ); ?></button></p>
						<div class="insert-preview" style="max-width: 300px; width: 100%; margin: 0 auto;">						
						</div>
						<div class="clearfix"></div>
						<hr style="margin-bottom: 10px;">
						<button class="button btndelete"><span class="dashicons dashicons-dismiss" title="Delete"></span><?php _e( 'Delete', 'image-caption-hover' ); ?></button>
						<button class="button btnadd"><span class="dashicons dashicons-admin-page"></span><?php _e( 'Duplicate', 'image-caption-hover' ); ?></button>&nbsp;
						<button class="button btnnew"><span class="dashicons dashicons-plus-alt"></span><?php _e( 'Add New', 'image-caption-hover' ); ?></button>&nbsp;
						<p class="wcp-shortc"><button class="button-primary fullshortcode" id="<?php echo $data['counter']; ?>"><?php _e( 'Get Shortcode', 'image-caption-hover' ); ?></button></p>
						<div class="clearfix"></div>
					</div>
					<?php } ?>
				<?php } else { ?>
					<h3 class="tab-head"><?php _e( 'Image Caption Hover', 'image-caption-hover' ); ?></h3>
			  		<div class="tab-content">
			  			<h3><?php _e( 'Image', 'image-caption-hover' ); ?></h3>
			  			<table class="form-table">
			  				<tr>
			  					<td><?php _e( 'Paste URL or use from Media', 'image-caption-hover' ); ?>
			  					<td>
			  						<input type="text" class="imageurl" value="">
			  						<button class="button-secondary upload_image_button"
			  							data-title="<?php _e( 'Select Image', 'image-caption-hover' ); ?>"
			  							data-btntext="<?php _e( 'Select', 'image-caption-hover' ); ?>"><?php _e( 'Media', 'image-caption-hover' ); ?></button>
			  					</td>
			  					<td>
			  						<p class="description"><?php _e( 'Use media to upload image', 'image-caption-hover' ); ?>.</p>
			  					</td>
			  				</tr>
			  				<tr>
			  					<td><?php _e( 'Title', 'image-caption-hover' ); ?></td>
			  					<td>
			  						<input type="text" class="imagetitle widefat" value="">
			  					</td>
			  					<td>
			  						<p class="description"><?php _e( 'It will be used as title attribute of image tag', 'image-caption-hover' ); ?>.</p>
			  					</td>
			  				</tr>
			  				<tr>
			  					<td><?php _e( 'Alternate Text', 'image-caption-hover' ); ?></td>
			  					<td>
			  						<input type="text" class="imagealt widefat" value="">
			  					</td>
			  					<td>
			  						<p class="description"><?php _e( 'It will be used as alt attribute of image tag', 'image-caption-hover' ); ?>.</p>
			  					</td>
			  				</tr>
			  				<tr>
			  					<td><?php _e( 'iLightBox Shortcode', 'image-caption-hover' ); ?></td>
			  					<td>
			  						<input type="text" class="wcpilight widefat" value="">
			  					</td>
			  					<td>
			  						<p class="description"><?php _e( 'Eg: [ilightbox id="7"]', 'image-caption-hover' ); ?>.</p>
			  					</td>
			  				</tr>
			  			</table>
				  		<h3><?php _e( 'Caption', 'image-caption-hover' ); ?></h3>
						<table class="form-table">
							<tr>
								<td><?php _e( 'Caption Text (HTML tags can be used)', 'image-caption-hover' ); ?></td>
								<td><textarea class="captiontext widefat"></textarea></td>
								<td><?php _e( 'Caption Alignment', 'image-caption-hover' ); ?></td>
								<td>
									<select class="captionalignment widefat">
										<option value="auto"><?php _e( 'Auto', 'image-caption-hover' ); ?></option>
										<option value="center"><?php _e( 'Center', 'image-caption-hover' ); ?></option>
										<option value="right"><?php _e( 'Right', 'image-caption-hover' ); ?></option>
										<option value="left"><?php _e( 'Left', 'image-caption-hover' ); ?></option>
										<option value="justify"><?php _e( 'Justify', 'image-caption-hover' ); ?></option>
									</select>
								</td>
							</tr>
							<tr>
								<td><?php _e( 'Caption Background Color', 'image-caption-hover' ); ?></td>
								<td><input class="captionbg colorpicker" type="text" value=""></td>
								<td><?php _e( 'Caption Text Color', 'image-caption-hover' ); ?></td>
								<td><input class="captioncolor colorpicker" type="text" value=""></td>
							</tr>
							<tr>
								<td><?php _e( 'Background Opacity', 'image-caption-hover' ); ?></td>
								<td><input class="captionopacity widefat" type="number" max="1" min="0" step="0.1" value=""></td>
								<td><?php _e( 'Title (for your reference)', 'image-caption-hover' ); ?></td>
								<td><input class="refname widefat" type="text" value=""></td>
							</tr>
						</table>
						<h3><?php _e( 'Hover', 'image-caption-hover' ); ?></h3>
						<table class="form-table">
							<tr>
								<td><?php _e( 'Hover Style', 'image-caption-hover' ); ?></td>
								<td>
									<select class="hoverstyle">
										<option value="slide-left-to-right"><?php _e( 'Slide left to right', 'image-caption-hover' ); ?></option>
										<option value="slide-right-to-left"><?php _e( 'Slide right to left', 'image-caption-hover' ); ?></option>
										<option value="slide-top-to-bottom"><?php _e( 'Slide bottom to top', 'image-caption-hover' ); ?></option>
										<option value="slide-bottom-to-top"><?php _e( 'Slide top to bottom', 'image-caption-hover' ); ?></option>
										<option value="image-flip-up"><?php _e( 'Image flip up', 'image-caption-hover' ); ?></option>
										<option value="image-flip-down"><?php _e( 'Image flip down', 'image-caption-hover' ); ?></option>
										<option value="image-flip-right"><?php _e( 'Image flip right', 'image-caption-hover' ); ?></option>
										<option value="image-flip-left"><?php _e( 'Image flip left', 'image-caption-hover' ); ?></option>
										<option value="rotate-image-down"><?php _e( 'Rotate image down', 'image-caption-hover' ); ?></option>
										<option value="image-turn-around"><?php _e( 'Image turn around', 'image-caption-hover' ); ?></option>
										<option value="zoom-and-pan"><?php _e( 'Zoom in', 'image-caption-hover' ); ?></option>
										<option value="tilt-image"><?php _e( 'Image tilt', 'image-caption-hover' ); ?></option>
										<option value="morph"><?php _e( 'Morph', 'image-caption-hover' ); ?></option>
										<option value="move-image-right"><?php _e( 'Move image right', 'image-caption-hover' ); ?></option>
										<option value="move-image-left"><?php _e( 'Move image left', 'image-caption-hover' ); ?></option>
										<option value="move-image-top"><?php _e( 'Move image top', 'image-caption-hover' ); ?></option>
										<option value="move-image-bottom"><?php _e( 'Move image bottom', 'image-caption-hover' ); ?></option>
										<option value="image-squeez-right"><?php _e( 'Image squeez right', 'image-caption-hover' ); ?></option>
										<option value="image-squeez-left"><?php _e( 'Image squeez left', 'image-caption-hover' ); ?></option>
										<option value="image-squeez-top"><?php _e( 'Image squeez top', 'image-caption-hover' ); ?></option>
										<option value="image-squeez-bottom"><?php _e( 'Image squeez bottom', 'image-caption-hover' ); ?></option>
									</select>									
								</td>
								<td>
									<p class="description"><?php _e( 'Choose hover style', 'image-caption-hover' ); ?></p>
								</td>
							</tr>
						</table>
						<h3><?php _e( 'Preview', 'image-caption-hover' ); ?></h3>
						<p class="text-center"><button class="button-secondary update-preview"><?php _e( 'Refresh Preview', 'image-caption-hover' ); ?></button></p>
						<div class="insert-preview" style="max-width: 300px; width: 100%; margin: 0 auto;">
							
						</div>
						<div class="clearfix"></div>
						<hr style="margin-bottom: 10px;">
						<button class="button btndelete"><span class="dashicons dashicons-dismiss" title="Delete"></span><?php _e( 'Delete', 'image-caption-hover' ); ?></button>
						<button class="button btnadd"><span class="dashicons dashicons-admin-page"></span><?php _e( 'Duplicate', 'image-caption-hover' ); ?></button>&nbsp;
						<button class="button btnnew"><span class="dashicons dashicons-plus-alt"></span><?php _e( 'Add New', 'image-caption-hover' ); ?></button>&nbsp;
						<p class="wcp-shortc"><button class="button-primary fullshortcode" id="1"><?php _e( 'Get Shortcode', 'image-caption-hover' ); ?></button></p>
						<div class="clearfix"></div>
					</div>
				<?php } ?>
				</div>

				<hr style="clear: both;">
				<button class="button-primary save-pages"><?php _e( 'Save Changes', 'image-caption-hover' ); ?></button>
				<span id="wcp-loader"><img src="<?php echo plugin_dir_url( __FILE__ ); ?>images/ajax-loader.gif"></span>
				<span id="wcp-saved"><strong><?php _e( 'Changes Saved', 'image-caption-hover' ); ?>!</strong></span>				
			</div>
		<?php
	}

	function render_all_shortcodes($atts, $content, $the_shortcode){

		$allCaptions = get_option('wcp_ich_plugin');

		if (isset($allCaptions['widgets'])) {
			foreach ($allCaptions['widgets'] as $key => $data) {
				extract($data);
				if ($atts['id'] == $data['counter']) {

					wp_enqueue_style( 'image-caption-hover-css');
					wp_enqueue_script( 'image-caption-hover-css');
					if (isset($wcpilight) && $wcpilight != '') {
					    $caption_class = 'captionna';
					}
					else {
						$caption_class = 'captiontext';
					}

					$contents = '<div class="wcp-caption-plugin" id="wcp-widget-'.$atts['id'].'">';

						$contents .=    '<div class="image-caption-box">';  
					        $contents .= '<div class="caption '.$hoverstyle.' '.$caption_class.'" style="background-color: '.$captionbg.'; color: '.$captioncolor.'; opacity: '.$captionopacity.';">  ';
						    	$contents .=    '<div class="centered-text" style="text-align: '.$captionalignment.'; padding: 5px;">'.stripslashes($captiontext).'</div>';
					        $contents .= '</div>';
					        if (isset($wcpilight) && $wcpilight != '') {
					        	$contents .= do_shortcode( $wcpilight.'<img class="wcp-caption-image" src="'.$imageurl.'" title="'.$imagetitle.'" alt="'.$imagealt.'"/>'.'[/ilightbox]' );
					        }
					        else {
					        	$contents .= '<img class="wcp-caption-image" src="'.$imageurl.'" title="'.$imagetitle.'" alt="'.$imagealt.'"/>';
					        }
					    $contents .= '</div>';
					$contents .= '</div>';

					return $contents;
				}
				
			}
		}		
	}
}

?>