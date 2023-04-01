<?php

/**
 * Class for main settings of the plugin
 */
class KLEN_Ecomail_Main
{

	/**
	 *
	 */
	public function __construct()
	{
		$this->actions();
	}

	/**
	 * Actions and hooks
	 *
	 * @return void
	 */
	public function actions()
	{
		add_action('admin_init', array( $this, 'setupSectionFields' ) );
	}

	/**
	 * Register settings sections
	 *
	 * @return void
	 */
	public function setupSectionFields()
	{

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
	public function sectionCallback()
	{
		echo __( 'The API key and list ID need to be filled in for the plugin to work properly. The number of subscribers will be shown after the API key is retrieved.', 'klen' );
	}

	/**
	 * API Key field callback
	 *
	 * @return void
	 */
	public function apiFieldCallback()
	{
		$api_key = get_option( 'klen_api_key' );
        $api_valid = get_option('klen_api_key_validation');

        if (!empty($api_key) && empty($api_valid)) {

            // Make a call to the Ecomail API to check if the API key is valid
            $url = 'https://api2.ecomailapp.cz/lists';

            $args = array(
                'headers' => array(
                    'Content-Type' => 'application/json',
                    'key' => $api_key
                ),
                'timeout' => 10
            );
            $response = wp_remote_get($url, $args);

            if (!is_wp_error($response)) {
                $result = json_decode($response['body'], true);
                if(!empty($result['message']) && $result['message'] == 'Wrong api key') {
                    // API key is invalid
                    update_option('klen_api_key_validation', false);
                    $api_valid = false;
                }
                else {
                    // API key is valid
                    update_option('klen_api_key_validation', true);
                    $api_valid = true;
                }
            } else {
                // API call failed
                add_settings_error('klen_api_key', 'klen_api_key_error', __('API call failed', 'klen_admin'));
            }
        }

		echo '<input class="klen-input klen-input_main klen-input_main-api-key" type="text" name="klen_api_key" value="' . esc_attr__( $api_key, 'klen' ) . '" placeholder="' . __( 'ecomail-api-key', 'klen' ) . '" required>';

        if($api_valid === true) {
            echo '<span class="icon icon_success"></span>';
        }
        else {
            echo '<br><span class="klen__alert klen__alert_error" style="display: inline-block;">' . __( 'This API key is not valid, please check it again.', 'klen' ) . '</span>';
        }

	}

	/**
	 * List ID field callback
	 *
	 * @return void
	 */
	public function listIDFieldCallback()
	{
		$list_id = get_option( 'klen_list_id' ) === false ? 1 : get_option( 'klen_list_id' );
		
		echo '<input class="klen-input klen-input_main klen-input_main-list-id" type="number" name="klen_list_id" value="' . esc_attr__( $list_id, 'klen' ) . '" required>';

		echo '<span class="icon icon_success"></span>';

		echo '<br><span class="klen__alert klen__alert_error" style="display: inline-block;">' . __( 'This List ID is not valid, please check it again.', 'klen' ) . '</span>';
	}

	/**
	 * List ID field callback
	 *
	 * @return void
	 */
	public function countFieldCallback()
	{
		$subscriber_count = get_option('klen_subscribers_count');

		echo '<input class="klen-input klen-input_main klen-input_main-subscribers" type="number" name="klen_subscribers_count" value="' . esc_attr__( $subscriber_count, 'klen' ) . '" placeholder="' . __( 'number-of-subscribers', 'klen' ) . '" required disabled>';
	}

}

new KLEN_Ecomail_Main();