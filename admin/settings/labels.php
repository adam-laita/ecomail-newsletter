<?php

/**
 * Class for labels settings of the plugin
 */
class KLEN_Ecomail_Labels
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
		add_action( 'admin_init', array( $this, 'fields_setup' ) );
	}

	/**
	 * Register settings sections
	 *
	 * @return void
	 */
	public function fields_setup()
	{

		add_settings_section(
			'klen_labels_settings',
			__('Labels Settings', 'klen'),
			array($this, 'klen_labels_section_callback'),
			'klen_labels'
		);

		add_settings_field(
			'klen_labels_title_field',
			__('Title', 'klen'),
			array($this, 'klen_labels_title_field_callback'),
			'klen_labels',
			'klen_labels_settings'
		);

		add_settings_field(
			'klen_labels_desc_field',
			__('Description', 'klen'),
			array($this, 'klen_labels_desc_field_callback'),
			'klen_labels',
			'klen_labels_settings'
		);

		add_settings_field(
			'klen_labels_label_field',
			__('Label', 'klen'),
			array($this, 'klen_labels_label_field_callback'),
			'klen_labels',
			'klen_labels_settings'
		);

		add_settings_field(
			'klen_labels_placeholder_field',
			__('Placeholder', 'klen'),
			array($this, 'klen_labels_placeholder_field_callback'),
			'klen_labels',
			'klen_labels_settings'
		);

		add_settings_field(
			'klen_labels_button_field',
			__('Button Text', 'klen')  . ' <span class="klen-label_required">*</span>',
			array($this, 'klen_labels_button_field_callback'),
			'klen_labels',
			'klen_labels_settings'
		);

		add_settings_field(
			'klen_labels_success_field',
			__('Success Message', 'klen')  . ' <span class="klen-label_required">*</span>',
			array($this, 'klen_labels_success_field_callback'),
			'klen_labels',
			'klen_labels_settings'
		);

		add_settings_field(
			'klen_labels_error_field',
			__('Error Message', 'klen')  . ' <span class="klen-label_required">*</span>',
			array($this, 'klen_labels_error_field_callback'),
			'klen_labels',
			'klen_labels_settings'
		);

		add_settings_field(
			'klen_labels_warning_field',
			__('Warning Message', 'klen')  . ' <span class="klen-label_required">*</span>',
			array($this, 'klen_labels_warning_field_callback'),
			'klen_labels',
			'klen_labels_settings'
		);

	}

	/**
	 * Labels section callback
	 *
	 * @return void
	 */
	public function klen_labels_section_callback()
	{
		echo __('You can change the form labels in this setting.', 'klen');
	}

	/**
	 * Title field callback
	 *
	 * @return void
	 */
	public function klen_labels_title_field_callback()
	{
		$labels_title = get_option('klen_labels_title') === false ? __('Newsletter', 'klen') : get_option('klen_labels_title');

		echo '<input class="klen-input klen-input_labels klen-input_labels-title" type="text" name="klen_labels_title" value="' . esc_attr__($labels_title, 'klen') . '">';
	}

	/**
	 * Description field callback
	 *
	 * @return void
	 */
	public function klen_labels_desc_field_callback()
	{
		$labels_desc = get_option('klen_labels_desc') === false ? __('Sign up for our newsletter to stay connected with us.', 'klen') : get_option('klen_labels_desc');

		echo '<textarea class="klen-input klen-input_labels klen-input_labels-desc" name="klen_labels_desc">' . esc_attr__($labels_desc, 'klen') . '</textarea>';
	}

	/**
	 * Label field callback
	 *
	 * @return void
	 */
	public function klen_labels_label_field_callback()
	{
		$labels_label = get_option('klen_labels_label') === false ? __('Your email address', 'klen') : get_option('klen_labels_label');

		echo '<input class="klen-input klen-input_labels klen-input_labels-label" type="text" name="klen_labels_label" value="' . esc_attr__($labels_label, 'klen') . '">';
	}

	/**
	 * Placeholder field callback
	 *
	 * @return void
	 */
	public function klen_labels_placeholder_field_callback()
	{
		$labels_placeholder = get_option('klen_labels_placeholder') === false ? __('john.doe@gmail.com', 'klen') : get_option('klen_labels_placeholder');

		echo '<input class="klen-input klen-input_labels klen-input_labels-placeholder" type="text" name="klen_labels_placeholder" value="' . esc_attr__($labels_placeholder, 'klen') . '">';
	}

	/**
	 * Button field callback
	 *
	 * @return void
	 */
	public function klen_labels_button_field_callback()
	{
		$labels_button = get_option('klen_labels_button') === false ? __('Subscribe', 'klen') : get_option('klen_labels_button');

		echo '<input class="klen-input klen-input_labels klen-input_labels-button" type="text" name="klen_labels_button" value="' . esc_attr__($labels_button, 'klen') . '" required>';
	}

	/**
	 * Success field callback
	 *
	 * @return void
	 */
	public function klen_labels_success_field_callback()
	{
		$labels_success = get_option('klen_labels_success') === false ? __('Thank you for subscribing!', 'klen') : get_option('klen_labels_success');

		echo '<input class="klen-input klen-input_labels klen-input_labels-success" type="text" name="klen_labels_success" value="' . esc_attr__($labels_success, 'klen') . '" required>';
	}

	/**
	 * Error field callback
	 *
	 * @return void
	 */
	public function klen_labels_error_field_callback()
	{
		$labels_error = get_option('klen_labels_error') === false ? __('There was an error processing your request.', 'klen') : get_option('klen_labels_error');

		echo '<input class="klen-input klen-input_labels klen-input_labels-error" type="text" name="klen_labels_error" value="' . esc_attr__($labels_error, 'klen') . '" required>';
	}

	/**
	 * Label field callback
	 *
	 * @return void
	 */
	public function klen_labels_warning_field_callback()
	{
		$labels_warning = get_option('klen_labels_warning') === false ? __('Something went wrong, try again.', 'klen') : get_option('klen_labels_warning');

		echo '<input class="klen-input klen-input_labels klen-input_labels-warning" type="text" name="klen_labels_warning" value="' . esc_attr__($labels_warning, 'klen') . '" required>';
	}

}

new KLEN_Ecomail_Labels();