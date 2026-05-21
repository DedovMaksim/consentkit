<?php
/**
 * Preferences page template.
 *
 * @package ConsentKit
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>

<div class="consentkit-preferences-page">

	<p>
		<?php esc_html_e( 'Manage your cookie settings and privacy preferences.', 'maksimdedov-cookie-consent-manager' ); ?>
	</p>

	<button
		type="button"
		class="consentkit-button consentkit-button--primary"
		data-consentkit-open-modal
	>
		<?php esc_html_e( 'Open Preferences Center', 'maksimdedov-cookie-consent-manager' ); ?>
	</button>

	<button
		type="button"
		class="consentkit-button consentkit-button--secondary"
		data-consentkit-reset
	>
		<?php esc_html_e( 'Reset preferences', 'maksimdedov-cookie-consent-manager' ); ?>
	</button>

</div>