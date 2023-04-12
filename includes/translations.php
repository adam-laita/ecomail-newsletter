<?php


/**
 * Class for translations of plugins
 */
class KLEN_Ecomail_Translations {

	/**
	 *
	 */
	public function __construct() {
		$this->actions();
	}

	/**
	 * Actions and hooks
	 *
	 * @return void
	 */
	public function actions() {
		add_action( 'init', array( $this, 'WpmlTranslations' ) );
		add_action( 'init', array( $this, 'PolylangTranslations' ) );
	}

	/**
	 * Register Strings for WPML
	 *
	 * @return void
	 */
	public function WpmlTranslations() {
		if ( ! function_exists( 'icl_register_string' ) ) {
			return;
		}

		icl_register_string( 'klen', __( 'Title', 'klen' ), get_option( 'klen_labels_title' ) );
		icl_register_string( 'klen', __( 'Description', 'klen' ), get_option( 'klen_labels_desc' ) );
		icl_register_string( 'klen', __( 'Label', 'klen' ), get_option( 'klen_labels_label' ) );
		icl_register_string( 'klen', __( 'Placeholder', 'klen' ), get_option( 'klen_labels_placeholder' ) );
		icl_register_string( 'klen', __( 'Button Text', 'klen' ), get_option( 'klen_labels_button' ) );
		icl_register_string( 'klen', __( 'Success Message', 'klen' ), get_option( 'klen_labels_success' ) );
		icl_register_string( 'klen', __( 'Error Message', 'klen' ), get_option( 'klen_labels_error' ) );
		icl_register_string( 'klen', __( 'Warning Message', 'klen' ), get_option( 'klen_labels_warning' ) );

	}

	/**
	 * Register Strings for Polylang
	 *
	 * @return void
	 */
	public function PolylangTranslations() {
		if ( ! function_exists( 'pll_register_string' ) ) {
			return;
		}

		pll_register_string( __( 'Title', 'klen' ), get_option( 'klen_labels_title' ), 'klen' );
		pll_register_string( __( 'Description', 'klen' ), get_option( 'klen_labels_desc' ), 'klen' );
		pll_register_string( __( 'Label', 'klen' ), get_option( 'klen_labels_label' ), 'klen' );
		pll_register_string( __( 'Placeholder', 'klen' ), get_option( 'klen_labels_placeholder' ), 'klen' );
		pll_register_string( __( 'Button Text', 'klen' ), get_option( 'klen_labels_button' ), 'klen' );
		pll_register_string( __( 'Success Message', 'klen' ), get_option( 'klen_labels_success' ), 'klen' );
		pll_register_string( __( 'Error Message', 'klen' ), get_option( 'klen_labels_error' ), 'klen' );
		pll_register_string( __( 'Warning Message', 'klen' ), get_option( 'klen_labels_warning' ), 'klen' );

	}

}

new KLEN_Ecomail_Translations();
