<?php


/**
 * Class for translations of plugins
 */
class KLEN_Ecomail_Translations
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
        add_action('init', array($this, 'WpmlTranslations'));
        //add_action('init', array($this, 'WpmlTranslations'));
    }

    /**
     * Register Strings for WPML
     *
     * @return void
     */
    public function WpmlTranslations()
    {
        if (!function_exists('icl_register_string')) {
            return;
        }

        icl_register_string('klen', __('Title', 'klen'), get_option('klen_labels_title'));
        icl_register_string('klen', __('Description', 'klen'), get_option('klen_labels_desc'));
        icl_register_string('klen', __('Label', 'klen'), get_option('klen_labels_label'));
        icl_register_string('klen', __('Placeholder', 'klen'), get_option('klen_labels_placeholder'));
        icl_register_string('klen', __('Button Text', 'klen'), get_option('klen_labels_button'));
        icl_register_string('klen', __('Success Message', 'klen'), get_option('klen_labels_success'));
        icl_register_string('klen', __('Error Message', 'klen'), get_option('klen_labels_error'));
        icl_register_string('klen', __('Warning Message', 'klen'), get_option('klen_labels_warning'));

    }

}

new KLEN_Ecomail_Translations();
