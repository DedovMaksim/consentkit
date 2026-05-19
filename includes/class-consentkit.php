<?php
/**
 * Main plugin class.
 *
 * @package ConsentKit
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class ConsentKit {

	/**
	 * Storage for plugin components.
	 */
	private $settings;
	private $admin_page;
	private $frontend;
	private $script_manager;
	private $shortcodes;

	/**
	 * Constructor.
	 */
	public function __construct() {
		$this->load_dependencies();
	}

	/**
	 * Load required files.
	 *
	 * @return void
	 */
	private function load_dependencies() {
		require_once CONSENTKIT_PATH . 'includes/helpers.php';
		require_once CONSENTKIT_PATH . 'includes/class-settings.php';
		require_once CONSENTKIT_PATH . 'includes/class-admin-page.php';
		require_once CONSENTKIT_PATH . 'includes/class-frontend.php';
		require_once CONSENTKIT_PATH . 'includes/class-script-manager.php';
		require_once CONSENTKIT_PATH . 'includes/class-shortcodes.php';
	}

	/**
	 * Register admin hooks.
	 *
	 * @return void
	 */
	private function define_admin_hooks() {
		$this->settings   = new ConsentKit_Settings();
		$this->admin_page = new ConsentKit_Admin_Page();

		add_action( 'admin_init', array( $this->settings, 'register_settings' ) );
		add_action( 'admin_menu', array( $this->admin_page, 'add_menu_page' ) );
		add_action( 'admin_enqueue_scripts', array( $this->admin_page, 'enqueue_assets' ) );
	}

	/**
	 * Register frontend hooks.
	 *
	 * @return void
	 */
	private function define_public_hooks() {
		$this->frontend       = new ConsentKit_Frontend();
		$this->script_manager = new ConsentKit_Script_Manager();
		$this->shortcodes     = new ConsentKit_Shortcodes();

		add_action( 'wp_enqueue_scripts', array( $this->frontend, 'enqueue_assets' ) );

		add_action( 'wp_footer', array( $this->frontend, 'render_banner' ) );
		add_action( 'wp_footer', array( $this->frontend, 'render_modal' ) );
		add_action( 'wp_footer', array( $this->frontend, 'render_preferences_button' ), 20 );

		add_action( 'wp_head', array( $this->script_manager, 'load_required_scripts' ), 1 );
		add_action( 'wp_footer', array( $this->script_manager, 'load_optional_scripts' ), 999 );

		$this->shortcodes->register();
	}

	/**
	 * Run plugin.
	 *
	 * @return void
	 */
	public function run() {
		$this->define_admin_hooks();
		$this->define_public_hooks();
	}
}