<?php
/**
 * Plugin Name: orion
 * Plugin URI: https://www.yourwebsiteurl.com/
 * Description: simple custom post type and custom taxonomy maker.
 * Version: 1.0
 * Author: Mohsen Walton
 * Text Domain: orion
 * Domain Path: /languages
 * Author URI:http://dalaran-team.ir
 **/
require "includes/basic-functions.php";
isDefined();

define( 'VIEWS_PATH', plugin_dir_path( __FILE__ ) . 'views/back-view.php' );
define( 'PLUGIN_DIR', ABSPATH . 'wp-content/plugins/orion/' );

require "includes/install-functions.php";
register_activation_hook( __FILE__, 'install_orion' );








