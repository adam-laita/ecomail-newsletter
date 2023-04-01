<?php

/**
 * Class for the ecomail-newsletter shortcode.
 */
class KLEN_Ecomail_Shortcode
{

	/**
	 * Constructor.
	 */
	public function __construct()
	{
		add_shortcode('ecomail-newsletter', array($this, 'newsletterShortcode'));
        add_shortcode('ecomail-subscribers', array($this, 'subscriberShortcode'));
        add_filter( 'klen_content', array($this, 'contentFilter') );
    }

	/**
	 * Callback function for the ecomail-newsletter shortcode.
	 *
	 * @param array $atts Shortcode attributes.
	 *
	 * @return string Shortcode output.
	 */
	public function newsletterShortcode($atts)
	{
        // Default attributes for the shortcode.
        $default_atts = array(
            'align' => 'left'//center;right;
        );

        // Merge the passed attributes with the default attributes.
        $atts = shortcode_atts( $default_atts, $atts );

		// Get the API key and list ID from the options.
		$api_key = get_option('klen_api_key');
		$list_id = get_option('klen_list_id');

		// Check if the API key and list ID are set.
		if ( empty( $api_key ) || empty( $list_id ) ) {
			$api_message = '<span class="klen__alert klen__alert_warning open">' . __( 'Ecomail Newsletter plugin is not configured correctly. Please check the API key and list ID settings.', 'klen' ) . '</span>';
			
			return $api_message;
		}

		$style = get_option('klen_appearance_style');

		if (empty($style) || $style == 'default') {
			//Enqueue styles
			wp_enqueue_style('klen_form');
		}

		//Enqueue scripts
		wp_enqueue_script('klen_form');

		// Get the labels from the options.
		$title = get_option('klen_labels_title', __('Newsletter', 'klen'));
		$description = get_option('klen_labels_desc', __('Sign up for our newsletter to stay connected with us.', 'klen'));
		$label = get_option('klen_labels_label', __('Your email address', 'klen'));
		$placeholder = get_option('klen_labels_placeholder', __('john.doe@gmail.com', 'klen'));
		$button_text = get_option('klen_labels_button', __('Subscribe', 'klen'));
		$success_message = get_option('klen_labels_success', __('Thank you for subscribing!', 'klen'));
		$error_message = get_option('klen_labels_error', __('There was an error processing your request.', 'klen'));
		$warning_message = get_option('klen_labels_warning', __('Something went wrong, try again.', 'klen'));

		ob_start(); ?>
		<div class="klen klen_align-<?=$atts['align'];?>">
			<div class="klen__wrapper">
				<?php
					if ( !empty( $title ) || !empty( $description ) ) {
						echo '<div class="klen__text">';

						if ( !empty( $title ) ) {
							echo '<span class="klen__text-title">' . esc_html( apply_filters( 'klen_content',$title ) ) . '</span>';
						}

						if ( !empty( $description ) ) {
							echo ' <p>' . esc_html( apply_filters( 'klen_content',$description )) . '</p>';
						}

						echo '</div>';
					}
				?>

				<form class="klen__form" id="klen-ecomail-form" method="POST">
					<div class="klen__form-field klen__form-field_email">
						<?php
							if ( !empty( $label ) ) {
								echo '<label for="klen_email">' . esc_html( $label ) . '</label>';
							}
						?>

						<input id="klen_email" type="email" name="email" placeholder="<?php if ( !empty( $placeholder ) ) { echo esc_attr( $placeholder ); } ?>" required>
					</div>

					<div class="klen__form-field klen__form-field_submit">
						<input type="submit" value="<?= esc_attr( $button_text ); ?>">
					</div>
				</form>

				<div class="klen__alerts">
					<div class="klen__alert klen__alert_success" id="klen_success">
						<p><?= esc_html( $success_message ); ?></p>
					</div>

					<div class="klen__alert klen__alert_error" id="klen_error">
						<p><?= esc_html( $error_message ); ?></p>
					</div>

					<div class="klen__alert klen__alert_warning" id="klen_warning">
						<p><?= esc_html( $warning_message ); ?></p>
					</div>
				</div>
			</div>
		</div>
		<?php return ob_get_clean();
	}

    /**
     * Callback function for the subscriber shortcode.
     *
     * @return string Shortcode output.
     */
    public function subscriberShortcode($atts)
    {

        // Default attributes for the shortcode.
        $default_atts = array(
            'style' => 'default'//bold;italic;
        );

        // Merge the passed attributes with the default attributes.
        $atts = shortcode_atts( $default_atts, $atts );

        // Get the API key and list ID from the options.
        $api_key = get_option('klen_api_key');
        $list_id = get_option('klen_list_id');

        // Check if the API key and list ID are set.
        if ( empty( $api_key ) || empty( $list_id ) ) {
            $api_message = '<span class="klen__alert klen__alert_warning open">' . __( 'Ecomail Newsletter plugin is not configured correctly. Please check the API key and list ID settings.', 'klen' ) . '</span>';

            return $api_message;
        }

        $subscriberCount =  get_option('klen_subscribers_count') ? get_option('klen_subscribers_count') : 0;

        return '<span class="klen-subscribers klen-subscribers_'.$atts['style'].'">'.$subscriberCount.'</span>';
    }

    /**
     * Filter content for custom variables
     *
     * @param $content
     * @return array|string|string[]
     */
    public function contentFilter($content) {
        $replacements = array(
            '{{count}}' => get_option('klen_subscribers_count') ? get_option('klen_subscribers_count') : 0
        );
        $content = str_replace( array_keys( $replacements ), array_values( $replacements ), $content );
        return $content;
    }
}

new KLEN_Ecomail_Shortcode();