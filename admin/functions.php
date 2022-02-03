<?php 

	/* ------------------------------ ADMIN PAGE ------------------------------ */
	/* --- PLUGIN LIST --- */

	// adds links to plugin in plugin list page
	add_action( 'plugin_action_links_' . KLEN_BASENAME, 'klen_action_links' );

	function klen_action_links( $links ) {

		$links = array_merge( $links, array(
			'<a href="' . esc_url( admin_url( '/options-general.php?page=klen_admin_page' ) ) . '">' . __( 'Settings', 'klen_admin' ) . '</a>'
		) );
	
		return $links;
	
	}

	/* --- PLUGIN PAGE --- */

	// Register our klen_api_key_page to the admin_menu action hook
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
		require_once KLEN_PATH_DIR . '/admin/admin-view.php';
	}

	//Include settings files
	require_once KLEN_PATH_DIR . '/admin/settings-general.php';
	require_once KLEN_PATH_DIR . '/admin/settings-content.php';
	require_once KLEN_PATH_DIR . '/admin/settings-design.php';

	