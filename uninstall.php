<?php

// Exit if accessed directly
	defined( 'ABSPATH' ) || exit;

/* Uninstall Plugin */

// if not uninstalled plugin
if( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) 
	exit(); // out!


/*esle:
	if uninstalled plugin, this options will be deleted
*/
delete_option('tcbd_google_map_latitude');
delete_option('tcbd_google_map_longitude');
delete_option('tcbd_google_map_zoom');
delete_option('tcbd_google_map_marker');
delete_option('tcbd_google_map_style');
delete_option('tcbd_google_map_scroll_zoom');
delete_option('tcbd_google_map_api_key');