<?php
/**
 * Plugin Name: ConsentKit
 * Plugin URI: https://maksimdedov.ru/cases/consentkit/
 * Description: Flexible cookie consent and privacy preferences manager for WordPress.
 * Version: 0.1.2
 * Author: Максим Дедов
 * Author URI:  https://maksimdedov.ru/
 * Text Domain: consentkit
 * Domain Path: /languages
 * Requires at least: 6.0
 * Requires PHP: 7.4
 * License: GPL-2.0-or-later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 *
 * @package ConsentKit
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'CONSENTKIT_VERSION', '0.1.2' );
define( 'CONSENTKIT_FILE', __FILE__ );
define( 'CONSENTKIT_PATH', plugin_dir_path( __FILE__ ) );
define( 'CONSENTKIT_URL', plugin_dir_url( __FILE__ ) );
define( 'CONSENTKIT_BASENAME', plugin_basename( __FILE__ ) );


require_once CONSENTKIT_PATH . 'includes/class-activator.php';
require_once CONSENTKIT_PATH . 'includes/class-deactivator.php';
require_once CONSENTKIT_PATH . 'includes/class-consentkit.php';

register_activation_hook( __FILE__, array( 'ConsentKit_Activator', 'activate' ) );
register_deactivation_hook( __FILE__, array( 'ConsentKit_Deactivator', 'deactivate' ) );

/**
 * Run the plugin.
 *
 * @return void
 */
function consentkit_run() {
	$plugin = new ConsentKit();
	$plugin->run();
}

add_action( 'plugins_loaded', 'consentkit_run', 10 );