<?php 
/**
 * custom option and settings
 */
function klen_settings_init() {
    // Register a new settings general tab
    register_setting( 'klen_general', 'klen_api_key' );
	register_setting( 'klen_general', 'klen_list_id' );

	// Register a new settings content tab
    register_setting( 'klen_content', 'klen_content_title' );
	register_setting( 'klen_content', 'klen_content_desc' );
	register_setting( 'klen_content', 'klen_content_label' );
	register_setting( 'klen_content', 'klen_content_placeholder' );
	register_setting( 'klen_content', 'klen_content_button' );
	register_setting( 'klen_content', 'klen_content_success' );
	register_setting( 'klen_content', 'klen_content_error' );
	register_setting( 'klen_content', 'klen_content_warning' );

	// Register a new settings design tab
    register_setting( 'klen_design', 'klen_design_style' );
 
 
    // Register a new section in the "klen" page.
    add_settings_section(
        'klen_section_developers',
        __( 'General settings', 'klen_admin' ), 'klen_section_developers_callback',
        'klen_general'
    );
 
    // Register a new field in the "klen_section_developers" section, inside the "klen" page.
    add_settings_field(
        'klen_api_key_field', 
        __( 'API Key', 'klen' ),
        'klen_api_key_field_cb',
        'klen_general',
        'klen_section_developers',
        array(
            'label_for'         => 'klen_api_key_field',
            'class'             => 'klen_row',
        )
    );
	

	add_settings_field(
        'klen_list_id_field', 
        __( 'List ID', 'klen' ),
        'klen_list_id_field_cb',
        'klen_general',
        'klen_section_developers',
        array(
            'label_for'         => 'klen_list_id_field',
            'class'             => 'klen_row',
        )
    );
	}
	
	/**
	 * Register our klen_settings_init to the admin_init action hook.
	 */
	add_action( 'admin_init', 'klen_settings_init' );
	
	
	/**
	 * Custom option and settings:
	 *  - callback functions
	 */
	
	
	/**
	 * Developers section callback function.
	 *
	 * @param array $args  The settings array, defining title, id, callback.
	 */
	function klen_section_developers_callback( $args ) {
	/* 	?>
		<p id="<?php echo esc_attr( $args['id'] ); ?>"><?php esc_html_e( 'Lorem ipsum', 'klen' ); ?></p>
		<?php */
	}
	
	function klen_api_key_field_cb( $args ) {
		// Get the value of the setting we've registered with register_setting()
		$options = get_option( 'klen_api_key' );
		?>
		<input type="text" name="klen_api_key[<?php echo esc_attr( $args['label_for'] ); ?>]" id="<?php echo esc_attr( $args['label_for'] ); ?>" value="<?=$options['klen_api_key_field'];?>">

		<?php
	}

	function klen_list_id_field_cb( $args ) {
		// Get the value of the setting we've registered with register_setting()
		$options = get_option( 'klen_list_id' );
		?>
		<input type="number" name="klen_list_id[<?php echo esc_attr( $args['label_for'] ); ?>]" id="<?php echo esc_attr( $args['label_for'] ); ?>" value="<?=$options['klen_list_id_field'];?>">

		<?php
	}