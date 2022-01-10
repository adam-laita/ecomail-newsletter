<?php 

	/* ------------------------------ ADMIN PAGE ------------------------------ */

	// Add admin page
    function klen_admin_page() {
        add_menu_page(
            __('Ecomail newsletter','klen_admin'),
            __('Ecomail newsletter','klen_admin'),
            'manage_options',
            'klen_admin_page',
            'klen_admin_page_html'
        );
    }

    /**
     * Register our leadhub_options_page to the admin_menu action hook.
     */
    add_action( 'admin_menu', 'klen_admin_page' );

    function klen_admin_page_html(){
        include "admin-view.php";
    }
    