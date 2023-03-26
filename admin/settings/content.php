<?php

/**
 * Class for content settings of the plugin
 */
class KLEN_Ecomail_Content
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
            'klen_content_settings',
            __('Content Settings', 'klen_admin'),
            array($this, 'klen_content_section_callback'),
            'klen_content'
        );

        add_settings_field(
            'klen_content_title_field',
            __('Title', 'klen_admin'),
            array($this, 'klen_content_title_field_callback'),
            'klen_content',
            'klen_content_settings'
        );

        add_settings_field(
            'klen_content_desc_field',
            __('Description', 'klen_admin'),
            array($this, 'klen_content_desc_field_callback'),
            'klen_content',
            'klen_content_settings'
        );

        add_settings_field(
            'klen_content_label_field',
            __('Label', 'klen_admin'),
            array($this, 'klen_content_label_field_callback'),
            'klen_content',
            'klen_content_settings'
        );

        add_settings_field(
            'klen_content_placeholder_field',
            __('Placeholder', 'klen_admin'),
            array($this, 'klen_content_placeholder_field_callback'),
            'klen_content',
            'klen_content_settings'
        );

        add_settings_field(
            'klen_content_button_field',
            __('Button Text', 'klen_admin'),
            array($this, 'klen_content_button_field_callback'),
            'klen_content',
            'klen_content_settings'
        );

        add_settings_field(
            'klen_content_success_field',
            __('Success Message', 'klen_admin'),
            array($this, 'klen_content_success_field_callback'),
            'klen_content',
            'klen_content_settings'
        );

        add_settings_field(
            'klen_content_error_field',
            __('Error Message', 'klen_admin'),
            array($this, 'klen_content_error_field_callback'),
            'klen_content',
            'klen_content_settings'
        );

        add_settings_field(
            'klen_content_warning_field',
            __('Warning Message', 'klen_admin'),
            array($this, 'klen_content_warning_field_callback'),
            'klen_content',
            'klen_content_settings'
        );

    }

    /**
     * Content section callback
     *
     * @return void
     */
    public function klen_content_section_callback()
    {
        echo __('Content settings for Ecomail Newsletter', 'klen_admin');
    }

    /**
     * Title field callback
     *
     * @return void
     */
    public function klen_content_title_field_callback()
    {
        $content_title = get_option('klen_content_title');
        echo '<input type="text" name="klen_content_title" value="' . esc_attr__($content_title, 'klen_admin') . '"/>';
    }

    /**
     * Description field callback
     *
     * @return void
     */
    public function klen_content_desc_field_callback()
    {
        $content_desc = get_option('klen_content_desc');
        echo '<textarea name="klen_content_desc">' . esc_attr__($content_desc, 'klen_admin') . '</textarea>';
    }

    /**
     * Label field callback
     *
     * @return void
     */
    public function klen_content_label_field_callback()
    {
        $content_label = get_option('klen_content_label');
        echo '<input type="text" name="klen_content_label" value="' . esc_attr__($content_label, 'klen_admin') . '"/>';
    }

    /**
     * Placeholder field callback
     *
     * @return void
     */
    public function klen_content_placeholder_field_callback()
    {
        $content_placeholder = get_option('klen_content_placeholder');
        echo '<input type="text" name="klen_content_placeholder" value="' . esc_attr__($content_placeholder, 'klen_admin') . '"/>';
    }

    /**
     * Button field callback
     *
     * @return void
     */
    public function klen_content_button_field_callback()
    {
        $content_button = get_option('klen_content_button');
        echo '<input type="text" name="klen_content_button" value="' . esc_attr__($content_button, 'klen_admin') . '"/>';
    }

    /**
     * Success field callback
     *
     * @return void
     */
    public function klen_content_success_field_callback()
    {
        $content_success = get_option('klen_content_success');
        echo '<input type="text" name="klen_content_success" value="' . esc_attr__($content_success, 'klen_admin') . '"/>';
    }

    /**
     * Error field callback
     *
     * @return void
     */
    public function klen_content_error_field_callback()
    {
        $content_error = get_option('klen_content_error');
        echo '<input type="text" name="klen_content_error" value="' . esc_attr__($content_error, 'klen_admin') . '"/>';
    }

    /**
     * Label field callback
     *
     * @return void
     */
    public function klen_content_warning_field_callback()
    {
        $content_warning = get_option('klen_content_warning');
        echo '<input type="text" name="klen_content_warning" value="' . esc_attr__($content_warning, 'klen_admin') . '"/>';
    }

}

new KLEN_Ecomail_Content();