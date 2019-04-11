<?php
/*
Plugin Name: WP Max Upload Limiter
Plugin URI:  https://gist.github.com/iPublicis/bc173884f27088c85b9ea3c619c7341f
Description: Limiting max size of images uploaded to Wordpress.
Version:     1.0
Author:      iPublicis!COM from code by WebHostingHero
Author URI:  https://ipublicis.com 
License:     GPL2
License URI: https://www.gnu.org/licenses/gpl-3.0.txt

Plugin version created from code made by Web Hosting Hero
Check at https://www.webhostinghero.com/blog/how-to-limit-the-image-upload-size-in-wordpress/

Copyright 2019 iPublicis!COM / WebHostingHero
WP Max Upload Limiter is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 2 of the License, or
any later version.
 
WP Max Upload Limiter is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.
 
You should have received a copy of the GNU General Public License
along with WP Max Upload Limiter. If not, see (https://www.gnu.org/licenses/gpl-3.0.txt).
*/

defined( 'ABSPATH' ) OR exit;

function wpmaxuploadsizelimiter_limit_image_size($file) {

  // Calculate the image size in KB
  $image_size = $file['size']/1024;

  // File size limit in KB. You should change to the value you wish
  $limit = 800;

  // Check if it's an image
  $is_image = strpos($file['type'], 'image');

  if ( ( $image_size > $limit ) && ($is_image !== false) )
    $file['error'] = __( 'Your picture is too large. It has to be smaller than ', 'wpmaxuploadsizelimiter' ) . $limit . ' KB.';

  return $file;
}
add_filter('wp_handle_upload_prefilter', 'wpmaxuploadsizelimiter_limit_image_size');

function wpmaxuploadsizelimiter_load_textdomain() {
	load_plugin_textdomain( 'wpmaxuploadsizelimiter', false, dirname( plugin_basename(__FILE__) ) . '/' );
}
add_action('plugins_loaded', 'wpmaxuploadsizelimiter_load_textdomain');
