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

		$title       = get_option( 'klen_labels_title' ) ? get_option( 'klen_labels_title' ) : 'Title';
		$desc        = get_option( 'klen_labels_desc' ) ? get_option( 'klen_labels_desc' ) : 'Description';
		$label       = get_option( 'klen_labels_label' ) ? get_option( 'klen_labels_label' ) : 'Label';
		$placeholder = get_option( 'klen_labels_placeholder' ) ? get_option( 'klen_labels_placeholder' ) : 'Placeholder';
		$button      = get_option( 'klen_labels_button' ) ? get_option( 'klen_labels_button' ) : 'Button Text';
		$success     = get_option( 'klen_labels_success' ) ? get_option( 'klen_labels_success' ) : 'Success Message';
		$error       = get_option( 'klen_labels_error' ) ? get_option( 'klen_labels_error' ) : 'Error Message';
		$warning     = get_option( 'klen_labels_warning' ) ? get_option( 'klen_labels_warning' ) : 'Warning Message';

		pll_register_string( 'klen', $title );
		pll_register_string( 'klen', $desc );
		pll_register_string( 'klen', $label );
		pll_register_string( 'klen', $placeholder );
		pll_register_string( 'klen', $button );
		pll_register_string( 'klen', $success );
		pll_register_string( 'klen', $error );
		pll_register_string( 'klen', $warning );

	}

}

new KLEN_Ecomail_Translations();
