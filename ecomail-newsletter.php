<?php
	/*
		Plugin Name: Ecomail Newsletter
		Plugin URI:  https://www.example.com/
		Description: Ecomail Newsletter plugin.
		Version:     1.0
		Author:      Adam Laita, Daniel Koch
		Author URI:  https://www.example.com/
		License:     GPL3
		License URI: https://www.gnu.org/licenses/gpl-3.0.html
		Text Domain: klen
		Domain Path: /languages
	*/

	/* ------------------------------ CONSTANTS ------------------------------ */

	// Paths
	define( 'KLEN_PATH', __DIR__ );

	/* ------------------------------ FUNCTIONS ------------------------------ */

	require_once KLEN_PATH . '/functions/shortcodes.php';

	/* ------------------------------ STYLES ------------------------------ */

	// Sets styles and scripts for Front-End
	add_action( 'wp_enqueue_scripts', 'klen_frontend_assets' );

	function klen_frontend_assets()
	{

		//-------------------------------------------------------------------
		// CSS
		//-------------------------------------------------------------------

		// Styles for Ecomail form
		wp_register_style( 'klen_form', KLEN_PATH . '/assets/css/form.css', null, null, 'all' );

		//-------------------------------------------------------------------
		// JS
		//-------------------------------------------------------------------

		// Scripts for Ecomail form
		wp_register_script( 'klen_form', KLEN_PATH . '/assets/js/form.js', null, null, true );

	}