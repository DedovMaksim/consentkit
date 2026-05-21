<?php
/**
 * Cookie modal template.
 *
 * @package ConsentKit
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$consentkit_options = consentkit_get_settings();
?>

<div class="consentkit-modal" id="consentkit-modal" hidden aria-hidden="true">
	<div class="consentkit-modal__overlay" data-consentkit-close-modal></div>

	<div
		class="consentkit-modal__dialog"
		role="dialog"
		aria-modal="true"
		aria-labelledby="consentkit-modal-title"
		tabindex="-1"
	>
		<button type="button" class="consentkit-modal__close" data-consentkit-close-modal>
			<span aria-hidden="true">&times;</span>
			<span class="screen-reader-text"><?php esc_html_e( 'Close', 'maksimdedov-cookie-consent-manager' ); ?></span>
		</button>

		<h2 id="consentkit-modal-title" class="consentkit-modal__title">
			<?php echo esc_html( $consentkit_options['modal_title'] ?? __( 'Cookie settings', 'maksimdedov-cookie-consent-manager' ) ); ?>
		</h2>

		<form class="consentkit-preferences" id="consentkit-preferences">
			<label class="consentkit-toggle">
				<input type="checkbox" checked disabled>
				<span>
					<strong><?php echo esc_html( $consentkit_options['required_title'] ?? __( 'Required cookies', 'maksimdedov-cookie-consent-manager' ) ); ?></strong>
					<small><?php echo esc_html( $consentkit_options['required_description'] ?? '' ); ?></small>
				</span>
			</label>

			<label class="consentkit-toggle">
				<input type="checkbox" name="analytics" value="1" data-consentkit-cookie-category="analytics">
				<span>
					<strong><?php echo esc_html( $consentkit_options['analytics_title'] ?? __( 'Analytics cookies', 'maksimdedov-cookie-consent-manager' ) ); ?></strong>
					<small><?php echo esc_html( $consentkit_options['analytics_description'] ?? '' ); ?></small>
				</span>
			</label>

			<label class="consentkit-toggle">
				<input type="checkbox" name="functional" value="1" data-consentkit-cookie-category="functional">
				<span>
					<strong><?php echo esc_html( $consentkit_options['functional_title'] ?? __( 'Functional cookies', 'maksimdedov-cookie-consent-manager' ) ); ?></strong>
					<small><?php echo esc_html( $consentkit_options['functional_description'] ?? '' ); ?></small>
				</span>
			</label>

			<label class="consentkit-toggle">
				<input type="checkbox" name="marketing" value="1" data-consentkit-cookie-category="marketing">
				<span>
					<strong><?php echo esc_html( $consentkit_options['marketing_title'] ?? __( 'Marketing cookies', 'maksimdedov-cookie-consent-manager' ) ); ?></strong>
					<small><?php echo esc_html( $consentkit_options['marketing_description'] ?? '' ); ?></small>
				</span>
			</label>

			<div class="consentkit-modal__actions">
				<button type="button" class="consentkit-button consentkit-button--secondary" data-consentkit-reject>
					<?php echo esc_html( $consentkit_options['button_reject_optional'] ?? __( 'Reject optional', 'maksimdedov-cookie-consent-manager' ) ); ?>
				</button>

				<button type="submit" class="consentkit-button consentkit-button--primary">
					<?php echo esc_html( $consentkit_options['button_save'] ?? __( 'Save preferences', 'maksimdedov-cookie-consent-manager' ) ); ?>
				</button>
			</div>
		</form>
		<?php
		$consentkit_privacy_page_id = absint( $consentkit_options['privacy_page_id'] ?? 0 );
		$consentkit_cookie_page_id  = absint( $consentkit_options['cookie_policy_page_id'] ?? 0 );
		?>

		<?php if ( $consentkit_privacy_page_id || $consentkit_cookie_page_id ) : ?>
			<div class="consentkit-modal__links">
				<?php if ( $consentkit_privacy_page_id ) : ?>
					<a href="<?php echo esc_url( get_permalink( $consentkit_privacy_page_id ) ); ?>">
						<?php echo esc_html( get_the_title( $consentkit_privacy_page_id ) ); ?>
					</a>
				<?php endif; ?>

				<?php if ( $consentkit_privacy_page_id && $consentkit_cookie_page_id ) : ?>
					<span> | </span>
				<?php endif; ?>

				<?php if ( $consentkit_cookie_page_id ) : ?>
					<a href="<?php echo esc_url( get_permalink( $consentkit_cookie_page_id ) ); ?>">
						<?php echo esc_html( get_the_title( $consentkit_cookie_page_id ) ); ?>
					</a>
				<?php endif; ?>
			</div>
		<?php endif; ?>
	</div>
</div>