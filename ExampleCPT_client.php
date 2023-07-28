<?php
/**
 * Plugin Name: ExampleCPT_client
 * Description: A plugin to manage ExampleCPT .
 * Version: 1.0.0
 * Author: Your Name
 * Author URI: https://mariolafuente.com
 * Text Domain: ExampleCPT_client
 */

// Exit if accessed directly
if (!defined('ABSPATH')) {
  exit;
}

define( 'ECAMPLECTP_CLIENT_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-examplectp-activator.php
 */
function activate_examplectp() {
	require_once plugin_dir_path( __FILE__ ) . '/class-examplectp-activator.php';
	examplectp_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes//class-examplectp-deactivator
 */
function deactivate_examplectp() {
	require_once plugin_dir_path( __FILE__ ) . '/class-examplectp-deactivator.php';
	examplectp_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_examplectp' );
register_deactivation_hook( __FILE__, 'deactivate_examplectp' );


require plugin_dir_path( __FILE__ ) . 'includes/post_type_entries.php';
