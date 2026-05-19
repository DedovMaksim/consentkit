<?php
/**
 * Cookie policy template.
 *
 * @package ConsentKit
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$consentkit_settings = consentkit_get_settings();

$consentkit_company_name    = $consentkit_settings['company_name'] ?? '';
$consentkit_company_email   = $consentkit_settings['company_email'] ?? '';
$consentkit_company_phone   = $consentkit_settings['company_phone'] ?? '';
$consentkit_company_address = $consentkit_settings['company_address'] ?? '';
?>

<div class="consentkit-policy-page">

	<p>
		<?php esc_html_e( 'This website uses cookies to improve user experience, analyze traffic, and provide personalized content.', 'consentkit' ); ?>
	</p>

	<h2>
		<?php esc_html_e( 'What are cookies?', 'consentkit' ); ?>
	</h2>

	<p>
		<?php esc_html_e( 'Cookies are small text files stored on your device when you visit a website.', 'consentkit' ); ?>
	</p>

	<h2>
		<?php esc_html_e( 'Types of cookies we use', 'consentkit' ); ?>
	</h2>

	<ul>
		<li>
			<strong>
				<?php esc_html_e( 'Required cookies', 'consentkit' ); ?>
			</strong>
			—
			<?php esc_html_e( 'Necessary for website functionality.', 'consentkit' ); ?>
		</li>

		<li>
			<strong>
				<?php esc_html_e( 'Analytics cookies', 'consentkit' ); ?>
			</strong>
			—
			<?php
			echo esc_html(
				$consentkit_settings['analytics_title']
				?? __( 'Analytics cookies', 'consentkit' )
			);
			?>
		</li>

		<li>
			<strong>
				<?php esc_html_e( 'Functional cookies', 'consentkit' ); ?>
			</strong>
			—
			<?php
			echo esc_html(
				$consentkit_settings['functional_title']
				?? __( 'Functional cookies', 'consentkit' )
			);
			?>
		</li>

		<li>
			<strong>
				<?php esc_html_e( 'Marketing cookies', 'consentkit' ); ?>
			</strong>
			—
			<?php
			echo esc_html(
				$consentkit_settings['marketing_title']
				?? __( 'Marketing cookies', 'consentkit' )
			);
			?>
		</li>
	</ul>

	<h2>
		<?php esc_html_e( 'Managing your preferences', 'consentkit' ); ?>
	</h2>

	<p>
		<?php esc_html_e( 'You can change your cookie preferences at any time.', 'consentkit' ); ?>
	</p>

	<button
		type="button"
		class="consentkit-button consentkit-button--primary"
		data-consentkit-open-modal
	>
		<?php esc_html_e( 'Open Cookie Settings', 'consentkit' ); ?>
	</button>

	<?php if ( $consentkit_company_name || $consentkit_company_email || $consentkit_company_phone || $consentkit_company_address ) : ?>

		<hr>

		<h2>
			<?php esc_html_e( 'Company Information', 'consentkit' ); ?>
		</h2>

		<ul class="consentkit-company-info">

			<?php if ( $consentkit_company_name ) : ?>
				<li>
					<strong><?php esc_html_e( 'Company:', 'consentkit' ); ?></strong>
					<?php echo esc_html( $consentkit_company_name ); ?>
				</li>
			<?php endif; ?>

			<?php if ( $consentkit_company_email ) : ?>
				<li>
					<strong><?php esc_html_e( 'Email:', 'consentkit' ); ?></strong>

					<a href="mailto:<?php echo esc_attr( $consentkit_company_email ); ?>">
						<?php echo esc_html( $consentkit_company_email ); ?>
					</a>
				</li>
			<?php endif; ?>

			<?php if ( $consentkit_company_phone ) : ?>
				<li>
					<strong><?php esc_html_e( 'Phone:', 'consentkit' ); ?></strong>
					<?php echo esc_html( $consentkit_company_phone ); ?>
				</li>
			<?php endif; ?>

			<?php if ( $consentkit_company_address ) : ?>
				<li>
					<strong><?php esc_html_e( 'Address:', 'consentkit' ); ?></strong>
					<?php echo esc_html( $consentkit_company_address ); ?>
				</li>
			<?php endif; ?>

		</ul>

	<?php endif; ?>

</div>