<?php
/**
 * Settings class.
 *
 * @package ConsentKit
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class ConsentKit_Settings {

	private $option_name = 'consentkit_settings';

	public function register_settings() {

		register_setting(
			'consentkit_settings_group',
			$this->option_name,
			array( $this, 'sanitize_settings' )
		);

		$this->register_general_section();
		$this->register_texts_section();
		$this->register_company_section();
		$this->register_pages_section();
		$this->register_scripts_section();
	}

	private function register_general_section() {

		$page = 'consentkit_general';

		add_settings_section(
			'consentkit_general_section',
			__( 'General Settings', 'consentkit' ),
			'__return_false',
			$page
		);

		$this->add_field( 'enable_banner', __( 'Enable Banner', 'consentkit' ), 'checkbox', 'consentkit_general_section', $page );
		$this->add_field( 'enable_modal', __( 'Enable Preferences Modal', 'consentkit' ), 'checkbox', 'consentkit_general_section', $page );
		$this->add_field( 'show_preferences_button', __( 'Show Floating Preferences Button', 'consentkit' ), 'checkbox', 'consentkit_general_section', $page );
		$this->add_field( 'enable_google_consent_mode', __( 'Enable Google Consent Mode v2', 'consentkit' ), 'checkbox', 'consentkit_general_section', $page );
		$this->add_field( 'cookie_expiration', __( 'Cookie Expiration (days)', 'consentkit' ), 'number', 'consentkit_general_section', $page );
		$this->add_field( 'primary_color', __( 'Primary Color', 'consentkit' ), 'color', 'consentkit_general_section', $page );
	}

	private function register_texts_section() {

		$page = 'consentkit_texts';

		add_settings_section(
			'consentkit_texts_section',
			__( 'Texts', 'consentkit' ),
			'__return_false',
			$page
		);

		$this->add_field( 'banner_title', __( 'Banner Title', 'consentkit' ), 'text', 'consentkit_texts_section', $page );
		$this->add_field( 'banner_text', __( 'Banner Text', 'consentkit' ), 'textarea', 'consentkit_texts_section', $page );
		$this->add_field( 'button_accept_all', __( 'Accept All Button', 'consentkit' ), 'text', 'consentkit_texts_section', $page );
		$this->add_field( 'button_reject', __( 'Reject Button', 'consentkit' ), 'text', 'consentkit_texts_section', $page );
		$this->add_field( 'button_settings', __( 'Settings Button', 'consentkit' ), 'text', 'consentkit_texts_section', $page );
		$this->add_field( 'modal_title', __( 'Modal Title', 'consentkit' ), 'text', 'consentkit_texts_section', $page );
		$this->add_field( 'button_save', __( 'Save Preferences Button', 'consentkit' ), 'text', 'consentkit_texts_section', $page );
		$this->add_field( 'button_reject_optional', __( 'Reject Optional Button', 'consentkit' ), 'text', 'consentkit_texts_section', $page );

		$this->add_field( 'required_title', __( 'Required Category Title', 'consentkit' ), 'text', 'consentkit_texts_section', $page );
		$this->add_field( 'required_description', __( 'Required Category Description', 'consentkit' ), 'textarea', 'consentkit_texts_section', $page );

		$this->add_field( 'analytics_title', __( 'Analytics Category Title', 'consentkit' ), 'text', 'consentkit_texts_section', $page );
		$this->add_field( 'analytics_description', __( 'Analytics Category Description', 'consentkit' ), 'textarea', 'consentkit_texts_section', $page );

		$this->add_field( 'functional_title', __( 'Functional Category Title', 'consentkit' ), 'text', 'consentkit_texts_section', $page );
		$this->add_field( 'functional_description', __( 'Functional Category Description', 'consentkit' ), 'textarea', 'consentkit_texts_section', $page );

		$this->add_field( 'marketing_title', __( 'Marketing Category Title', 'consentkit' ), 'text', 'consentkit_texts_section', $page );
		$this->add_field( 'marketing_description', __( 'Marketing Category Description', 'consentkit' ), 'textarea', 'consentkit_texts_section', $page );
	}

	private function register_company_section() {

		$page = 'consentkit_company';

		add_settings_section(
			'consentkit_company_section',
			__( 'Company Information', 'consentkit' ),
			'__return_false',
			$page
		);

		$this->add_field( 'company_name', __( 'Company Name', 'consentkit' ), 'text', 'consentkit_company_section', $page );
		$this->add_field( 'company_email', __( 'Company Email', 'consentkit' ), 'email', 'consentkit_company_section', $page );
		$this->add_field( 'company_phone', __( 'Company Phone', 'consentkit' ), 'text', 'consentkit_company_section', $page );
		$this->add_field( 'company_address', __( 'Company Address', 'consentkit' ), 'textarea', 'consentkit_company_section', $page );
	}

	private function register_pages_section() {

		$page = 'consentkit_pages';

		add_settings_section(
			'consentkit_pages_section',
			__( 'Pages', 'consentkit' ),
			'__return_false',
			$page
		);

		$this->add_field( 'privacy_page_id', __( 'Privacy Policy Page', 'consentkit' ), 'select_pages', 'consentkit_pages_section', $page );
$this->add_field( 'cookie_policy_page_id', __( 'Cookie Policy Page', 'consentkit' ), 'select_pages', 'consentkit_pages_section', $page );
	}

	private function register_scripts_section() {

		$page = 'consentkit_scripts';

		add_settings_section(
			'consentkit_scripts_section',
			__( 'Scripts', 'consentkit' ),
			'__return_false',
			$page
		);

		$this->add_field( 'required_scripts', __( 'Required Scripts', 'consentkit' ), 'textarea', 'consentkit_scripts_section', $page );
		$this->add_field( 'analytics_scripts', __( 'Analytics Scripts', 'consentkit' ), 'textarea', 'consentkit_scripts_section', $page );
		$this->add_field( 'functional_scripts', __( 'Functional Scripts', 'consentkit' ), 'textarea', 'consentkit_scripts_section', $page );
		$this->add_field( 'marketing_scripts', __( 'Marketing Scripts', 'consentkit' ), 'textarea', 'consentkit_scripts_section', $page );
	}

	private function add_field( $id, $label, $type, $section, $page ) {

		add_settings_field(
			$id,
			$label,
			array( $this, 'render_field' ),
			$page,
			$section,
			array(
				'id'          => $id,
				'type'        => $type,
				'description' => $this->get_field_description( $id ),
			)
		);
	}

	/**
	 * Render field html based on type.
	 *
	 * @param array $args Field arguments.
	 * @return void
	 */
	public function render_field( $args ) {

		$options = consentkit_get_settings();
		$id      = $args['id'];
		$type    = $args['type'];
		$name    = "{$this->option_name}[{$id}]";
		$value   = $options[$id] ?? $args['default'] ?? '';

		switch ( $type ) {

			case 'checkbox':
				printf(
					'<input type="checkbox" id="%1$s" name="%2$s" value="1" %3$s>',
					esc_attr( $id ),
					esc_attr( $name ),
					checked( 1, $value, false )
				);
				break;

			case 'text':
				printf(
					'<input type="text" id="%1$s" name="%2$s" value="%3$s" class="regular-text">',
					esc_attr( $id ),
					esc_attr( $name ),
					esc_attr( $value )
				);
				break;

			case 'color':
				printf(
					'<input type="color" id="%1$s" name="%2$s" value="%3$s">',
					esc_attr( $id ),
					esc_attr( $name ),
					esc_attr( $value )
				);
				break;

			case 'number':
				printf(
					'<input type="number" id="%1$s" name="%2$s" value="%3$s" class="small-text">',
					esc_attr( $id ),
					esc_attr( $name ),
					absint( $value )
				);
				break;

			case 'textarea':
				printf(
					'<textarea id="%1$s" name="%2$s" rows="5" cols="50" class="large-text">%3$s</textarea>',
					esc_attr( $id ),
					esc_attr( $name ),
					esc_textarea( $value )
				);
				break;

			case 'select_pages':
				wp_dropdown_pages(
					array(
						// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
						'name'             => $name,
						'show_option_none' => esc_html__( 'Select a page', 'consentkit' ),
						'option_none_value' => '0',
						'selected'         => absint( $value ),
					)
				);
				break;

			case 'script':
				printf(
					'<textarea id="%1$s" name="%2$s" rows="8" cols="50" class="large-text code">%3$s</textarea>',
					esc_attr( $id ),
					esc_attr( $name ),
					esc_textarea( $value )
				);
				break;
		}

		if ( ! empty( $args['description'] ) ) {
			printf(
				'<p class="description">%s</p>',
				esc_html( $args['description'] )
			);
		}
	}

	private function get_field_description( $id ) {

		$descriptions = array(
			'banner_title'           => __( 'Main title shown in the cookie banner.', 'consentkit' ),
			'banner_text'            => __( 'Main message shown in the cookie banner.', 'consentkit' ),
			'button_accept_all'      => __( 'Text for the accept all button.', 'consentkit' ),
			'button_reject'          => __( 'Text for the reject button.', 'consentkit' ),
			'button_settings'        => __( 'Text for the settings button.', 'consentkit' ),
			'modal_title'            => __( 'Title shown at the top of the preferences modal.', 'consentkit' ),
			'button_save'            => __( 'Text for the save preferences button.', 'consentkit' ),
			'button_reject_optional' => __( 'Text for the reject optional cookies button.', 'consentkit' ),

			'required_title'         => __( 'Title for required cookies category.', 'consentkit' ),
			'required_description'   => __( 'Description for required cookies category.', 'consentkit' ),
			'analytics_title'        => __( 'Title for analytics cookies category.', 'consentkit' ),
			'analytics_description'  => __( 'Description for analytics cookies category.', 'consentkit' ),
			'functional_title'       => __( 'Title for functional cookies category.', 'consentkit' ),
			'functional_description' => __( 'Description for functional cookies category.', 'consentkit' ),
			'marketing_title'        => __( 'Title for marketing cookies category.', 'consentkit' ),
			'marketing_description'  => __( 'Description for marketing cookies category.', 'consentkit' ),

			'enable_banner'              => __( 'Show the cookie consent banner on the frontend.', 'consentkit' ),
			'enable_modal'               => __( 'Allow visitors to manage cookie categories in a preferences modal.', 'consentkit' ),
			'show_preferences_button' => __( 'Show a floating button that allows visitors to reopen cookie preferences.', 'consentkit' ),
			'enable_google_consent_mode' => __( 'Enable Google Consent Mode v2. ConsentKit will send default denied consent and update it after the visitor makes a choice.', 'consentkit' ),
			'cookie_expiration'          => __( 'Number of days before the visitor will be asked for consent again.', 'consentkit' ),
			'primary_color'              => __( 'Main color used for primary buttons and checkboxes.', 'consentkit' ),
			'company_name'               => __( 'Legal name of the company or website owner.', 'consentkit' ),
			'company_email'              => __( 'Contact email shown on the cookie policy page.', 'consentkit' ),
			'company_phone'              => __( 'Optional contact phone shown on the cookie policy page.', 'consentkit' ),
			'company_address'            => __( 'Legal or contact address shown on the cookie policy page.', 'consentkit' ),
			'privacy_page_id'            => __( 'Select your privacy policy page. This link can be shown in the cookie banner and preferences modal.', 'consentkit' ),
			'cookie_policy_page_id'      => __( 'Select your cookie policy page. This link can be shown in the cookie banner and preferences modal.', 'consentkit' ),
			'required_scripts'           => __( 'Scripts that are necessary for the website to work. They are loaded immediately and do not wait for consent.', 'consentkit' ),
			'analytics_scripts'          => __( 'Analytics scripts, such as GA4, Matomo, or Yandex Metrica. They are loaded only after analytics consent.', 'consentkit' ),
			'functional_scripts'         => __( 'Functional scripts, such as chat widgets, maps, embedded media, or personalization tools.', 'consentkit' ),
			'marketing_scripts'          => __( 'Marketing scripts, such as advertising pixels, remarketing tags, or conversion tracking.', 'consentkit' ),
		);

		return $descriptions[ $id ] ?? '';
	}

	private function sanitize_script_field( $value ) {

		if ( ! current_user_can( 'manage_options' ) ) {
			return '';
		}

		$value = trim( wp_unslash( (string) $value ) );

		if ( empty( $value ) ) {
			return '';
		}

		if ( current_user_can( 'unfiltered_html' ) ) {
			return $value;
		}

		return wp_kses_post( $value );
	}


	public function sanitize_settings( $input ) {

		$sanitized = array();

		$sanitized['enable_banner']              = ! empty( $input['enable_banner'] ) ? 1 : 0;
		$sanitized['enable_modal']               = ! empty( $input['enable_modal'] ) ? 1 : 0;
		$sanitized['enable_google_consent_mode'] = ! empty( $input['enable_google_consent_mode'] ) ? 1 : 0;

		$sanitized['show_preferences_button'] = ! empty( $input['show_preferences_button'] ) ? 1 : 0;

		$sanitized['banner_title'] = sanitize_text_field(
			$input['banner_title'] ?? __( 'Cookie preferences', 'consentkit' )
		);

		$sanitized['banner_text'] = sanitize_textarea_field(
			$input['banner_text'] ?? ''
		);

		$sanitized['button_accept_all'] = sanitize_text_field(
			$input['button_accept_all'] ?? __( 'Accept all', 'consentkit' )
		);

		$sanitized['button_reject'] = sanitize_text_field(
			$input['button_reject'] ?? __( 'Reject', 'consentkit' )
		);

		$sanitized['button_settings'] = sanitize_text_field(
			$input['button_settings'] ?? __( 'Settings', 'consentkit' )
		);

		$sanitized['modal_title'] = sanitize_text_field(
			$input['modal_title'] ?? __( 'Cookie settings', 'consentkit' )
		);

		$sanitized['button_save'] = sanitize_text_field(
			$input['button_save'] ?? __( 'Save preferences', 'consentkit' )
		);

		$sanitized['button_reject_optional'] = sanitize_text_field(
			$input['button_reject_optional'] ?? __( 'Reject optional', 'consentkit' )
		);

		$sanitized['required_title'] = sanitize_text_field(
			$input['required_title'] ?? __( 'Required cookies', 'consentkit' )
		);

		$sanitized['required_description'] = sanitize_textarea_field(
			$input['required_description'] ?? ''
		);

		$sanitized['analytics_title'] = sanitize_text_field(
			$input['analytics_title'] ?? __( 'Analytics cookies', 'consentkit' )
		);

		$sanitized['analytics_description'] = sanitize_textarea_field(
			$input['analytics_description'] ?? ''
		);

		$sanitized['functional_title'] = sanitize_text_field(
			$input['functional_title'] ?? __( 'Functional cookies', 'consentkit' )
		);

		$sanitized['functional_description'] = sanitize_textarea_field(
			$input['functional_description'] ?? ''
		);

		$sanitized['marketing_title'] = sanitize_text_field(
			$input['marketing_title'] ?? __( 'Marketing cookies', 'consentkit' )
		);

		$sanitized['marketing_description'] = sanitize_textarea_field(
			$input['marketing_description'] ?? ''
		);

		$sanitized['company_name']    = sanitize_text_field( $input['company_name'] ?? '' );
		$sanitized['company_email']   = sanitize_email( $input['company_email'] ?? '' );
		$sanitized['company_phone']   = sanitize_text_field( $input['company_phone'] ?? '' );
		$sanitized['company_address'] = sanitize_textarea_field( $input['company_address'] ?? '' );

		$sanitized['privacy_page_id'] = absint( $input['privacy_page_id'] ?? 0 );
		$sanitized['cookie_policy_page_id'] = absint( $input['cookie_policy_page_id'] ?? 0 );

		$cookie_expiration                = absint( $input['cookie_expiration'] ?? 180 );
		$sanitized['cookie_expiration'] = $cookie_expiration > 0 ? $cookie_expiration : 180;

		$primary_color              = sanitize_hex_color( $input['primary_color'] ?? '#2563eb' );
		$sanitized['primary_color'] = $primary_color ? $primary_color : '#2563eb';

		$sanitized['required_scripts'] = $this->sanitize_script_field(
			$input['required_scripts'] ?? ''
		);

		$sanitized['analytics_scripts'] = $this->sanitize_script_field(
			$input['analytics_scripts'] ?? ''
		);

		$sanitized['functional_scripts'] = $this->sanitize_script_field(
			$input['functional_scripts'] ?? ''
		);

		$sanitized['marketing_scripts'] = $this->sanitize_script_field(
			$input['marketing_scripts'] ?? ''
		);

		return $sanitized;
	}
}