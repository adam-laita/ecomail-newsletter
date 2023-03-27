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
		add_action('admin_init', array( $this, 'fields_setup' ) );
	}

	/**
	 * Register settings sections
	 *
	 * @return void
	 */
	public function fields_setup()
	{

		add_settings_section(
			'klen_main_settings',
			__( 'Main Settings', 'klen' ),
			array( $this, 'klen_main_section_callback' ),
			'klen_main'
		);

		add_settings_field(
			'klen_api_key_field',
			__( 'API Key', 'klen' ) . ' <span class="klen-label_required">*</span>',
			array( $this, 'klen_api_key_field_callback' ),
			'klen_main',
			'klen_main_settings'
		);

		add_settings_field(
			'klen_list_id_field',
			__( 'List ID', 'klen' ) . ' <span class="klen-label_required">*</span>',
			array( $this, 'klen_list_id_field_callback' ),
			'klen_main',
			'klen_main_settings'
		);

		add_settings_field(
			'klen_subscriber_count_field',
			__( 'Number of subscribers', 'klen' ),
			array( $this, 'klen_subscriber_count_field' ),
			'klen_main',
			'klen_main_settings'
		);

	}

	/**
	 * Main section callback
	 *
	 * @return void
	 */
	public function klen_main_section_callback()
	{
		echo __( 'The API key and list ID need to be filled in for the plugin to work properly. The number of subscribers will be shown after the API key is retrieved.', 'klen' );
	}

	/**
	 * API Key field callback
	 *
	 * @return void
	 */
	public function klen_api_key_field_callback()
	{
		$api_key = get_option( 'klen_api_key' );

		echo '<input class="klen-input klen-input_main klen-input_main-api-key" type="text" name="klen_api_key" value="' . esc_attr__( $api_key, 'klen' ) . '" placeholder="' . __( 'ecomail-api-key', 'klen' ) . '" required>';
	}

	/**
	 * List ID field callback
	 *
	 * @return void
	 */
	public function klen_list_id_field_callback()
	{
		$list_id = get_option( 'klen_list_id' ) === false ? 1 : get_option( 'klen_list_id' );
		
		echo '<input class="klen-input klen-input_main klen-input_main-list-id" type="number" name="klen_list_id" value="' . esc_attr__( $list_id, 'klen' ) . '" required>';
	}

	/**
	 * List ID field callback
	 *
	 * @return void
	 */
	public function klen_subscriber_count_field()
	{
		$subscriber_count = get_option('klen_subscribers_count');

		echo '<input class="klen-input klen-input_main klen-input_main-subscribers" type="number" name="klen_subscribers_count" value="' . esc_attr__( $subscriber_count, 'klen' ) . '" placeholder="' . __( 'number-of-subscribers', 'klen' ) . '" required disabled>';
	}

}

new KLEN_Ecomail_Main();