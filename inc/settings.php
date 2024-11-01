<?php

	// Exit if accessed directly
	defined( 'ABSPATH' ) || exit;



	function TCBD_Google_Map_settings() {
		add_plugins_page( 'TCBD Google Map Settings', 'TCBD Google Map', 'update_core', 'TCBD_Google_Map_settings', 'tcbd_google_map_settings_page');
	}
	add_action( 'admin_menu', 'TCBD_Google_Map_settings' );
	
	function TCBD_Google_Map_register_settings() {
		register_setting( 'TCBD_Google_Map_register_setting', 'tcbd_google_map_latitude' );
		register_setting( 'TCBD_Google_Map_register_setting', 'tcbd_google_map_longitude' );
		register_setting( 'TCBD_Google_Map_register_setting', 'tcbd_google_map_zoom' );
		register_setting( 'TCBD_Google_Map_register_setting', 'tcbd_google_map_marker' );
		register_setting( 'TCBD_Google_Map_register_setting', 'tcbd_google_map_style' );
		register_setting( 'TCBD_Google_Map_register_setting', 'tcbd_google_map_scroll_zoom' );
		register_setting( 'TCBD_Google_Map_register_setting', 'tcbd_google_map_api_key' );
	}
	add_action( 'admin_init', 'TCBD_Google_Map_register_settings' );
		
	function tcbd_google_map_settings_page(){ // settings page function
	
		if( get_option('tcbd_google_map_latitude') ){
			$map_latitude = get_option('tcbd_google_map_latitude');
		}else{
			$map_latitude = '23.810332';
		}
		
		if( get_option('tcbd_google_map_longitude') ){
			$map_longitude = get_option('tcbd_google_map_longitude');
		}else{
			$map_longitude = '90.412518';
		}
		
		if( get_option('tcbd_google_map_zoom') ){
			$map_zoom = get_option('tcbd_google_map_zoom');
		}else{
			$map_zoom = '8';
		}
		
		if( get_option('tcbd_google_map_scroll_zoom') ){
			$scroll_zoom = get_option('tcbd_google_map_scroll_zoom');
		}else{
			$scroll_zoom = '0';
		}
		
		if( get_option('tcbd_google_map_api_key') ){
			$tcbd_google_map_api = get_option('tcbd_google_map_api_key');
		}else{
			$tcbd_google_map_api = null;
		}
		
		
		?>
			<div class="wrap">
				<h2 style="margin-bottom: 30px;">TCBD Google Map Settings</h2>
                
				<?php if( isset($_GET['settings-updated']) && $_GET['settings-updated'] ){ ?>
					<div id="setting-error-settings_updated" class="updated settings-error notice is-dismissible"> 
						<p><strong>Settings saved.</strong></p>
                        <button type="button" class="notice-dismiss"><span class="screen-reader-text">Dismiss this notice.</span></button>
					</div>
				<?php } ?>
			
                
            	<form method="post" action="options.php">
                	<?php settings_fields( 'TCBD_Google_Map_register_setting' ); ?>
					<?php if( !isset($tcbd_google_map_api)): ?>
					<div class="error updated settings-error notice is-dismissible">
						<h1>Important Notification</h1>
						<p></p>
						<p><strong>*ALL* Google Maps now require an API key to function.</strong> <a href="https://googlegeodevelopers.blogspot.co.za/2016/06/building-for-scale-updates-to-google.html" target="_BLANK">You can read more about that here.</a></p>
						<p>Before creating a map please follow these steps:</p>
						<ol>
							<li>
								<a target="_BLANK" href="https://console.developers.google.com/flows/enableapi?apiid=maps_backend,geocoding_backend,directions_backend,distance_matrix_backend,elevation_backend&amp;keyType=CLIENT_SIDE&amp;reusekey=true" class="">Create an API key now (free)</a>
							</li>
							<li>
								Paste your API key and press 'Save Changes'.
							</li>
						</ol>
						<button type="button" class="notice-dismiss"><span class="screen-reader-text">Dismiss this notice.</span></button>
					</div>
					<?php endif; ?>
					
                	<table class="form-table">
                		<tbody>
                        
                    		<tr>
                        		<th scope="row"><label for="tcbd_google_maps_api_key">Google Map API Key:</label></th>
                            	<td>
                                    <input class="regular-text" name="tcbd_google_map_api_key" type="text" id="tcbd_google_maps_api_key" value="<?php echo esc_attr( $tcbd_google_map_api ); ?>" placeholder="Google Maps JavaScript API Key">
                                    <p class="description">Create an API key from <a target="_blank" href="https://console.developers.google.com/flows/enableapi?apiid=maps_backend,geocoding_backend,directions_backend,distance_matrix_backend,elevation_backend&amp;keyType=CLIENT_SIDE&amp;reusekey=true">Here.</a></p>
								</td>
                        	</tr>
                        
                    		<tr>
                        		<th scope="row"><label for="tcbd_google_map_latitude">Latitude Number:</label></th>
                            	<td>
                                    <input class="regular-text" name="tcbd_google_map_latitude" type="text" id="tcbd_google_map_latitude" value="<?php echo esc_attr( $map_latitude ); ?>">
                                    <p class="description">You may find Latitude Number and Longitude Number from <a target="_blank" href="http://www.latlong.net/">Here.</a></p>
								</td>
                        	</tr>
                            
                    		<tr>
                        		<th scope="row"><label for="tcbd_google_map_longitude">Longitude Number:</label></th>
                            	<td>
                                    <input class="regular-text" name="tcbd_google_map_longitude" type="text" id="tcbd_google_map_longitude" value="<?php echo esc_attr( $map_longitude ); ?>">
                                    <p class="description">You may find Latitude Number and Longitude Number from <a target="_blank" href="http://www.latlong.net/">Here.</a></p>
								</td>
                        	</tr>
                            
                    		<tr>
                        		<th scope="row"><label for="tcbd_google_map_zoom">Map Zoom Level:</label></th>
                            	<td>
                                    <input class="regular-text" name="tcbd_google_map_zoom" type="text" id="tcbd_google_map_zoom" value="<?php echo esc_attr( $map_zoom ); ?>">
								</td>
                        	</tr>
							                            
                    		<tr>
                        		<th scope="row"><label for="tcbd_google_map_marker">Map Marker:</label></th>
                            	<td>
									<?php
										if( get_option( 'tcbd_google_map_marker' ) ){
											$show_marker = get_option( 'tcbd_google_map_marker' );
										}else{
											$show_marker = '0';
										}
									?>
									<label for="tcbd_google_map_marker">
										<input type="checkbox" id="tcbd_google_map_marker" name="tcbd_google_map_marker" value="1" <?php checked( 1, $show_marker ); ?> >
										On
									</label>
								</td>
                        	</tr>
							                            
                    		<tr>
                        		<th scope="row"><label for="tcbd_google_map_scroll_zoom">Scroll Zoom:</label></th>
                            	<td>
									<?php
										if( get_option( 'tcbd_google_map_scroll_zoom' ) ){
											$show_marker = get_option( 'tcbd_google_map_scroll_zoom' );
										}else{
											$show_marker = '0';
										}
									?>
									<label for="tcbd_google_map_scroll_zoom">
										<input type="checkbox" id="tcbd_google_map_scroll_zoom" name="tcbd_google_map_scroll_zoom" value="1" <?php checked( 1, $show_marker ); ?> >
										On
									</label>
								</td>
                        	</tr>
							                            
                    		<tr>
                        		<th scope="row"><label for="tcbd_google_map_style">Map Style:</label></th>
                            	<td class="tcbd-map">
									<?php
										if( get_option( 'tcbd_google_map_style' ) ){
											$map_style = get_option( 'tcbd_google_map_style' );
										}else{
											$map_style = 1;
										}
									?>
									<label style="margin-bottom: 15px;" title="Style 1">
										<input type="radio" name="tcbd_google_map_style" value="1" <?php checked( $map_style, '1' ); ?> > <span class="tcbd-map-text">Style 1</span>
										<span class="tcbd-map-image"><img style="margin-top: 10px;" src="<?php echo TCBD_GOOGLE_MAP_PLUGIN_URL ?>/img/style-1.png" alt="" /></span>
									</label>
									<label style="margin-bottom: 15px;" title="Style 2">
										<input id="tcbd_google_map_style" type="radio" name="tcbd_google_map_style" value="2" <?php checked( $map_style, '2' ); ?> > <span class="tcbd-map-text">Style 2</span>
										<span class="tcbd-map-image"><img style="margin-top: 10px;" src="<?php echo TCBD_GOOGLE_MAP_PLUGIN_URL ?>/img/style-2.png" alt="" /></span>
									</label>
									<label style="margin-bottom: 15px;" title="Style 3">
										<input id="tcbd_google_map_style" type="radio" name="tcbd_google_map_style" value="3" <?php checked( $map_style, '3' ); ?> > <span class="tcbd-map-text">Style 3</span>
										<span class="tcbd-map-image"><img style="margin-top: 10px;" src="<?php echo TCBD_GOOGLE_MAP_PLUGIN_URL ?>/img/style-3.png" alt="" /></span>
									</label>
									<label style="margin-bottom: 15px;" title="Style 4">
										<input id="tcbd_google_map_style" type="radio" name="tcbd_google_map_style" value="4" <?php checked( $map_style, '4' ); ?> > <span class="tcbd-map-text">Style 4</span>
										<span class="tcbd-map-image"><img style="margin-top: 10px;" src="<?php echo TCBD_GOOGLE_MAP_PLUGIN_URL ?>/img/style-4.png" alt="" /></span>
									</label>
								</td>
                        	</tr>
							
							<tr>
								<th scope="row"><label for="tcbd_google_map_marker">ShortCode:</label></th>
								<td>
									
									<?php $shortcode = '&#91;tcbd-map&#93;'; ?>
									
									<input class="regular-text" type="text" value="<?php echo $shortcode; ?>" onfocus="this.select();">
								</td>
							</tr>
                            
                    	</tbody>
                    </table>
                    
                    <p class="submit"><input id="submit" class="button button-primary" type="submit" name="submit" value="Save Changes"></p>
                </form>
                
            </div>
        <?php
	} // settings page function

?>