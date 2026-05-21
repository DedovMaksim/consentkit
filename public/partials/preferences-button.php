<?php
/**
 * Preferences button template.
 *
 * @package ConsentKit
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$consentkit_options = consentkit_get_settings();

if ( empty( $consentkit_options['show_preferences_button'] ) ) {
	return;
}
?>

<div
	class="consentkit-preferences-wrapper"
	id="consentkit-preferences-wrapper"
	hidden
>
	<button
		type="button"
		class="consentkit-preferences-button"
		id="consentkit-preferences-button"
		data-consentkit-open-modal
	>
		<?php esc_html_e( 'Cookie settings', 'maksimdedov-cookie-consent-manager' ); ?>
	</button>

	<button
		type="button"
		class="consentkit-preferences-close"
		id="consentkit-preferences-close"
		aria-label="<?php esc_attr_e( 'Close cookie settings button', 'maksimdedov-cookie-consent-manager' ); ?>"
	>
		&times;
	</button>
</div>