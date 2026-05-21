<?php
/**
 * Helper functions.
 *
 * @package ConsentKit
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Get default plugin settings.
 *
 * @return array
 */
function consentkit_get_default_settings() {

	return array(
		'company_name'    => '',
		'company_email'   => '',
		'company_phone'   => '',
		'company_address' => '',
		'privacy_page_id' => 0,
		'cookie_policy_page_id' => 0,

		'enable_banner'              => 1,
		'enable_modal'               => 1,
		'show_preferences_button'    => 1,
		'enable_google_consent_mode' => 0,

		'primary_color'   => '#2563eb',
		'secondary_color' => '#e5e7eb',

		'banner_title' => __( 'Cookie preferences', 'maksimdedov-cookie-consent-manager' ),

		'banner_text' => __(
			'We use cookies to improve your experience, analyze traffic, and personalize content. You can accept all cookies or manage your preferences.',
			'maksimdedov-cookie-consent-manager'
		),

		'button_accept_all'      => __( 'Accept all', 'maksimdedov-cookie-consent-manager' ),
		'button_reject'          => __( 'Reject', 'maksimdedov-cookie-consent-manager' ),
		'button_settings'        => __( 'Settings', 'maksimdedov-cookie-consent-manager' ),
		'modal_title'            => __( 'Cookie settings', 'maksimdedov-cookie-consent-manager' ),
		'button_save'            => __( 'Save preferences', 'maksimdedov-cookie-consent-manager' ),
		'button_reject_optional' => __( 'Reject optional', 'maksimdedov-cookie-consent-manager' ),

		'required_title'       => __( 'Required cookies', 'maksimdedov-cookie-consent-manager' ),
		'required_description' => __(
			'These cookies are necessary for the website to work.',
			'maksimdedov-cookie-consent-manager'
		),

		'analytics_title'       => __( 'Analytics cookies', 'maksimdedov-cookie-consent-manager' ),
		'analytics_description' => __(
			'Help us understand how visitors use the website.',
			'maksimdedov-cookie-consent-manager'
		),

		'functional_title'       => __( 'Functional cookies', 'maksimdedov-cookie-consent-manager' ),
		'functional_description' => __(
			'Enable additional features and personalization.',
			'maksimdedov-cookie-consent-manager'
		),

		'marketing_title'       => __( 'Marketing cookies', 'maksimdedov-cookie-consent-manager' ),
		'marketing_description' => __(
			'Used for ads, remarketing, and embedded third-party content.',
			'maksimdedov-cookie-consent-manager'
		),

		'cookie_expiration' => 180,

		'required_scripts'   => '',
		'analytics_scripts'  => '',
		'marketing_scripts'  => '',
		'functional_scripts' => '',
	);
}

/**
 * Get plugin settings with defaults.
 *
 * @return array
 */
function consentkit_get_settings() {

	$options = get_option( 'consentkit_settings', array() );

	if ( ! is_array( $options ) ) {
		$options = array();
	}

	return wp_parse_args(
		$options,
		consentkit_get_default_settings()
	);
}

/**
 * Get single setting value.
 *
 * @param string $key Setting key.
 * @param mixed  $default Default value.
 *
 * @return mixed
 */
function consentkit_get_setting( $key, $default = null ) {

	$settings = consentkit_get_settings();

	if ( array_key_exists( $key, $settings ) ) {
		return $settings[ $key ];
	}

	return $default;
}