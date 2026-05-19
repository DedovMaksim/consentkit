<?php
/**
 * Fired when the plugin is uninstalled.
 *
 * @package ConsentKit
 */

if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
	exit;
}

/**
 * Delete plugin options for a site.
 *
 * @return void
 */
function consentkit_delete_options() {

	delete_option( 'consentkit_settings' );
	delete_option( 'consentkit_version' );
	delete_option( 'consentkit_cookie_policy_page' );
	delete_option( 'consentkit_preferences_page' );
}

/**
 * Multisite cleanup.
 */
if ( is_multisite() ) {

	$consentkit_sites = get_sites(
		array(
			'fields' => 'ids',
		)
	);

	foreach ( $consentkit_sites as $consentkit_site_id ) {

		switch_to_blog( $consentkit_site_id );

		consentkit_delete_options();

		restore_current_blog();
	}
} else {

	consentkit_delete_options();
}