<?php

/**
 * Class for main settings of the plugin
 */
class KLEN_Ecomail_Main {

	/**
	 *
	 */
	public function __construct() {
		$this->actions();
	}

	/**
	 * Actions and hooks
	 *
	 * @return void
	 */
	public function actions() {
		add_action( 'admin_init', array( $this, 'setupSectionFields' ) );
		add_action( 'admin_init', array( $this, 'validateAPICredentials' ) );
	}

	/**
	 * Register settings sections
	 *
	 * @return void
	 */
	public function setupSectionFields() {

		add_settings_section(
			'klen_main_settings',
			__( 'Main Settings', 'klen' ),
			array( $this, 'sectionCallback' ),
			'klen_main'
		);

		add_settings_field(
			'klen_api_key_field',
			__( 'API Key', 'klen' ) . ' <span class="klen-label_required">*</span>',
			array( $this, 'apiFieldCallback' ),
			'klen_main',
			'klen_main_settings'
		);

		add_settings_field(
			'klen_list_id_field',
			__( 'List ID', 'klen' ) . ' <span class="klen-label_required">*</span>',
			array( $this, 'listIDFieldCallback' ),
			'klen_main',
			'klen_main_settings'
		);

		add_settings_field(
			'countFieldCallback',
			__( 'Number of subscribers', 'klen' ),
			array( $this, 'countFieldCallback' ),
			'klen_main',
			'klen_main_settings'
		);

	}

	/**
	 * Main section callback
	 *
	 * @return void
	 */
	public function sectionCallback() {
		echo __( 'The API key and list ID need to be filled in for the plugin to work properly. The number of subscribers will be shown after the API key is retrieved.', 'klen' );
	}

	/**
	 * API Key field callback
	 *
	 * @return void
	 */
	public function apiFieldCallback() {
		$api_key   = get_option( 'klen_api_key' );
		$api_valid = get_option( 'klen_api_key_validation' );

		echo '<input class="klen-input klen-input_main klen-input_main-api-key" type="text" name="klen_api_key" value="' . esc_attr__( $api_key, 'klen' ) . '" placeholder="' . __( 'ecomail-api-key', 'klen' ) . '" required>';

		if ( ! empty( $api_key ) ) {
			if ( $api_valid == true ) {
				echo '<span class="icon icon_success"></span>';
			} else {
				echo '<br><span class="klen__alert klen__alert_error" style="display: inline-block;">' . __( 'This API key is not valid, please check it again.', 'klen' ) . '</span>';
			}
		}

	}

	/**
	 * List ID field callback
	 *
	 * @return void
	 */
	public function listIDFieldCallback() {
		$list_id    = get_option( 'klen_list_id' ) === false ? 1 : get_option( 'klen_list_id' );
		$list_valid = get_option( 'klen_list_id_validation' );

		echo '<input class="klen-input klen-input_main klen-input_main-list-id" type="number" name="klen_list_id" value="' . esc_attr__( $list_id, 'klen' ) . '" required>';

		if ( ! empty( $list_id ) ) {
			if ( $list_valid == true ) {
				echo '<span class="icon icon_success"></span>';
			} else {
				echo '<br><span class="klen__alert klen__alert_error" style="display: inline-block;">' . __( 'This List ID is not valid, please check it again.', 'klen' ) . '</span>';
			}
		}
	}

	/**
	 * Count field callback
	 *
	 * @return void
	 */
	public function countFieldCallback() {
		$subscriber_count = get_option( 'klen_subscribers_count' );

		echo '<input class="klen-input klen-input_main klen-input_main-subscribers" type="number" name="klen_subscribers_count" value="' . esc_attr__( $subscriber_count, 'klen' ) . '" placeholder="' . __( 'number-of-subscribers', 'klen' ) . '" required disabled>';
	}

	/**
	 * List ID field callback
	 *
	 * @return void
	 */
	public function validateAPICredentials() {

		if ( ! empty( $_POST['klen_form_submission'] ) ) {
			// Get the submitted form data
			$api_key = sanitize_text_field( $_POST['klen_api_key'] );
			$list_id = $_POST['klen_list_id'];

			// Save the form data to the database
			update_option( 'klen_api_key', $api_key );
			update_option( 'klen_list_id', $list_id );

			// Make a call to the Ecomail API to check if the API key is valid
			$url = 'https://api2.ecomailapp.cz/lists/' . $list_id;

			$args     = array(
				'headers' => array(
					'Content-Type' => 'application/json',
					'key'          => $api_key
				),
				'timeout' => 10
			);
			$response = wp_remote_get( $url, $args );

			if ( ! is_wp_error( $response ) ) {
				$result = json_decode( $response['body'], true );
				if ( ! empty( $result['message'] ) && $result['message'] == 'Wrong api key' ) {
					// Api key is invalid and therefore list_id is invalid
					update_option( 'klen_api_key_validation', false );
					update_option( 'klen_list_id_validation', false );
					update_option( 'klen_subscribers_count', 0 );
				} elseif ( ! empty( $result['message'] ) && $result['message'] == 'Not Found!' ) {
					update_option( 'klen_list_id_validation', false );
					update_option( 'klen_subscribers_count', 0 );
				} else {
					update_option( 'klen_api_key_validation', true );
					update_option( 'klen_list_id_validation', true );
					update_option( 'klen_subscribers_count', $result['subscribers']['subscribed'] );
				}
			}

			// Display a success message
			add_settings_error( 'klen_main', 'klen_form_success', __( 'Settings saved successfully', 'klen' ), 'updated' );

		}

	}

}

new KLEN_Ecomail_Main();