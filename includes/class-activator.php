<?php
/**
 * Plugin activator.
 *
 * @package ConsentKit
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class ConsentKit_Activator {

	/**
	 * Run on plugin activation.
	 *
	 * @return void
	 */
	public static function activate() {

		if ( ! function_exists( 'consentkit_get_default_settings' ) ) {
			require_once CONSENTKIT_PATH . 'includes/helpers.php';
		}

		if ( ! get_option( 'consentkit_settings' ) ) {
			add_option( 'consentkit_settings', consentkit_get_default_settings() );
		}

		if ( ! get_option( 'consentkit_version' ) ) {
			add_option( 'consentkit_version', CONSENTKIT_VERSION );
		}

		self::create_pages();

		flush_rewrite_rules();
	}

	/**
	 * Create service pages.
	 *
	 * @return void
	 */
	private static function create_pages() {

		$pages = array(

			'consentkit_cookie_policy_page' => array(
				'title'     => __( 'Cookie Policy', 'maksimdedov-cookie-consent-manager' ),
				'slug'      => 'cookie-policy',
				'shortcode' => '[consentkit_cookie_policy]',
			),

			'consentkit_preferences_page' => array(
				'title'     => __( 'Cookie Preferences', 'maksimdedov-cookie-consent-manager' ),
				'slug'      => 'cookie-preferences',
				'shortcode' => '[consentkit_cookie_preferences]',
			),

		);

		foreach ( $pages as $option_name => $page ) {

			$existing_page_id = self::find_existing_page(
				$page['slug'],
				$page['shortcode']
			);

			if ( $existing_page_id ) {
				update_option( $option_name, $existing_page_id );
				continue;
			}

			$new_page_id = wp_insert_post(
				array(
					'post_title'   => $page['title'],
					'post_name'    => $page['slug'],
					'post_content' => $page['shortcode'],
					'post_status'  => 'publish',
					'post_type'    => 'page',
				)
			);

			if ( $new_page_id && ! is_wp_error( $new_page_id ) ) {
				update_option( $option_name, $new_page_id );
			}
		}
	}

	/**
	 * Find existing page by slug or shortcode.
	 *
	 * @param string $slug      Page slug.
	 * @param string $shortcode Page shortcode.
	 *
	 * @return int|false
	 */
	private static function find_existing_page( $slug, $shortcode ) {

		$page_by_path = get_page_by_path( $slug );

		if ( $page_by_path ) {
			return (int) $page_by_path->ID;
		}

		$shortcode_tag = str_replace(
			array( '[', ']' ),
			'',
			$shortcode
		);

		$pages = get_posts(
			array(
				'post_type'      => 'page',
				'post_status'    => 'publish',
				'posts_per_page' => -1,
				'fields'         => 'ids',
			)
		);

		foreach ( $pages as $page_id ) {

			$content = get_post_field( 'post_content', $page_id );

			if ( has_shortcode( $content, $shortcode_tag ) ) {
				return (int) $page_id;
			}
		}

		return false;
	}
}