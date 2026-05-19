<?php
/**
 * Admin page class.
 *
 * @package ConsentKit
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class ConsentKit_Admin_Page {

	/**
	 * Add admin menu page.
	 *
	 * @return void
	 */
	public function add_menu_page() {

		add_menu_page(
			__( 'ConsentKit', 'consentkit' ),
			__( 'ConsentKit', 'consentkit' ),
			'manage_options',
			'consentkit',
			array( $this, 'render_page' ),
			'dashicons-shield',
			81
		);
	}

	/**
	 * Enqueue admin assets.
	 *
	 * @param string $hook Current admin hook.
	 *
	 * @return void
	 */
	public function enqueue_assets( $hook ) {

		if ( 'toplevel_page_consentkit' !== $hook ) {
			return;
		}

		wp_enqueue_style(
			'consentkit-admin',
			CONSENTKIT_URL . 'admin/css/admin.css',
			array(),
			CONSENTKIT_VERSION
		);

		wp_enqueue_script(
			'consentkit-admin',
			CONSENTKIT_URL . 'admin/js/admin.js',
			array( 'jquery' ),
			CONSENTKIT_VERSION,
			true
		);
	}

	/**
	 * Render admin page.
	 *
	 * @return void
	 */
	public function render_page() {

		if ( ! current_user_can( 'manage_options' ) ) {
			return;
		}

		require_once CONSENTKIT_PATH . 'admin/partials/settings-page.php';
	}
}