<?php

/**
 * Class for appearance settings of the plugin
 */
class KLEN_Ecomail_Appearance
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
		add_action('admin_init', array($this, 'setupSectionFields'));
	}

	/**
	 * Register settings sections
	 *
	 * @return void
	 */
	public function setupSectionFields()
	{

		add_settings_section(
			'klen_appearance_settings',
			__('Appearance Settings', 'klen'),
			array($this, 'sectionCallback'),
			'klen_appearance'
		);

		add_settings_field(
			'klen_appearance_style_field',
			__('Form Style', 'klen'),
			array($this, 'styleFieldCallback'),
			'klen_appearance',
			'klen_appearance_settings'
		);

	}

	/**
	 * Appearance section callback
	 *
	 * @return void
	 */
	public function sectionCallback()
	{
		echo __( 'In this setting, you can select the desired form style.', 'klen' );
	}

	/**
	 * Form Style field callback
	 *
	 * @return void
	 */
	public function styleFieldCallback()
	{
		$style = get_option('klen_appearance_style') ? get_option('klen_appearance_style') : 'default';

		echo '<select class="klen-input klen-input_appearance klen-input_apperance-style" name="klen_appearance_style">';
		echo '<option value="default" ' . selected($style, 'default', false) . '>' . __('Default', 'klen') . '</option>';
		echo '<option value="none" ' . selected($style, 'none', false) . '>' . __('None', 'klen') . '</option>';
		echo '</select>';
	}

}

new KLEN_Ecomail_Appearance();
