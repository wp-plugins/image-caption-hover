<div class="wrap">
	<h2>Grid Builder <a href="http://webcodingplace.com/image-caption-hover-pro-wordpress-plugin/" class="add-new-h2"><?php _e( 'It will work in Pro Version', 'image-caption-hover' ); ?></a></h2>
		<div class="wrap-cap">
			<select class="allcaptions widefat">
				<?php
					$allCaptions = get_option('wcp_ich_plugin');

					foreach ($allCaptions['widgets'] as $wid) {
						$shortcode = $wid['shortcode'];
						$name = ($wid['refname'] != '') ? $wid['refname'] : 'title not set' ;
						echo '<option value="'.$shortcode.'">'.$name.'</option>';
					}

				?>
			</select>
		</div>
		<table>
			<tr>
				<th>Number of Columns in Row</th>
				<td>
					<select id="noofcolumns">
						<option value="1">1</option>
						<option value="2">2</option>
						<option value="3">3</option>
						<option value="4">4</option>
						<option value="5">5</option>
						<option value="6">6</option>
						<option value="7">7</option>
						<option value="8">8</option>
						<option value="9">9</option>
						<option value="10">10</option>
					</select>
				</td>
				<td><button class="button-secondary add-table">Add</button></td>
			</tr>
		</table>
		<div class="append-table">
			
		</div>

		<br>
		<button class="button-primary get-sc">Get Shortcode</button>
</div>
<style>
	.wrap-cap select { display: none; }
	.wp-list-table.widefat.fixed {text-align: center;}
</style>
