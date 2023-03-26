<?php
/*
		Plugin Name: Ecomail Newsletter
		Plugin URI:  https://www.example.com/
		Description: Ecomail Newsletter plugin.
		Version:     1.0.0
		Author:      Daniel Koch, Adam Laita
		Author URI:  https://www.example.com/
		License:     GPL3
		License URI: https://www.gnu.org/licenses/gpl-3.0.html
		Text Domain: klen
*/

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

// Path, directory & basename
define('KLEN_PATH_DIR', plugin_dir_path(__FILE__));
define('KLEN_PATH_URL', plugin_dir_url(__FILE__));
define('KLEN_BASENAME', plugin_basename(__FILE__));

class KLEN_Ecomail
{
    /**
     * Plugin meta
     *
     * @var string
     */
    public $plugin_meta;

    /**
     *
     */
    public function __construct()
    {
        $this->actions();
        $this->load_plugin_files();
        $this->admin_settings_fields();
        //$this->init_updater();
    }

    /**
     * List all actions of the plugin
     *
     * @return void
     */
    private function actions()
    {
        add_action('wp_enqueue_scripts', array($this, 'register_frontend_scripts'));
        add_action('admin_enqueue_scripts', array($this, 'register_admin_scripts'));
        add_action('admin_menu', array($this, 'create_admin_page'));
    }

    /**
     * @return void
     */
    private function load_plugin_files()
    {
        require_once KLEN_PATH_DIR . '/admin/settings/content.php';
        require_once KLEN_PATH_DIR . '/admin/settings/design.php';
        require_once KLEN_PATH_DIR . '/admin/settings/general.php';
        require_once KLEN_PATH_DIR . '/includes/request.php';
        require_once KLEN_PATH_DIR . '/includes/shortcode.php';
        //require_once KLEN_PATH_DIR . '/includes/updater.php';
    }

    /**
     * Register all frontend scripts used in plugin
     *
     * @return void
     */
    public function register_frontend_scripts()
    {
        $plugin_meta = get_plugin_data(__FILE__);

        // Styles for Ecomail form
        wp_register_style('klen_form', KLEN_PATH_URL . '/assets/css/klen-form.css', null, $plugin_meta['Version'], 'all');

        // Scripts for Ecomail form
        wp_register_script('klen_form', KLEN_PATH_URL . '/assets/js/klen-form.js', null, $plugin_meta['Version'], true);
    }

    /**
     * Register all admin scripts used in plugin
     *
     * @return void
     */
    public function register_admin_scripts()
    {
        $plugin_meta = get_plugin_data(__FILE__);

        // Styles for admin
        wp_enqueue_style('klen_admin', KLEN_PATH_URL . '/assets/css/klen-admin.css', null, $plugin_meta['Version'], 'all');

        // Styles for Ecomail form
        wp_enqueue_style('klen_form', KLEN_PATH_URL . '/assets/css/klen-form.css', null, $plugin_meta['Version'], 'all');

        // Scripts for Ecomail form
        wp_enqueue_script('klen_form', KLEN_PATH_URL . '/assets/js/klen-form.js', null, $plugin_meta['Version'], true);
    }

    /**
     * Create admin menu page
     *
     * @return void
     */
    public function create_admin_page()
    {
        add_submenu_page(
            'options-general.php',
            __('Ecomail newsletter', 'klen_admin'),
            __('Ecomail newsletter', 'klen_admin'),
            'manage_options',
            'klen_admin_page',
            array($this, 'admin_page_template')
        );
    }

    /**
     * Admin menu page content callback
     *
     * @return void
     */
    public function admin_page_template()
    {
        require_once KLEN_PATH_DIR . '/admin/settings/template.php';
    }

    public function admin_settings_fields()
    {

        // Register a new settings general tab
        register_setting('klen_general', 'klen_api_key');
        register_setting('klen_general', 'klen_list_id');

        // Register a new settings content tab
        register_setting('klen_content', 'klen_content_title');
        register_setting('klen_content', 'klen_content_desc');
        register_setting('klen_content', 'klen_content_label');
        register_setting('klen_content', 'klen_content_placeholder');
        register_setting('klen_content', 'klen_content_button');
        register_setting('klen_content', 'klen_content_success');
        register_setting('klen_content', 'klen_content_error');
        register_setting('klen_content', 'klen_content_warning');

        // Register a new settings design tab
        register_setting('klen_design', 'klen_design_style');
    }

    /**
     * GitHub updater before release to WP repository
     *
     * @return void
     */
    private function init_updater()
    {
        $updater = new KLEN_Updater(__FILE__);
        $updater->set_username('');
        $updater->set_repository('');
        $updater->authorize('');

        $updater->initialize();
    }

}

new KLEN_Ecomail();