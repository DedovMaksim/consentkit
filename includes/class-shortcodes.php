<?php
/**
 * Shortcodes class.
 *
 * @package ConsentKit
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class ConsentKit_Shortcodes {

	/**
	 * Register shortcodes.
	 *
	 * @return void
	 */
	public function register() {

		add_shortcode(
			'consentkit_cookie_policy',
			array( $this, 'render_cookie_policy' )
		);

		add_shortcode(
			'consentkit_cookie_preferences',
			array( $this, 'render_cookie_preferences' )
		);

		add_shortcode(
			'md_cookie_policy',
			array( $this, 'render_cookie_policy' )
		);

		add_shortcode(
			'md_cookie_preferences',
			array( $this, 'render_cookie_preferences' )
		);
	}

	/**
	 * Render cookie policy shortcode.
	 *
	 * @return string
	 */
	public function render_cookie_policy() {

		ob_start();

		require CONSENTKIT_PATH . 'templates/policy-page.php';

		return ob_get_clean();
	}

	/**
	 * Render cookie preferences shortcode.
	 *
	 * @return string
	 */
	public function render_cookie_preferences() {

		ob_start();

		require CONSENTKIT_PATH . 'templates/preferences-page.php';

		return ob_get_clean();
	}
}