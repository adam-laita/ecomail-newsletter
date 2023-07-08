<?php

/**
 * Class for the ecomail-newsletter shortcode.
 */
class KLEN_Ecomail_Shortcode {

	/**
	 * Constructor.
	 */
	public function __construct() {
		add_shortcode( 'ecomail-newsletter', array( $this, 'newsletterShortcode' ) );
		add_shortcode( 'ecomail-subscribers', array( $this, 'subscriberShortcode' ) );
		add_filter( 'klen_content', array( $this, 'contentFilter' ) );
	}

	/**
	 * Callback function for the ecomail-newsletter shortcode.
	 *
	 * @param array $atts Shortcode attributes.
	 *
	 * @return string Shortcode output.
	 */
	public function newsletterShortcode( $atts ) {
		// Default attributes for the shortcode.
		$default_atts = array(
			'align' => 'left'//center;right;
		);

		// Merge the passed attributes with the default attributes.
		$atts = shortcode_atts( $default_atts, $atts );

		// Get the API key and list ID from the options.
		$api_key = get_option( 'klen_api_key' );
		$list_id = get_option( 'klen_list_id' );

		// Check if the API key and list ID are set.
		if ( empty( $api_key ) || empty( $list_id ) ) {
			$api_message = '<span class="klen__alert klen__alert_warning open">' . $this->translateString( 'Ecomail Newsletter plugin is not configured correctly. Please check the API key and list ID settings.' ) . '</span>';

			return $api_message;
		}

		$style = get_option( 'klen_appearance_style' );

		if ( empty( $style ) || $style == 'default' ) {
			//Enqueue styles
			wp_enqueue_style( 'klen_form' );
		}

		//Enqueue scripts
		wp_enqueue_script( 'klen_form' );

		// Get the labels from the options.
		$title           = get_option( 'klen_labels_title' ) ? $this->translateString( get_option( 'klen_labels_title' ) ) : $this->translateString( 'Newsletter' );
		$description     = get_option( 'klen_labels_desc' ) ? $this->translateString( get_option( 'klen_labels_desc' ) ) : $this->translateString( 'Sign up for our newsletter to stay connected with us.' );
		$label           = get_option( 'klen_labels_label' ) ? $this->translateString( get_option( 'klen_labels_label' ) ) : $this->translateString( 'Your email address' );
		$placeholder     = get_option( 'klen_labels_placeholder' ) ? $this->translateString( get_option( 'klen_labels_placeholder' ) ) : $this->translateString( 'john.doe@gmail.com' );
		$button_text     = get_option( 'klen_labels_button' ) ? $this->translateString( get_option( 'klen_labels_button' ) ) : $this->translateString( 'Subscribe' );
		$success_message = get_option( 'klen_labels_success' ) ? $this->translateString( get_option( 'klen_labels_success' ) ) : $this->translateString( 'Thank you for subscribing!' );
		$error_message   = get_option( 'klen_labels_error' ) ? $this->translateString( get_option( 'klen_labels_error' ) ) : $this->translateString( 'There was an error processing your request.' );
		$warning_message = get_option( 'klen_labels_warning' ) ? $this->translateString( get_option( 'klen_labels_warning' ) ) : $this->translateString( 'Something went wrong, try again.' );

		ob_start(); ?>
        <div class="klen klen_align-<?= $atts['align']; ?>">
            <div class="klen__wrapper">
				<?php
				if ( ! empty( $title ) || ! empty( $description ) ) {
					echo '<div class="klen__text">';

					if ( ! empty( $title ) ) {
						echo '<span class="klen__text-title">' . esc_html( apply_filters( 'klen_content', $title ) ) . '</span>';
					}

					if ( ! empty( $description ) ) {
						echo ' <p>' . esc_html( apply_filters( 'klen_content', $description ) ) . '</p>';
					}

					echo '</div>';
				}
				?>

                <form class="klen__form" id="klen-ecomail-form" method="POST">
                    <div class="klen__form-field klen__form-field_email">
						<?php
						if ( ! empty( $label ) ) {
							echo '<label for="klen_email">' . esc_html( $label ) . '</label>';
						}
						?>

                        <input id="klen_email" type="email" name="email"
                               placeholder="<?php if ( ! empty( $placeholder ) ) {
							       echo esc_attr( $placeholder );
						       } ?>" required>
                    </div>

                    <div class="klen__form-field" style="display: none;">
                        <label for="klen_name"><?= $this->translateString( 'Leave this field blank' ); ?></label>
                        <input id="klen_name" type="text" name="your_name">
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
	public function subscriberShortcode( $atts ) {

		// Default attributes for the shortcode.
		$default_atts = array(
			'style' => 'default'//bold;italic;
		);

		// Merge the passed attributes with the default attributes.
		$atts = shortcode_atts( $default_atts, $atts );

		// Get the API key and list ID from the options.
		$api_key = get_option( 'klen_api_key' );
		$list_id = get_option( 'klen_list_id' );

		// Check if the API key and list ID are set.
		if ( empty( $api_key ) || empty( $list_id ) ) {
			$api_message = '<span class="klen__alert klen__alert_warning open">' . $this->translateString( 'Ecomail Newsletter plugin is not configured correctly. Please check the API key and list ID settings.' ) . '</span>';

			return $api_message;
		}

		$subscriberCount = get_option( 'klen_subscribers_count' ) ? get_option( 'klen_subscribers_count' ) : 0;

		return '<span class="klen-subscribers klen-subscribers_' . $atts['style'] . '">' . $subscriberCount . '</span>';
	}

	/**
	 * Filter content for custom variables
	 *
	 * @param $content
	 *
	 * @return array|string|string[]
	 */
	public function contentFilter( $content ) {
		$replacements = array(
			'{{count}}' => get_option( 'klen_subscribers_count' ) ? get_option( 'klen_subscribers_count' ) : 0
		);
		$content      = str_replace( array_keys( $replacements ), array_values( $replacements ), $content );

		return $content;
	}

	/**
	 * Based on plugin, return correct function for translating
	 *
	 * @param $string
	 *
	 * @return string
	 */
	public function translateString( $string ) {

		if ( function_exists( 'pll__' ) ) {
			return pll__( $string );
		}

		return __( $string, 'klen' );
	}
}

new KLEN_Ecomail_Shortcode();