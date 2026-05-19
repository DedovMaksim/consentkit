<?php
/**
 * Cookie banner template.
 *
 * @package ConsentKit
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$consentkit_options = consentkit_get_settings();
?>

<div class="consentkit-banner" id="consentkit-banner" hidden>
	<div class="consentkit-banner__content">
		<h2 class="consentkit-banner__title">
			<?php echo esc_html( $consentkit_options['banner_title'] ?? __( 'Cookie preferences', 'consentkit' ) ); ?>
		</h2>

		<p class="consentkit-banner__text">
			<?php echo esc_html( $consentkit_options['banner_text'] ?? '' ); ?>
		</p>

		<?php
		$consentkit_privacy_page_id = absint( $consentkit_options['privacy_page_id'] ?? 0 );
		$consentkit_cookie_page_id  = absint( $consentkit_options['cookie_policy_page_id'] ?? 0 );
		?>

		<?php if ( $consentkit_privacy_page_id || $consentkit_cookie_page_id ) : ?>
			<div class="consentkit-banner__links">

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

	<div class="consentkit-banner__actions">
		<button type="button" class="consentkit-button consentkit-button--secondary" data-consentkit-open-modal>
			<?php echo esc_html( $consentkit_options['button_settings'] ?? __( 'Settings', 'consentkit' ) ); ?>
		</button>

		<button type="button" class="consentkit-button consentkit-button--primary" data-consentkit-accept-all>
			<?php echo esc_html( $consentkit_options['button_accept_all'] ?? __( 'Accept all', 'consentkit' ) ); ?>
		</button>
	</div>
</div>