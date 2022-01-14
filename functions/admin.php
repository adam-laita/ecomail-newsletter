<?php 

	/* ------------------------------ ADMIN PAGE ------------------------------ */

	// Register our klen_options_page to the admin_menu action hook
	add_action( 'admin_menu', 'klen_admin_page' );

	function klen_admin_page() {

		add_submenu_page(
			'options-general.php',
			__('Ecomail newsletter','klen_admin'),
			__('Ecomail newsletter','klen_admin'),
			'manage_options',
			'klen_admin_page',
			'klen_admin_page_callback'
		);
	}

	// Callback for output
	function klen_admin_page_callback() {
		require_once KLEN_PATH_DIR . '/functions/admin-view.php';
	}