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
		Domain Path: /languages
	*/

	/* ------------------------------ CONSTANTS ------------------------------ */

	// Paths of plugin
	define( 'KLEN_PATH_DIR', plugin_dir_path( __FILE__ ) );
	define( 'KLEN_PATH_URL', plugin_dir_url( __FILE__ ) );
	define( 'KLEN_BASENAME', plugin_basename( __FILE__ ) );

	// Ecomail API
	//define( 'KLEN_API_KEY', ECOMAIL_API_KEY_XXXYYYZZZ );
	//define( 'KLEN_API_LIST_ID', ECOMAIL_API_LIST_ID_XX );

	/* ------------------------------ FUNCTIONS ------------------------------ */

	require_once KLEN_PATH_DIR . '/functions/shortcodes.php';
	require_once KLEN_PATH_DIR . '/functions/admin.php';


	/* ------------------------------ STYLES ------------------------------ */

	// Sets styles and scripts for Front-End
	add_action( 'wp_enqueue_scripts', 'klen_frontend_assets' );

	function klen_frontend_assets()
	{

		//-------------------------------------------------------------------
		// CSS
		//-------------------------------------------------------------------

		// Styles for Ecomail form
		wp_register_style( 'klen_form', KLEN_PATH_URL . '/assets/css/klen-form.css', null, null, 'all' );

		//-------------------------------------------------------------------
		// JS
		//-------------------------------------------------------------------

		// Scripts for Ecomail form
		wp_register_script( 'klen_form', KLEN_PATH_URL . '/assets/js/klen-form.js', null, null, true );

	}

	// Sets styles and scripts for Back-End
	add_action( 'admin_enqueue_scripts', 'klen_backend_assets' );

	function klen_backend_assets()
	{

		//-------------------------------------------------------------------
		// CSS
		//-------------------------------------------------------------------

		// Styles for admin
		wp_enqueue_style( 'klen_admin', KLEN_PATH_URL . '/assets/css/klen-admin.css', null, null, 'all' );

		// Styles for Ecomail form
		wp_enqueue_style( 'klen_form', KLEN_PATH_URL . '/assets/css/klen-form.css', null, null, 'all' );

		//-------------------------------------------------------------------
		// JS
		//-------------------------------------------------------------------

		// Scripts for Ecomail form
		wp_enqueue_script( 'klen_form', KLEN_PATH_URL . '/assets/js/klen-form.js', null, null, true );

	}