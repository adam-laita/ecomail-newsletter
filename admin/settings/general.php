<?php

/**
 * Class for general settings of the plugin
 */
class KLEN_Ecomail_General
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
        add_action('admin_init', array($this, 'fields_setup'));
    }

    /**
     * Register settings sections
     *
     * @return void
     */
    public function fields_setup()
    {

        add_settings_section(
            'klen_general_settings',
            __('General Settings', 'klen_admin'),
            array($this, 'klen_general_section_callback'),
            'klen_general'
        );

        add_settings_field(
            'klen_api_key_field',
            __('API Key', 'klen_admin'),
            array($this, 'klen_api_key_field_callback'),
            'klen_general',
            'klen_general_settings'
        );

        add_settings_field(
            'klen_list_id_field',
            __('List ID', 'klen_admin'),
            array($this, 'klen_list_id_field_callback'),
            'klen_general',
            'klen_general_settings'
        );

    }

    /**
     * General section callback
     *
     * @return void
     */
    public function klen_general_section_callback()
    {
        echo __('General settings for Ecomail Newsletter', 'klen_admin');
    }

    /**
     * API Key field callback
     *
     * @return void
     */
    public function klen_api_key_field_callback()
    {
        $api_key = get_option('klen_api_key');
        echo '<input type="text" name="klen_api_key" value="' . esc_attr__($api_key, 'klen_admin') . '"/>';
    }

    /**
     * List ID field callback
     *
     * @return void
     */
    public function klen_list_id_field_callback()
    {
        $list_id = get_option('klen_list_id');
        echo '<input type="text" name="klen_list_id" value="' . esc_attr__($list_id, 'klen_admin') . '"/>';
    }

}

new KLEN_Ecomail_General();