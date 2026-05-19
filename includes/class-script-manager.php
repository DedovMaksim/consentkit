<?php
/**
 * Script manager class.
 *
 * @package ConsentKit
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class ConsentKit_Script_Manager {

	/**
	 * Load required scripts immediately.
	 *
	 * @return void
	 */
	public function load_required_scripts() {

		$options = consentkit_get_settings();

		if ( empty( $options['required_scripts'] ) ) {
			return;
		}

		echo "\n\n";
		
		// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		echo $this->prepare_script_output( $options['required_scripts'] ); 

		echo "\n\n";
	}

	/**
	 * Load optional scripts placeholders.
	 *
	 * @return void
	 */
	public function load_optional_scripts() {

		$options = consentkit_get_settings();

		$categories = array(
			'analytics'  => $options['analytics_scripts'] ?? '',
			'functional' => $options['functional_scripts'] ?? '',
			'marketing'  => $options['marketing_scripts'] ?? '',
		);

		echo "\n\n";

		foreach ( $categories as $category => $scripts ) {

			if ( empty( $scripts ) ) {
				continue;
			}

			$prepared_scripts = $this->prepare_script_output( $scripts );

			// Вместо base64 используем легальный rawurlencode.
			// Он кодирует пробелы и спецсимволы, делая строку безопасной для HTML-атрибута.
			$encoded_scripts = rawurlencode( $prepared_scripts );

			printf(
				'<script type="text/plain" data-consentkit-category="%1$s" data-consentkit-source="%2$s"></script>' . "\n",
				esc_attr( $category ),
				esc_attr( $encoded_scripts ) // Надежно экранируем строку внутри атрибута
			);
		}

		echo "\n";
	}

	/**
	 * Prepare script output.
	 *
	 * @param string $scripts Raw scripts.
	 *
	 * @return string
	 */
	private function prepare_script_output( $scripts ) {

		$scripts = html_entity_decode(
			(string) $scripts,
			ENT_QUOTES,
			get_bloginfo( 'charset' )
		);

		return trim( $scripts );
	}
}