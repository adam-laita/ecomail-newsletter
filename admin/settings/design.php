<?php

/**
 * Class for design settings of the plugin
 */
class KLEN_Ecomail_Design
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
            'klen_design_settings',
            __('Design Settings', 'klen_admin'),
            array($this, 'klen_design_section_callback'),
            'klen_design'
        );

        add_settings_field(
            'klen_design_style_field',
            __('Form Style', 'klen_admin'),
            array($this, 'klen_design_style_field_callback'),
            'klen_design',
            'klen_design_settings'
        );

    }

    /**
     * Design section callback
     *
     * @return void
     */
    public function klen_design_section_callback()
    {
        echo __('Design settings for Ecomail Newsletter form', 'klen_admin');
    }

    /**
     * Form Style field callback
     *
     * @return void
     */
    public function klen_design_style_field_callback()
    {
        $style = get_option('klen_design_style');
        echo '<select name="klen_design_style">';
        echo '<option value="default" ' . selected($style, 'default', false) . '>' . __('Default', 'klen_admin') . '</option>';
        echo '<option value="custom" ' . selected($style, 'custom', false) . '>' . __('Custom', 'klen_admin') . '</option>';
        echo '</select>';
    }

}

new KLEN_Ecomail_Design();
