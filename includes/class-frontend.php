<?php
/**
 * Frontend class.
 *
 * @package ConsentKit
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class ConsentKit_Frontend {

	/**
	 * Enqueue frontend assets.
	 *
	 * @return void
	 */
	public function enqueue_assets() {

		$options = consentkit_get_settings();

		if ( empty( $options['enable_banner'] ) && empty( $options['enable_modal'] ) ) {
			return;
		}

		wp_enqueue_style(
			'maksimdedov-cookie-consent-manager',
			CONSENTKIT_URL . 'public/css/consentkit.css',
			array(),
			CONSENTKIT_VERSION
		);

		wp_enqueue_script(
			'maksimdedov-cookie-consent-manager',
			CONSENTKIT_URL . 'public/js/consentkit.js',
			array(),
			CONSENTKIT_VERSION,
			true
		);

		wp_localize_script(
			'maksimdedov-cookie-consent-manager',
			'ConsentKitData',
			array(
				'cookieExpiration'        => absint( $options['cookie_expiration'] ?? 180 ),
				'primaryColor'            => esc_attr( $options['primary_color'] ?? '#2563eb' ),
				'enableGoogleConsentMode' => ! empty( $options['enable_google_consent_mode'] ),
			)
		);
	}

	/**
	 * Render cookie banner.
	 *
	 * @return void
	 */
	public function render_banner() {

		$options = consentkit_get_settings();

		if ( empty( $options['enable_banner'] ) ) {
			return;
		}

		require CONSENTKIT_PATH . 'public/partials/banner.php';
	}

	/**
	 * Render preferences modal.
	 *
	 * @return void
	 */
	public function render_modal() {

		$options = consentkit_get_settings();

		if ( empty( $options['enable_modal'] ) ) {
			return;
		}

		require CONSENTKIT_PATH . 'public/partials/modal.php';
	}

	/**
	 * Render floating preferences button.
	 *
	 * @return void
	 */
	public function render_preferences_button() {

		$options = consentkit_get_settings();

		if ( empty( $options['enable_modal'] ) ) {
			return;
		}

		require CONSENTKIT_PATH . 'public/partials/preferences-button.php';
	}
}