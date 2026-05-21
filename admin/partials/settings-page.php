<?php
/**
 * Settings page template.
 *
 * @package ConsentKit
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>

<div class="wrap consentkit-admin">

	<h1>
		<?php esc_html_e( 'ConsentKit Settings', 'maksimdedov-cookie-consent-manager' ); ?>
	</h1>

	<nav class="consentkit-tabs" aria-label="<?php esc_attr_e( 'ConsentKit settings tabs', 'maksimdedov-cookie-consent-manager' ); ?>">
		<button type="button" class="consentkit-tab is-active" data-consentkit-tab="general">
			<?php esc_html_e( 'General', 'maksimdedov-cookie-consent-manager' ); ?>
		</button>

		<button type="button" class="consentkit-tab" data-consentkit-tab="texts">
			<?php esc_html_e( 'Texts', 'maksimdedov-cookie-consent-manager' ); ?>
		</button>

		<button type="button" class="consentkit-tab" data-consentkit-tab="company">
			<?php esc_html_e( 'Company', 'maksimdedov-cookie-consent-manager' ); ?>
		</button>

		<button type="button" class="consentkit-tab" data-consentkit-tab="pages">
			<?php esc_html_e( 'Pages', 'maksimdedov-cookie-consent-manager' ); ?>
		</button>

		<button type="button" class="consentkit-tab" data-consentkit-tab="scripts">
			<?php esc_html_e( 'Scripts', 'maksimdedov-cookie-consent-manager' ); ?>
		</button>

	</nav>

	<form method="post" action="options.php">

		<?php settings_fields( 'consentkit_settings_group' ); ?>

		<div class="consentkit-tab-panel is-active" data-consentkit-panel="general">
			<?php do_settings_sections( 'consentkit_general' ); ?>
		</div>

		<div class="consentkit-tab-panel" data-consentkit-panel="texts">
			<?php do_settings_sections( 'consentkit_texts' ); ?>
		</div>

		<div class="consentkit-tab-panel" data-consentkit-panel="company">
			<?php do_settings_sections( 'consentkit_company' ); ?>
		</div>

		<div class="consentkit-tab-panel" data-consentkit-panel="pages">
			<?php do_settings_sections( 'consentkit_pages' ); ?>
		</div>

		<div class="consentkit-tab-panel" data-consentkit-panel="scripts">
			<?php do_settings_sections( 'consentkit_scripts' ); ?>
		</div>

		<?php submit_button( __( 'Save Settings', 'maksimdedov-cookie-consent-manager' ) ); ?>

	</form>

</div>